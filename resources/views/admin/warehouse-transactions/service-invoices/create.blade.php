<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('transaction.service_invoice')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('transaction.service_invoice')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.service-invoice.add-edit-service-invoice')
        </div>
    </div>

</x-master-layout>
