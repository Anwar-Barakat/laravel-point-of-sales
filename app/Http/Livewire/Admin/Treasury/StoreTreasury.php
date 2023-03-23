<?php

namespace App\Http\Livewire\Admin\Treasury;

use App\Models\Treasury;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StoreTreasury extends Component
{
    public $treasury_name_ar, $treasury_name_en,
        $is_master,
        $is_active,
        $last_payment_receipt,
        $last_payment_collect;

    protected $rules = [
        'treasury_name_ar'      => ['required', 'string', 'min:3'],
        'treasury_name_en'      => ['required', 'string', 'min:3'],
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
        try {
            $this->validate();
            $auth       = Auth::guard('admin')->user();
            $authComp   = $auth->company_code;

            /*
                1- check if the treasury exists for auth company code
                2-  check if a master treasury exists for auth company code
            */
            $masterExists   = Treasury::where(['company_code' => $authComp, 'name->en' => $this->treasury_name_en, 'is_master' => '1'])->first();
            if ($masterExists) {
                toastr()->error(__('msgs.exists', ['name' => __('treasury.master_treasury')]));
                return false;
            }

            $TreasuryExists = Treasury::where(['company_code' => $authComp, 'name->en' => $this->treasury_name_en])->first();
            if ($TreasuryExists) {
                toastr()->error(__('msgs.exists', ['name' => __('treasury.treasury')]));
                return false;
            }

            Treasury::create([
                'name'                  => [
                    'ar'                => $this->treasury_name_ar,
                    'en'                => $this->treasury_name_en,
                ],
                'is_master'             => $this->is_master,
                'is_active'             => $this->is_active,
                'last_payment_receipt'  => $this->last_payment_receipt,
                'last_payment_collect'  => $this->last_payment_collect,
                'added_by'              => $auth->id,
                'company_code'          => $authComp,
                'date'                  => date('Y-m-d')
            ]);

            toastr()->success(__('msgs.created', ['name' => __('treasury.treasury')]));
            $this->reset();
        } catch (\Throwable $th) {
            return redirect()->back()->withError($th->getMessage())->withInput();
        }
    }

    public function render()
    {
        return view('livewire.admin.treasury.store-treasury');
    }
}