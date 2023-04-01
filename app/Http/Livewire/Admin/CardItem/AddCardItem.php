<?php

namespace App\Http\Livewire\Admin\CardItem;

use App\Models\Category;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddCardItem extends Component
{
    public $auth, $categories, $wholesale_units, $retail_units;
    public $barcode, $item_name, $is_active;
    public $item_type, $category_id;
    public $parent_id, $has_retail_unit, $wholesale_unit_id, $retail_unit_id, $retail_count_for_wholesale;
    public $image;

    public function mount()
    {
        $this->auth             = Auth::guard('admin')->user();
        $this->categories       = Category::with('subCategories:id,name')->select('id', 'name')->where('company_code', $this->auth->company_code)->active()->latest()->get();
        $this->wholesale_units  = Unit::select('id', 'name')->where(['company_code' => $this->auth->company_code, 'status' => 'wholesale'])->active()->get();
        $this->retail_units     = Unit::select('id', 'name')->where(['company_code' => $this->auth->company_code, 'status' => 'retail'])->active()->get();
    }

    public function render()
    {
        return view('livewire.admin.card-item.add-card-item');
    }
}
