<x-master-layout>
    @section('pageTitle', __('setting.settings'))
    @section('breadcrumbTitle', __('setting.settings'))
    @section('breadcrumbSubtitle', __('partials.general_setting'))

    <div class="card">
        <div class="row g-0">
            @include('admin.settings.inc.sidebar')

            @livewire('admin.setting.company-component', ['company' => $company])
        </div>
    </div>
</x-master-layout>
