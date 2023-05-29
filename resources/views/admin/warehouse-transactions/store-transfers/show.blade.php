<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('transaction.store_transfer')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('transaction.store_transfer')]))
    @section('breadcrumbSubtitle', __('transaction.store_transfers'))

    @livewire('admin.warehouse-transaction.store-transfer.store-transfer-detail-component', ['transfer' => $store_transfer])
</x-master-layout>
