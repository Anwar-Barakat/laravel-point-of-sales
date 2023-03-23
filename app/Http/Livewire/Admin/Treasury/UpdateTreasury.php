<?php

namespace App\Http\Livewire\Admin\Treasury;

use App\Models\Treasury;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateTreasury extends Component
{
    public $treasury_name_ar, $treasury_name_en,
        $is_master,
        $is_active,
        $last_payment_receipt,
        $last_payment_collect,
        $treasury;

    public function mount($treasury)
    {
        $this->treasury                 = $treasury;
        $this->treasury_name_ar         = $treasury->getTranslation('name', 'ar');
        $this->treasury_name_en         = $treasury->getTranslation('name', 'en');
        $this->is_master                = $treasury->is_master;
        $this->is_active                = $treasury->is_active;
        $this->last_payment_receipt     = $treasury->last_payment_receipt;
        $this->last_payment_collect     = $treasury->last_payment_collect;
    }

    public function update()
    {
        try {
            $auth   = Auth::guard('admin')->user();

            if ($this->is_master == 1) {
                dd(Treasury::where('id', '!=', $this->treasury->id)->first());
                $masterExists   = Treasury::where(['company_code' => $auth->company_code, 'is_master' => 1])->where('id', '!=', $this->treasury->id)->first();
                if ($masterExists) {
                    toastr()->error(__('msgs.exists', ['name' => __('treasury.master_treasury')]));
                    return false;
                }
            } else {
                $this->treasury->update([
                    'name'                  => [
                        'ar'                => $this->treasury_name_ar,
                        'en'                => $this->treasury_name_en,
                    ],
                    'is_master'             => $this->is_master,
                    'is_active'             => $this->is_active,
                    'last_payment_receipt'  => $this->last_payment_receipt,
                    'last_payment_collect'  => $this->last_payment_collect,
                    'updated_by'            => $auth->id,
                    'date'                  => date('Y-m-d')
                ]);

                toastr()->success(__('msgs.updated', ['name' => __('treasury.treasury')]));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()])->withInput();
        }
    }

    public function render()
    {
        return view('livewire.admin.treasury.update-treasury');
    }
}
