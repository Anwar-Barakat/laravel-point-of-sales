<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('movement.sales_invoices')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('movement.sales_invoices')]))
    @section('breadcrumbSubtitle', __('movement.stock_movements'))

    @livewire('admin.stock-movement.sale.show-sale')
</x-master-layout>
