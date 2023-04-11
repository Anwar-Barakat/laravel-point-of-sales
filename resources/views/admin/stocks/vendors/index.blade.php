<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('account.vendors')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('account.vendors')]))
    @section('breadcrumbSubtitle', __('account.vendors'))

    @livewire('admin.stock.vendor.show-vendor')
</x-master-layout>
