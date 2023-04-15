<?php

namespace App\Http\Livewire\Admin\GeneralSetting\Treasury;

use App\Models\Admin;
use App\Models\Treasury;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddEditTreasury extends Component
{
    public Treasury $treasury;
    public Admin $admin;

    public $auth;

    public function mount(Treasury $treasury, Admin $admin)
    {
        $this->auth     = Auth::guard('admin')->user();
        $this->treasury = $treasury;
        $this->admin    = $admin;
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();
        try {
            $masterExists   = Treasury::where(['company_code' => $this->auth->company_code, 'is_master' => '1'])->first();
            if ($masterExists && $masterExists->is_master == $this->treasury['is_master']) {
                toastr()->error(__('msgs.exists', ['name' => __('treasury.master_treasury')]));
                return false;
            }

            $this->treasury['admin_id']       = $this->admin->id ?? $this->auth->id;
            $this->treasury['company_code']   = $this->auth->company_code;
            $this->treasury->save();

            toastr()->success(__('msgs.submitted', ['name' => __('treasury.treasury')]));
        } catch (\Throwable $th) {
            return redirect()->route('admin.treasuries.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.general-setting.treasury.add-edit-treasury');
    }

    public function rules()
    {
        return [
            'treasury.name'                  => [
                'required',
                'min:3',
                Rule::unique('treasuries', 'name')->ignore($this->treasury->id)->where(function ($query) {
                    return $query->where('company_code', $this->auth->company_code)
                        ->orWhere(['company_code' => $this->auth->company_code, 'admin_id' => $this->auth->id]);
                })
            ],
            'treasury.is_master'             => ['required', 'in:0,1'],
            'treasury.is_active'             => ['required', 'in:0,1'],
            'treasury.last_payment_receipt'  => ['required', 'integer', 'min:1'],
            'treasury.last_payment_collect'  => ['required', 'integer', 'min:1']
        ];
    }
}
