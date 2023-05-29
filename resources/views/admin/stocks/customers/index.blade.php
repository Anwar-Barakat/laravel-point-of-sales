<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('stock.customers')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('stock.customers')]))
    @section('breadcrumbSubtitle', __('stock.customers'))

    @livewire('admin.stock.customer.show-customer')
</x-master-layout>
