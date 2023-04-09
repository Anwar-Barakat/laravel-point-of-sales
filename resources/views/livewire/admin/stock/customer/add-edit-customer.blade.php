<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.customer_name')" />
                        <x-text-input type="text" class="form-control" wire:model.debounce.350='customer.name' />
                        <x-input-error :messages="$errors->get('customer.name')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.address')" />
                        <x-text-input type="text" class="form-control" wire:model.debounce.350='customer.address' />
                        <x-input-error :messages="$errors->get('customer.address')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('setting.status')" />
                        <select id="" class="form-control" wire:model.debounce.350='customer.is_active'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.is_active') }}</option>
                            <option value="0">{{ __('msgs.not_active') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('customer.is_active')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="row row-cards">
                {{-- @if (!$edit) --}}
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('account.initial_balance_status')" />
                        <select id="" class="form-control" wire:model.debounce.350='customer.initial_balance_status'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach (App\Models\Customer::INITIALBANALNCESTATUS as $key => $status)
                                <option value="{{ $key }}">{{ __('account.' . $status) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('customer.initial_balance_status')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('account.initial_balance')" />
                        <x-text-input type="number" class="form-control" wire:model.debounce.350='customer.initial_balance' />
                        <x-input-error :messages="$errors->get('customer.initial_balance')" class="mt-2" />
                    </div>
                </div>
                {{-- @endif --}}

            </div>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.notes')" />
                        <textarea rows="5" class="form-control" wire:model.debounce.350='customer.notes'></textarea>
                        <x-input-error :messages="$errors->get('customer.notes')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">{{ __('btns.submit') }}</button>
        </div>
    </form>
</div>
