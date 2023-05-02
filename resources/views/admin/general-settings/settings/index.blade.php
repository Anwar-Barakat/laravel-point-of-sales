<x-master-layout>
    @section('pageTitle', __('setting.settings'))
    @section('breadcrumbTitle', __('setting.settings'))
    @section('breadcrumbSubtitle', __('partials.general_setting'))

    <div class="card">
        <div class="row g-0">
            @include('admin.general-settings.settings.inc.sidebar')

            @livewire('admin.general-setting.setting.general-setting', ['company' => $company])
        </div>
    </div>
</x-master-layout>
