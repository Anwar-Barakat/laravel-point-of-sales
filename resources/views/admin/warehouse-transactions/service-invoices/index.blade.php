<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('transaction.services_invoices')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('transaction.services_invoices')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    <livewire:admin.warehouse-transaction.service-invoice.show-service-invoice>
</x-master-layout>
