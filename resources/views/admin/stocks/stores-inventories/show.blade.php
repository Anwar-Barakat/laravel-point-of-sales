<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('transaction.service_invoice')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('transaction.service_invoice')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))


    @livewire('admin.warehouse-transaction.service-invoice.service-invoice-detail-component', ['invoice' => $services_invoice])
</x-master-layout>
