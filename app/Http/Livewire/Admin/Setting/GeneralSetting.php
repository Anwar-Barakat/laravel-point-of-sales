<?php

namespace App\Http\Livewire\Admin\Setting;

use Illuminate\Http\Request;
use Livewire\Component;

class GeneralSetting extends Component
{
    public $setting;

    public $company_name_ar, $company_name_en, $company_code,
        $address, $mobile, $alert_msg, $logo;

    public function mount()
    {
        $this->company_name_ar  = $this->setting->getTranslation('company_name', 'ar');
        $this->company_name_en  = $this->setting->getTranslation('company_name', 'en');
        $this->company_code     = $this->setting->company_code;
        $this->address          = $this->setting->address;
        $this->mobile           = $this->setting->mobile;
        $this->alert_msg        = $this->setting->alert_msg;
    }


    public function update(Request $request)
    {
        dd($request->all());
    }

    public function render()
    {
        return view('livewire.admin.setting.general-setting');
    }
}
