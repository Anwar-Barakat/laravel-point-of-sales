<?php

namespace App\Http\Livewire\Admin\StockMovement\Sale;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Delegate;
use App\Models\Sale;
use App\Models\Store;
use Livewire\Component;

class AddEditSale extends Component
{
    public Sale $sale;

    public $customers = [],
        $delegates = [],
        $categories = [],
        $stores = [];

    public function mount(Sale $sale)
    {
        $this->sale         = $sale;
        $this->sale->invoice_date  = date('Y-m-d');
        $this->customers    = Customer::active()->where('company_code', get_auth_com())->get();
        $this->delegates    = Delegate::active()->where('company_code', get_auth_com())->get();
        $this->categories   = Category::with('subCategories')->where(['parent_id' => 0])->get();
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
            $this->sale->account_id      = $this->sale->customer->account->id;
            $this->sale->added_by        = get_auth_id();
            $this->sale->company_code    = get_auth_com();
            $this->sale->save();

            toastr()->success(__('msgs.submitted', ['name' => __('movement.sale_invoice')]));
            return redirect()->route('admin.sales.index');
        } catch (\Throwable $th) {
            return redirect()->route('admin.sales.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.stock-movement.sale.add-edit-sale');
    }

    public function rules(): array
    {
        return [
            'sale.customer_id'     => ['required', 'integer'],
            'sale.invoice_type'    => ['required', 'boolean'],
            'sale.invoice_date'    => ['required', 'date'],
            'sale.category_id'     => ['required', 'integer'],
            'sale.delegate_id'     => ['required', 'integer'],
            'sale.notes'           => ['required', 'min:10'],
        ];
    }
}