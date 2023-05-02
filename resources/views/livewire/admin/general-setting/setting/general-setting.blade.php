<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h2 class="mb-4">{{ __('setting.settings') }}</h2>
            <div class="row align-items-center">
                <div class="col-auto">
                    @if ($company->getFirstMediaUrl('company_logo'))
                        <img src="{{ $company->getFirstMediaUrl('company_logo') }}" alt="{{ $company->name }}" class="img img-thumbnail" width="200">
                    @else
                        <img src="{{ asset('backend/static/avatars/default-logo.jpg.webp') }}" alt="">
                    @endif
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('setting.business_profile') }}</h3>
            <div class="row row-cards">
                <div class="col-12 col-lg-4 col-md-6">
                    <x-input-label class="form-label" :value="__('setting.company_name_ar')" />
                    <x-text-input type="text" class="form-control" wire:model="name_ar" required />
                    <x-input-error :messages="$errors->get('name_ar')" class="mt-2" />
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    <x-input-label class="form-label" :value="__('setting.company_name_en')" />
                    <x-text-input type="text" class="form-control" wire:model="name_en" required />
                    <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    <x-input-label class="form-label" :value="__('setting.mobile')" />
                    <x-text-input type="text" class="form-control" wire:model="company.mobile" required />
                    <x-input-error :messages="$errors->get('company.mobile')" class="mt-2" />
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-md-12 col-lg-6">
                    <label class="form-label">
                        {{ __('setting.company_name_ar') }}
                        <span class="text-azure-500">( {{ $company->parentCustomer->account->number ?? '-' }} )</span>
                    </label>
                    <select wire:model='company.parent_customer_id' class="form-control">
                        <option value="">{{ __('btns.select') }}</option>
                        @foreach ($parent_accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('customer_account_id')" class="mt-2" />
                </div>
                <div class="col-md-12 col-lg-6">
                    <label class="form-label">
                        {{ __('setting.parent_v_account') }}
                        <span class="text-azure-500">( {{ $company->parentVendor->account->number ?? '-' }} )</span>
                    </label>
                    <select wire:model='company.parent_vendor_id' class="form-control">
                        <option value="">{{ __('btns.select') }}</option>
                        @foreach ($parent_accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('parent_vendor_id')" class="mt-2" />
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-md-12 col-lg-6">
                    <label class="form-label">
                        {{ __('setting.parent_d_account') }}
                        <span class="text-azure-500">( {{ $company->parentDelegate->account->number ?? '-' }} )</span>
                    </label>
                    <select wire:model='company.parent_delegate_id' class="form-control">
                        <option value="">{{ __('btns.select') }}</option>
                        @foreach ($parent_accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('company.parent_delegate_id')" class="mt-2" />
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-md-12 col-lg-6">
                    <x-input-label class="form-label" :value="__('setting.address')" />
                    <textarea class="form-control" rows="3" wire:model="company.address" required></textarea>
                    <x-input-error :messages="$errors->get('company.address')" class="mt-2" />
                </div>
                <div class="col-md-12 col-lg-6">
                    <x-input-label class="form-label" :value="__('setting.alert_msg')" />
                    <textarea class="form-control" rows="3" wire:model="company.alert_msg" required></textarea>
                    <x-input-error :messages="$errors->get('company.alert_msg')" class="mt-2" />
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-md-6">
                    <x-input-label class="form-label" :value="__('setting.logo')" />
                    <x-text-input type="file" class="form-control" wire:model="logo" />
                    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-between">
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
