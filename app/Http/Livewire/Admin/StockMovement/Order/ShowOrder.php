<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class ShowOrder extends Component
{
    use WithPagination;

    public $name,
        $sort_by    = 'asc',
        $per_page   = PAGINATION_COUNT;


    public function render()
    {
        $orders = $this->getOrders();
        return view('livewire.admin.stock-movement.order.show-order', ['orders' => $orders]);
    }

    public function getOrders()
    {
        return  Order::with(['account', 'vendor'])
            ->paginate($this->per_page);;
    }
}