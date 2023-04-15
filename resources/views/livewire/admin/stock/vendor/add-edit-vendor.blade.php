<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.vendor_name')" />
                        <x-text-input type="text" class="form-control" wire:model.debounce.350='vendor.name' />
                        <x-input-error :messages="$errors->get('vednor.name')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.address')" />
                        <x-text-input type="text" class="form-control" wire:model.debounce.350='vendor.address' />
                        <x-input-error :messages="$errors->get('vednor.address')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('setting.status')" />
                        <select class="form-select" wire:model.debounce.350='vendor.is_active'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1" {{ old('order.vendor_id') ? 'selected' : '' }}>{{ __('msgs.is_active') }}</option>
                            <option value="0" {{ old('order.vendor_id') == '0' ? 'selected' : '' }}>{{ __('msgs.not_active') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('vednor.is_active')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.category')" />
                        <select class="form-select" wire:model.debounce.350='vendor.category_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @if ($categories)
                                @foreach ($categories as $root)
                                    <option value="{{ $root->id }}">{{ ucwords($root->name) }}</option>
                                    @if ($root->subCategories)
                                        @foreach ($root->subCategories as $child)
                                            <option value="{{ $child->id }}">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;
                                                {{ ucwords($child->name) }}
                                            </option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('vednor.category_id')" class="mt-2" />
                    </div>
                </div>
            </div>
            @if (!$edit)
                <div class="row row-cards">
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.initial_balance_status')" />
                            <select class="form-select" wire:model.debounce.350='vendor.initial_balance_status'>
                                <option value="">{{ __('btns.select') }}</option>
                                @foreach (App\Models\Vendor::INITIALBANALNCESTATUS as $key => $status)
                                    <option value="{{ $key }}">{{ __('account.' . $status) }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('vednor.initial_balance_status')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('account.initial_balance')" />
                            <x-text-input type="number" class="form-control" wire:model.debounce.350='vendor.initial_balance' />
                            <x-input-error :messages="$errors->get('vednor.initial_balance')" class="mt-2" />
                        </div>
                    </div>
                </div>
            @endif
            <div class="row row-cards">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.notes')" />
                        <textarea rows="5" class="form-control" wire:model.debounce.350='vendor.notes'></textarea>
                        <x-input-error :messages="$errors->get('vednor.notes')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">{{ __('btns.submit') }}</button>
        </div>
    </form>
</div>
