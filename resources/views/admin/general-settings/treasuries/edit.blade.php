<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('treasury.treasury')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('treasury.treasury')]))
    @section('breadcrumbSubtitle', __('treasury.treasuries'))


    @livewire('admin.general-setting.treasury.update-treasury', ['treasury' => $treasury])
</x-master-layout>
