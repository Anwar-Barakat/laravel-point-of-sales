<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Sale;
use App\Models\WorkshopInvoice;
use Livewire\Component;

class DashboardComponent extends Component
{
    public $order_filter;
    public $sale_filter;

    public function render()
    {
        return view('livewire.admin.dashboard-component', [
            'orders_result'         => $this->getOrders(),
            'sales_result'          => $this->getSales(),
        ]);
    }

    public function getOrders()
    {
        $order_filter   = $this->getFilter($this->order_filter);
        $total_orders   = Order::where('company_id', get_auth_id())->where('type', 1)
            ->where('created_at', '>=', $order_filter)
            ->selectRaw('SUM(cost_after_discount) AS total_cost')
            ->first()
            ->toArray();

        $total_paid = Order::where('company_id', get_auth_id())->where('type', 1)
            ->where('created_at', '>=', $order_filter)
            ->selectRaw('SUM(paid) AS paid_cost')
            ->first()
            ->toArray();

        $total_remaining = Order::where('company_id', get_auth_id())->where('type', 1)
            ->where('created_at', '>=', $order_filter)
            ->selectRaw('SUM(remains) AS remaining_cost')
            ->first()
            ->toArray();

        $paid_percentage = 0;
        if ($total_orders['total_cost'] > 0)
            $paid_percentage = number_format($total_paid['paid_cost'] / $total_orders['total_cost'] * 100, 2);


        $remaining_percentage = 0;
        if ($total_orders['total_cost'] > 0)
            $remaining_percentage = number_format($total_remaining['remaining_cost'] / $total_orders['total_cost'] * 100, 2);


        return [
            'total_orders'          => $total_orders['total_cost'],
            'total_paid'            => $total_paid['paid_cost'],
            'total_remaining'       => $total_remaining['remaining_cost'],
            'paid_percentage'       => $paid_percentage,
            'remaining_percentage'  => $remaining_percentage,
        ];
    }

    public function getSales()
    {
        $sale_filter    = $this->getFilter($this->sale_filter);
        $total_sales    = Sale::where('company_id', get_auth_id())->where('type', 1)
            ->where('created_at', '>=', $sale_filter)
            ->selectRaw('SUM(cost_after_discount) AS total_cost')
            ->first()
            ->toArray();

        $total_paid     = Sale::where('company_id', get_auth_id())->where('type', 1)
            ->where('created_at', '>=', $sale_filter)
            ->selectRaw('SUM(paid) AS paid_cost')
            ->first()
            ->toArray();

        $total_remaining = Sale::where('company_id', get_auth_id())->where('type', 1)
            ->where('created_at', '>=', $sale_filter)
            ->selectRaw('SUM(remains) AS remaining_cost')
            ->first()
            ->toArray();

        $paid_percentage = 0;
        if ($total_sales['total_cost'] > 0)
            $paid_percentage = number_format($total_paid['paid_cost'] / $total_sales['total_cost'] * 100, 2);


        $remaining_percentage = 0;
        if ($total_sales['total_cost'] > 0)
            $remaining_percentage = number_format($total_remaining['remaining_cost'] / $total_sales['total_cost'] * 100, 2);


        return [
            'total_sales'           => $total_sales['total_cost'],
            'total_paid'            => $total_paid['paid_cost'],
            'total_remaining'       => $total_remaining['remaining_cost'],
            'paid_percentage'       => $paid_percentage,
            'remaining_percentage'  => $remaining_percentage,
        ];
    }

    public function getFilter($filter)
    {
        $value = null;
        if ($filter == 2)
            $value = now()->subMonth(1);
        elseif ($filter == 3)
            $value = now()->subMonth(3);
        else
            $value = now()->subDays(7);
        return $value;
    }
}