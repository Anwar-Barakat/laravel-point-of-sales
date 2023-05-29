<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('transaction.store_transfer')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('transaction.store_transfer')]))
    @section('breadcrumbSubtitle', __('transaction.store_transfers'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.service-invoice.add-edit-service-invoice', ['invoice' => $services_invoice])
        </div>
    </div>

</x-master-layout>
