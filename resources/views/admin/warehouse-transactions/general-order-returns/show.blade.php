<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('transaction.' . App\Models\Order::ORDERTYPE[$order->type])]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('transaction.' . App\Models\Order::ORDERTYPE[$order->type])]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))


    @livewire('admin.warehouse-transaction.order.order-detail', ['order' => $order])

</x-master-layout>
