<div>
    <div class="row">
        <div class="col-12 col-lg-4 mb-3">
            <div class="card">
                <div class="card-header flex justify-content-between items-center">
                    <h3 class="card-title">{{ __('msgs.main_info') }}</h3>
                    @if ($order->is_approved == 0 && $order->orderProducts->count() > 0)
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approval-modal">{{ __('btns.approval') }}</button>
                    @endif
                    @livewire('admin.warehouse-transaction.order.order-approval', ['invoice' => $order])
                </div>
                @include('livewire.admin.warehouse-transaction.order.inc.main-detail', ['order' => $order])
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
                                            @forelse ($products as $product)
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
                            </div>
                            <div class="row row-cards">
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
                @include('livewire.admin.warehouse-transaction.order.inc.display-items', ['order_products' => $order_products])
                <div class="card-footer border-top-0">
                </div>
            </div>
        </div>
    </div>
</div>
