<?php

namespace App\Http\Livewire\Admin\Stock\Item;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AddEditItem extends Component
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
        $this->auth             = Auth::guard('admin')->user();
        $this->item             = $item;
        $this->barcode          = $item->barcode;
        $this->parent_items     = Item::select('id', 'name')->where(['company_code' => $this->auth->company_code])->active()->get();
        $this->categories       = Category::with('subCategories:id,name')->select('id', 'name')->where('company_code', $this->auth->company_code)->active()->latest()->get();
        $this->wholesale_units  = Unit::select('id', 'name')->where(['company_code' => $this->auth->company_code, 'status' => 'wholesale'])->active()->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedItemHasRetailUnit()
    {
        $this->retail_units = $this->item->has_retail_unit
            ? Unit::select('id', 'name')->where(['company_code' => $this->auth->company_code, 'status' => 'retail'])->active()->get()
            : [];
    }


    public function submit()
    {
        // try {
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

        toastr()->success(__('msgs.submitted', ['name' => __('item.item')]));
        return redirect()->route('admin.items.index');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        // }
    }


    public function render()
    {
        return view('livewire.admin.stock.item.add-edit-item');
    }

    protected function rules()
    {
        return [
            'item.name' => [
                'required',
                'min:3',
                Rule::unique('items', 'name')->ignore($this->item->id)->where(function ($query) {
                    return $query->where('company_code', $this->auth->company_code);
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
