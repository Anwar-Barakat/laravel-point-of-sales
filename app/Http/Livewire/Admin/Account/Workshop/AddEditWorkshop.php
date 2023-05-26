<?php

namespace App\Http\Livewire\Admin\Account\Workshop;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Workshop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddEditWorkshop extends Component
{
    public $workshop;
    public $edit = false;


    public function mount(Workshop $workshop)
    {
        $this->workshop = $workshop;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedWorkshopInitialBalanceStatus()
    {
        $this->workshop->initial_balance = ($this->workshop->initial_balance_status == 1) ? 0 : '';
    }

    public function submit()
    {
        $this->validate();
        try {
            DB::beginTransaction();

            switch ($this->workshop->initial_balance_status) {
                case 1:
                    $this->workshop->initial_balance = 0;
                    break;
                case 2:
                    $this->workshop->initial_balance = $this->workshop->initial_balance * (-1);
                    break;
                case 3:
                    abs($this->workshop->initial_balance);
                    break;
            }

            $this->workshop->company_id         = get_auth_com();
            $this->workshop->save();

            if (!$this->workshop->account)
                Account::create([
                    'name'                      => $this->workshop->name,
                    'account_type_id'           => AccountType::where('name->en', 'workshop')->first()->id,
                    'is_parent'                 => 0,
                    'parent_id'                 => Auth::guard('admin')->user()->company->parent_workshop_id,
                    'number'                    => uniqid(),
                    'initial_balance_status'    => $this->workshop->initial_balance_status,
                    'initial_balance'           => $this->workshop->initial_balance,
                    'current_balance'           => $this->workshop->initial_balance,
                    'notes'                     => $this->workshop->notes,
                    'workshop_id'               => $this->workshop->id,
                    'company_id'                => get_auth_com(),
                    'added_by'                  => get_auth_id(),
                ]);
            else
                $this->workshop->account->update(['name' => $this->workshop->name]);

            DB::commit();

            toastr()->success(__('msgs.submitted', ['name' => __('account.workshop')]));
            return redirect()->route('admin.workshops.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.workshops.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.account.workshop.add-edit-workshop');
    }


    public function rules(): array
    {
        return [
            'workshop.name'                     => [
                'required',
                'min:3',
                Rule::unique('workshops', 'name')->ignore($this->workshop->id)->where(function ($query) {
                    return $query->where('company_id', get_auth_com());
                })
            ],
            'workshop.email'                    => [
                'required',
                'min:3',
                Rule::unique('workshops', 'email')->ignore($this->workshop->id)->where(function ($query) {
                    return $query->where('company_id', get_auth_com());
                })
            ],
            'workshop.address'                  => ['required', 'min:10'],
            'workshop.mobile'                   => ['required', 'min:10'],
            'workshop.initial_balance_status'   => ['required', 'in:1,2,3'],
            'workshop.initial_balance'          => ['required', 'between:0,999999'],
            'workshop.is_active'                => ['required', 'boolean'],
            'workshop.notes'                    => ['required', 'min:10'],
        ];
    }
}
