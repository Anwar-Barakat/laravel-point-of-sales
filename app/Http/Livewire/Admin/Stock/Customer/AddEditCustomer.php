<?php

namespace App\Http\Livewire\Admin\Stock\Customer;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Customer;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddEditCustomer extends Component
{
    public Customer $customer;
    public $edit = false;


    public function mount(Customer $customer)
    {
        $this->customer = $customer;
        $this->edit = !empty($this->customer->initial_balance_status) ? true : false;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedCustomerInitialBalanceStatus()
    {
        $this->customer->initial_balance = ($this->customer->initial_balance_status == 1) ? 0 : '';
    }

    public function submit()
    {
        $this->validate();
        try {
            DB::beginTransaction();

            switch ($this->customer->initial_balance_status) {
                case 1:
                    $this->customer->initial_balance = 0;
                    break;
                case 2:
                    abs($this->customer->initial_balance);
                    break;
                case 3:
                    $this->customer->initial_balance = $this->customer->initial_balance * (-1);
                    break;
            }

            $this->customer['added_by']     = get_auth_id();
            $this->customer['company_code'] = get_auth_com();
            $this->customer->save();

            Account::updateOrCreate(
                [
                    'customer_id'              => $this->customer->id,
                ],
                [
                    'name'                      => $this->customer->name,
                    'account_type_id'           => AccountType::where('name->en', 'customer')->first()->id,
                    'is_parent'                 => 0,
                    'parent_id'                 => Setting::where('company_code', get_auth_com())->first()->customer_account_id,
                    'number'                    => uniqid(),
                    'initial_balance_status'    => $this->customer->initial_balance_status,
                    'initial_balance'           => $this->customer->initial_balance,
                    'notes'                     => $this->customer->notes,
                    'company_code'              => get_auth_com(),
                    'added_by'                  => get_auth_id(),
                ]
            );
            DB::commit();

            toastr()->success(__('msgs.submitted', ['name' => __('account.financial_account')]));
            return redirect()->route('admin.customers.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.customers.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.stock.customer.add-edit-customer');
    }

    public function rules(): array
    {
        return [
            'customer.name'                     => [
                'required',
                'min:3',
                Rule::unique('customers', 'name')->ignore($this->customer->id)->where(function ($query) {
                    return $query->where('company_code', get_auth_com());
                })
            ],
            'customer.address'                  => ['required', 'min:10'],
            'customer.initial_balance_status'   => ['required', 'in:1,2,3'],
            'customer.initial_balance'          => ['required', 'between:0,999999'],
            'customer.is_active'                => ['required', 'boolean'],
            'customer.notes'                    => ['required', 'min:10'],
        ];
    }
}
