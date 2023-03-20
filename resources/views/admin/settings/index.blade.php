<x-master-layout>
    @section('pageTitle', 'settings')

    @section('breadcrumbTitle', __('setting.settings'))

    @section('breadcrumbSubtitle', __('partials.home'))

    <div class="card">
        <div class="row g-0">
            <div class="col-3 d-none d-md-block border-end">
                <div class="card-body">
                    <h4 class="subheader">{{ __('setting.general_setting') }}</h4>
                    <div class="list-group list-group-transparent">
                        <a href="{{ route('admin.settings.index') }}" class="list-group-item list-group-item-action d-flex align-items-center active">{{ __('setting.general_setting') }}</a>
                        <a href="" class="list-group-item list-group-item-action d-flex align-items-center">{{ __('partials.profile') }}</a>
                    </div>
                </div>
            </div>
            @livewire('admin.setting.general-setting', ['setting' => $setting])
        </div>
    </div>
</x-master-layout>
