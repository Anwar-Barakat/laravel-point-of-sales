<?php

namespace App\Http\Livewire\Admin\CardItem;

use App\Models\Category;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddCardItem extends Component
{
    use WithFileUploads;

    public $auth,
        $categories = [],
        $wholesale_units = [],
        $retail_units = [];
    public $barcode, $item_name, $is_active;
    public $item_type, $category_id;
    public $has_retail_unit,
        $has_fixed_price,
        $wholesale_unit_id,
        $retail_unit_id,
        $retail_count_for_wholesale;
    public $wholesale_price, $wholesale_price_for_block, $wholesale_price_for_half_block, $wholesale_cost_price;
    public $retail_price, $retail_price_for_block, $retail_price_for_half_block, $retail_cost_price,
        $image;

    protected $rules = [
        'item_name'                         => ['required', 'min:3'],
        'is_active'                         => ['required', 'boolean'],
        'item_type'                         => ['required', 'in:stored,consuming,protected'],
        'category_id'                       => ['required', 'integer'],
        'has_fixed_price'                   => ['required', 'boolean'],
        'has_retail_unit'                   => ['required', 'boolean'],
        'wholesale_unit_id'                 => ['required', 'integer'],
        'wholesale_price'                   => ['required', 'min:0', 'numeric'],
        'wholesale_price_for_block'         => ['required', 'min:0', 'numeric'],
        'wholesale_price_for_half_block'    => ['required', 'min:0', 'numeric'],
        'wholesale_cost_price'              => ['required', 'min:0', 'numeric'],

        'retail_count_for_wholesale'        => 'required_if:has_retail_unit,yes|numeric',
        'retail_unit_id'                    => 'required_if:has_retail_unit,yes|numeric',
        'retail_price'                      => 'required_if:has_retail_unit,yes|numeric',
        'retail_price_for_block'            => 'required_if:has_retail_unit,yes|numeric',
        'retail_price_for_half_block'       => 'required_if:has_retail_unit,yes|numeric',
        'retail_cost_price'                 => 'required_if:has_retail_unit,yes|numeric',
    ];

    public function mount()
    {
        $this->auth             = Auth::guard('admin')->user();
        $this->categories       = Category::with('subCategories:id,name')->select('id', 'name')->where('company_code', $this->auth->company_code)->active()->latest()->get();
        $this->wholesale_units  = Unit::select('id', 'name')->where(['company_code' => $this->auth->company_code, 'status' => 'wholesale'])->active()->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedHasRetailUnit()
    {
        if ($this->has_retail_unit)
            $this->retail_units     = Unit::select('id', 'name')->where(['company_code' => $this->auth->company_code, 'status' => 'retail'])->active()->get();
        else
            $this->retail_units  = [];
    }

    public function submit()
    {
        $this->validate();
        dd('hi');
    }


    public function render()
    {
        return view('livewire.admin.card-item.add-card-item');
    }
}
