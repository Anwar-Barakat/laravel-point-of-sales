<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('transaction.purchase_bill')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('transaction.purchase_bill')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.order.add-edit-order', ['order' => $order])
        </div>
    </div>

</x-master-layout>
