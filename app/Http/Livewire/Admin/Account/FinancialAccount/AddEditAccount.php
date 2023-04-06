<?php

namespace App\Http\Livewire\Admin\Account\FinancialAccount;

use App\Models\AccountType;
use App\Models\FinancialAccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddEditAccount extends Component
{
    public FinancialAccount $financialAccount;

    public $auth;
    public $account_types   = [];
    public $parent_accounts = [];



    public function render()
    {
        return view('livewire.admin.account.financial-account.add-edit-account');
    }

}