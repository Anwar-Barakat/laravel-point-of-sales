<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('transaction.production_line')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('transaction.production_line')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))


    @livewire('admin.warehouse-transaction.service-invoice.service-invoice-detail-component', ['invoice' => $services_invoice])
</x-master-layout>
