<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('account.collect_transaction')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('account.collect_transaction')]))
    @section('breadcrumbSubtitle', __('account.accounts'))


    @livewire('admin.account.collect-transaction.add-edit-collect-transaction')

</x-master-layout>
