<?php

namespace App\Http\Livewire\Admin\Stock\Delegate;

use App\Models\Account;
use App\Models\Delegate;
use Livewire\Component;
use Livewire\WithPagination;

class ShowDelegate extends Component
{
    use WithPagination;

    public $name,
        $account_status,
        $total_balances,
        $order_by   = 'name',
        $sort_by    = 'asc',
        $per_page   = CUSTOM_PAGINATION;

    public function updateStatus($id)
    {
        $delegate    = Delegate::findOrFail($id);
        $delegate->update(['is_active' => !$delegate->is_active]);
    }

    public function updatedAccountStatus()
    {
        if ($this->account_status == 2)
            $this->total_balances = Account::whereHas(
                'accountType',
                function ($query) {
                    $query->where('name->en', 'delegate');
                }
            )->where('current_balance', '<', 0)->active()->sum('current_balance');
        elseif ($this->account_status == 3)
            $this->total_balances = Account::whereHas(
                'accountType',
                function ($query) {
                    $query->where('name->en', 'delegate');
                }
            )->where('current_balance', '>', 0)->active()->sum('current_balance');
    }

    public function render()
    {
        return view('livewire.admin.stock.delegate.show-delegate', ['delegates' => $this->getDelegates()]);
    }

    public function getDelegates()
    {
        return  Delegate::whereHas('account', function ($query) {
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
            ->paginate($this->per_page);;
    }
}