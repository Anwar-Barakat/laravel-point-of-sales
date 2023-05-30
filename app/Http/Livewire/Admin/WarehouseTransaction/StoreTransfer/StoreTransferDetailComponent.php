<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\StoreTransfer;

use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\StoreTransfer;
use App\Models\StoreTransferDetail;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class StoreTransferDetailComponent extends Component
{
    use WithPagination;

    public StoreTransfer $transfer;
    public $product;

    public $items = [], $item, $unit;
    public $batches = [], $batch;

    protected $listeners = ['updateStoreTransfer'];

    public function updateStoreTransfer(StoreTransfer $transfer)
    {
        $this->transfer = $transfer;
    }

    public function mount(StoreTransfer $transfer, StoreTransferDetail $product)
    {
        $this->transfer                 = $transfer;
        $this->product                  = $product ?? new StoreTransferDetail();
        $this->transfer->transfer_date  = date('Y-m-d');
        $this->product->qty             = 1;
        $this->transfer->is_approved    == 0 ?  $this->items = Item::select('id', 'name')->active()->get() : [];
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
    }

    public function updatedProductItemBatchId($value)
    {
        $this->batch = ItemBatch::findOrFail($value);
        $this->product->unit_price = get_unit_price($this->unit, $this->batch);
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

    public function submit()
    {
        $this->validate();
        try {
            DB::beginTransaction();

            $this->product->fill([
                'store_transfer_id'     => $this->transfer->id,
                'added_by'              => get_auth_id(),
                'company_id'            => get_auth_com(),
            ])->save();

            $totalPrices    = StoreTransferDetail::where('store_transfer_id', $this->transfer->id)->where('company_id', get_auth_com())->sum('total_price');
            $this->transfer->fill(['items_cost' => $totalPrices])->save();

            $this->batch->qty           -= $this->product->qty;
            $this->batch->total_price   = $this->batch->qty * $this->batch->unit_price;
            $this->batch->save();

            DB::commit();
            toastr()->success(__('msgs.added', ['name' => __('transaction.store_transfer')]));
            $this->emit('updateStoreTransfer', ['transfer' => $this->transfer]);
            $this->reset('product');
            $this->product =  new StoreTransferDetail();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.store-transfers.show', ['store_transfer' => $this->transfer])->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.store-transfer.store-transfer-detail-component', ['storeTransferItems' => $this->getStoreTransferItems()]);
    }

    public function rules(): array
    {
        return [
            'product.item_id'           => [
                'required',
                Rule::unique('store_transfer_details', 'item_id')->where(function ($query) {
                    return $query->where('company_id', get_auth_com())
                        ->where('unit_id', $this->product->unit_id)
                        ->where('store_transfer_id', $this->transfer->id);
                })->ignore($this->product->id)
            ],
            'product.item_batch_id'     => ['required', 'integer'],
            'product.unit_id'           => ['required', 'integer'],
            'product.unit_price'        => ['required', 'between:0,9999'],
            'product.qty'               => ['required', 'integer'],
            'product.production_date'   => ['date', 'nullable'],
            'product.expiration_date'   => ['date', 'nullable'],
            'product.total_price'       => ['required'],
        ];
    }

    public function getStoreTransferItems()
    {
        return StoreTransferDetail::where('store_transfer_id', $this->transfer->id)
            ->where('company_id', get_auth_com())->paginate(CUSTOM_PAGINATION - 5);
    }

    public function getItemAndUnit()
    {
        $this->item = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        $this->unit = Unit::select('id', 'name', 'status')->findOrFail($this->product->unit_id);
    }
}
