<?php

namespace App\Http\Livewire\Admin\Treasury;

use App\Models\Treasury;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StoreTreasury extends Component
{
    public $name,
        $is_master,
        $is_active,
        $last_payment_receipt,
        $last_payment_collect;

    protected $rules = [
        'name'                  => ['required', 'string', 'min:3'],
        'is_master'             => ['required', 'in:0,1'],
        'is_active'             => ['required', 'in:0,1'],
        'last_payment_receipt'  => ['required', 'integer', 'min:1'],
        'last_payment_collect'  => ['required', 'integer', 'min:1']
    ];

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function store()
    {
        $authComp   = Auth::guard('admin')->user()->company_code;

        $validation                 = $this->validate();
        $validation['added_by']     = Auth::guard('admin')->id();
        $validation['company_code'] = $authComp;
        $validation['date']         = Carbon::now();

        /*
            1- check if the treasury exists for auth company code
            2-  check if a master treasury exists for auth company code
        */
        $TreasuryExists = Treasury::where(['company_code' => $authComp, 'name' => $this->name])->first();
        if ($TreasuryExists) {
            toastr()->error(__('msgs.exists', ['name' => __('treasury.treasury')]));
            return false;
        }

        $masterExists   = Treasury::where(['company_code' => $authComp, 'is_master' => '1'])->first();
        if ($masterExists && $masterExists->is_master == $this->is_master) {
            toastr()->error(__('msgs.exists', ['name' => __('msgs.master_treasury')]));
            return false;
        }

        Treasury::create($validation);

        toastr()->success(__('msgs.created', ['name' => __('treasury.treasury')]));
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.treasury.store-treasury');
    }
}
