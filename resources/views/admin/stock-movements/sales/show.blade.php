<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('movement.sale_invoice')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('movement.sale_invoice')]))
    @section('breadcrumbSubtitle', __('movement.stock_movements'))


    @livewire('admin.stock-movement.sale.sale-detail', ['sale' => $sale])

</x-master-layout>
