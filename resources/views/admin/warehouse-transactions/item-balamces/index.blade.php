<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('transaction.item_balances')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('transaction.item_balances')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    @livewire('admin.warehouse-transaction.item-balance.show-item-balance')
</x-master-layout>
