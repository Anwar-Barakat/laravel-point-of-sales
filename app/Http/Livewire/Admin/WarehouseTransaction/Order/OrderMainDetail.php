<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\Order;

use App\Models\Order;
use Livewire\Component;

class OrderMainDetail extends Component
{
    public Order $order;

    protected $listeners = ['addNewOrder'];

    public function addNewOrder(Order $order)
    {
        $this->order = $order;
    }

    public function mount(Order $order)
    {
        $this->order = $order;
    }
    public function render()
    {
        return view('livewire.admin.warehouse-transaction.order.order-main-detail', ['order' => $this->order]);
    }
}