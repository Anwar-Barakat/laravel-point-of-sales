<div>
    <div class="row">
        <div class="col-6 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('msgs.main_info') }}</h3>
                </div>
                <div>
                    <table class="table card-table table-vcenter table-striped-columns">
                        <thead>
                            <tr>
                                <th>{{ __('msgs.column') }}</th>
                                <th colspan="2">{{ __('btns.details') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>{{ __('stock.item_name') }}</th>
                                <td>{{ $item->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('msgs.photo') }}</th>
                                <th>
                                    @if ($item->getFirstMediaUrl('items', 'thumb'))
                                        <img src="{{ $item->getFirstMediaUrl('items') }}" class="img img-thumbnail" alt="{{ $item->name }}" width="80">
                                    @else
                                        <img src="{{ asset('backend/static/default-show-product.png') }}" class="img img-thumbnail" alt="{{ $item->name }}" width="80">
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th>{{ __('stock.item_type') }}</th>
                                <td>{{ __('stock.' . App\Models\Item::ITEMTYPE[$item->type]) }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('partials.status') }}</th>
                                <td>
                                    {{ $item->is_active ? __('msgs.active') : __('msgs.not_active') }}
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('stock.item_category') }}</th>
                                <td>
                                    {{ $item->category->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('stock.wholesale_qty') }}</th>
                                <td>
                                    {{ number_format($item->wholesale_qty, 0) }}
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('stock.retail_qty') }}</th>
                                <td>
                                    {{ number_format($item->retail_qty, 0) }}
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('stock.has_fixed_price') }}</th>
                                <td>{{ $item->has_fixed_price ? __('msgs.yes') : __('msgs.no') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer border-top-0"></div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header d-grid">
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <h3 class="card-title">{{ __('stock.wholesale_price') }}</h3>
                    </div>
                </div>
                <div class="card-table table-responsive">
                    <table class="table table-vcenter" wire:key='store'>
                        <thead>
                            <tr>
                                <th>{{ __('stock.wholesale_unit') }}</th>
                                <th>{{ __('stock.wholesale_price') }}</th>
                                <th>{{ __('stock.wholesale_price_for_half_block') }}</th>
                                <th>{{ __('stock.wholesale_price_for_block') }}</th>
                                <th>{{ __('stock.wholesale_cost_price') }}</th>
                            </tr>
                        </thead>
                        <tr>
                            <td><span class="badge bg-blue-lt">{{ $item->parentUnit->name }}</span></td>
                            <td>{{ $item->wholesale_price }}</td>
                            <td>{{ $item->wholesale_price_for_half_block }}</td>
                            <td>{{ $item->wholesale_price_for_block }}</td>
                            <td>{{ $item->wholesale_cost_price }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer border-top-0"></div>
            </div>
            @if ($item->childUnit)
                <div class="card mt-3">
                    <div class="card-header d-grid">
                        <div class="w-100 d-flex align-items-center justify-content-between">
                            <h3 class="card-title">{{ __('stock.retail_price') }}</h3>
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table class="table table-vcenter" wire:key='store'>
                            <thead>
                                <tr>
                                    <th>{{ __('stock.retail_unit') }}</th>
                                    <th>{{ __('stock.retail_price') }}</th>
                                    <th>{{ __('stock.retail_price_for_half_block') }}</th>
                                    <th>{{ __('stock.retail_price_for_block') }}</th>
                                    <th>{{ __('stock.retail_cost_price') }}</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><span class="badge bg-blue-lt">{{ $item->childUnit->name }}</span></td>
                                <td>{{ $item->retail_price }}</td>
                                <td>{{ $item->retail_price_for_half_block }}</td>
                                <td>{{ $item->retail_price_for_block }}</td>
                                <td>{{ $item->retail_cost_price }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer border-top-0"></div>
                </div>
            @endif
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header w-100 d-flex align-items-center justify-content-between">
                    <h3 class="card-title">{{ __('stock.transactions_on_item') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row row-cards">
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('transaction.item_transaction_type')" />
                                <select class="form-select" wire:model='item_transaction_type_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach (App\Models\ItemTransactionType::get() as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-2">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('transaction.item_transaction_category')" />
                                <select class="form-select" wire:model='item_transaction_category_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach (App\Models\ItemTransactionCategory::get() as $trans)
                                        <option value="{{ $trans->id }}">{{ $trans->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-2">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('stock.store')" />
                                <select class="form-select" wire:model='store_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach (App\Models\Store::get() as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-2">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('setting.admin')" />
                                <select class="form-select" wire:model='admin_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach (App\Models\Admin::get() as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-1">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('msgs.per_page')" />
                                <select class="form-select" wire:model='per_page'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-2">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('msgs.sort_by')" />
                                <select class="form-select" wire:model='sort_by'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="asc">{{ __('msgs.asc') }}</option>
                                    <option value="desc">{{ __('msgs.desc') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <br>
                    <table class="table card-table table-vcenter table-striped-columns">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('transaction.item_transaction_type') }}</th>
                                <th>{{ __('transaction.item_transaction_category') }}</th>
                                <th>{{ __('setting.admin') }}</th>
                                <th>{{ __('transaction.qty_before_transaction') }}</th>
                                <th>{{ __('transaction.qty_after_transaction') }}</th>
                                <th>{{ __('msgs.created_at') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $trans)
                                <tr>
                                    <td>{{ $trans->id }}</td>
                                    <td><span class="badge bg-blue">{{ $trans->transaction_type->name }}</span></td>
                                    <td><span class="badge bg-blue-lt">{{ $trans->transaction_category->name }}</span></td>
                                    <td><span class="badge bg-green">{{ $trans->admin->name }}</span></td>
                                    <td>
                                        <p>{{ __('transaction.all_stores') . ' ( ' }} {{ $trans->qty_before_transaction . ' ) ' }}</p>
                                        <p class="text-red-700">{{ $trans->store->name . ' ( ' }} {{ $trans->store_qty_before_transaction . ' ) ' }}</p>
                                    </td>
                                    <td>
                                        <p>{{ __('transaction.all_stores') . ' ( ' }} {{ $trans->qty_after_transaction . ' ) ' }}</p>
                                        <p class="text-red-700">{{ $trans->store->name . ' ( ' }} {{ $trans->store_qty_after_transaction . ' ) ' }}</p>
                                    </td>
                                    <td>{{ $trans->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">
                                        <x-blank-section :content="''" :url="'javascript:;'" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if ($transactions->count() > 0)
                        <div class="p-3 mt-2">
                            {{ $transactions->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
                <div class="card-footer border-top-0">
                </div>
            </div>
        </div>
    </div>
</div>
