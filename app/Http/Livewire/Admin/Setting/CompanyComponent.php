<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Account;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyComponent extends Component
{
    use WithFileUploads;

    public Company $company;

    public $name_ar, $name_en, $logo;

    public $parent_accounts;

    public function mount(Company $company)
    {
        $this->company          = $company;
        $this->name_ar          = $company->getTranslation('name', 'ar');
        $this->name_en          = $company->getTranslation('name', 'en');
        $this->parent_accounts  = Account::active()->parent()->get();
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->company->name = [
                'ar' => $this->name_ar,
                'en' => $this->name_en
            ];
            $this->company->save();

            if ($this->logo) {
                $this->company->clearMediaCollection('company_logo');
                $this->company->addMedia($this->logo)
                    ->toMediaCollection('company_logo');
            }

            toastr()->success(__('msgs.updated', ['name' => __('setting.settings')]));
        } catch (\Throwable $th) {
            return redirect()->route('admin.setting.company')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.setting.company-component');
    }

    public function rules(): array
    {
        return [
            'name_ar'                               => ['required', 'string', 'min:3'],
            'name_en'                               => ['required', 'string', 'min:3'],
            'company.address'                       => ['required', 'min:3'],
            'company.mobile'                        => ['required'],
            'company.parent_customer_id'            => ['required', 'integer'],
            'company.parent_vendor_id'              => ['required', 'integer'],
            'company.parent_delegate_id'            => ['required', 'integer'],
            'company.parent_production_line_id'     => ['required', 'integer'],
            'company.alert_msg'                     => ['required'],
            'logo'                                  => ['nullable', 'image', 'max:1024', 'mimes:jpeg,png,jpg,svg'],
        ];
    }
}
