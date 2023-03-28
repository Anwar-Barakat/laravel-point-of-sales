<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $is_active, $category_id;

    public function updateStatus($category_id)
    {
        $category           = Category::findOrFail($category_id);
        $category->update(['is_active' => !$category->is_active]);
        $this->is_active    = $category->is_active;
    }

    public function render()
    {
        return view('livewire.admin.category.update-status');
    }
}
