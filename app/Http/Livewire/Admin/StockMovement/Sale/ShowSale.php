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
        $this->customers            = Customer::active()->where('company_code', get_auth_com())->get();
        $this->stores               = Store::active()->where('company_code', get_auth_com())->get();
        $this->items                = Item::active()->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
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
        $this->unit     = Unit::select('id', 'name', 'status')->findOrFail($this->sale->unit_id);
        $this->batches  = $this->getBatches();
    }


    public function updatedSaleStoreId()
    {
        if (!is_null($this->sale->item_id) && !is_null($this->sale->unit_id))
            $this->batches  = $this->getBatches();
    }


    public function render()
    {
        return view('livewire.admin.stock-movement.sale.show-sale');
    }


    public function rules(): array
    {
        return [
            'sale.invoice_date'    => ['required', 'date'],
            'sale.invoice_type'    => ['required', 'boolean'],
            'sale.store_id'        => ['required', 'integer'],
            'sale.customer_id'     => ['required', 'integer'],
            'sale.store_id'        => ['required', 'integer'],
            'sale.unit_id'         => ['required', 'integer'],
            'sale.item_id'         => ['required', 'integer'],
            'sale.item_batch_id'   => ['required', 'integer'],
        ];
    }

    public function getBatches()
    {
        return ItemBatch::select('unit_price', 'qty', 'production_date', 'expiration_date')
            ->where([
                'company_code'  => get_auth_com()
            ])
            ->when($this->sale->item_id, function ($query) {
                return $query->where(['item_id'  => $this->sale->item_id]);
            })
            ->when($this->sale->store_id, function ($query) {
                return $query->where(['store_id' => $this->sale->store_id]);
            })
            ->when($this->sale->unit_id, function ($query) {
                return $query->where(['unit_id' => $this->item->parentUnit->id]);
            })
            ->when($this->item->type == 2, function ($query) {
                return $query->orderBy('production_date', 'asc');
            })->latest()->get();
    }

    public function getItem()
    {
        return Item::with(['parentUnit', 'childUnit'])->findOrFail($this->sale->item_id);
    }
}
