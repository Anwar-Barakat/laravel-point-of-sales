<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('transaction.general_orders_returns')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('transaction.general_orders_returns')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    @livewire('admin.warehouse-transaction.order.show-order', ['order_type' => 3])
</x-master-layout>
