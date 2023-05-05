<x-master-layout>
    @php
        $pageTitle = $order_type == 3 ? __('transaction.' . App\Models\Order::ORDERTYPE[3]) : __('transaction.purchase_bill');
    @endphp
    @section('pageTitle', __('msgs.edit', ['name' => $pageTitle])))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => $pageTitle])))
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
