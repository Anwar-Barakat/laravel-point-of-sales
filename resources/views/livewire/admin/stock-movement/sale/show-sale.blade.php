    <div>
        <div class="row g-0">
            <div class="col d-flex flex-column">
                <div class="card">
                    <form wire:submit.prevent='submit'>
                        <div class="card-body">
                            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                            <div class="row row-cards">
                                <div class="col-12 col-lg-3">
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            {{ __('stock.customer_name') }}
                                            (<a href="{{ route('admin.customers.create') }}" class="text underline" title="{{ __('msgs.create', ['name' => __('stock.customer')]) }}">{{ __('msgs.add_new') }}</a>)
                                        </label>
                                        <select class="form-select" wire:model.debounce.500s='sale.customer_id'>
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
                                <div class="col-12 col-lg-3">
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
                                <div class="col-12 col-lg-3">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('movement.invoice_date')" />
                                        <x-text-input type="date" class="form-control" wire:model.debounce.500s='sale.invoice_date' />
                                        <x-input-error :messages="$errors->get('vednor.invoice_date')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-4 mb-3 w-50">
                            <h4 class="mb-4 text-blue">{{ __('stock.wholesale_retail_prices') }}</h4>
                            <div class="row row-cards">
                                <div class="col-12 col-lg-3">
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            {{ __('stock.store') }}
                                            (<a href="{{ route('admin.stores.index') }}" class="text underline" title="{{ __('msgs.create', ['name' => __('stock.store')]) }}">{{ __('msgs.add_new') }}</a>)
                                        </label>
                                        <select class="form-select" wire:model='sale.store_id'>
                                            <option value="">{{ __('btns.select') }}</option>
                                            @if ($stores)
                                                @foreach ($stores as $store)
                                                    <option value="{{ $store->id }}" {{ old('sale.store_id') == $store->id ? 'selected' : '' }}>
                                                        {{ $store->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <x-input-error :messages="$errors->get('sale.store_id')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('movement.sale_type')" />
                                        <select class="form-select" wire:model='sale.sale_type'>
                                            <option value="">{{ __('btns.select') }}</option>
                                            @foreach (App\Models\SALE::SALETYPE as $key => $value)
                                                <option value="{{ $key }}">{{ __('movement.' . $value) }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('sale.sale_type')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('stock.item')" />
                                        <select class="form-select" wire:model='sale.item_id'>
                                            <option value="">{{ __('btns.select') }}</option>
                                            @foreach ($items as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('sale.item_id')" class="mt-2" />
                                    </div>
                                </div>
                                @if ($wholesale_unit)
                                    <div class="col-12 col-lg-3">
                                        <div class="mb-3">
                                            <x-input-label class="form-label" :value="__('stock.unit')" />
                                            <select class="form-select" wire:model='sale.unit_id'>
                                                <option value="">{{ __('btns.select') }}</option>
                                                <option value="{{ $wholesale_unit->id }}">{{ $wholesale_unit->name }} ({{ __('stock.wholesale_unit') }})</option>
                                                @if (!is_null($retail_unit))
                                                    <option value="{{ $retail_unit->id }}">{{ $retail_unit->name }} ({{ __('stock.retail_unit') }})</option>
                                                @endif
                                            </select>
                                            <x-input-error :messages="$errors->get('sale.unit_id')" class="mt-2" />
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="row row-cards">
                                @if ($batches)
                                    <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <x-input-label class="form-label" :value="__('movement.specific_store_qty')" />
                                            <select class="form-select" wire:model.defer='sale.item_batch_id'>
                                                <option value="">{{ __('btns.select') }}</option>
                                                @foreach ($batches as $batch)
                                                    @if ($unit->status == 'retail')
                                                        @php
                                                            $qty = floatval($batch->qty) * floatval($item->retail_count_for_wholesale);
                                                            $price = floatval($item->retail_count_for_wholesale) != 0 ? floatval($batch->unit_price) / floatval($item->retail_count_for_wholesale) : 0;
                                                        @endphp
                                                        @if ($price > 0)
                                                            <option value="{{ $batch->id }}">
                                                                {{ __('movement.number') }} {{ $qty }} ({{ __('stock.unit') . ' : ' . $unit->name }})
                                                                - {{ __('stock.unit_price') . ' : ' . number_format($price, 0) }}
                                                            </option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $batch->id }}">
                                                            {{ __('movement.number') }} {{ number_format($batch->qty, 0) }} ({{ __('stock.unit') }} : {{ $unit->name }})
                                                            {{ $batch->production_date ? __('movement.production_date') . ' : ' . $batch->production_date : '' }}
                                                            - {{ __('stock.unit_price') . ' : ' . number_format($batch->unit_price, 0) }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('sale.item_batch_id')" class="mt-2" />
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12 col-lg-3">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('movement.qty')" />
                                        <x-text-input type="number" class="form-control" wire:model='sale.qty' wire:keyup='calcPrice' />
                                        <x-input-error :messages="$errors->get('sale.qty')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('stock.unit_price')" />
                                        <x-text-input type="number" class="form-control" wire:model.debounce.500s='sale.unit_price' readonly disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cards">
                                <div class="col-12 col-lg-4">
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
    </div>
