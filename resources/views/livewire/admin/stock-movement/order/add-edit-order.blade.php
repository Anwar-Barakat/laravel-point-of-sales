<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <label for="" class="form-label">
                            {{ __('stock.vendor_name') }}
                            (<a href="{{ route('admin.vendors.create') }}" class="text underline">{{ __('msgs.add_new') }}</a>)
                        </label>
                        <select class="form-control" wire:model.debounce.350='order.vendor_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @if ($vendors)
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}" {{ old('order.vendor_id') == $vendor->id ? 'selected' : '' }}>
                                        {{ $vendor->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('order.vendor_id')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('movement.invoice_type')" />
                        <select id="" class="form-control" wire:model.debounce.350='order.invoice_type'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach (App\Models\Order::INVOICETYPE as $key => $value)
                                <option value="{{ $key }}">{{ __('movement.' . $value) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('order.invoice_type')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('movement.invoice_date')" />
                        <x-text-input type="date" class="form-control" wire:model.debounce.350='order.invoice_date' />
                        <x-input-error :messages="$errors->get('vednor.invoice_date')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <label for="" class="form-label">
                            {{ __('stock.store') }}
                            (<a href="{{ route('admin.stores.index') }}" class="text underline">{{ __('msgs.add_new') }}</a>)
                        </label>
                        <select class="form-control" wire:model.debounce.350='order.store_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @if ($stores)
                                @foreach ($stores as $store)
                                    <option value="{{ $store->id }}" {{ old('order.store_id') == $store->id ? 'selected' : '' }}>
                                        {{ $store->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('order.store_id')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="row row-cards">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.notes')" />
                        <textarea rows="5" class="form-control" wire:model.debounce.350='order.notes'></textarea>
                        <x-input-error :messages="$errors->get('order.notes')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">{{ __('btns.submit') }}</button>
        </div>
    </form>
</div>
