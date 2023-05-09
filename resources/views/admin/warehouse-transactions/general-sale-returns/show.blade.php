<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('transaction.sale_invoice')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('transaction.sale_invoice')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))


    @livewire('admin.warehouse-transaction.sale.sale-detail', ['sale' => $sale, 'sale_type' => 3])

</x-master-layout>
