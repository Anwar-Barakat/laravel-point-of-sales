<div>
    <div class="row">
        <div class="col-12 col-lg-4 mb-3">
            <div class="card">
                <div class="card-header flex justify-content-between items-center">
                    <h3 class="card-title">{{ __('msgs.main_info') }}</h3>
                    @if ($order->is_approved == 0 && $order->orderProducts->count() > 0)
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approval-modal">{{ __('btns.approval') }}</button>
                    @endif
                    @livewire('admin.warehouse-transaction.order.order-approval', ['order' => $order])
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
                            <th>{{ __('transaction.order_id') }}</th>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.order_type') }}</th>
                            <td>
                                <span class="badge bg-red-lt">{{ __('transaction.' . App\Models\Order::ORDERTYPE[$order->type]) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.invoice_type') }}</th>
                            <td>{{ $order->invoice_type ? __('transaction.delayed') : __('transaction.cash') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('stock.vendor_name') }}</th>
                            <td>{{ $order->vendor->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('stock.store') }}</th>
                            <td>{{ $order->store->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.invoice_number') }}</th>
                            <td>{{ $order->account->number }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.items_cost') }}</th>
                            <td>{{ $order->items_cost ?? '0' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.tax') }}</th>
                            <td>{{ $order->tax_value ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.cost_before_discount') }}</th>
                            <td>{{ $order->cost_before_discount ?? '0' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.discount') }}</th>
                            <td>{{ $order->discount_value ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.grand_total') }}</th>
                            <td>{{ $order->cost_after_discount ?? '0' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('msgs.created_at') }}</th>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('msgs.added_by') }}</th>
                            <td>{{ $order->addedBy->name }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer border-top-0"></div>
            </div>
        </div>
        @if ($order->is_approved == 0 && $order->type === 1)
            <div class="col-12 col-lg-8 mb-3" id="add-items">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('transaction.add_items') }}</h3>
                    </div>
                    <form wire:submit.prevent='submit'>
                        <div class="card-body">
                            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                            <div class="row">
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
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('transaction.unit_price')" />
                                        <x-text-input type="number" placeholder="10.15" class="form-control" wire:model.debounce.500s='product.unit_price' wire:keyup='calcPrice' />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('transaction.qty')" />
                                        <x-text-input type="number" placeholder="10.15" class="form-control" wire:model.debounce.500s='product.qty' wire:keyup='calcPrice' />
                                    </div>
                                </div>
                                @if ($consuming)
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <x-input-label class="form-label" :value="__('transaction.production_date')" />
                                            <x-text-input type="date" class="form-control" wire:model.debounce.500s='product.production_date' />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <x-input-label class="form-label" :value="__('transaction.expiration_date')" />
                                            <x-text-input type="date" class="form-control" wire:model.debounce.500s='product.expiration_date' />
                                        </div>
                                    </div>
                                @endif
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
        @elseif($order->is_approved == 0 && $order->type === 3)
            @livewire('admin.warehouse-transaction.order.general-order-return-item-form', ['order' => $order])
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
                <div class="card-header w-100 d-flex align-items-center justify-content-between">
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
                                <th>{{ __('transaction.qty') }}</th>
                                <th>{{ __('transaction.production_date') }}</th>
                                <th>{{ __('transaction.expiration_date') }}</th>
                                <th>{{ __('transaction.total_price') }}</th>
                                @if (!$order->is_approved == 1)
                                    <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order_products as $orderProduct)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($orderProduct->item->getFirstMediaUrl('items'))
                                            <img src="{{ $orderProduct->item->getFirstMediaUrl('items') }}" class="img img-thumbnail" alt="{{ $orderProduct->item->name }}" width="80">
                                        @else
                                            <img src="{{ asset('backend/static/default-show-product.png') }}" class="img img-thumbnail" alt="{{ $orderProduct->item->name }}" width="80">
                                        @endif
                                    </td>
                                    <td>{{ $orderProduct->item->name }}</td>
                                    <td>
                                        <span class="badge bg-blue">
                                            {{ __('stock.' . App\Models\Item::ITEMTYPE[$orderProduct->item->type]) }}
                                        </span>
                                    </td>
                                    <td> <span class="badge bg-blue-lt">{{ $orderProduct->unit->name }}</span></td>
                                    <td>{{ $orderProduct->unit_price }}</td>
                                    <td>{{ $orderProduct->qty }}</td>
                                    <td>{{ $orderProduct->production_date ?? '-' }}</td>
                                    <td>{{ $orderProduct->expiration_date ?? '-' }}</td>
                                    <td class="bg-blue-500">{{ $orderProduct->total_price }}</td>
                                    @if (!$order->is_approved == 1)
                                        <td>
                                            <div class="btn-list flex-nowrap justify-content-center">
                                                <a wire:click.prevent="edit({{ $orderProduct->id }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                </a>
                                                <a wire:click.prevent="delete({{ $orderProduct->id }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center">
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
                                    <td colspan="11">
                                        <x-blank-section :content="__('stock.item')" :url="'#add-items'" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if ($order_products->count() > 0)
                        <div class="p-3 mt-2">
                            {{ $order_products->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
                <div class="card-footer border-top-0">
                </div>
            </div>
        </div>
    </div>
</div>
