<?php

namespace App\Http\Livewire\Admin\Item;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class EditItem extends Component
{
    use WithFileUploads;

    public Item $item;

    public $auth,
        $categories         = [],
        $parent_items       = [],
        $wholesale_units    = [],
        $retail_units       = [];

    public $barcode,
        $image;

    public function mount(Item $item)
    {
        $this->item             = $item;
        $this->barcode          = $item->barcode;
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
        $this->validate();
        $this->item['code']         = Str::random(15);
        $this->item['barcode']      = 'item-' . Str::random(15);
        $this->item['added_by']     = $this->auth->id;
        $this->item['company_code'] = $this->auth->company_code;

        $this->item->save();
        if ($this->image) {
            $this->validate(['image' => 'image|max:1024']);
            $this->item->clearMediaCollection('items');
            $this->item->addMedia($this->image)->toMediaCollection('items');
        }

        toastr()->success(__('msgs.submited', ['name' => __('item.item')]));
    }


    public function render()
    {
        return view('livewire.admin.item.edit-item');
    }

    protected function rules()
    {
        return [
            'item.name'                              => ['required', 'min:3', 'unique:items,name,NULL,id'],
            'item.is_active'                         => ['required', 'boolean'],
            'item.type'                              => ['required', 'in:1,2,3'],
            'item.category_id'                       => ['required', 'integer'],
            'item.parent_id'                         => ['required', 'integer'],
            'item.has_fixed_price'                   => ['required', 'boolean'],
            'item.has_retail_unit'                   => ['required', 'boolean'],
            'item.wholesale_unit_id'                 => ['required', 'integer'],
            'item.wholesale_price'                   => ['required', 'min:0', 'numeric'],
            'item.wholesale_price_for_block'         => ['required', 'min:0', 'numeric'],
            'item.wholesale_price_for_half_block'    => ['required', 'min:0', 'numeric'],
            'item.wholesale_cost_price'              => ['required', 'min:0', 'numeric'],

            'item.retail_count_for_wholesale'        => 'required_if:has_retail_unit,1',
            'item.retail_unit_id'                    => 'required_if:has_retail_unit,1',
            'item.retail_price'                      => 'required_if:has_retail_unit,1',
            'item.retail_price_for_block'            => 'required_if:has_retail_unit,1',
            'item.retail_price_for_half_block'       => 'required_if:has_retail_unit,1',
            'item.retail_cost_price'                 => 'required_if:has_retail_unit,1',
        ];
    }
}
