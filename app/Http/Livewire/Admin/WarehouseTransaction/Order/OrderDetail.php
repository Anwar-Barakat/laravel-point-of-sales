<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\Order;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class OrderDetail extends Component
{
    use WithPagination;

    public Order $order;
    public OrderProduct $product;

    public $items = [], $item;

    public $consuming = false;

    public $products = [];


    public function mount(Order $order, OrderProduct $product)
    {
        $this->order                = $order;
        $this->product              = $product;
        $this->order->invoice_date  = date('Y-m-d');
        $this->product->qty         = 1;
        $this->order->is_approved   == 0 ?  $this->items = Item::select('id', 'name')->active()->get() : [];
    }

    public function calcPrice()
    {
        $this->product->total_price = (int)$this->product->qty * (float)$this->product->unit_price;
    }

    public function updatedProductItemId()
    {
        $this->item             = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        $this->consuming        = $this->item->type == 2 ? true : false;
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


                $this->product->fill([
                    'order_id'      => $this->order->id,
                    'added_by'      => get_auth_id(),
                    'company_code'  => get_auth_com(),
                ])->save();

                $totalPrices = OrderProduct::where('order_id', $this->order->id)->where('company_code', get_auth_com())->sum('total_price');
                $this->order->fill([
                    'items_cost'            => $totalPrices,
                    'cost_before_discount'  => $totalPrices,
                    'cost_after_discount'   => $totalPrices,
                ])->save();

                DB::commit();
                toastr()->success(__('msgs.added', ['name' => __('stock.item')]));
                $this->reset('product');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.orders.show', $this->order)->with(['error' => $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $product                = OrderProduct::with('item')->findOrFail($id);
        $this->consuming        = $product->item->type == 2 ?  true : false;
        $this->product          = $product;
        $this->item             = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
    }

    public function delete($id)
    {
        $product            = OrderProduct::where(['id' => $id, 'order_id' => $this->order->id])->first();
        $product->delete();
        $this->getOrderProducts();
        toastr()->info(__('msgs.deleted', ['name' => __('stock.items')]));
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.order.order-detail', ['order_products' => $this->getOrderProducts()]);
    }


    public function rules(): array
    {
        return [
            'product.item_id'           => [
                'required',
                Rule::unique('order_products', 'item_id')->where(function ($query) {
                    return $query->where('company_code', get_auth_com())
                        ->where('unit_id', $this->product->unit_id)
                        ->where('order_id', $this->order->id);
                })->ignore($this->product->id)
            ],
            'product.unit_id'           => ['required', 'integer'],
            'product.unit_price'        => ['required', 'between:0,9999'],
            'product.qty'               => ['required', 'integer'],
            'product.production_date'   => ['required_if:consuming,yes'],
            'product.expiration_date'   => ['required_if:consuming,yes'],
            'product.total_price'       => ['required'],
        ];
    }

    public function getOrderProducts()
    {
        return OrderProduct::where('order_id', $this->order->id)
            ->where('company_code', get_auth_com())->paginate(CUSTOM_PAGINATION - 5);
    }
}
