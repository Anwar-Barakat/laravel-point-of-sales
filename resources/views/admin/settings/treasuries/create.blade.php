<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('treasury.treasury')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('treasury.treasury')]))
    @section('breadcrumbSubtitle', __('partials.general_setting'))


    @livewire('admin.setting.treasury.add-edit-treasury')
</x-master-layout>
