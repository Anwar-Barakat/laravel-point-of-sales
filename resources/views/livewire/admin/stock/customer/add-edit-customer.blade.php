<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            <div class="row row-cards">
                <div class="col-12 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.customer_name')" />
                        <x-text-input type="text" class="form-control" wire:model.debounce.350s='customer.name' />
                        <x-input-error :messages="$errors->get('customer.name')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('auth.email')" />
                        <x-text-input type="email" class="form-control" wire:model.debounce.350s='customer.email' placeholder="example@domin.com" />
                        <x-input-error :messages="$errors->get('customer.email')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('setting.mobile')" />
                        <x-text-input type="tel" class="form-control" wire:model.debounce.350s='customer.mobile' placeholder="+17865637735" />
                        <x-input-error :messages="$errors->get('customer.mobile')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('setting.status')" />
                        <select class="form-select" wire:model.debounce.350s='customer.is_active'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.is_active') }}</option>
                            <option value="0">{{ __('msgs.not_active') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('customer.is_active')" class="mt-2" />
                    </div>
                </div>
            </div>

            @if (!$customer->account)
                <div class="row row-cards">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.initial_balance_status')" />
                            <select class="form-select" wire:model.debounce.350s='customer.initial_balance_status'>
                                <option value="">{{ __('btns.select') }}</option>
                                @foreach (App\Models\Customer::INITIALBANALNCESTATUS as $key => $status)
                                    <option value="{{ $key }}">{{ __('account.' . $status) }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('customer.initial_balance_status')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.initial_balance')" />
                            <x-text-input type="number" placeholder="10.15" class="form-control" wire:model.debounce.350s='customer.initial_balance' />
                            <x-input-error :messages="$errors->get('customer.initial_balance')" class="mt-2" />
                        </div>
                    </div>
                </div>
            @endif
            <div class="row row-cards">
                <div class="col-12 col-lg-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.address')" />
                        <textarea rows="3" class="form-control" wire:model.debounce.350s='customer.address' placeholder="{{ __('msgs.at_least_ten_ch') }}"></textarea>
                        <x-input-error :messages="$errors->get('customer.address')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.notes')" />
                        <textarea rows="3" class="form-control" wire:model.debounce.350s='customer.notes' placeholder="{{ __('msgs.at_least_ten_ch') }}"></textarea>
                        <x-input-error :messages="$errors->get('customer.notes')" class="mt-2" />
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
