<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('account.treasury_transaction')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('account.treasury_transaction')]))
    @section('breadcrumbSubtitle', __('account.accounts'))


    @livewire('admin.account.treasury-transaction.add-edit-treasury-transaction')

</x-master-layout>
