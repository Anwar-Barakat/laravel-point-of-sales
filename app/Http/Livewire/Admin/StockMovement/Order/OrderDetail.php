<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class OrderDetail extends Component
{
    use WithPagination;

    public Order $order;
    public OrderProduct $orderProduct;

    public $items = [], $auth;
    public $wholesale_unit = null,
        $retail_unit = null;

    public $consuming = false;

    public $orderProducts = [];


    public function mount(Order $order, OrderProduct $orderProduct)
    {
        $this->auth                 = Auth::guard('admin')->user();
        $this->order                = $order;
        $this->orderProduct         = $orderProduct;
        $this->orderProduct->qty    = 1;
        $this->order->is_approved   == 0 ?  $this->items = Item::select('id', 'name')->active()->get() : [];
    }

    public function calcPrice()
    {
        $this->orderProduct->total_price = (int)$this->orderProduct->qty * (float)$this->orderProduct->unit_price;
    }

    public function updatedOrderProductItemId()
    {
        $item                   = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->orderProduct->item_id);
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
                $this->orderProduct->order_id       = $this->order->id;
                $this->orderProduct->added_by       = $this->auth->id;
                $this->orderProduct->company_code   = $this->auth->company_code;
                $this->orderProduct->save();
            }
            toastr()->success(__('msgs.added', ['name' => __('stock.item')]));
        } catch (\Throwable $th) {
            return redirect()->route('admin.orders.show', $this->order)->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        $order_products = OrderProduct::where('order_id', $this->order->id)->paginate(PAGINATION_COUNT);
        return view('livewire.admin.stock-movement.order.order-detail', ['order_products' => $order_products]);
    }


    public function rules(): array
    {
        return [
            'orderProduct.item_id'           => [
                'required',
                Rule::unique('order_products', 'item_id')->ignore($this->orderProduct->id)->where(function ($query) {
                    return $query->where('item_id', $this->orderProduct->item_id);
                })
            ],
            'orderProduct.unit_id'           => ['required'],
            'orderProduct.unit_price'        => ['required', 'integer'],
            'orderProduct.qty'               => ['required', 'integer'],
            'orderProduct.production_date'   => ['required_if:consuming,yes'],
            'orderProduct.expiration_date'   => ['required_if:consuming,yes'],
            'orderProduct.total_price'       => ['required'],
        ];
    }
}
