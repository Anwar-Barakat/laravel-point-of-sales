<?php

namespace App\Http\Livewire\Admin\StockMovement\Sale;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\Store;
use Livewire\Component;

class AddEditSale extends Component
{
    public Sale $sale;

    public $customers = [],
        $stores = [];

    public function mount(Sale $sale)
    {
        $this->sale         = $sale;
        $this->sale->invoice_date  = date('Y-m-d');
        $this->customers    = Customer::active()->where('company_code', get_auth_com())->get();
        $this->stores       = Store::active()->where('company_code', get_auth_com())->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function render()
    {
        return view('livewire.admin.stock-movement.sale.add-edit-sale');
    }

    public function rules(): array
    {
        return [
            'order.customer_id'     => ['required', 'integer'],
            'order.store_id'        => ['required', 'integer'],
            'order.invoice_type'    => ['required', 'boolean'],
            'order.invoice_date'    => ['required', 'date'],
            'order.notes'           => ['required', 'min:10'],
        ];
    }
}