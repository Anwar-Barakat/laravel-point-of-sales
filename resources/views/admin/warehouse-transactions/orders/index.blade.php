<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('transaction.purchase_bills')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('transaction.purchase_bills')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    @livewire('admin.warehouse-transaction.order.show-order', ['order_type' => 1])
</x-master-layout>
