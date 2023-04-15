<x-master-layout>
    @section('pageTitle', __('setting.admins'))
    @section('breadcrumbTitle', __('setting.admins'))
    @section('breadcrumbSubtitle', __('partials.general_setting'))

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('msgs.all', ['name' => __('setting.admins')]) }}</h3>
        </div>

        @livewire('admin.general-setting.admin.show-admin')
    </div>
</x-master-layout>
