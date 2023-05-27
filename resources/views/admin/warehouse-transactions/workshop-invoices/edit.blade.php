<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('transaction.workshop_invoice')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('transaction.workshop_invoice')]))
    @section('breadcrumbSubtitle', __('transaction.workshops_invoices'))

    @livewire('admin.warehouse-transaction.workshop-invoice.add-edit-workshop-invoice', ['workshop_invoice' => $workshop_invoice])
</x-master-layout>
