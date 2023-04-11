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

    public $auth;
    public $setting,
        $company_name_ar, $company_name_en,
        $customer_account_id, $vendor_account_id,
        $address, $mobile, $alert_msg, $logo;

    public $parent_accounts;

    public function mount()
    {
        $this->auth = Auth::guard('admin')->user();
        $this->company_name_ar      = $this->setting->getTranslation('company_name', 'ar');
        $this->company_name_en      = $this->setting->getTranslation('company_name', 'en');
        $this->address              = $this->setting->address;
        $this->customer_account_id  = $this->setting->customer_account_id;
        $this->vendor_account_id    = $this->setting->vendor_account_id;
        $this->mobile               = $this->setting->mobile;
        $this->alert_msg            = $this->setting->alert_msg;

        $this->parent_accounts    = Account::where('company_code', $this->auth->company_code)->parent()->get();
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
        return view('livewire.admin.general-setting.setting.general-setting');
    }

    public function rules(): array
    {
        return [
            'company_name_ar'       => ['required', 'string', 'min:3'],
            'company_name_en'       => ['required', 'string'],
            'address'               => ['required', 'min:3'],
            'mobile'                => ['required'],
            'customer_account_id'   => ['required', 'integer'],
            'vendor_account_id'     => ['required', 'integer'],
            'alert_msg'             => ['required'],
            'logo'                  => ['nullable', 'image', 'max:1024', 'mimes:jpeg,png,jpg,svg'],
        ];
    }
}