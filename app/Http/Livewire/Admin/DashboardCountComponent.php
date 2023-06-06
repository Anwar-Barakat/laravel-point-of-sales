<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Sale;
use App\Models\ServiceInvoice;
use Livewire\Component;

class DashboardCountComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard-count-component', [
            'orders_count'              => $this->getOrdersCount(),
            'orders_waiting_payment'    => $this->getWaitingPaymentOrders(),
            'sales_count'               => $this->getSalesCount(),
            'sales_has_shipped'         => $this->getSalesHasShipped()
        ]);
    }

    public function getOrdersCount()
    {
        return Order::where('type', 1)->count();
    }

    public function getWaitingPaymentOrders()
    {
        return Order::where('type', 1)->where('remains', '!=', 0)->count();
    }

    public function getSalesCount()
    {
        return Sale::where('type', 1)->count();
    }

    public function getSalesHasShipped()
    {
        return Sale::where('type', 1)->where('is_approved', 1)->count();
    }
}
