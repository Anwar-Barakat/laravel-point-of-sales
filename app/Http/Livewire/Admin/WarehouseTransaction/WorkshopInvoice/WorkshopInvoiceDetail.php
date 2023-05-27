<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\WorkshopInvoice;

use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\Store;
use App\Models\Unit;
use App\Models\Workshop;
use App\Models\WorkshopInvoice;
use App\Models\WorkshopInvoiceItem;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class WorkshopInvoiceDetail extends Component
{


    use WithPagination;

    public WorkshopInvoice $invoice;
    public WorkshopInvoiceItem $product;

    public $stores         = [],
        $items          = [];
    public $batches, $unit, $item, $batch;

    protected $listeners = ['updateWorkshopProducts'];

    public function updateWorkshopProducts(WorkshopInvoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function mount(WorkshopInvoice $invoice, WorkshopInvoiceItem $product)
    {
        $this->invoice              = $invoice;
        $this->product              = $product;
        $this->product->qty         = 1;
        $this->stores               = Store::active()->get();
        $this->items                = Item::active()->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function updatedProductStoreId()
    {
        if ($this->product->item_id && $this->product->unit_id)
            $this->batches  = getBatches($this->product);
    }

    public function updatedProductItemId()
    {
        $this->item = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        if ($this->product->item_id && $this->product->unit_id)
            $this->batches  = getBatches($this->product);

        if ($this->batch)
            $this->product->unit_price = $this->batch->unit_price;
    }

    public function updatedProductUnitId()
    {
        $this->getItemAndUnit();
        $this->batches  = getBatches($this->product);
        calc_total_price($this->product);
    }

    public function updatedProductItemBatchId($value)
    {
        $this->batch = ItemBatch::findOrFail($value);
        $this->product->unit_price = $this->batch->unit_price;
        calc_total_price($this->product);
    }

    public function calcPrice()
    {
        if (!$this->batch) {
            toastr()->error(__('validation.select_item_batch'));
            $this->product->qty = 1;
        }

        if (isset($this->batch->qty)) {
            $batchQty = $this->unit->status == 'wholesale' ? $this->batch->qty : $this->batch->qty * $this->item->retail_count_for_wholesale;

            if ($this->product->qty > $batchQty) {
                toastr()->error(__('validation.qty_not_available_now'));
                $this->product->qty = 1;
            }
        }
        if ($this->product->qty && $this->product->unit_price)
            calc_total_price($this->product);
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.workshop-invoice.workshop-invoice-detail', ['workshopItems' => $this->getWorkshopItems()]);
    }

    public function rules(): array
    {
        return [
            'product.store_id'         => ['required', 'integer'],
            'product.unit_id'          => ['required', 'integer'],
            'product.item_id'          => [
                'required',
                'integer',
                Rule::unique('workshop_invoice_items', 'item_id')->where(function ($query) {
                    return $query->where(['workshop_invoice_id' => $this->invoice->id, 'unit_id' => $this->product->unit_id, 'company_id' => get_auth_com()]);
                })->ignore($this->product->id)
            ],
            'product.item_batch_id'    => ['required', 'integer'],
            'product.unit_price'       => ['required', 'numeric', 'min:1'],
            'product.qty'              => ['required', 'integer', 'min:1'],
            'product.total_price'      => ['required', 'numeric', 'min:1'],
        ];
    }


    public function getWorkshopItems()
    {
        return WorkshopInvoiceItem::where('workshop_invoice_id', $this->invoice->id)
            ->where('company_id', get_auth_com())->paginate(CUSTOM_PAGINATION - 5);
    }

    public function getItemAndUnit()
    {
        $this->item = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        $this->unit = Unit::select('id', 'name', 'status')->findOrFail($this->product->unit_id);
    }
}