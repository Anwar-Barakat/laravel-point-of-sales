    <div class="card">
        <div class="row g-0">
            <div class="col d-flex flex-column">
                <form wire:submit.prevent='submit'>
                    <div class="card-body">
                        <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                        <div class="row row-cards">
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">
                                        {{ __('stock.customer_name') }}
                                        (<a href="{{ route('admin.customers.create') }}" class="text underline" title="{{ __('msgs.create', ['name' => __('stock.customer')]) }}">{{ __('msgs.add_new') }}</a>)
                                    </label>
                                    <select class="form-select" wire:model.debounce.500s='sale.customer_id' id="select-tags-advanced">
                                        <option value="">{{ __('btns.select') }}</option>
                                        @if ($customers)
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ old('sale.customer_id') == $customer->id ? 'selected' : '' }}>
                                                    {{ $customer->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <x-input-error :messages="$errors->get('sale.customer_id')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.invoice_type')" />
                                    <select class="form-select" wire:model.debounce.500s='sale.invoice_type'>
                                        <option value="">{{ __('btns.select') }}</option>
                                        @foreach (App\Models\SALE::INVOICETYPE as $key => $value)
                                            <option value="{{ $key }}">{{ __('movement.' . $value) }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('sale.invoice_type')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.invoice_date')" />
                                    <x-text-input type="date" class="form-control" wire:model.debounce.500s='sale.invoice_date' />
                                    <x-input-error :messages="$errors->get('vednor.invoice_date')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="row row-cards">
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.sale_type')" />
                                    <select class="form-select" wire:model.debounce.500s='sale.invoice_type'>
                                        <option value="">{{ __('btns.select') }}</option>
                                        @foreach (App\Models\SALE::SALETYPE as $key => $value)
                                            <option value="{{ $key }}">{{ __('movement.' . $value) }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('sale.invoice_type')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('stock.item')" />
                                    <select class="form-select" wire:model='sale.item_id' id="select-tags-advanced">
                                        <option value="">{{ __('btns.select') }}</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('sale.item_id')" class="mt-2" />
                                </div>
                            </div>
                            @if ($wholesale_unit)
                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('stock.unit')" />
                                        <select class="form-select" wire:model.debounce.500s='sale.unit_id' id="select-tags-advanced">
                                            <option value="">{{ __('btns.select') }}</option>
                                            <option value="{{ $wholesale_unit->id }}">{{ $wholesale_unit->name }} ({{ __('stock.wholesale_unit') }})</option>
                                            @if (!is_null($retail_unit))
                                                <option value="{{ $retail_unit->id }}">{{ $retail_unit->name }} ({{ __('stock.retail_unit') }})</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.qty')" />
                                    <x-text-input type="number" class="form-control" wire:model.debounce.500s='sale.qty' wire:keyup='calcPrice' />
                                    <x-input-error :messages="$errors->get('sale.invoice_type')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('stock.unit_price')" />
                                    <x-text-input type="number" class="form-control" wire:model.debounce.500s='sale.unit_price' readonly disabled />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.grand_total')" />
                                    <x-text-input type="number" class="form-control" wire:model.debounce.500s='sale.total_price' readonly disabled />
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
        </div>
    </div>
