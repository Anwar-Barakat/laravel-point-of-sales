<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\Order;

use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Validation\Rule;
use Livewire\Component;

class GeneralOrderReturnItemForm extends Component
{
    public OrderProduct $product;

    public Order $order;

    public $batches,
        $items,
        $item;

    public function mount(Order $order, OrderProduct $product)
    {
        $this->order                = $order;
        $this->product              = $product;
        $this->order->is_approved   == 0 ?  $this->items = Item::select('id', 'name')->active()->get() : [];
    }

    public function updatedProductItemId()
    {
        $this->item             = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        $this->batches          = $this->getBatches();
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
            'product.batch_id'          => ['required', 'integer'],
            'product.production_date'   => ['required_if:consuming,yes'],
            'product.expiration_date'   => ['required_if:consuming,yes'],
            'product.total_price'       => ['required'],
        ];
    }

    public function getBatches()
    {
        return ItemBatch::where(['store_id' => $this->order->store_id, 'company_id' => get_auth_com()])
            ->when($this->product->item_id,     fn ($q) => $q->where(['item_id'     => $this->product->item_id]))
            ->when($this->product->unit_id,     fn ($q) => $q->where(['unit_id'     => $this->product->unit_id]))
            ->get();
    }
}