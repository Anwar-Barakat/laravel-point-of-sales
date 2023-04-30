<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('movement.purchase_bill')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('movement.purchase_bill')]))
    @section('breadcrumbSubtitle', __('movement.stock_movements'))


    @livewire('admin.stock-movement.order.order-detail', ['order' => $order])

</x-master-layout>
