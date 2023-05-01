<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('transaction.purchase_bill')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('transaction.purchase_bill')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.order.add-edit-order')
        </div>
    </div>

</x-master-layout>
