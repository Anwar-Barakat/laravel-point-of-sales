<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Sale;
use Livewire\Component;

class DashboardComponent extends Component
{
    public $sales, $sale_filter;

    public function render()
    {
        return view('livewire.admin.dashboard-component', [
            'sales_result'   => $this->getSales(),
        ]);
    }

    public function getSales()
    {
        $sale_filter = null;
        if ($this->sale_filter == 2)
            $sale_filter = now()->subMonth(1);
        elseif ($this->sale_filter == 3)
            $sale_filter = now()->subMonth(3);
        else
            $sale_filter = now()->subDays(7);

        $total_sales = Order::where('company_id', get_auth_id())->where('type', 1)
            ->where('created_at', '>=', $sale_filter)
            ->selectRaw('SUM(cost_after_discount) AS total_cost')
            ->first()
            ->toArray();

        $total_paid = Order::where('company_id', get_auth_id())->where('type', 1)
            ->where('created_at', '>=', $sale_filter)
            ->selectRaw('SUM(paid) AS paid_cost')
            ->first()
            ->toArray();

        $total_remaining = Order::where('company_id', get_auth_id())->where('type', 1)
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
}
