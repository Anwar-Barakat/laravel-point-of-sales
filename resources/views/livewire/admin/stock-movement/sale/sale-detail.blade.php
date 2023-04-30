<div>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header flex justify-content-between items-center">
                    <h3 class="card-title">{{ __('msgs.main_info') }}</h3>
                    @if ($sale->is_approved == 0 && $sale_products->count() > 0)
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approval-modal">{{ __('btns.approval') }}</button>
                    @endif
                    {{-- @livewire('admin.stock-movement.sale.approval-sale', ['sale' => $sale]) --}}
                </div>
                <table class="table card-table table-vcenter table-striped-columns">
                    <thead>
                        <tr>
                            <th>{{ __('msgs.column') }}</th>
                            <th colspan="2">{{ __('btns.details') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{ __('movement.sale_invoice') }}</th>
                            <td>{{ $sale->id }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('movement.invoice_type') }}</th>
                            <td>{{ $sale->invoice_type ? __('movement.delayed') : __('movement.cash') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('stock.customer_name') }}</th>
                            <td>{{ $sale->customer->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('movement.delegate_name') }}</th>
                            <td>{{ $sale->delegate->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('movement.invoice_number') }}</th>
                            <td>{{ $sale->account->number }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('movement.items_cost') }}</th>
                            <td>{{ $sale->items_cost ?? '0' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('movement.tax') }}</th>
                            <td>{{ $sale->tax ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('movement.cost_before_discount') }}</th>
                            <td>{{ $sale->cost_before_discount ?? '0' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('movement.discount') }}</th>
                            <td>{{ $sale->discount ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('movement.grand_total') }}</th>
                            <td>{{ $sale->cost_after_discount ?? '0' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('msgs.created_at') }}</th>
                            <td>{{ $sale->created_at }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('msgs.added_by') }}</th>
                            <td>{{ $sale->addedBy->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if ($sale->is_approved == 0)
            <div class="col-12 col-lg-8 d-flex flex-column">
                <div class="card">
                    <form wire:submit.prevent='submit'>
                        <div class="card-body">
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
                            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                            <div class="row row-cards">
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            {{ __('stock.store') }}
                                            (<a href="{{ route('admin.stores.index') }}" class="text underline" title="{{ __('msgs.create', ['name' => __('stock.store')]) }}">{{ __('msgs.add_new') }}</a>)
                                        </label>
                                        <select class="form-select" wire:model='product.store_id'>
                                            <option value="">{{ __('btns.select') }}</option>
                                            @if ($stores)
                                                @foreach ($stores as $store)
                                                    <option value="{{ $store->id }}" {{ old('product.store_id') == $store->id ? 'selected' : '' }}>
                                                        {{ $store->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <x-input-error :messages="$errors->get('product.store_id')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('movement.sale_type')" />
                                        <select class="form-select" wire:model='product.sale_type'>
                                            <option value="">{{ __('btns.select') }}</option>
                                            @foreach (App\Models\SALEPRODUCT::SALETYPE as $key => $value)
                                                <option value="{{ $key }}">{{ __('movement.' . $value) }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('product.sale_type')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cards">
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('stock.item')" />
                                        <select class="form-select" wire:model='product.item_id'>
                                            <option value="">{{ __('btns.select') }}</option>
                                            @foreach ($items as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('product.item_id')" class="mt-2" />
                                    </div>
                                </div>
                                @if ($wholesale_unit)
                                    <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <x-input-label class="form-label" :value="__('stock.unit')" />
                                            <select class="form-select" wire:model='product.unit_id'>
                                                <option value="">{{ __('btns.select') }}</option>
                                                <option value="{{ $wholesale_unit->id }}">{{ $wholesale_unit->name }} ({{ __('stock.wholesale_unit') }})</option>
                                                @if (!is_null($retail_unit))
                                                    <option value="{{ $retail_unit->id }}">{{ $retail_unit->name }} ({{ __('stock.retail_unit') }})</option>
                                                @endif
                                            </select>
                                            <x-input-error :messages="$errors->get('product.unit_id')" class="mt-2" />
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="row row-cards">
                                @if ($batches)
                                    <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <x-input-label class="form-label" :value="__('movement.specific_store_qty')" />
                                            <select class="form-select" wire:model.defer='product.item_batch_id'>
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
                                            <x-input-error :messages="$errors->get('product.item_batch_id')" class="mt-2" />
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12 col-lg-3">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('movement.qty')" />
                                        <x-text-input type="number" class="form-control" wire:model='product.qty' wire:keyup='calcPrice' />
                                        <x-input-error :messages="$errors->get('product.qty')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('stock.unit_price')" />
                                        <x-text-input type="number" class="form-control" wire:model.debounce.500s='product.unit_price' readonly disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cards">
                                <div class="col-12 col-lg-4">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('movement.grand_total')" />
                                        <x-text-input type="number" class="form-control" wire:model.debounce.500s='product.total_price' readonly disabled />
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
        @else
            <div class="col-12 col-lg-8" id="add-items">
                <div class="card mb-3">
                    <div class="card-header text-info">
                        <h3 class="card-title">{{ __('movement.order_is_closed') }}</h3>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header flex justify-content-between items-center">
                    <h3 class="card-title">{{ __('stock.items') }}</h3>
                </div>
                <table class="table card-table table-vcenter table-striped-columns">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('stock.item') }}</th>
                            <th>{{ __('stock.item_name') }}</th>
                            <th>{{ __('stock.item_type') }}</th>
                            <th>{{ __('stock.unit') }}</th>
                            <th>{{ __('stock.unit_price') }}</th>
                            <th>{{ __('movement.qty') }}</th>
                            <th>{{ __('movement.production_date') }}</th>
                            <th>{{ __('movement.expiration_date') }}</th>
                            <th>{{ __('movement.total_price') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse ($sale_products as $saleProduct)
                            <tr>
                                <td>{{ $saleProduct->id }}</td>
                                <td>
                                    @if ($saleProduct->item->getFirstMediaUrl('items'))
                                        <img src="{{ $saleProduct->item->getFirstMediaUrl('items') }}" class="img img-thumbnail" alt="{{ $saleProduct->item->name }}" width="80">
                                    @else
                                        <img src="{{ asset('backend/static/default-show-product.png') }}" class="img img-thumbnail" alt="{{ $saleProduct->item->name }}" width="80">
                                    @endif
                                </td>
                                <td>{{ $saleProduct->item->name }}</td>
                                <td>
                                    <span class="badge bg-blue">
                                        {{ __('stock.' . App\Models\Item::ITEMTYPE[$saleProduct->item->type]) }}
                                    </span>
                                </td>
                                <td> <span class="badge bg-blue-lt">{{ $saleProduct->unit->name }}</span></td>
                                <td>{{ $saleProduct->unit_price }}</td>
                                <td>{{ $saleProduct->qty }}</td>
                                <td>{{ $saleProduct->production_date ?? '-' }}</td>
                                <td>{{ $saleProduct->expiration_date ?? '-' }}</td>
                                <td class="bg-blue-500">{{ $saleProduct->total_price }}</td>
                                @if (!$order->is_approved == 1)
                                    <td>
                                        <div class="btn-list flex-nowrap justify-content-center">
                                            <a wire:click.prefetch="edit({{ $orderProduct->id }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </a>
                                            <a wire:click.prefetch="delete({{ $orderProduct->id }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon m-0 text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </a>

                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    <x-blank-section :content="__('stock.item')" :url="'#add-items'" />
                                </td>
                            </tr>
                        @endforelse --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
