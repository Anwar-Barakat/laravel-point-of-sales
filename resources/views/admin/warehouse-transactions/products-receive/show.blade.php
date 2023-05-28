<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('transaction.product_receive')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('transaction.product_receive')]))
    @section('breadcrumbSubtitle', __('transaction.workshops_invoices'))

    @livewire('admin.warehouse-transaction.product-receive.product-receive-detail-component', ['invoice' => $products_receive])
</x-master-layout>
