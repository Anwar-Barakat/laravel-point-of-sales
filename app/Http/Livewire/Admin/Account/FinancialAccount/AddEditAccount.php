<?php

namespace App\Http\Livewire\Admin\Account\FinancialAccount;

use App\Models\AccountType;
use App\Models\FinancialAccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddEditAccount extends Component
{
    public FinancialAccount $account;

    public $auth;
    public $account_types   = [];
    public $parent_accounts = [];

    public function mount(FinancialAccount $account)
    {
        $this->auth             = Auth::guard('admin')->user();
        $this->account          = $account;
        $this->account_types    = AccountType::select('id', 'name')->where('related_to_internal_account', 0)->active()->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function updateFinancialAccountIsParent()
    {
        $this->parent_accounts = $this->account->is_parent
            ? FinancialAccount::select('id', 'name')->where('company_code', $this->auth->company_code)->active()->get()
            : [];
    }

    public function updatedFinancialAccountInitialBalanceStatus()
    {
        $this->account->initial_balance = ($this->account->initial_balance_status == 1) ? 0 : '';
    }

    public function submit()
    {
        try {
            $this->validate();
            $this->account['added_by']     = $this->auth->id;
            $this->account['company_code'] = $this->auth->company_code;

            switch ($this->account->initial_balance_status) {
                case 1:
                    $this->account->initial_balance = 0;
                    break;
                case 2:
                    abs($this->account->initial_balance);
                    break;
                case 3:
                    $this->account->initial_balance = $this->account->initial_balance * (-1);
                    break;
            }

            $this->account->save();
            toastr()->success(__('msgs.submitted', ['name' => __('account.financial_account')]));
            return redirect()->route('admin.financial-accounts.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.account.financial-account.add-edit-account');
    }

    public function rules(): array
    {
        return [
            'account.name'                     => ['required', 'min:3'],
            'account.account_type_id'          => ['required', 'integer'],
            'account.is_parent'                => ['required', 'boolean'],
            'account.parent_id'                => ['required_if:is_parent,yes'],
            'account.initial_balance_status'   => ['required', 'in:1,2,3'],
            'account.initial_balance'          => ['required', 'between:0,999999'],
            'account.is_archived'              => ['required', 'boolean'],
            'account.notes'                    => ['required', 'min:10'],
        ];
    }
}
