<div class="col d-flex flex-column">
    <form wire:submit.prevent='update'>
        <div class="card-body">
            <h2 class="mb-4">{{ __('setting.general_setting') }}</h2>
            <h3 class="card-title">{{ __('setting.details') }}</h3>
            <div class="row align-items-center">
                <div class="col-auto">
                    <img src="{{ asset('backend/static/avatars/000m.jpg') }}" alt="">
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('setting.business_profile') }}</h3>
            <div class="row g-3">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="form-label">{{ __('setting.company_name_ar') }}</div>
                    <input type="text" class="form-control" wire:model="company_name_ar">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="form-label">{{ __('setting.company_name_en') }}</div>
                    <input type="text" class="form-control" wire:model="company_name_en">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="form-label">{{ __('setting.company_code') }}</div>
                    <input type="text" class="form-control" wire:model="company_code">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="form-label">{{ __('setting.mobile') }}</div>
                    <input type="text" class="form-control" wire:model="mobile">
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('setting.address') }}</h3>
            <div class="row g-3">
                <div class="col-md-12 col-lg-6">
                    <input type="text" class="form-control" wire:model="address">
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('setting.alert_msg') }}</h3>
            <div class="row g-3">
                <div class="col-md-12 col-lg-6">
                    <input type="text" class="form-control" wire:model="alert_msg">
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('setting.updated_by') }}</h3>
            <div class="row g-3">
                <div class="col-md-12 col-lg-6">
                    @if (!$setting->updated_by)
                        {{ __('msgs.not_found') }}
                    @else
                        {{ $setting->updatedBy->name ?? '' }}
                        {{ __('setting.on_the_date') }}
                        ( {{ Carbon\Carbon::parse($setting->updated_at)->format('Y-m-d H:m A') }} )
                    @endif
                </div>
            </div>

            <h3 class="card-title mt-4">{{ __('setting.logo') }}</h3>
            <div class="row col-sm-12 col-lg-6">
                <input type="file" class="form-control" wire:model=logo />
            </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <a href="#" class="btn">
                    {{ __('btns.cancel') }}
                </a>
                <button type="subnit" class="btn btn-primary">
                    {{ __('btns.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>
