<?php

namespace App\Http\Livewire\Admin\StockMovement\Sale;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Sale;
use App\Models\Store;
use Livewire\Component;

class ShowSale extends Component
{
    public Sale $sale;

    public $customers   = [],
        $stores         = [];
    public $items       = [];
    public $wholesale_unit = null,
        $retail_unit = null;

    public function mount(Sale $sale)
    {
        $this->sale                 = $sale;
        $this->sale->invoice_date   = date('Y-m-d');
        $this->customers            = Customer::active()->where('company_code', get_auth_com())->get();
        $this->stores               = Store::active()->where('company_code', get_auth_com())->get();
        $this->items                = Item::active()->get();
    }

    public function updatedSaleItemId()
    {
        $item                   = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->sale->item_id);
        $this->wholesale_unit   = $item->parentUnit;
        $this->retail_unit      = $item->childUnit ?? null;
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
            'sale.customer_id'     => ['required', 'integer'],
            'sale.store_id'        => ['required', 'integer'],
            'sale.unit_id'         => ['required', 'integer'],
            'sale.item_id'         => ['required', 'integer'],
        ];
    }
}
