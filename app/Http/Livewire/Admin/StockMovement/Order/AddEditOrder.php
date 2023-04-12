<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddEditOrder extends Component
{

    public function render()
    {
        return view('livewire.admin.stock-movement.order.add-edit-order');
    }

}