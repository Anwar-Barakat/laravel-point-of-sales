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

    public function submit()
    {
        $this->validate();
        try {
            $this->sale->type            = 1; // purchase
            $this->sale->account_id      = $this->sale->vendor->account->id;
            $this->sale->added_by        = get_auth_id();
            $this->sale->company_code    = get_auth_com();

            $this->sale->save();
            toastr()->success(__('msgs.submitted', ['name' => __('movement.order')]));
            return redirect()->route('admin.orders.index');
        } catch (\Throwable $th) {
            return redirect()->route('admin.orders.create')->with(['error' => $th->getMessage()]);
        }
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