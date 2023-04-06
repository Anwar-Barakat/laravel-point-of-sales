<?php

namespace App\Http\Livewire\Admin\Account\FinancialAccount;

use App\Models\FinancialAccount;
use Livewire\Component;

class ShowAccount extends Component
{
    public $financial_accounts = [];

    public function mount()
    {
        $this->financial_accounts   = FinancialAccount::latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.account.financial-account.show-account');
    }
}
