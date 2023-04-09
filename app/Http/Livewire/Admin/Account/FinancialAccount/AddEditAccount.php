<?php

namespace App\Http\Livewire\Admin\Account\FinancialAccount;

use App\Models\AccountType;
use App\Models\FinancialAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddEditAccount extends Component
{
    public FinancialAccount $financialAccount;

    public $auth;
    public $account_types   = [];
    public $parent_accounts = [];
    public $edit            = false;

    public function mount(FinancialAccount $financialAccount)
    {
        $this->auth             = Auth::guard('admin')->user();
        $this->financialAccount = $financialAccount;

        $this->edit = !empty($this->financialAccount->initial_balance_status) ? true : false;
        if ($this->edit && $this->financialAccount['is_parent'] == 0)
            $this->parent_accounts = $this->getParentAccount();

        $this->account_types    = AccountType::select('id', 'name')->where('related_to_internal_account', 0)->active()->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedFinancialAccountIsParent()
    {
        $this->parent_accounts = $this->financialAccount->is_parent == '0'
            ? $this->getParentAccount()
            : [];
    }

    public function updatedFinancialAccountInitialBalanceStatus()
    {
        $this->financialAccount->initial_balance = ($this->financialAccount->initial_balance_status == 1) ? 0 : '';
    }

    public function submit()
    {
        $this->validate();
        $this->financialAccount['added_by']     = $this->auth->id;
        $this->financialAccount['company_code'] = $this->auth->company_code;

        switch ($this->financialAccount->initial_balance_status) {
            case 1:
                $this->financialAccount->initial_balance = 0;
                break;
            case 2:
                abs($this->financialAccount->initial_balance);
                break;
            case 3:
                $this->financialAccount->initial_balance = $this->financialAccount->initial_balance * (-1);
                break;
        }

        $this->financialAccount->save();
        toastr()->success(__('msgs.submitted', ['name' => __('account.financial_account')]));
        return redirect()->route('admin.financial-accounts.index');
    }

    public function render()
    {
        return view('livewire.admin.account.financial-account.add-edit-account');
    }

    public function rules(): array
    {
        return [
            'financialAccount.name'                     => [
                'required',
                'min:3',
                Rule::unique('financial_accounts', 'name')->ignore($this->financialAccount->id)->where(function ($query) {
                    return $query->where('company_code', $this->auth->company_code);
                })
            ],
            'financialAccount.account_type_id'          => ['required', 'integer'],
            'financialAccount.is_parent'                => ['required', 'boolean'],
            'financialAccount.parent_id'                => ['required_if:is_parent,yes'],
            'financialAccount.initial_balance_status'   => ['required', 'in:1,2,3'],
            'financialAccount.initial_balance'          => ['required', 'between:0,999999'],
            'financialAccount.is_archived'              => ['required', 'boolean'],
            'financialAccount.notes'                    => ['required', 'min:10'],
        ];
    }

    public function getParentAccount()
    {
        return FinancialAccount::select('id', 'name')->where(['company_code' => $this->auth->company_code])
            ->where('id', '!=', $this->financialAccount->id)->active()->get();
    }
}
