<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('transaction.store_transfer')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('transaction.store_transfer')]))
    @section('breadcrumbSubtitle', __('transaction.store_transfers'))

    {{-- @livewire('admin.warehouse-transaction.service-invoice.service-invoice-detail-component', ['invoice' => $services_invoice]) --}}
</x-master-layout>
