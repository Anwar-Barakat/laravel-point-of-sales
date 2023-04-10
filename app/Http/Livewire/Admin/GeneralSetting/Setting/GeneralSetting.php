<?php

namespace App\Http\Livewire\Admin\GeneralSetting\Setting;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class GeneralSetting extends Component
{
    use WithFileUploads;

    public $setting,
        $company_name_ar, $company_name_en, $account_id,
        $address, $mobile, $alert_msg, $logo;

    public $parent_accounts;

    public function mount()
    {
        $this->company_name_ar  = $this->setting->getTranslation('company_name', 'ar');
        $this->company_name_en  = $this->setting->getTranslation('company_name', 'en');
        $this->address          = $this->setting->address;
        $this->account_id       = $this->setting->account_id;
        $this->mobile           = $this->setting->mobile;
        $this->alert_msg        = $this->setting->alert_msg;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function updateSetting()
    {
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
        return redirect()->route('admin.settings.index');
    }

    public function render()
    {
        $this->parent_accounts  = Account::where('company_code', Auth::guard('admin')->user()->company_code)->parent()->get();
        return view('livewire.admin.general-setting.setting.general-setting', ['parent_accounts' => $this->parent_accounts]);
    }

    public function rules(): array
    {
        return [
            'company_name_ar'   => ['required', 'string', 'min:3'],
            'company_name_en'   => ['required', 'string'],
            'address'           => ['required', 'min:3'],
            'mobile'            => ['required'],
            'account_id'        => ['required', 'integer'],
            'alert_msg'         => ['required'],
            'logo'              => ['nullable', 'image', 'max:1024', 'mimes:jpeg,png,jpg,svg'],
        ];
    }
}
