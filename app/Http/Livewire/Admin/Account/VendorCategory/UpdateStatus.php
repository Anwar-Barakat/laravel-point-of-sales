<?php

namespace App\Http\Livewire\Admin\Account\VendorCategory;

use App\Models\VendorCategory;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $is_active, $vendor_category_id;

    public function updateStatus($vendor_category_id)
    {
        $category           = VendorCategory::findOrFail($vendor_category_id);
        $category->update(['is_active' => !$category->is_active]);
        $this->is_active    = $category->is_active;
    }

    public function render()
    {
        return view('livewire.admin.account.vendor-category.update-status');
    }
}