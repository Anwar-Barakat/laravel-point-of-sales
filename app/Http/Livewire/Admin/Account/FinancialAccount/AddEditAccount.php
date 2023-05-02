<?php

namespace App\Http\Livewire\Admin\Account\FinancialAccount;

use App\Models\AccountType;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddEditAccount extends Component
{
    public Account $account;

    public $account_types   = [];
    public $parent_accounts = [];
    public $edit            = false;

    public function mount(Account $account)
    {
        $this->account = $account;

        $this->account->account_type_id;
        $this->edit = !empty($this->account->initial_balance_status) ? true : false;
        if ($this->edit && $this->account['is_parent'] == 0)
            $this->parent_accounts = $this->getParentAccount();

        $this->account_types    = AccountType::select('id', 'name')->active()->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedAccountIsParent()
    {
        $this->parent_accounts = $this->account->is_parent == '0'
            ? $this->getParentAccount()
            : [];
    }

    public function updatedAccountInitialBalanceStatus()
    {
        $this->account->initial_balance = ($this->account->initial_balance_status == 1) ? 0 : '';
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->account->number            = uniqid();
            $this->account->company_id        = get_auth_com();

            switch ($this->account->initial_balance_status) {
                case 1:
                    $this->account->initial_balance = 0;
                    break;
                case 2:
                    $this->account->initial_balance = $this->account->initial_balance * (-1);
                    break;
                case 3:
                    abs($this->account->initial_balance);
                    break;
            }
            $this->account->current_balance   = $this->account->initial_balance;
            $this->account->save();

            toastr()->success(__('msgs.submitted', ['name' => __('account.account')]));
            return redirect()->route('admin.accounts.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.accounts.index')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.account.financial-account.add-edit-account');
    }

    public function rules(): array
    {
        return [
            'account.name'                     => [
                'required',
                'min:3',
                Rule::unique('accounts', 'name')->ignore($this->account->id)->where(function ($query) {
                    return $query->where('company_id', get_auth_com());
                })
            ],
            'account.account_type_id'          => ['required', 'integer'],
            'account.is_parent'                => ['required', 'boolean'],
            'account.parent_id'                => ['required_if:is_parent,yes'],
            'account.initial_balance_status'   => ['required', 'in:1,2,3'],
            'account.initial_balance'          => ['required', 'between:0,999999'],
            'account.is_archived'              => ['required', 'boolean'],
            'account.notes'                    => ['required', 'min:10'],
        ];
    }

    public function getParentAccount()
    {
        return Account::select('id', 'name')->where(['company_id' => get_auth_com()])
            ->where('id', '!=', $this->account->id)->parent()->get();
    }
}
