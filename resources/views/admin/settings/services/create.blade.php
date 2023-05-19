<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('setting.service')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('setting.service')]))
    @section('breadcrumbSubtitle', __('partials.settings'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.setting.service.add-edit-service')
        </div>
    </div>

</x-master-layout>
