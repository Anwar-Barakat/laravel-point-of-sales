<?php

namespace App\Http\Livewire\Admin\Account\FinancialAccount;

use App\Models\Account;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAccount extends Component
{
    use WithPagination;

    public $name,
        $account_status,
        $order_by   = 'created_at',
        $total_balances,
        $sort_by    = 'desc',
        $account_type_id,
        $per_page   = CUSTOM_PAGINATION;

    public function updateStatus($id)
    {
        $account    = Account::findOrFail($id);
        $account->update(['is_archived' => !$account->is_archived]);
        $this->getAccounts();
    }

    public function updatedAccountStatus()
    {
        if ($this->account_status == 2)
            $this->total_balances = Account::where('current_balance', '<', 0)->active()->sum('current_balance');
        elseif ($this->account_status == 3)
            $this->total_balances = Account::where('current_balance', '>', 0)->active()->sum('current_balance');
    }

    public function render()
    {
        return view('livewire.admin.account.financial-account.show-account', ['accounts' => $this->getAccounts()]);
    }

    public function getAccounts()
    {
        return  Account::with(['parentAccount:id,name', 'accountType', 'customer:id,name'])
            ->when($this->account_type_id, fn ($q) => $q->where('account_type_id', $this->account_type_id))
            ->when($this->account_status, function ($query) {
                if ($this->account_status == 1)
                    return $query->where('current_balance', '=', 0);
                elseif ($this->account_status == 2)
                    return $query->where('current_balance', '<', 0);
                elseif ($this->account_status == 3)
                    return $query->where('current_balance', '>', 0);
            })
            ->search(trim($this->name))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}
