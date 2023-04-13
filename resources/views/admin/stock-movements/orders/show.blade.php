<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('movement.order')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('movement.order')]))
    @section('breadcrumbSubtitle', __('movement.stock_movements'))


    @livewire('admin.stock-movement.order.order-detail', ['order' => $order])

</x-master-layout>
