<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('transaction.products_receive')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('transaction.products_receive')]))
    @section('breadcrumbSubtitle', __('transaction.products_receive'))

    @livewire('admin.warehouse-transaction.product-receive.show-product-receive')
</x-master-layout>
