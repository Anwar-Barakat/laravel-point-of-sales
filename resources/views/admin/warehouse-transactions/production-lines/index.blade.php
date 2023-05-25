<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('transaction.production_lines')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('transaction.production_lines')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    @livewire('admin.warehouse-transaction.production-line.show-production-line')
</x-master-layout>
