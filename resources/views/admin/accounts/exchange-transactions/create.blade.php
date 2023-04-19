<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('account.exchange_transaction')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('account.exchange_transaction')]))
    @section('breadcrumbSubtitle', __('account.accounts'))


    @livewire('admin.account.exchange-transaction.add-edit-exchange-transaction')

</x-master-layout>
