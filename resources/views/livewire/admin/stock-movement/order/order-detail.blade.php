<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('msgs.main_info') }}</h3>
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
                        <th>{{ __('movement.order_id') }}</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('movement.invoice_type') }}</th>
                        <td>{{ $order->invoice_type ? __('movement.delayed') : __('movement.cash') }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('stock.vendor_name') }}</th>
                        <td>{{ $order->vendor->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('movement.invoice_number') }}</th>
                        <td>{{ $order->account->number }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('movement.discount_type') }}</th>
                        <td>{{ $order->discount_type ? __('movement.fixed') : __('movement.percentage') }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('movement.items_cost') }}</th>
                        <td>{{ $order->items_cost ?? '0' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('movement.cost_before_discount') }}</th>
                        <td>{{ $order->cost_before_discount ?? '0' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('movement.cost_after_discount') }}</th>
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
        </div>
    </div>
    @if ($order->is_approved == 0)
        <div class="col-md-12 col-lg-8" id="add-items">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">{{ __('movement.add_items') }}</h3>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">
                                        {{ __('stock.item_name') }}
                                        (<a href="{{ route('admin.items.create') }}" class="text underline">{{ __('msgs.add_new') }}</a>)
                                    </label>
                                    <select class="form-select" wire:model.debounce.350='orderProduct.item_id' id="select-tags-advanced">
                                        <option value="">{{ __('btns.select') }}</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if ($wholesale_unit)
                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('stock.unit')" />
                                        <select class="form-select" wire:model.debounce.350='orderProduct.unit_id' id="select-tags-advanced">
                                            <option value="">{{ __('btns.select') }}</option>
                                            <option value="{{ $wholesale_unit->id }}">{{ $wholesale_unit->name }} ({{ __('stock.wholesale_unit') }})</option>
                                            @if (!is_null($retail_unit))
                                                <option value="{{ $wholesale_unit->id }}">{{ $wholesale_unit->name }} ({{ __('stock.retail_unit') }})</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.unit_price')" />
                                    <x-text-input type="number" class="form-control" wire:model.debounce.350='orderProduct.unit_price' wire:keyup='calcPrice' />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.qty')" />
                                    <x-text-input type="number" class="form-control" wire:model.debounce.350='orderProduct.qty' wire:keyup='calcPrice' />
                                </div>
                            </div>
                            @if ($consuming)
                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('movement.production_date')" />
                                        <x-text-input type="date" class="form-control" wire:model.debounce.350='orderProduct.production_date' :value="date('Y-m-d')" />
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('movement.expiration_date')" />
                                        <x-text-input type="date" class="form-control" wire:model.debounce.350='orderProduct.expiration_date' :value="date('Y-m-d')" />
                                    </div>
                                </div>
                            @endif
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.total_price')" />
                                    <x-text-input type="number" class="form-control" wire:model.debounce.350='orderProduct.total_price' readonly disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">{{ __('btns.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="col-md-12 col-lg-8" id="add-items">
            <div class="card mb-3">
                <div class="card-header text-info">
                    <h3 class="card-title">{{ __('movement.order_is_closed') }}</h3>
                </div>
            </div>
        </div>
    @endif

    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header w-100 d-flex align-items-center justify-content-between">
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
                        @forelse ($order_products as $orderProduct)
                            <tr>
                                <td>{{ $orderProduct->id }}</td>
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
                                <td class="bg-blue-500">
                                    {{ $orderProduct->total_price }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    <x-blank-section :content="__('stock.item')" :url="'#add-items'" />
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
