<div class="col-12 col-lg-8 mb-3" id="add-items">
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title">{{ __('transaction.add_items') }}</h3>
        </div>
        <form wire:submit.prevent='submit'>
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
            <div class="card-body">
                <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.store')" />
                            <select class="form-select" wire:model='order.store_id' readonly disabled>
                                <option value="">{{ __('btns.select') }}</option>
                                @forelse (App\Models\Store::active()->get() as $store)
                                    @if ($store->id == $order->store_id)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">
                                {{ __('stock.item_name') }}
                                (<a href="{{ route('admin.items.create') }}" class="text underline">{{ __('msgs.add_new') }}</a>)
                            </label>
                            <select class="form-select" wire:model='product.item_id'>
                                <option value="">{{ __('btns.select') }}</option>
                                @forelse ($items as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($item)
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('stock.unit')" />
                                <select class="form-select" wire:model='product.unit_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="{{ $item->parentUnit->id }}">{{ $item->parentUnit->name }} ({{ __('stock.wholesale_unit') }})</option>
                                    @if (!is_null($item->childUnit))
                                        <option value="{{ $item->childUnit->id }}">{{ $item->childUnit->name }} ({{ __('stock.retail_unit') }})</option>
                                    @endif
                                </select>
                                <x-input-error :messages="$errors->get('product.unit_id')" class="mt-2" />
                            </div>
                        </div>
                    @endif
                    @if ($batches)
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">
                                    {{ __('transaction.specific_store_qty') }}
                                    (<a href="{{ route('admin.orders.create') }}" class="text underline text-blue-500" title="{{ __('msgs.create', ['name' => __('transaction.purchase_bill')]) }}">{{ __('msgs.add_new') }}</a>)
                                </label>
                                <select class="form-select" wire:model='product.item_batch_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach ($batches as $batch)
                                        @if ($unit->status == 'retail')
                                            @php
                                                $qty = floatval($batch->qty) * floatval($item->retail_count_for_wholesale);
                                                $price = floatval($item->retail_count_for_wholesale) != 0 ? floatval($batch->unit_price) / floatval($item->retail_count_for_wholesale) : 0;
                                            @endphp
                                            @if ($price > 0)
                                                <option value="{{ $batch->id }}" {{ $qty == 0 ? 'readony disabled' : '' }}>
                                                    {{ __('transaction.number') }} {{ $qty }} ({{ __('stock.unit') . ' : ' . $unit->name }})
                                                    - {{ __('stock.unit_price') . ' : ' . number_format($price, 0) }}
                                                </option>
                                            @endif
                                        @else
                                            <option value="{{ $batch->id }}" {{ $batch->qty == 0 ? 'readony disabled' : '' }}>
                                                {{ __('transaction.number') }} {{ number_format($batch->qty, 0) }} ({{ __('stock.unit') }} : {{ $unit->name }})
                                                {{ $batch->production_date ? __('transaction.production_date') . ' : ' . $batch->production_date : '' }}
                                                - {{ __('stock.unit_price') . ' : ' . number_format($batch->unit_price, 0) }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('product.item_batch_id')" class="mt-2" />
                            </div>
                        </div>
                    @endif

                    @if ($batch)
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('transaction.unit_price')" />
                                <x-text-input type="number" placeholder="10.15" class="form-control" wire:model.debounce.500s='product.unit_price' readonly disabled />
                            </div>
                        </div>
                    @endif
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('transaction.returned_qty')" />
                            <x-text-input type="number" placeholder="10.15" class="form-control" wire:model.debounce.500s='product.qty' wire:keyup='calcPrice' />
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('transaction.total_price')" />
                            <x-text-input type="number" placeholder="10.15" class="form-control" wire:model.debounce.500s='product.total_price' readonly disabled />
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
