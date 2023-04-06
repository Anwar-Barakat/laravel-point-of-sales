<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <ul class="p-0 m-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row row-cards">
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('account.account_name')" />
                        <x-text-input type="text" class="form-control" wire:model='financialAccount.name' required />
                        <x-input-error :messages="$errors->get('financialAccount.name')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('account.account_type')" />
                        <select id="" class="form-control" wire:model='financialAccount.account_type_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach ($account_types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('financialAccount.account_type_id')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('account.is_parent_account')" />
                        <select id="" class="form-control" wire:model='financialAccount.is_parent'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.yes') }}</option>
                            <option value="0">{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('financialAccount.is_parent')" class="mt-2" />
                    </div>
                </div>
                @if (!empty($parent_accounts) || !empty($financialAccount['is_parent']))
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.is_parent_account')" />
                            <select id="" class="form-control" wire:model='financialAccount.parent_id'>
                                <option value="">{{ __('btns.select') }}</option>
                                @foreach ($parent_accounts as $parent_accounts)
                                    <option value="{{ $parent_accounts->id }}">{{ $parent_accounts->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('financialAccount.parent_id')" class="mt-2" />
                        </div>
                    </div>
                @endif
            </div>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('account.initial_balance_status')" />
                        <select id="" class="form-control" wire:model='financialAccount.initial_balance_status'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach (App\Models\FinancialAccount::INITIALBANALNCESTATUS as $key => $status)
                                <option value="{{ $key }}">{{ __('account.' . $status) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('financialAccount.initial_balance_status')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('account.initial_balance')" />
                        <x-text-input type="number" class="form-control" wire:model='financialAccount.initial_balance' required />
                        <x-input-error :messages="$errors->get('financialAccount.initial_balance')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.is_active')" />
                        <select id="" class="form-control" wire:model='financialAccount.is_active'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.yes') }}</option>
                            <option value="0">{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('financialAccount.is_active')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="row row-cards">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.notes')" />
                        <textarea rows="5" class="form-control" wire:model='financialAccount.notes' required></textarea>
                        <x-input-error :messages="$errors->get('financialAccount.notes')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">{{ __('btns.submit') }}</button>
        </div>
    </form>
</div>
