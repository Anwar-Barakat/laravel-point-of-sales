<x-master-layout>
    @section('pageTitle', 'settings')

    @section('breadcrumbTitle', __('setting.settings'))

    @section('breadcrumbSubtitle', __('partials.home'))

    <div class="card">
        <div class="row g-0">
            <div class="col-3 d-none d-md-block border-end">
                <div class="card-body">
                    <h4 class="subheader">{{ __('partials.profile') }}</h4>
                    <div class="list-group list-group-transparent">
                        <a href="{{ route('admin.setting.index') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.setting.index') ? 'active' : '' }}">{{ __('setting.general_setting') }}</a>
                        <a href="{{ route('admin.profile.index') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.profile.index') ? 'active' : '' }}">{{ __('partials.profile') }}</a>
                    </div>
                </div>
            </div>

            @livewire('admin.profile.admin-profile')
        </div>
    </div>
</x-master-layout>
