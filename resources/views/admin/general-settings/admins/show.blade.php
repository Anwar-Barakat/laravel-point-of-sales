<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('setting.admin')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('setting.admin')]))
    @section('breadcrumbSubtitle', __('partials.general_setting'))


    @livewire('admin.general-setting.admin.admin-detail', ['admin' => $admin])
</x-master-layout>
