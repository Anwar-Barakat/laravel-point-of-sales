<?php

namespace App\Http\Livewire\Admin\Stock\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCustomer extends Component
{
    use WithPagination;

    public $name,
        $order_by   = 'name',
        $sort_by    = 'asc',
        $per_page   = CUSTOM_PAGINATION;

    public function updateStatus($id)
    {
        $account    = Customer::findOrFail($id);
        $account->update(['is_active' => !$account->is_active]);
        $this->getCustomers();
    }

    public function render()
    {
        $customers  = $this->getCustomers();
        return view('livewire.admin.stock.customer.show-customer', ['customers' => $customers]);
    }

    public function getCustomers()
    {
        return  Customer::with(['account'])
            ->search(trim($this->name))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);;
    }
}