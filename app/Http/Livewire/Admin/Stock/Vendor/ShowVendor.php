<?php

namespace App\Http\Livewire\Admin\Stock\Vendor;

use App\Models\Account;
use App\Models\Vendor;
use Livewire\Component;
use Livewire\WithPagination;

class ShowVendor extends Component
{
    use WithPagination;

    public $name,
        $total_balances,
        $account_status,
        $order_by   = 'name',
        $sort_by    = 'asc',
        $per_page   = CUSTOM_PAGINATION;

    public function updateStatus($id)
    {
        $vendor    = Vendor::findOrFail($id);
        $vendor->update(['is_active' => !$vendor->is_active]);
    }

    public function updatedAccountStatus()
    {
        if ($this->account_status == 2)
            $this->total_balances = Account::whereHas(
                'accountType',
                function ($query) {
                    $query->where('name->en', 'vendor');
                }
            )->where('current_balance', '<', 0)->active()->sum('current_balance');
        elseif ($this->account_status == 3)
            $this->total_balances = Account::whereHas(
                'accountType',
                function ($query) {
                    $query->where('name->en', 'vendor');
                }
            )->where('current_balance', '>', 0)->active()->sum('current_balance');
    }

    public function render()
    {
        $vendors  = $this->getVendors();
        return view('livewire.admin.stock.vendor.show-vendor', ['vendors' => $vendors]);
    }

    public function getVendors()
    {
        return  Vendor::whereHas('account', function ($query) {
            $query->when($this->account_status, function ($query) {
                if ($this->account_status == 1)
                    return $query->where('current_balance', '=', 0);
                elseif ($this->account_status == 2)
                    return $query->where('current_balance', '<', 0);
                elseif ($this->account_status == 3)
                    return $query->where('current_balance', '>', 0);
            });
        })->with(['account'])
            ->search(trim($this->name))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}