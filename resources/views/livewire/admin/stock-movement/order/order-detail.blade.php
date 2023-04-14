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
                        <th>{{ __('stock.vendor_name') }}</th>
                        <td>{{ $order->vendor->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('stock.vendor_name') }}</th>
                        <td>{{ $order->vendor->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('movement.discount_type') }}</th>
                        <td>{{ $order->discount_type ? __('movement.fixed') : __('movement.percentage') }}</td>
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
    <div class="col-md-12 col-lg-8">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">{{ __('movement.add_items') }}</h3>
            </div>
            <form wire:submit.prevent='submit'>
                <div class="card-body">
                    <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="mb-3">
                                <label for="" class="form-label">
                                    {{ __('stock.item_name') }}
                                    (<a href="{{ route('admin.items.create') }}" class="text underline">{{ __('msgs.add_new') }}</a>)
                                </label>
                                <select class="form-select" wire:model.debounce.350='item_id' id="select-tags-advanced">
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('order_id')" class="mt-2" />
                            </div>
                        </div>
                        @if ($wholesale_unit)
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('stock.unit')" />
                                    <select class="form-select" wire:model.debounce.350='unit_id' id="select-tags-advanced">
                                        <option value="">{{ __('btns.select') }}</option>
                                        <option value="{{ $wholesale_unit->id }}">{{ $wholesale_unit->name }} ({{ __('stock.wholesale_unit') }})</option>
                                        @if (!is_null($retail_unit))
                                            <option value="{{ $wholesale_unit->id }}">{{ $wholesale_unit->name }} ({{ __('stock.retail_unit') }})</option>
                                        @endif
                                    </select>
                                    <x-input-error :messages="$errors->get('unit_id')" class="mt-2" />
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-12 col-md-4">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('movement.unit_price')" />
                                <x-text-input type="number" class="form-control" wire:model.debounce.350='unit_price' wire:keyup='calcPrice' />
                                <x-input-error :messages="$errors->get('unit_price')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('movement.qty')" />
                                <x-text-input type="number" class="form-control" wire:model.debounce.350='qty' wire:keyup='calcPrice' />
                                <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                            </div>
                        </div>
                        @if ($consuming)
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.production_date')" />
                                    <x-text-input type="date" class="form-control" wire:model.debounce.350='production_date' />
                                    <x-input-error :messages="$errors->get('production_date')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.expiration_date')" />
                                    <x-text-input type="date" class="form-control" wire:model.debounce.350='expiration_date' />
                                    <x-input-error :messages="$errors->get('expiration_date')" class="mt-2" />
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-12 col-md-4">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('movement.total_price')" />
                                <x-text-input type="number" class="form-control" wire:model.debounce.350='total_price' readonly disabled />
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
</div>
