<?php

namespace App\Http\Livewire\Admin\Stock\Item;

use App\Models\Category;
use App\Models\Item;
use App\Models\OrderProduct;
use App\Models\SaleProduct;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AddEditItem extends Component
{
    use WithFileUploads;

    public Item $item;

    public $categories         = [],
        $parent_items       = [],
        $wholesale_units    = [],
        $retail_units       = [],
        $item_used = false;

    public $image;

    public function mount(Item $item)
    {
        $this->item             = $item;
        $this->parent_items     = Item::select('id', 'name')->where(['company_id' => get_auth_com()])->active()->get();
        $this->categories       = Category::with('subCategories')->where(['company_id' => get_auth_com(), 'parent_id' => 0])->get();
        $this->wholesale_units  = Unit::select('id', 'name')->where(['company_id' => get_auth_com(), 'status' => 'wholesale'])->active()->get();
        $this->retail_units     = $this->item->has_retail_unit ?
            Unit::select('id', 'name')->where(['company_id' => get_auth_com(), 'status' => 'retail'])->active()->get() : [];

        $item_order         = OrderProduct::where('item_id', $this->item->id)->count();
        $item_sales         = SaleProduct::where('item_id', $this->item->id)->count();
        $this->item_used    = $item_order > 0 || $item_sales > 0 ? true : false;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedItemHasRetailUnit()
    {
        $this->retail_units = $this->item->has_retail_unit
            ? Unit::select('id', 'name')->where(['company_id' => get_auth_com(), 'status' => 'retail'])->active()->get()
            : [];
    }


    public function submit()
    {
        $this->validate();
        try {
            if (!$this->item->barcode)
                $this->item->barcode = uniqid();

            $this->item['added_by']     = get_auth_id();
            $this->item['company_id'] = get_auth_com();
            $this->item->save();

            if ($this->image) {
                $this->validate(['image' => 'image|max:1024']);
                $this->item->clearMediaCollection('items');
                $this->item->addMedia($this->image)->toMediaCollection('items');
            }

            toastr()->success(__('msgs.submitted', ['name' => __('stock.item')]));
            return redirect()->route('admin.items.index');
        } catch (\Throwable $th) {
            return redirect()->route('admin.items.create')->with(['error' => $th->getMessage()]);
        }
    }


    public function render()
    {
        return view('livewire.admin.stock.item.add-edit-item');
    }

    protected function rules()
    {
        return [
            'item.name'                          => [
                'required',
                'min:3',
                Rule::unique('items', 'name')->ignore($this->item->id)->where(function ($query) {
                    return $query->where('company_id', get_auth_com());
                })
            ],

            'item.is_active'                        => ['required', 'boolean'],
            'item.type'                             => ['required', 'in:1,2,3'],
            'item.category_id'                      => ['required', 'integer'],
            'item.parent_id'                        => ['required', 'integer'],
            'item.has_fixed_price'                  => ['required', 'boolean'],
            'item.has_retail_unit'                  => ['required', 'boolean'],
            'item.wholesale_unit_id'                => ['required', 'integer'],
            'item.wholesale_price'                  => ['required', 'between:0,999999'],
            'item.wholesale_price_for_block'        => ['required', 'between:0,999999'],
            'item.wholesale_price_for_half_block'   => ['required', 'between:0,999999'],
            'item.wholesale_cost_price'             => ['required', 'between:0,999999'],

            'item.retail_count_for_wholesale'       => ['required_if:has_retail_unit,yes'],
            'item.retail_unit_id'                   => ['required_if:has_retail_unit,yes'],
            'item.retail_price'                     => ['required_if:has_retail_unit,yes'],
            'item.retail_price_for_block'           => ['required_if:has_retail_unit,yes'],
            'item.retail_price_for_half_block'      => ['required_if:has_retail_unit,yes'],
            'item.retail_cost_price'                => ['required_if:has_retail_unit,yes'],
        ];
    }
}
