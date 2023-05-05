<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('transaction.general_order_return')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('transaction.general_order_return')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.general-order-return.add-edit-general-order-return')
        </div>
    </div>

</x-master-layout>
