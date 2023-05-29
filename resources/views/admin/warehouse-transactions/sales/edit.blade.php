<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('transaction.sales_invoices')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('transaction.sales_invoices')]))
    @section('breadcrumbSubtitle', __('transaction.sales_invoices'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.sale.add-edit-sale', ['sale_type' => 1])
        </div>
    </div>
</x-master-layout>
