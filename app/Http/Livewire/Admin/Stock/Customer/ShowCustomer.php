<?php

namespace App\Http\Livewire\Admin\Stock\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCustomer extends Component
{
    use WithPagination;

    public function updateStatus($id)
    {
        $account    = Customer::findOrFail($id);
        $account->update(['is_active' => !$account->is_active]);
        $this->getCustomers();
    }

    public function render()
    {
        $customers  = $this->getCustomers();
        dd($customers);
        return view('livewire.admin.stock.customer.show-customer', ['customers' => $customers]);
    }

    public function getCustomers()
    {
        return  Customer::with(['account:id,name,account_number'])
            ->paginate(10);
    }
}
