<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('transaction.sales_invoices')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('transaction.sales_invoices')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    @livewire('admin.warehouse-transaction.sale.show-sale')
</x-master-layout>
