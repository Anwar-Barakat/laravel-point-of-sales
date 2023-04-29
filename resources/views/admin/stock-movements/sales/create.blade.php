<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('movement.sales_invoices')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('movement.sales_invoices')]))
    @section('breadcrumbSubtitle', __('movement.stock_movements'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock-movement.sale.add-edit-sale')
        </div>
    </div>
</x-master-layout>
