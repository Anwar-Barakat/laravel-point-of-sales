<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class StoreCategory extends Component
{
    use WithFileUploads;

    public $name, $is_active, $image, $description,
        $section_id, $parent_id, $categories;

    protected $rules = [
        'name'          => ['required', 'string', 'min:3'],
        'is_active'     => ['required', 'boolean'],
        'parent_id'     => ['required', 'integer'],
        'section_id'    => ['required', 'integer'],
        'description'   => ['required', 'min:10']
    ];

    public function updated($fileds)
    {
        return $this->validateOnly($fileds);
    }

    public function updatedSectionId()
    {
        $this->categories = Category::where('section_id', $this->section_id)->active()->get();
    }

    public function store()
    {
        $auth   = Auth::guard('admin')->user();

        $validation                 = $this->validate();
        $validation['added_by']     = $auth->id;
        $validation['company_code'] = $auth->company_code;

        $category   = Category::create($validation);

        if ($this->image) {
            $this->validate(['image' => 'image|max:1024']);
            $category->clearMediaCollection('categories');
            $category->addMedia($this->image)->toMediaCollection('categories');
        }

        toastr()->success(__('msgs.create', ['name' => __('category.category')]));
        $this->reset();
    }

    public function render()
    {
        $sections   = Section::get();
        return view('livewire.admin.category.store-category', ['sections' => $sections]);
    }
}
