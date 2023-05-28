<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('transaction.product_receive')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('transaction.product_receive')]))
    @section('breadcrumbSubtitle', __('transaction.products_receive'))

    @livewire('admin.warehouse-transaction.product-receive.add-edit-product-receive')
</x-master-layout>
