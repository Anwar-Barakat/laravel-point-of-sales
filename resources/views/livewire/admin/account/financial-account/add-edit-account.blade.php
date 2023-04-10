<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('account.account_name')" />
                        <x-text-input type="text" class="form-control" wire:model.debounce.350='account.name' />
                        <x-input-error :messages="$errors->get('account.name')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('account.account_type')" />
                        <select id="" class="form-control" wire:model.debounce.350='account.account_type_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach ($account_types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('account.account_type_id')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('account.is_parent_account')" />
                        <select id="" class="form-control" wire:model.debounce.350='account.is_parent'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.yes') }}</option>
                            <option value="0">{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('account.is_parent')" class="mt-2" />
                    </div>
                </div>
                @if ($parent_accounts)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.parent_accounts')" />
                            <select id="" class="form-control" wire:model.debounce.350='account.parent_id'>
                                <option value="">{{ __('btns.select') }}</option>
                                @foreach ($parent_accounts as $parent_accounts)
                                    <option value="{{ $parent_accounts->id }}">{{ $parent_accounts->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('account.parent_id')" class="mt-2" />
                        </div>
                    </div>
                @endif
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('setting.status')" />
                        <select id="" class="form-control" wire:model.debounce.350='account.is_archived'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('account.is_archived') }}</option>
                            <option value="0">{{ __('account.not_archived') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('account.is_archived')" class="mt-2" />
                    </div>
                </div>
            </div>
            @if (!$edit)
                <div class="row row-cards">
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.initial_balance_status')" />
                            <select id="" class="form-control" wire:model.debounce.350='account.initial_balance_status'>
                                <option value="">{{ __('btns.select') }}</option>
                                @foreach (App\Models\Account::INITIALBANALNCESTATUS as $key => $status)
                                    <option value="{{ $key }}">{{ __('account.' . $status) }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('account.initial_balance_status')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.initial_balance')" />
                            <x-text-input type="number" class="form-control" wire:model.debounce.350='account.initial_balance' />
                            <x-input-error :messages="$errors->get('account.initial_balance')" class="mt-2" />
                        </div>
                    </div>
                </div>
            @endif

            <div class="row row-cards">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.notes')" />
                        <textarea rows="5" class="form-control" wire:model.debounce.350='account.notes'></textarea>
                        <x-input-error :messages="$errors->get('account.notes')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">{{ __('btns.submit') }}</button>
        </div>
    </form>
</div>
