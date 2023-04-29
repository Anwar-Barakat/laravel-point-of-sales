<?php

namespace App\Http\Livewire\Admin\StockMovement\Sale;

use App\Models\Customer;
use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\Sale;
use App\Models\Store;
use App\Models\Unit;
use Livewire\Component;

class ShowSale extends Component
{
    public Sale $sale;

    public $customers   = [],
        $stores         = [];

    public $items       = [];
    public $wholesale_unit = null,
        $retail_unit = null;

    public $batches, $unit, $item;

    public function mount(Sale $sale)
    {
        $this->sale                 = $sale;
        $this->sale->invoice_date   = date('Y-m-d');
        $this->sale->qty            = 1;
        $this->customers            = Customer::active()->where('company_code', get_auth_com())->get();
        $this->stores               = Store::active()->where('company_code', get_auth_com())->get();
        $this->items                = Item::active()->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function updatedSaleStoreId()
    {
        if (!is_null($this->sale->item_id) && !is_null($this->sale->unit_id))
            $this->batches  = $this->getBatches();
    }

    public function updatedSaleSaleType()
    {
        if (!is_null($this->sale->item_id) && !is_null($this->sale->unit_id))
            $this->sale->unit_price = $this->getUnitPrice();
    }

    public function updatedSaleItemId()
    {
        $this->item             = $this->getItem();
        $this->wholesale_unit   = $this->item->parentUnit;
        $this->retail_unit      = $this->item->childUnit ?? null;

        if (!is_null($this->sale->item_id) && !is_null($this->sale->unit_id))
            $this->batches  = $this->getBatches();
    }

    public function updatedSaleUnitId()
    {
        $this->item     = $this->getItem();
        $this->unit     = Unit::select('id', 'name', 'status')->findOrFail($this->sale->unit_id);
        $this->batches  = $this->getBatches();

        if (!is_null($this->sale->item_id) && !is_null($this->sale->sale_type))
            $this->sale->unit_price = $this->getUnitPrice();
    }

    public function calcPrice()
    {
        $batch = ItemBatch::find($this->sale->item_batch_id);
        if (!$batch) {
            toastr()->error(__('validation.select_item_batch'));
            $this->sale->qty = 1;
        }

        $batchQty = $this->unit->status == 'wholesale' ? $batch->qty : $batch->qty * $this->item->retail_count_for_wholesale;
        if ($this->sale->qty > $batchQty) {
            toastr()->error(__('validation.qty_not_available_now'));
            $this->sale->qty = 1;
        }
    }

    public function submit()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.admin.stock-movement.sale.show-sale');
    }


    public function rules(): array
    {
        return [
            'sale.invoice_date'     => ['required', 'date'],
            'sale.invoice_type'     => ['required', 'boolean'],
            'sale.store_id'         => ['required', 'integer'],
            'sale.sale_type'        => ['required', 'in:1,2,3'],
            'sale.customer_id'      => ['required', 'integer'],
            'sale.store_id'         => ['required', 'integer'],
            'sale.unit_id'          => ['required', 'integer'],
            'sale.item_id'          => ['required', 'integer'],
            'sale.item_batch_id'    => ['required', 'integer'],
            'sale.unit_price'       => ['required', 'numeric', 'min:1'],
            'sale.qty'              => ['required', 'integer', 'min:1'],
            'sale.total_price'      => ['required', 'numeric', 'min:1'],
        ];
    }

    public function getBatches()
    {
        return ItemBatch::select('id', 'unit_price', 'qty', 'production_date', 'expiration_date')
            ->where(['company_code'         => get_auth_com()])
            ->when($this->sale->item_id,    fn ($query) => $query->where(['item_id'  => $this->sale->item_id]))
            ->when($this->sale->store_id,   fn ($query) => $query->where(['store_id' => $this->sale->store_id]))
            ->when($this->sale->unit_id,    fn ($query) => $query->where(['unit_id' => $this->item->parentUnit->id]))
            ->when($this->item->type == 2,  fn ($query) => $query->orderBy('production_date', 'asc'))
            ->latest()->get();
    }

    public function getItem()
    {
        return Item::with(['parentUnit', 'childUnit'])->findOrFail($this->sale->item_id);
    }

    public function getUnitPrice()
    {
        $prices = [
            $this->item->retail_price,
            $this->item->retail_price_for_half_block,
            $this->item->retail_price_for_block,
            $this->item->wholesale_price,
            $this->item->wholesale_price_for_half_block,
            $this->item->wholesale_price_for_block,
        ];

        if ($this->unit->status == 'wholesale') {
            $index = $this->sale->sale_type + 2;
        } else {
            $index = $this->sale->sale_type - 1;
        }

        return $prices[$index];
    }
}
