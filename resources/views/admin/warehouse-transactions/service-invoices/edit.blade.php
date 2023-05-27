<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('transaction.service_invoice')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('transaction.service_invoice')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.service-invoice.add-edit-service-invoice', ['invoice' => $services_invoice])
        </div>
    </div>

</x-master-layout>
