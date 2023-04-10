<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('account.accounts')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('account.accounts')]))
    @section('breadcrumbSubtitle', __('account.accounts'))

    @livewire('admin.account.financial-account.show-account')
</x-master-layout>
