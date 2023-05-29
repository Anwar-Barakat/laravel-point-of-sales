<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('transaction.store_transfer')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('transaction.store_transfer')]))
    @section('breadcrumbSubtitle', __('transaction.store_transfers'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.store-transfer.add-edit-store-transfer')
        </div>
    </div>

</x-master-layout>
