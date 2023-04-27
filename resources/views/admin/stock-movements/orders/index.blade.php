<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('movement.purchase_bills')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('movement.purchase_bills')]))
    @section('breadcrumbSubtitle', __('movement.stock_movements'))

    @livewire('admin.stock-movement.order.show-order')
</x-master-layout>
