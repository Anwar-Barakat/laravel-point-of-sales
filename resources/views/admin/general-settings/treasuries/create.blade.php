<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('treasury.treasury')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('treasury.treasury')]))
    @section('breadcrumbSubtitle', __('treasury.treasuries'))


    @livewire('admin.general-setting.treasury.store-treasury')
</x-master-layout>
