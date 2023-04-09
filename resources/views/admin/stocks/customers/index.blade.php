<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('account.financial_accounts')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('account.financial_accounts')]))
    @section('breadcrumbSubtitle', __('account.accounts'))

    @livewire('admin.stock.customer.show-customer')
</x-master-layout>
