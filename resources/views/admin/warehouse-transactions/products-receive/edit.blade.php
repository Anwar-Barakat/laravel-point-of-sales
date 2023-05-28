<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('transaction.product_receive')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('transaction.product_receive')]))
    @section('breadcrumbSubtitle', __('transaction.workshops_invoices'))

    @livewire('admin.warehouse-transaction.product-receieve.add-edit-product-receieve', ['invoice' => $products_receive])
</x-master-layout>
