<div class="col-3 d-none d-md-block border-end">
    <div class="card-body">
        <h4 class="subheader">{{ __('setting.general_setting') }}</h4>
        <div class="list-group list-group-transparent">
            <a href="{{ route('admin.setting.index') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.setting.index') ? 'active' : '' }}">{{ __('setting.general_setting') }}</a>
            <a href="{{ route('admin.setting.profile') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.setting.profile') ? 'active' : '' }}">{{ __('partials.profile') }}</a>
            <a href="{{ route('admin.setting.change-password') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.setting.change-password') ? 'active' : '' }}">{{ __('setting.change_password') }}</a>
        </div>
    </div>
</div>
