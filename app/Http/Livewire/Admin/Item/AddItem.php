<?php

namespace App\Http\Livewire\Admin\Item;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AddItem extends Component
{
    use WithFileUploads;

    public $auth,
        $categories         = [],
        $parent_items       = [],
        $wholesale_units    = [],
        $retail_units       = [];

    public $name, $is_active;
    public $type, $category_id, $parent_id;
    public $has_retail_unit,
        $has_fixed_price,
        $wholesale_unit_id,
        $retail_unit_id,
        $retail_count_for_wholesale;
    public $wholesale_price;
    public $wholesale_price_for_block;
    public $wholesale_price_for_half_block;
    public $wholesale_cost_price;
    public $retail_price;
    public $retail_price_for_block;
    public $retail_price_for_half_block;
    public $retail_cost_price,
        $image;

    public function mount()
    {
        $this->auth             = Auth::guard('admin')->user();
        $this->parent_items     = Item::select('id', 'name')->where(['company_code' => $this->auth->company_code])->active()->get();
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
        $validation                 = $this->validate();
        $validation['code']         = Str::random(15);
        $validation['barcode']      = 'item-' . Str::random(15);
        $validation['added_by']     = $this->auth->id;
        $validation['company_code'] = $this->auth->company_code;

        $item = Item::create($validation);
        if ($this->image) {
            $this->validate(['image' => 'image|max:1024']);
            $item->clearMediaCollection('items');
            $item->addMedia($this->image)->toMediaCollection('items');
        }

        toastr()->success(__('msgs.created', ['name' => __('item.card')]));
        $this->resetExcept(['auth', 'categories', 'wholesale_units', 'parent_items']);
    }


    public function render()
    {
        return view('livewire.admin.item.add-item');
    }

    protected function rules()
    {
        return [
            'name'                              => ['required', 'min:3', 'unique:items,name'],
            'is_active'                         => ['required', 'boolean'],
            'type'                              => ['required', 'in:1,2,3'],
            'category_id'                       => ['required', 'integer'],
            'parent_id'                         => ['required', 'integer'],
            'has_fixed_price'                   => ['required', 'boolean'],
            'has_retail_unit'                   => ['required', 'boolean'],
            'wholesale_unit_id'                 => ['required', 'integer'],
            'wholesale_price'                   => ['required', 'min:0', 'numeric'],
            'wholesale_price_for_block'         => ['required', 'min:0', 'numeric'],
            'wholesale_price_for_half_block'    => ['required', 'min:0', 'numeric'],
            'wholesale_cost_price'              => ['required', 'min:0', 'numeric'],

            'retail_count_for_wholesale'        => 'required_if:has_retail_unit,1',
            'retail_unit_id'                    => 'required_if:has_retail_unit,1',
            'retail_price'                      => 'required_if:has_retail_unit,1',
            'retail_price_for_block'            => 'required_if:has_retail_unit,1',
            'retail_price_for_half_block'       => 'required_if:has_retail_unit,1',
            'retail_cost_price'                 => 'required_if:has_retail_unit,1',
        ];
    }
}
