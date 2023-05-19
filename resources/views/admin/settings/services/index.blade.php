<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('setting.services')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('setting.services')]))
    @section('breadcrumbSubtitle', __('setting.settings'))

    @livewire('admin.setting.service.show-service')
</x-master-layout>
