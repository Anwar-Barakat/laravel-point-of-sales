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

    public $batches,
        $batch,
        $items,
        $item,
        $unit;

    public function mount(Order $order, OrderProduct $product)
    {
        $this->order                = $order;
        $this->product              = $product;
        $this->product->qty         = 1;
        $this->order->is_approved   == 0 ?  $this->items = Item::select('id', 'name')->active()->get() : [];
    }

    public function updatedProductItemId()
    {
        $this->item = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        if ($this->product->item_id && $this->product->unit_id)
            $this->batches  = $this->getBatches();
    }

    public function updatedProductUnitId()
    {
        $this->getItemAndUnit();
        $this->batches  = $this->getBatches();

        if ($this->product->item_id && $this->product->sale_type)
            $this->product->unit_price = $this->getUnitPrice();

        if ($this->product->qty && $this->product->unit_price)
            $this->product->total_price = intval($this->product->qty) * floatval($this->product->unit_price);
    }

    public function updatedProductItemBatchId()
    {
        $this->batch                = $this->getItemBatch();
        $this->product->unit_price  = $this->batch->unit_price;
        $this->product->total_price = (int)$this->product->qty * (float)$this->product->unit_price;
    }

    public function calcPrice()
    {
        $qty = item_batch_qty($this->product->item, $this->order->store_id);
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
                $this->reset('product.item_id');
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
            ],
            'product.item_batch_id'     => ['required', 'integer'],
            'product.unit_id'           => ['required', 'integer'],
            'product.qty'               => ['required', 'integer'],
            'product.unit_price'        => ['required', 'numeric', 'between:1,9999'],
            'product.total_price'       => ['required'],
        ];
    }


    public function getBatches()
    {
        return ItemBatch::select('id', 'unit_price', 'qty', 'production_date', 'expiration_date')
            ->where(['company_id'         => get_auth_com()])
            ->when($this->product->item_id,     fn ($q) => $q->where(['item_id'     => $this->product->item_id]))
            ->when($this->product->store_id,    fn ($q) => $q->where(['store_id'    => $this->product->store_id]))
            ->when($this->product->unit_id,     fn ($q) => $q->where(['unit_id'     => $this->item->parentUnit->id]))
            ->latest()->get();
    }

    public function getItemBatch()
    {
        return ItemBatch::select('unit_price', 'qty')->where(['id' => $this->product->item_batch_id, 'company_id' => get_auth_com()])->first();
    }

    public function getItemAndUnit()
    {
        $this->item             = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        $this->unit             = Unit::select('id', 'name', 'status')->findOrFail($this->product->unit_id);
    }
}