<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\Sale;

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

    public $sale_type;

    public function mount(Sale $sale, $sale_type)
    {
        $this->sale         = $sale;
        $this->sale->invoice_date  = date('Y-m-d');
        $this->sale_type  = $sale_type;
        $this->customers    = Customer::active()->where('company_id', get_auth_com())->get();
        $this->delegates    = Delegate::active()->where('company_id', get_auth_com())->get();
        $this->categories   = Category::with('subCategories')->where(['parent_id' => 0])->get();
        $this->stores       = Store::active()->where('company_id', get_auth_com())->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->sale->type           = $this->sale_type;
            $this->sale->account_id     = $this->sale->customer->account->id;
            $this->sale->added_by       = get_auth_id();
            $this->sale->company_id     = get_auth_com();
            $this->sale->save();

            if ($this->sale->type == 1) {
                $name = __('transaction.sale_invoice');
            } elseif ($this->sale->type == 3) {
                $name = __('transaction.general_sale_return');
            }

            toastr()->success(__('msgs.submitted', ['name' => $name]));
            return redirect()->route('admin.sales.index');
        } catch (\Throwable $th) {
            return redirect()->route('admin.sales.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.sale.add-edit-sale');
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
