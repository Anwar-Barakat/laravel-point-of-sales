<div class="card">
    <div class="row g-0">
        <div class="col d-flex flex-column">
            <form wire:submit.prevent='update'>
                <div class="card-body">
                    <h3 class="mb-4">{{ __('msgs.main_info') }}</h3>
                    <div class="row row-cards">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('treasury.treasury_name')" />
                                <x-text-input type="text" class="form-control" placeholder="{{ __('treasury.treasury_name') }}" wire:model='name' required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('msgs.is_master')" />
                                <select id="" class="form-control" wire:model='is_master'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="1">{{ __('msgs.yes') }}</option>
                                    <option value="0">{{ __('msgs.no') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('is_master')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('msgs.is_active')" />
                                <select id="" class="form-control" wire:model='is_active'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="1">{{ __('msgs.yes') }}</option>
                                    <option value="0">{{ __('msgs.no') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="row row-cards">
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('treasury.last_payment_receipt')" />
                                <x-text-input type="text" class="form-control" placeholder="{{ __('treasury.last_payment_receipt') }}" wire:model='last_payment_receipt' required oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                                <x-input-error :messages="$errors->get('last_payment_receipt')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="row row-cards">
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('treasury.last_payment_collect')" />
                                <x-text-input type="text" class="form-control" placeholder="{{ __('treasury.last_payment_collect') }}" wire:model='last_payment_collect' required oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                                <x-input-error :messages="$errors->get('last_payment_collect')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">{{ __('btns.update') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
