<?php

namespace App\Http\Livewire\Admin\Setting;

use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class GeneralSetting extends Component
{
    use WithFileUploads;

    public $setting,
        $company_name_ar, $company_name_en,
        $address, $mobile, $alert_msg, $logo;

    protected $rules = [
        'company_name_ar'   => ['required', 'string', 'min:3'],
        'company_name_en'   => ['required', 'string'],
        'address'           => ['required', 'min:3'],
        'mobile'            => ['required'],
        'alert_msg'         => ['required'],
        'logo'              => ['nullable', 'image', 'max:1024', 'mimes:jpeg,png,jpg,svg']
    ];

    public function mount()
    {
        $this->company_name_ar  = $this->setting->getTranslation('company_name', 'ar');
        $this->company_name_en  = $this->setting->getTranslation('company_name', 'en');
        $this->address          = $this->setting->address;
        $this->mobile           = $this->setting->mobile;
        $this->alert_msg        = $this->setting->alert_msg;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, $this->rules);
    }

    public function updateSetting()
    {
        try {
            $validation                         = $this->validate();
            $validation['company_name']['ar']   = $this->company_name_ar;
            $validation['company_name']['en']   = $this->company_name_en;
            $this->setting->update($validation);

            if ($this->logo) {
                $this->setting->clearMediaCollection('global_setting');
                $this->setting->addMedia($this->logo)
                    ->toMediaCollection('global_setting');
            }

            toastr()->success(__('msgs.updated', ['name' => __('setting.settings')]));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.setting.general-setting');
    }
}
