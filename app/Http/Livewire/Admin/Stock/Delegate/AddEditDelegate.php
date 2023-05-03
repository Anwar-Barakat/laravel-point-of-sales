<?php

namespace App\Http\Livewire\Admin\Stock\Delegate;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Delegate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddEditDelegate extends Component
{
    public Delegate $delegate;

    public $categories;

    public function mount(Delegate $delegate)
    {
        $this->delegate     = $delegate;
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function render()
    {
        return view('livewire.admin.stock.delegate.add-edit-delegate');
    }

    public function submit()
    {
        $this->validate();
        try {
            DB::beginTransaction();
            switch ($this->delegate->initial_balance_status) {
                case 1:
                    $this->delegate->initial_balance = 0;
                    break;
                case 2:
                    $this->delegate->initial_balance = $this->delegate->initial_balance * (-1);
                    break;
                case 3:
                    abs($this->delegate->initial_balance);
                    break;
            }

            $this->delegate->company_id     = get_auth_com();
            $this->delegate->save();

            if (!$this->delegate->account)
                Account::create([
                    'name'                      => $this->delegate->name,
                    'account_type_id'           => AccountType::where('name->en', 'delegate')->first()->id,
                    'is_parent'                 => 0,
                    'parent_id'                 => Auth::guard('admin')->user()->company->parent_delegate_id,
                    'number'                    => uniqid(),
                    'initial_balance_status'    => $this->delegate->initial_balance_status,
                    'initial_balance'           => $this->delegate->initial_balance,
                    'current_balance'           => $this->delegate->initial_balance,
                    'notes'                     => $this->delegate->notes,
                    'delegate_id'                 => $this->delegate->id,
                    'company_id'                => get_auth_com(),
                    'added_by'                  => get_auth_id(),
                ]);
            else
                $this->delegate->account->update(['name' => $this->delegate->name]);


            DB::commit();
            toastr()->success(__('msgs.submitted', ['name' => __('transaction.delegate')]));
            return redirect()->route('admin.delegates.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.delegates.create')->with(['error' => $th->getMessage()]);
        }
    }


    public function rules(): array
    {
        return [
            'delegate.name'                     => [
                'required',
                'min:3',
                Rule::unique('delegates', 'name')->ignore($this->delegate->id)->where(function ($query) {
                    return $query->where('company_id', get_auth_com());
                })
            ],
            'delegate.email'                    => [
                'required',
                Rule::unique('delegates', 'email')->ignore($this->delegate->id)->where(function ($query) {
                    return $query->where('company_id', get_auth_com());
                })
            ],
            'delegate.address'                          => ['required', 'min:10'],
            'delegate.initial_balance_status'           => ['required', 'in:1,2,3'],
            'delegate.initial_balance'                  => ['required', 'between:0,999999'],
            'delegate.is_active'                        => ['required', 'boolean'],
            'delegate.notes'                            => ['required', 'min:10'],
            'delegate.commission_type'                  => ['required', 'boolean'],
            'delegate.commission_for_sectoral'          => ['required', 'numeric', function ($value) {
                if ($this->delegate->commission_type  == 0 && $this->delegate->commission_for_sectoral  >= 50) {
                    toastr()->error(__('validation.commission_type_is_percent'));
                    $this->delegate->commission_for_sectoral = 0;
                }
            }],
            'delegate.commission_for_half_block'        => ['required', function () {
                if ($this->delegate->commission_type  == 0 && $this->delegate->commission_for_half_block  >= 50) {
                    toastr()->error(__('validation.commission_type_is_percent'));
                    $this->delegate->commission_for_half_block = 0;
                }
            }],
            'delegate.commission_for_block'             => ['required', function () {
                if ($this->delegate->commission_type  == 0 && $this->delegate->commission_for_block  >= 50) {
                    toastr()->error(__('validation.commission_type_is_percent'));
                    $this->delegate->commission_for_block = 0;
                }
            }],
            'delegate.commission_for_delayed_collect' => ['required', function () {
                if ($this->delegate->commission_type  == 0 && $this->delegate->commission_for_delayed_collect  >= 50) {
                    toastr()->error(__('validation.commission_type_is_percent'));
                    $this->delegate->commission_for_delayed_collect = 0;
                }
            }],
        ];
    }
}