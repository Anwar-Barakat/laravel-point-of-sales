<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\Order;

use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class GeneralOrderReturnItemForm extends Component
{
    public OrderProduct $product;
    public Order $order;
    public $batches, $batch,
        $items, $item,
        $unit;

    protected $listeners = ['updateOrderItem'];

    public function updateOrderItem(OrderProduct $product)
    {
        $this->product  = $product;
        $this->getItemAndUnit();
        $this->batches  = getBatches($this->product);
        $this->batch    = $this->product->item_batch;
    }

    public function mount(Order $order, OrderProduct $product)
    {
        $this->order                = $order;
        $this->product              = $product;
        $this->product->qty         = 1;
        $this->order->is_approved   == 0 ?  $this->items = Item::select('id', 'name')->active()->where('category_id', $this->order->vendor->category->id)->get() : [];
    }

    public function updatedProductItemId()
    {
        $this->item = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        if ($this->product->item_id && $this->product->unit_id)
            $this->batches  = getBatches($this->product);
    }

    public function updatedProductUnitId()
    {
        $this->batches  = getBatches($this->product);
        $this->getItemAndUnit();

        if ($this->product->item_batch_id) {
            $batch = $this->getItemBatch();
            $this->product->unit_price = $this->unit->status == 'wholesale'
                ? $batch->unit_price
                : $batch->unit_price / $this->product->item->retail_count_for_wholesale;
        }

        if ($this->product->qty >= 1 && $this->product->unit_price)
            $this->product->total_price = intval($this->product->qty) * floatval($this->product->unit_price);
    }

    public function updatedProductItemBatchId()
    {
        $this->batch = $this->getItemBatch();
        $this->product->unit_price = $this->unit->status == 'wholesale'
            ? $this->batch->unit_price
            : $this->batch->unit_price / $this->product->item->retail_count_for_wholesale;

        $this->product->total_price = intval($this->product->qty) * floatval($this->product->unit_price);
    }

    public function calcPrice()
    {
        $batch = $this->getItemBatch();

        $qty = $this->unit->status == 'wholesale'
            ? $batch->qty
            : $batch->qty * $this->product->item->retail_count_for_wholesale;

        if ($qty < $this->product->qty) {
            toastr()->error(__('validation.qty_not_available_now'));
            $this->product->qty = 1;
        }
        $this->product->total_price = (int)$this->product->qty * (float)$this->product->unit_price;
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
                    'company_id'    => get_auth_com(),
                ])->save();

                $totalPrices = $this->order->orderProducts()->sum('total_price');
                $this->order->fill([
                    'items_cost'            => $totalPrices,
                    'cost_before_discount'  => $totalPrices,
                    'cost_after_discount'   => $totalPrices,
                ])->save();

                DB::commit();
                $this->emit('updateOrderProducts', ['order' => $this->order]);
                toastr()->success(__('msgs.added', ['name' => __('stock.item')]));
                $this->reset('product');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.order.general-order-return-item-form', ['order' => $this->order]);
    }

    public function rules(): array
    {
        return [
            'order.store_id'            => ['required', 'integer'],
            'product.item_id'           => [
                'required',
                Rule::unique('order_products', 'item_id')->where(function ($query) {
                    return $query->where(['order_id' => $this->order->id, 'unit_id' => $this->product->unit_id, 'company_id' => get_auth_com()]);
                })->ignore($this->product->id)
            ],
            'product.item_batch_id'     => ['required', 'integer'],
            'product.unit_id'           => ['required', 'integer'],
            'product.qty'               => ['required', 'integer'],
            'product.unit_price'        => ['required', 'numeric', 'between:1,9999'],
            'product.total_price'       => ['required'],
        ];
    }

    public function getItemBatch()
    {
        return ItemBatch::select('unit_price', 'qty')->where(['id' => $this->product->item_batch_id, 'company_id' => get_auth_com()])->first();
    }

    public function getItemAndUnit()
    {
        $this->item = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        $this->unit = Unit::select('id', 'name', 'status')->findOrFail($this->product->unit_id);
    }
}
