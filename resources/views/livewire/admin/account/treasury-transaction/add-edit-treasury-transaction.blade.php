<div class="col d-flex flex-column">
    @if ($shiftExists)
        <form wire:submit.prevent='submit'>
            <div class="card-body">
                <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                <div class="row row-cards">
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.transaction_date')" />
                            <x-text-input type="date" class="form-control" wire:model.debounce.500s='transaction.transaction_date' />
                            <x-input-error :messages="$errors->get('transaction.transaction_date')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('treasury.treasury')" />
                            <x-text-input type="text" class="form-control" :value="$shiftExists->treasury->name" readonly disabled />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.treasury_available_balance')" />
                            <x-text-input type="number" class="form-control" :value="$treasuryBalance" readonly disabled />
                        </div>
                    </div>
                </div>
                <div class="row row-cards">
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.account')" />
                            <select class="form-select" wire:model.debounce.500s='transaction.account_id' id="select-tags-advanced">
                                <option value="">{{ __('btns.select') }}</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('transaction.account_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.amount_collected')" />
                            <x-text-input type="number" class="form-control" wire:model.debounce.500s='transaction.amount_collected' />
                            <x-input-error :messages="$errors->get('transaction.amount_collected')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.shift_type')" />
                            <select class="form-select" wire:model.debounce.500s='transaction.shift_type_id' id="select-tags-advanced">
                                <option value="">{{ __('btns.select') }}</option>
                                @foreach ($shiftTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('transaction.shift_type_id')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="row row-cards">
                    <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('dash.report')" />
                            <textarea rows="5" class="form-control" wire:model.debounce.500s='transaction.report'></textarea>
                            <x-input-error :messages="$errors->get('transaction.report')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">{{ __('btns.submit') }}</button>
            </div>
        </form>
    @else
        <div class="card-body">
            <div class="alert alert-azure">
                {{ __('account.dont_have_open_shift') }}
            </div>
        </div>
    @endif
</div>
