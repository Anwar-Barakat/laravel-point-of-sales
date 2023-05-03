<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            <div class="row row-cards">
                <div class="col-sm-12 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('transaction.delegate_name')" />
                        <x-text-input type="text" class="form-control" wire:model='delegate.name' />
                        <x-input-error :messages="$errors->get('delegate.name')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('auth.email')" />
                        <x-text-input type="email" class="form-control" wire:model='delegate.email' placeholder="example@domain.com" />
                        <x-input-error :messages="$errors->get('delegate.email')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('setting.status')" />
                        <select class="form-select" wire:model='delegate.is_active'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1" {{ old('order.is_active') ? 'selected' : '' }}>{{ __('msgs.is_active') }}</option>
                            <option value="0" {{ old('order.is_active') == '0' ? 'selected' : '' }}>{{ __('msgs.not_active') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('delegate.is_active')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="row row-cards">
                @if (!$delegate->account)
                    <div class="col-sm-12 col-lg-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.initial_balance_status')" />
                            <select class="form-select" wire:model='delegate.initial_balance_status'>
                                <option value="">{{ __('btns.select') }}</option>
                                @foreach (App\Models\Vendor::INITIALBANALNCESTATUS as $key => $status)
                                    <option value="{{ $key }}">{{ __('account.' . $status) }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('delegate.initial_balance_status')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.initial_balance')" />
                            <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='delegate.initial_balance' />
                            <x-input-error :messages="$errors->get('delegate.initial_balance')" class="mt-2" />
                        </div>
                    </div>
                @endif
            </div>
            <div class="row row-cards">
                <div class="col-sm-12 col-lg-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.address')" />
                        <textarea rows="3" class="form-control" wire:model='delegate.address' placeholder="{{ __('msgs.at_least_ten_ch') }}"></textarea>
                        <x-input-error :messages="$errors->get('delegate.address')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.notes')" />
                        <textarea rows="3" class="form-control" wire:model='delegate.notes' placeholder="{{ __('msgs.at_least_ten_ch') }}"></textarea>
                        <x-input-error :messages="$errors->get('delegate.notes')" class="mt-2" />
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-3 w-50">
            <h3 class="mb-3 text-blue">{{ __('stock.commission_value') }}</h3>
            <div class="row row-cards">
                <div class="col-sm-12 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.commission_type')" />
                        <select class="form-select" wire:model='delegate.commission_type'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="0" {{ old('delegate.commission_type') ? 'selected' : '' }}>{{ __('transaction.percentage') }}</option>
                            <option value="1" {{ old('delegate.commission_type') == '0' ? 'selected' : '' }}>{{ __('transaction.fixed') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('delegate.commission_type')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.commission_for_sectoral')" />
                        <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='delegate.commission_for_sectoral' />
                        <x-input-error :messages="$errors->get('delegate.commission_for_sectoral')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.commission_for_half_block')" />
                        <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='delegate.commission_for_half_block' />
                        <x-input-error :messages="$errors->get('delegate.commission_for_half_block')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.commission_for_block')" />
                        <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='delegate.commission_for_block' />
                        <x-input-error :messages="$errors->get('delegate.commission_for_block')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.commission_for_delayed_collect')" />
                        <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='delegate.commission_for_delayed_collect' />
                        <x-input-error :messages="$errors->get('delegate.commission_for_delayed_collect')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checklist" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"></path>
                    <path d="M14 19l2 2l4 -4"></path>
                    <path d="M9 8h4"></path>
                    <path d="M9 12h2"></path>
                </svg>
                {{ __('btns.submit') }}
            </button>
        </div>
    </form>
</div>
