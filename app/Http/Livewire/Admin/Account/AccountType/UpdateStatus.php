<?php

namespace App\Http\Livewire\Admin\Account\AccountType;

use App\Models\AccountType;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $is_active, $account_type_id;

    public function updateStatus($account_type_id)
    {
        $account_type       = AccountType::findOrFail($account_type_id);
        $account_type->update(['is_active' => !$account_type->is_active]);
        $this->is_active    = $account_type->is_active;
    }

    public function render()
    {
        return view('livewire.admin.account.account-type.update-status');
    }
}
