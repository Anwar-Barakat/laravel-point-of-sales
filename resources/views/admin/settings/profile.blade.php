<x-master-layout>
    @section('pageTitle', __('partials.profile'))
    @section('breadcrumbTitle', __('partials.profile'))
    @section('breadcrumbSubtitle', __('partials.general_setting'))

    <div class="card">
        <div class="row g-0">
            @include('admin.settings.inc.sidebar')

            @livewire('admin.setting.admin-profile')
        </div>
    </div>
</x-master-layout>
