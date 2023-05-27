<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('transaction.workshop_invoice')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('transaction.workshop_invoice')]))
    @section('breadcrumbSubtitle', __('transaction.workshops_invoices'))

    @livewire('admin.warehouse-transaction.workshop-invoice.workshop-invoice-detail', ['invoice' => $workshop_invoice])
</x-master-layout>
