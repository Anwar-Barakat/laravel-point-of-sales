<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('account.workshops')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('account.workshops')]))
    @section('breadcrumbSubtitle', __('account.workshops'))

    @livewire('admin.account.workshop.show-workshop')
</x-master-layout>
