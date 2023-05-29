<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('transaction.' . App\Models\Order::ORDERTYPE[$order_type])]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('transaction.' . App\Models\Order::ORDERTYPE[$order_type])]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.order.add-edit-order', [
                'order_type' => 3,
                'order' => $order,
            ])
        </div>
    </div>

</x-master-layout>
