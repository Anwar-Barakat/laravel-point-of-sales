<?php

namespace App\Http\Livewire\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Livewire\Component;

class DashboardChartComponent extends Component
{
    public function render()
    {
        $orders_options = [
            'chart_title'       => __('dash.orders_by_month'),
            'report_type'       => 'group_by_date',
            'model'             => 'App\Models\Order',
            'group_by_field'    => 'created_at',
            'group_by_period'   => 'day',
            'chart_type'        => 'bar',
        ];
        $orders = new LaravelChart($orders_options);

        $sales_options = [
            'chart_title'       => __('dash.sales_by_month'),
            'report_type'       => 'group_by_date',
            'model'             => 'App\Models\Sale',
            'group_by_field'    => 'created_at',
            'group_by_period'   => 'day',
            'chart_type'        => 'line',
        ];
        $sales = new LaravelChart($sales_options);


        return view('livewire.admin.dashboard-chart-component', [
            'orders'    => $orders,
            'sales'     => $sales,
        ]);
    }
}