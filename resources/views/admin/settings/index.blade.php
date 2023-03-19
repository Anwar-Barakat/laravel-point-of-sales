<x-master-layout>
    @section('pageTitle', 'settings')

    @section('breadcrumbTitle', __('setting.settings'))

    @section('breadcrumbSubtitle', __('partials.home'))

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Account Settings
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-3 d-none d-md-block border-end">
                            <div class="card-body">
                                <h4 class="subheader">{{ __('setting.general_setting') }}</h4>
                                <div class="list-group list-group-transparent">
                                    <a href="{{ route('admin.settings.index') }}" class="list-group-item list-group-item-action d-flex align-items-center active">{{ __('setting.my_account') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex flex-column">
                            <div class="card-body">
                                <h2 class="mb-4">{{ __('setting.my_account') }}</h2>
                                <h3 class="card-title">{{ __('setting.profile_details') }}</h3>
                                <div class="row align-items-center">
                                    <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url(./static/avatars/000m.jpg)"></span>
                                    </div>
                                    <div class="col-auto"><a href="#" class="btn">
                                            Change avatar
                                        </a></div>

                                </div>
                                <h3 class="card-title mt-4">{{ __('setting.business_profile') }}</h3>
                                <div class="row g-3">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-label">{{ __('setting.company_name_ar') }}</div>
                                        <input type="text" class="form-control" value="{{ $settings->getTranslation('company_name', 'ar') }}" name="company_name">
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-label">{{ __('setting.company_name_en') }}</div>
                                        <input type="text" class="form-control" value="{{ $settings->getTranslation('company_name', 'en') }}" name="company_name">
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-label">{{ __('setting.company_code') }}</div>
                                        <input type="text" class="form-control" value="{{ $settings->company_code }}" name="company_code">
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-label">{{ __('setting.mobile') }}</div>
                                        <input type="text" class="form-control" value="{{ $settings->mobile }}" name="mobile">
                                    </div>
                                </div>
                                <h3 class="card-title mt-4">{{ __('setting.address') }}</h3>
                                <div class="row g-3">
                                    <div class="col-md-12 col-lg-6">
                                        <input type="text" class="form-control" value="{{ $settings->address }}">
                                    </div>
                                </div>
                                <h3 class="card-title mt-4">{{ __('setting.alert_msg') }}</h3>
                                <div class="row g-3">
                                    <div class="col-md-12 col-lg-6">
                                        <input type="text" class="form-control" value="{{ $settings->alert_msg }}">
                                    </div>
                                </div>
                                @if (!$settings->updated_by)
                                    <p class="card-subtitle">
                                        {{ __('msgs.not_found') }}
                                    </p>
                                @else
                                    <h3 class="card-title mt-4">
                                        {{ __('setting.updated_by') }} {{ $settings->updatedBy->name ?? '' }}
                                    </h3>
                                    <p lass="card-subtitle" @if (App::getLocale() == 'ar') dir="ltr" @else dir="rtl" @endif>
                                        {{ Carbon\Carbon::parse($settings->updated_at)->format('Y-m-d H:m A') }}
                                    </p>
                                @endif
                                <div>
                                    <label class="form-check form-switch form-switch-lg">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label form-check-label-on">You're currently visible</span>
                                        <span class="form-check-label form-check-label-off">You're
                                            currently invisible</span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="btn-list justify-content-end">
                                    <a href="#" class="btn">
                                        Cancel
                                    </a>
                                    <a href="#" class="btn btn-primary">
                                        Submit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ms-lg-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item"><a href="./docs/" class="link-secondary">Documentation</a></li>
                            <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a></li>
                            <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary" rel="noopener">Source code</a></li>
                            <li class="list-inline-item">
                                <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary" rel="noopener">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                    </svg>
                                    Sponsor
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; 2023
                                <a href="." class="link-secondary">Tabler</a>.
                                All rights reserved.
                            </li>
                            <li class="list-inline-item">
                                <a href="./changelog.html" class="link-secondary" rel="noopener">
                                    v1.0.0-beta17
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</x-master-layout>
