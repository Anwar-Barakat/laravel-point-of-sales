<x-master-layout>
    @section('pageTitle', __('setting.change_password'))
    @section('breadcrumbTitle', __('setting.change_password'))
    @section('breadcrumbSubtitle', __('partials.general_setting'))


    <div class="card">
        <div class="row g-0">
            @include('admin.general-settings.settings.inc.sidebar')

            @livewire('admin.general-setting.setting.change-password')
        </div>
    </div>
</x-master-layout>
