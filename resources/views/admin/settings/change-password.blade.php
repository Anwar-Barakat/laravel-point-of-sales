<x-master-layout>
    @section('pageTitle', 'settings')
    @section('breadcrumbTitle', __('setting.settings'))

    <div class="card">
        <div class="row g-0">
            @include('admin.settings.inc.sidebar')

            @livewire('admin.setting.change-password')
        </div>
    </div>
</x-master-layout>
