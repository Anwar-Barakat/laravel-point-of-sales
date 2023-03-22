<div class="col d-flex flex-column">
    <form wire:submit.prevent='updateSetting'>
        <div class="card-body">
            <h2 class="mb-4">{{ __('setting.general_setting') }}</h2>
            <h3 class="card-title">{{ __('setting.details') }}</h3>
            <div class="row align-items-center">
                <div class="col-auto">
                    @if ($setting->getFirstMediaUrl('global_setting'))
                        <img src="{{ $setting->getFirstMediaUrl('global_setting') }}" alt="{{ $setting->company_code }}" class="img img-thumbnail" width="200">
                    @else
                        <img src="{{ asset('backend/static/avatars/default-logo.jpg.webp') }}" alt="">
                    @endif
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('setting.business_profile') }}</h3>
            <div class="row g-3">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <x-input-label class="form-label" :value="__('setting.company_name_ar')" />
                    <x-text-input type="text" class="form-control" wire:model="company_name_ar" required />
                    <x-input-error :messages="$errors->get('company_name_ar')" class="mt-2" />
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <x-input-label class="form-label" :value="__('setting.company_name_en')" />
                    <x-text-input type="text" class="form-control" wire:model="company_name_en" required />
                    <x-input-error :messages="$errors->get('company_name_en')" class="mt-2" />
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <x-input-label class="form-label" :value="__('setting.company_code')" />
                    <x-text-input type="text" class="form-control" readonly="readonly" :value="$setting->company_code" />
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <x-input-label class="form-label" :value="__('setting.mobile')" />
                    <x-text-input type="text" class="form-control" wire:model="mobile" required />
                    <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('setting.address') }}</h3>
            <div class="row g-3">
                <div class="col-md-12 col-lg-6">
                    <x-text-input type="text" class="form-control" wire:model="address" required />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('setting.alert_msg') }}</h3>
            <div class="row g-3">
                <div class="col-md-12 col-lg-6">
                    <x-text-input type="text" class="form-control" wire:model="alert_msg" required />
                    <x-input-error :messages="$errors->get('alert_msg')" class="mt-2" />
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('setting.updated_by') }}</h3>
            <div class="row g-3">
                <div class="col-md-12">
                    @if (!$setting->updated_by)
                        {{ __('msgs.not_found') }}
                    @else
                        {{ $setting->updatedBy->name ?? '' }}
                        <b>{{ __('setting.on_the_date') }}</b>
                        ( {{ Carbon\Carbon::parse($setting->updated_at)->format('Y-m-d H:m A') }} )
                    @endif
                </div>
            </div>

            <h3 class="card-title mt-4">{{ __('setting.logo') }}</h3>
            <div class="row g-3">
                <div class="col-md-12">
                    <x-text-input type="file" class="form-control" wire:model="logo" />
                    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <a href="#" class="btn">
                    {{ __('btns.cancel') }}
                </a>
                <button type="subnit" class="btn btn-primary">
                    <div wire:loading.delay wire:key='updateSetting' wire:target='updateSetting'>
                        <i class="fa fa-spinner fa-spin text-lg"></i>
                    </div>
                    {{ __('btns.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>
