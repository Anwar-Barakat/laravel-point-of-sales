<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('transaction.treasuries_shifts')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('transaction.treasuries_shifts')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    @livewire('admin.warehouse-transaction.shift.show-shift')
</x-master-layout>
