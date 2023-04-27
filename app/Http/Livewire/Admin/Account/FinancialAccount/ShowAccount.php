<?php

namespace App\Http\Livewire\Admin\Account\FinancialAccount;

use App\Models\Account;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAccount extends Component
{
    use WithPagination;

    public $name,
        $order_by   = 'name',
        $sort_by    = 'asc',
        $account_type_id,
        $per_page   = CUSTOM_PAGINATION;

    public function updateStatus($id)
    {
        $account    = Account::findOrFail($id);
        $account->update(['is_archived' => !$account->is_archived]);
        $this->getAccounts();
    }

    public function render()
    {
        return view('livewire.admin.account.financial-account.show-account', ['accounts' => $this->getAccounts()]);
    }

    public function getAccounts()
    {
        return  Account::with(['parentAccount:id,name', 'accountType:id,name', 'customer:id,name'])
            ->when($this->account_type_id, fn ($q) => $q->where('account_type_id', $this->account_type_id))
            ->search(trim($this->name))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}
