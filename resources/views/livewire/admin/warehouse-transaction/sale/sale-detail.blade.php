<div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="card">
                <div class="card-header flex justify-content-between items-center">
                    <h3 class="card-title">{{ __('msgs.main_info') }}</h3>
                    @if ($sale->is_approved == 0 && $sale_products->count() > 0)
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approval-modal">{{ __('btns.approval') }}</button>
                    @endif
                    @livewire('admin.warehouse-transaction.sale.sale-approval', ['sale' => $sale])
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
                            <th>{{ __('transaction.sale_invoice') }}</th>
                            <td>#{{ $sale->id }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.sale_type') }}</th>
                            <td>
                                <span class="badge bg-red-lt">
                                    @if ($sale->type == 1)
                                        {{ __('transaction.sales') }}
                                    @elseif($sale->type == 3)
                                        {{ __('transaction.general_sale_return') }}
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.invoice_type') }}</th>
                            <td>{{ $sale->invoice_type ? __('transaction.delayed') : __('transaction.cash') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('stock.customer_name') }}</th>
                            <td>{{ $sale->customer->name }}</td>
                        </tr>

                        <tr>
                            <th>{{ __('transaction.invoice_number') }}</th>
                            <td>{{ $sale->account->number }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.items_cost') }}</th>
                            <td>{{ $sale->items_cost ?? '0' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.tax') }}</th>
                            <td>
                                {{ $sale->tax_value ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.cost_before_discount') }}</th>
                            <td>{{ $sale->cost_before_discount ?? '0' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.discount') }}</th>
                            <td>
                                {{ $sale->discount_value ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.grand_total') }}</th>
                            <td>{{ $sale->cost_after_discount ?? '0' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.delegate_name') }}</th>
                            <td>{{ $sale->delegate->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('stock.commission_value') }}</th>
                            <td class="flex items-center justify-between gap-1">
                                <span>{{ abs($sale->commission_value) ?? '0' }}</span>

                                @php
                                    $commission = 0;
                                    if ($sale->invoice_sale_type == 1) {
                                        $commission = $sale->delegate->commission_for_sectoral;
                                    } elseif ($sale->invoice_sale_type == 2) {
                                        $commission = $sale->delegate->commission_for_half_block;
                                    } elseif ($sale->invoice_sale_type == 3) {
                                        $commission = $sale->delegate->commission_for_block;
                                    }
                                @endphp
                                @if ($commission > 0)
                                    <span class="badge badge-info">
                                        {{ $commission }}
                                        {{ $sale->commission_type == 0 ? '%' : '$' }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.invoice_date') }}</th>
                            <td>{{ $sale->invoice_date }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('msgs.added_by') }}</th>
                            <td>{{ $sale->addedBy->name }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer border-top-0">
                </div>
            </div>
        </div>
        @if ($sale->is_approved == 0)
            <div class="col-12 col-lg-8 mb-3 d-flex flex-column">
                <div class="card">
                    <form wire:submit.prevent='submit' id="add-items">
                        <div class="card-body">
                            <h3 class="mb-4 text-blue">{{ __('transaction.add_items') }}</h3>
                            <div class="row row-cards">
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            {{ __('stock.store') }}
                                            (<a href="{{ route('admin.stores.index') }}" class="text underline text-blue-500" title="{{ __('msgs.create', ['name' => __('stock.store')]) }}">{{ __('msgs.add_new') }}</a>)
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
                                        <x-input-label class="form-label" :value="__('transaction.sale_type')" />
                                        <select class="form-select" wire:model.defer='product.sale_type' readonly disabled>
                                            <option value="">{{ __('btns.select') }}</option>
                                            @foreach (App\Models\SALEPRODUCT::SALETYPE as $key => $value)
                                                <option value="{{ $key }}">{{ __('transaction.' . $value) }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('product.sale_type')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cards">
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            {{ __('stock.item') }}
                                            (<a href="{{ route('admin.items.create') }}" class="text underline text-blue-500" title="{{ __('msgs.create', ['name' => __('stock.item')]) }}">{{ __('msgs.add_new') }}</a>)
                                        </label>
                                        <select class="form-select" wire:model='product.item_id'>
                                            <option value="">{{ __('btns.select') }}</option>
                                            @foreach ($items as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('product.item_id')" class="mt-2" />
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
                            </div>
                            <div class="row row-cards">
                                @include('livewire.admin.inc.batches')
                                <div class="col-12 col-lg-3">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('transaction.qty')" />
                                        <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='product.qty' wire:keyup='calcPrice' />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('stock.unit_price')" />
                                        <x-text-input type="number" placeholder="10.15" class="form-control" wire:model.debounce.500s='product.unit_price' readonly disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cards">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('transaction.grand_total')" />
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
        @else
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="ribbon ribbon-top bg-yellow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                        </svg>
                    </div>
                    <div class="card-body flex justify-center items-center flex-column">
                        <h3 class="card-title mt-4">{{ __('transaction.order_is_closed') }}</h3>
                        <img src="{{ asset('backend/static/illustrations/undraw_quitting_time_dm8t.svg') }}" width="400" alt="{{ __('transaction.order_is_closed') }}">
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
                <div>
                    <table class="table card-table table-vcenter table-striped-columns">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('stock.item') }}</th>
                                <th>{{ __('stock.item_name') }}</th>
                                <th>{{ __('stock.item_type') }}</th>
                                <th>{{ __('stock.unit') }}</th>
                                <th>{{ __('stock.unit_price') }}</th>
                                <th>{{ __('transaction.sale_type') }}</th>
                                <th>{{ __('transaction.qty') }}</th>
                                <th>{{ __('transaction.production_date') }}</th>
                                <th>{{ __('transaction.expiration_date') }}</th>
                                <th>{{ __('transaction.total_price') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sale_products as $saleProduct)
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
                                    <td>
                                        <span class="badge bg-azure-lt">
                                            {{ __('transaction.' . App\Models\SaleProduct::SALETYPE[$saleProduct->sale_type]) }}
                                        </span>
                                    </td>
                                    <td>{{ $saleProduct->qty }}</td>
                                    <td>{{ $saleProduct->item_batch->production_date ?? '-' }}</td>
                                    <td>{{ $saleProduct->item_batch->expiration_date ?? '-' }}</td>
                                    <td class="bg-blue-500">{{ $saleProduct->total_price }}</td>
                                    @if (!$sale->is_approved == 1)
                                        <td>
                                            <div class="btn-list flex-nowrap justify-content-center">
                                                <a wire:click.prevent="edit({{ $saleProduct->id }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                </a>
                                                <a wire:click.prevent="delete({{ $saleProduct->id }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center">
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
                                    <td colspan="12">
                                        <x-blank-section :content="__('stock.item')" :url="'#add-items'" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if ($sale_products->count() > 0)
                        <div class="p-3 mt-2">
                            {{ $sale_products->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
                <div class="card-footer border-top-0">
                </div>
            </div>
        </div>
    </div>
</div>
