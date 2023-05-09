<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('transaction.sales_invoices')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('transaction.sales_invoices')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.sale.add-edit-sale', ['sale_type' => 3])
        </div>
    </div>
</x-master-layout>
