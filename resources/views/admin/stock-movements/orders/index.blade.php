<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('movement.orders')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('movement.orders')]))
    @section('breadcrumbSubtitle', __('movement.stock_movements'))

    @livewire('admin.stock-movement.order.show-order')
</x-master-layout>
