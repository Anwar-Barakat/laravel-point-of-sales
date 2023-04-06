<?php

namespace App\Http\Livewire\Admin\Account\FinancialAccount;

use App\Models\FinancialAccount;
use Livewire\Component;

class ShowAccount extends Component
{
    public $financial_accounts = [];

    public function mount()
    {
        $this->getAccounts();
    }

    public function updateStatus($id)
    {
        $account    = FinancialAccount::findOrFail($id);
        $account->update(['is_active' => !$account->is_active]);
        $this->getAccounts();
    }

    public function render()
    {
        return view('livewire.admin.account.financial-account.show-account');
    }

    public function getAccounts()
    {
        return $this->financial_accounts   = FinancialAccount::with(['parentAccount:id,name', 'accountType:id,name'])->latest()
            ->get();
    }
}
