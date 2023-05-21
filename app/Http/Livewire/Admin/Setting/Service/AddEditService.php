<?php

namespace App\Http\Livewire\Admin\Setting\Service;

use App\Models\Service;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddEditService extends Component
{
    public Service $service;

    public $name_ar, $name_en;

    public function mount(Service $service)
    {
        $this->service  = $service ?? new Service();
        $this->name_ar  = $service->getTranslation('name', 'ar');
        $this->name_en  = $service->getTranslation('name', 'en');
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function render()
    {
        return view('livewire.admin.setting.service.add-edit-service');
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->service->name = [
                'ar' => $this->name_ar,
                'en' => $this->name_ar,
            ];
            $this->service->company_id = get_auth_com();
            $this->service->save();

            toastr()->success(__('msgs.submitted', ['name' => __('setting.service')]));
            return redirect()->route('admin.services.index');
        } catch (\Throwable $th) {
            return redirect()->route('admin.services.index')->with(['error' => $th->getMessage()]);
        }
    }

    public function rules()
    {
        return [
            'name_ar'               => [
                'required', 'string', 'min:3',
                Rule::unique('services', 'name->ar')->ignore($this->service->id)
            ],
            'name_en'               => [
                'required', 'string', 'min:3',
                Rule::unique('services', 'name->en')->ignore($this->service->id)
            ],
            'service.type'      => ['required', 'boolean'],
            'service.is_active' => ['required', 'boolean'],
        ];
    }
}