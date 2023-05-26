<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('account.customers')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('account.customers')]))
    @section('breadcrumbSubtitle', __('account.customers'))

    @livewire('admin.stock.customer.show-customer')
</x-master-layout>
