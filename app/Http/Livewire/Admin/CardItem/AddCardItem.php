<?php

namespace App\Http\Livewire\Admin\CardItem;

use App\Models\Category;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddCardItem extends Component
{
    public $auth,
        $categories = [],
        $wholesale_units = [],
        $retail_units = [];
    public $barcode, $item_name, $is_active;
    public $item_type, $category_id;
    public $has_retail_unit,
        $wholesale_unit_id,
        $retail_unit_id,
        $retail_count_for_wholesale;
    public $wholesale_price, $wholesale_price_for_block, $wholesale_price_for_half_block, $wholesale_cost_price;
    public $retail_price, $retail_price_for_block, $retail_price_for_half_block, $retail_cost_price,
        $image;

    public function mount()
    {
        $this->auth             = Auth::guard('admin')->user();
        $this->categories       = Category::with('subCategories:id,name')->select('id', 'name')->where('company_code', $this->auth->company_code)->active()->latest()->get();
        $this->wholesale_units  = Unit::select('id', 'name')->where(['company_code' => $this->auth->company_code, 'status' => 'wholesale'])->active()->get();
    }

    public function updatedHasRetailUnit()
    {
        if ($this->has_retail_unit)
            $this->retail_units     = Unit::select('id', 'name')->where(['company_code' => $this->auth->company_code, 'status' => 'retail'])->active()->get();
        else
            $this->retail_units  = [];
    }


    public function render()
    {
        return view('livewire.admin.card-item.add-card-item');
    }
}
