<?php

namespace App\Http\Livewire\Admin\Stock\Category;

use App\Models\Category;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCategory extends Component
{
    use WithFileUploads;

    public $category;

    public $name_ar, $name_en, $is_active, $image, $description,
        $section_id, $parent_id, $categories;

    protected $rules = [
        'name_ar'       => ['required', 'string', 'min:3'],
        'name_en'       => ['required', 'string', 'min:3'],
        'is_active'     => ['required', 'boolean'],
        'parent_id'     => ['required', 'integer'],
        'section_id'    => ['required', 'integer'],
        'description'   => ['required', 'min:10']
    ];

    public function mount()
    {
        $this->name_ar      = $this->category->getTranslation('name', 'ar');
        $this->name_en      = $this->category->getTranslation('name', 'en');
        $this->parent_id    = $this->category->parent_id;
        $this->is_active    = $this->category->is_active;
        $this->section_id   = $this->category->section_id;
        $this->description  = $this->category->description;
        $this->categories   = Category::with('subCategories')->where(['section_id' => $this->section_id, 'parent_id' => 0])->get();
        // dd($this->categories);
        // dd($this->parent_id);
    }

    public function updated($fileds)
    {
        return $this->validateOnly($fileds);
    }

    public function updatedSectionId()
    {
        $this->categories = Category::with('subCategories')->where(['section_id' => $this->section_id, 'parent_id' => 0])->get();
    }

    public function update()
    {
        $auth   = Auth::guard('admin')->user();

        $validation                 = $this->validate();
        $validation['name']['ar']   = $this->name_ar;
        $validation['name']['en']   = $this->name_en;
        $validation['added_by']     = $auth->id;
        $validation['company_code'] = $auth->company_code;

        $this->category->update($validation);

        if ($this->image) {
            $this->validate(['image' => 'image|max:1024']);
            $this->category->clearMediaCollection('categories');
            $this->category->addMedia($this->image)->toMediaCollection('categories');
        }

        toastr()->success(__('msgs.create', ['name' => __('category.category')]));
        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        $sections = Section::get();
        return view('livewire.admin.stock.category.edit-category', ['sections' => $sections]);
    }
}