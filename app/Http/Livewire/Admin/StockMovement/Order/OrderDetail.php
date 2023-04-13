<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\Item;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderDetail extends Component
{
    use WithPagination;

    public Order $order;

    public $items = [];
    public $order_id, $unit_id;
    public $wholesale_unit,
        $retail_unit,
        $qty,
        $total_price;

    public $consuming = false,
        $production_date = '',
        $expiration_date = '';


    public function mount(Order $order)
    {
        $this->order        = $order;
        $this->order->is_approved == 0 ?  $this->items = Item::select('id', 'name')->active()->get() : [];
    }

    public function updatedorderId()
    {
        $item                   = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->order_id);
        $this->consuming        = $item->type == 2 ? true : false;
        $this->wholesale_unit   = $item->parentUnit;
        $this->retail_unit      = $item->childUnit ?? null;
    }

    public function render()
    {
        return view('livewire.admin.stock-movement.order.order-detail');
    }
}
