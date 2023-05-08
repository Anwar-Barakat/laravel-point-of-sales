    <div class="card">
        <div class="row g-0">
            <div class="card-header">
                <h3 class="card-title">{{ __('msgs.all', ['name' => __('transaction.item_balances')]) }}</h3>
            </div>
            <div class="card-body">
                <div id="table-default" class="table-responsive">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('stock.item_name')" />
                                <select class="form-select" wire:model='item_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach (App\Models\Item::all() as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('stock.store')" />
                                <select class="form-select" wire:model='store_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach (App\Models\Store::all() as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-2">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('msgs.order_by')" />
                                <select class="form-select" wire:model='order_by'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="name">{{ __('stock.item_name') }}</option>
                                    <option value="created_at">{{ __('msgs.created_at') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-2">
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
                    <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> {{ __('msgs.photo') }}</th>
                                <th class="w-15"> {{ __('stock.item') }}</th>
                                <th> {{ __('transaction.qty') }}</th>
                                <th> {{ __('stock.item_category') }}</th>
                                <th class="w-auto">{{ __('transaction.stocks_qty') }}</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @forelse ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($item->getFirstMediaUrl('items', 'thumb'))
                                            <img src="{{ $item->getFirstMediaUrl('items') }}" class="img img-thumbnail" alt="{{ $item->name }}" width="80">
                                        @else
                                            <img src="{{ asset('backend/static/default-show-product.png') }}" class="img img-thumbnail" alt="{{ $item->name }}" width="80">
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">
                                        <p class="badge bg-red-lt d-block mb-1 width-fit-content">({{ number_format($item->wholesale_qty, 0) ?? '0' }}) {{ $item->parentUnit->name }}</p>
                                        @if ($item->childUnit)
                                            <p class="badge bg-red-lt">({{ number_format($item->retail_qty, 0) ?? '0' }}) {{ $item->childUnit->name ?? '-' }}</p>
                                        @endif
                                    </td>
                                    <td class="text-center"><span class="badge badge-outline text-blue">{{ $item->category->name }}</span></td>
                                    <td>
                                        @if ($item->item_batches)
                                            @forelse ($item->item_batches as $batch)
                                                <ol>
                                                    <li>
                                                        {{ __('transaction.batch_number') }} #{{ $batch->id }} -
                                                        {{ __('stock.store') }} : <span class="text-bold text-gray-600">{{ $batch->store->name }}</span> -
                                                        {{ __('transaction.qty') }} :
                                                        <span class="text-bold text-blue-600"> ({{ number_format($batch->qty, 0) }} {{ $batch->unit->name }})</span>
                                                        <br>
                                                        @if ($batch->production_date)
                                                            {{ __('transaction.production_date') }} : <span class="text-green-600">({{ $batch->production_date }})</span> -
                                                            {{ __('transaction.expiration_date') }} : <span class="text-red-600">({{ $batch->expiration_date }})</span>
                                                            <br>
                                                        @endif

                                                        @if ($batch->item->has_retail_unit)
                                                            {{ __('transaction.retail_unit_price') }} : <span class="text-cyan-600">({{ $batch->unit_price / $batch->item->retail_count_for_wholesale }} {{ __('transaction.for') }} {{ $batch->item->childUnit->name }})</span> -
                                                        @endif

                                                        {{ __('transaction.wholesale_unit_price') }} : <span class="text-cyan-600">({{ $batch->unit_price }} {{ __('transaction.for') }} {{ $batch->unit->name }})</span> -
                                                        {{ __('transaction.total_price') }} : <span class="text-green-600">{{ $batch->total_price }}</span>

                                                        @if ($loop->iteration > $loop->last)
                                                            <hr class="mt-2 mb-3 d-block w-75">
                                                        @endif
                                                    </li>
                                                </ol>
                                            @empty
                                                <p class="text-bold">{{ __('msgs.not_found') }}</p>
                                            @endforelse
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <x-blank-section :content="__('stock.item')" :url="route('admin.items.create')" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-3 mt-2">
                        {{ $items->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
