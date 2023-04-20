<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class OrderDetail extends Component
{
    use WithPagination;

    public Order $order;
    public OrderProduct $product;

    public $items = [], $auth;
    public $wholesale_unit = null,
        $retail_unit = null;

    public $consuming = false;

    public $products = [];


    public function mount(Order $order, OrderProduct $product)
    {
        $this->auth            = Auth::guard('admin')->user();
        $this->order           = $order;
        $this->product         = $product;
        $this->product->qty    = 1;
        $this->order->is_approved   == 0 ?  $this->items = Item::select('id', 'name')->active()->get() : [];
    }

    public function calcPrice()
    {
        $this->product->total_price = (int)$this->product->qty * (float)$this->product->unit_price;
    }

    public function updatedProductItemId()
    {
        $item                   = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        $this->consuming        = $item->type == 2 ? true : false;
        $this->wholesale_unit   = $item->parentUnit;
        $this->retail_unit      = $item->childUnit ?? null;
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            if ($this->order->is_approved == 0) {
                DB::beginTransaction();

                $this->product->order_id       = $this->order->id;
                $this->product->added_by       = $this->auth->id;
                $this->product->company_code   = $this->auth->company_code;
                $this->product->save();

                $totalPrices = OrderProduct::where('order_id', $this->order->id)->where('company_code', $this->auth->company_code)->sum('total_price');
                $this->order->items_cost            = $totalPrices;
                $this->order->cost_before_discount  = $totalPrices + $this->order->tax;
                $this->order->cost_after_discount   = $this->order->cost_before_discount - $this->order->discount;
                $this->order->save();

                DB::commit();
                toastr()->success(__('msgs.added', ['name' => __('stock.item')]));
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.orders.show', $this->order)->with(['error' => $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $product            = OrderProduct::with('item:id,type')->findOrFail($id);
        $this->consuming    = $product->item->type == 2 ?  true : false;
        $this->product      = $product;
    }

    public function delete($id)
    {
        $product            = OrderProduct::findOrFail($id);
        $product->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('stock.items')]));
    }

    public function render()
    {
        $order_products = OrderProduct::where('order_id', $this->order->id)
            ->where('company_code', $this->auth->company_code)->paginate(CUSTOM_PAGINATION);
        return view('livewire.admin.stock-movement.order.order-detail', ['order_products' => $order_products]);
    }


    public function rules(): array
    {
        return [
            'product.item_id'           => [
                'required',
                Rule::unique('order_products', 'item_id')->ignore($this->product->id)->where(function ($query) {
                    return $query->where('item_id', $this->product->item_id);
                })
            ],
            'product.unit_id'           => ['required', 'integer'],
            'product.unit_price'        => ['required', 'between:0,9999'],
            'product.qty'               => ['required', 'integer'],
            'product.production_date'   => ['required_if:consuming,yes'],
            'product.expiration_date'   => ['required_if:consuming,yes'],
            'product.total_price'       => ['required'],
        ];
    }
}