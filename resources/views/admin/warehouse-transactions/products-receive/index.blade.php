<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('transaction.workshops_invoices')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('transaction.workshops_invoices')]))
    @section('breadcrumbSubtitle', __('transaction.workshops_invoices'))

    @livewire('admin.warehouse-transaction.product-receieve.show-product-receieve')
</x-master-layout>
