<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('transaction.workshop_invoice')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('transaction.workshop_invoice')]))
    @section('breadcrumbSubtitle', __('transaction.workshops_invoices'))

    @livewire('admin.warehouse-transaction.workshop-invoice.add-edit-workshop-invoice')
</x-master-layout>
