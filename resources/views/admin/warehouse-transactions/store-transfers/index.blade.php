<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('transaction.store_transfers')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('transaction.store_transfers')]))
    @section('breadcrumbSubtitle', __('transaction.store_transfers'))

    @livewire('admin.warehouse-transaction.service-invoice.show-service-invoice')
</x-master-layout>
