<?php

namespace App\Http\Livewire\Admin\Treasury;

use App\Models\Treasury;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateTreasury extends Component
{
    public $name,
        $is_master,
        $is_active,
        $last_payment_receipt,
        $last_payment_collect,
        $treasury;

    protected $rules = [
        'name'                  => ['required', 'string', 'min:3'],
        'is_master'             => ['required', 'in:0,1'],
        'is_active'             => ['required', 'in:0,1'],
        'last_payment_receipt'  => ['required', 'integer', 'min:1'],
        'last_payment_collect'  => ['required', 'integer', 'min:1']
    ];

    public function mount($treasury)
    {
        $this->treasury                 = $treasury;
        $this->name                     = $treasury->name;
        $this->is_master                = $treasury->is_master;
        $this->is_active                = $treasury->is_active;
        $this->last_payment_receipt     = $treasury->last_payment_receipt;
        $this->last_payment_collect     = $treasury->last_payment_collect;
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function update()
    {
        $id         = $this->treasury->id;
        $authComp   = Auth::guard('admin')->user()->company_code;

        $validaion                  = $this->validate();
        $validaion['updated_by']    = Auth::guard('admin')->id();
        $validaion['date']          = Carbon::now();

        $TreasuryExists = Treasury::where(['company_code' => $authComp, 'name' => $this->name])->first();
        if ($TreasuryExists && $TreasuryExists->id != $id) {
            toastr()->error(__('msgs.exists', ['name' => __('treasury.treasury')]));
            return;
        }

        $masterExists = Treasury::where(['company_code' => $authComp, 'is_master' => 1])->first();
        if ($masterExists && $masterExists->is_master == $this->is_master && $masterExists->id != $id) {
            toastr()->error(__('msgs.exists', ['name' => __('treasury.master_treasury')]));
            return;
        }

        $this->treasury->update($validaion);
        toastr()->success(__('msgs.updated', ['name' => __('treasury.treasury')]));
    }

    public function render()
    {
        return view('livewire.admin.treasury.update-treasury');
    }
}
