<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\Item;
use App\Models\Order;
use Livewire\Component;

class OrderDetail extends Component
{
    public Order $order;

    public $items = [];

    public function mount(Order $order)
    {
        $this->order = $order;

        $this->items    = Item::active()->get();
    }

    public function render()
    {
        return view('livewire.admin.stock-movement.order.order-detail');
    }
}
