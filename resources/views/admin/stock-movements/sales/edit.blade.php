<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('movement.sales_invoices')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('movement.sales_invoices')]))
    @section('breadcrumbSubtitle', __('movement.stock_movements'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock-movement.sale.add-edit-sale', ['sale' => $sale])
        </div>
    </div>
</x-master-layout>
