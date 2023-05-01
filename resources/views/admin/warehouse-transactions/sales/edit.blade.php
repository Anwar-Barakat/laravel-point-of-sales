<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('transaction.sales_invoices')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('transaction.sales_invoices')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.sale.add-edit-sale', ['sale' => $sale])
        </div>
    </div>
</x-master-layout>
