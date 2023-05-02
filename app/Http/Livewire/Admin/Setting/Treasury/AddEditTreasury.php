<?php

namespace App\Http\Livewire\Admin\Setting\Treasury;

use App\Models\Admin;
use App\Models\Treasury;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddEditTreasury extends Component
{
    public Treasury $treasury;
    public Admin $admin;

    public function mount(Treasury $treasury, Admin $admin)
    {
        $this->treasury = $treasury;
        $this->admin    = $admin;
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            $masterExists   = Treasury::where(['company_id' => get_auth_com(), 'is_master' => '1'])->first();
            if ($masterExists && $masterExists->is_master == $this->treasury['is_master']) {
                toastr()->error(__('msgs.exists', ['name' => __('treasury.master_treasury')]));
                return false;
            }

            $this->treasury['admin_id']       = $this->admin->id ?? get_auth_id();
            $this->treasury['company_id']   = get_auth_com();
            $this->treasury->save();

            toastr()->success(__('msgs.submitted', ['name' => __('treasury.treasury')]));
        } catch (\Throwable $th) {
            return redirect()->route('admin.treasuries.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.setting.treasury.add-edit-treasury');
    }

    public function rules()
    {
        return [
            'treasury.name'                  => [
                'required',
                'min:3',
                Rule::unique('treasuries', 'name')->ignore($this->treasury->id)->where(function ($query) {
                    return $query->where('company_id', get_auth_com())
                        ->orWhere(['company_id' => get_auth_com(), 'admin_id' => get_auth_id()]);
                })
            ],
            'treasury.is_master'             => ['required', 'in:0,1'],
            'treasury.is_active'             => ['required', 'in:0,1'],
            'treasury.last_payment_exchange' => ['required', 'integer', 'min:1'],
            'treasury.last_payment_collect'  => ['required', 'integer', 'min:1']
        ];
    }
}
