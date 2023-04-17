<?php

namespace App\Http\Livewire\Admin\Account\TreasuryTransaction;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Shift;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddEditTreasuryTransaction extends Component
{
    public function render()
    {
        return view('livewire.admin.account.treasury-transaction.add-edit-treasury-transaction');
    }
}
