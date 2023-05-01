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
            DB::beginTransaction();

            $this->account['added_by']     = get_auth_id();
            $this->account['number']       = uniqid();
            $this->account['company_code'] = get_auth_com();

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

            if (!is_null($this->account->customer))
                $this->account->customer->update(['name' => $this->account->name,]);

            if (!is_null($this->account->vendor))
                $this->account->vendor->update(['name' => $this->account->name]);

            $this->account->save();
            DB::commit();

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
                    return $query->where('company_code', get_auth_com());
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
        return Account::select('id', 'name')->where(['company_code' => get_auth_com()])
            ->where('id', '!=', $this->account->id)->parent()->get();
    }
}