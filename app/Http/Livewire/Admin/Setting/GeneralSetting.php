<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Illuminate\Http\Request;
use Livewire\Component;

class GeneralSetting extends Component
{
    public $setting;

    public $company_name_ar, $company_name_en, $company_code,
        $address, $mobile, $alert_msg, $logo;

    protected $rules = [
        'company_name_ar'   => ['required', 'string', 'min:3'],
        'company_name_en'   => ['required', 'string'],
        'company_code'      => ['required', 'integer'],
        'address'           => ['required', 'min:3'],
        'mobile'            => ['required'],
        'alert_msg'         => ['required']
    ];

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
        $validation     = $this->validate();
        $setting        = Setting::find($this->setting->id);
        $setting->update([
            'company_name'   => [
                'ar'    => $this->company_name_ar,
                'en'    => $this->company_name_en,
            ],
            'company_code'      => $this->company_code,
            'address'           => $this->address,
            'mobile'            => $this->mobile,
            'alert_msg'         => $this->alert_msg,
        ]);
        toastr()->success(__('msgs.updated', ['name' => __('setting.settings')]));
    }

    public function render()
    {
        return view('livewire.admin.setting.general-setting');
    }
}