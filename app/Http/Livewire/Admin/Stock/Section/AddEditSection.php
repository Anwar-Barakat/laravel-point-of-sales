<?php

namespace App\Http\Livewire\Admin\Stock\Section;

use App\Models\Section;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddEditSection extends Component
{
    public Section $section;

    public $name_ar, $name_en;

    public function mount(Section $section)
    {
        $this->section              = $section;
        $this->name_ar  = $section->getTranslation('name', 'ar');
        $this->name_en  = $section->getTranslation('name', 'en');
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->section->name = [
                'ar' => $this->name_ar,
                'en' => $this->name_ar,
            ];

            $this->section->save();
            toastr()->success(__('msgs.submitted', ['name' => __('section.section')]));
            return redirect()->route('admin.sections.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.stock.section.add-edit-section');
    }

    public function rules()
    {
        return [
            'name_ar'               => [
                'required', 'string', 'min:3',
                Rule::unique('sections', 'name->ar')->ignore($this->section->id)
            ],
            'name_en'               => [
                'required', 'string', 'min:3',
                Rule::unique('sections', 'name->en')->ignore($this->section->id)
            ],
            'section.is_active'     => ['required', 'boolean'],
        ];
    }
}
