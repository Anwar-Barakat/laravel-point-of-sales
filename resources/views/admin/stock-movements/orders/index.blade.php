<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('movement.orders')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('movement.orders')]))
    @section('breadcrumbSubtitle', __('account.vendors'))

    @livewire('admin.stock-movement.order.show-order')
</x-master-layout>
