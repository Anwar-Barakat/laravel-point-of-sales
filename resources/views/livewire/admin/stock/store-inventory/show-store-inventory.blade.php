<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">{{ __('msgs.all', ['name' => __('stock.stores_inventories')]) }}</h3>
        <a href="{{ route('admin.stores-inventories.create') }}"class="btn btn-primary">
            {{ __('msgs.create', ['name' => __('stock.store_inventory')]) }}
        </a>
    </div>

    <div class="card-body">
        <div id="table-default" class="table-responsive">
            <div class="row row-cards">
                <div class="col-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.order_by')" />
                        <select class="form-select" wire:model='order_by'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="created_at">{{ __('msgs.created_at') }}</option>
                            <option value="inventory_date">{{ __('stock.inventory_date') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.store')" />
                        <select class="form-select" wire:model='store_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.store')" />
                        <select class="form-select" wire:model='inventory_type'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach (App\models\StoreInventory::INVENTORYTYPE as $key => $value)
                                <option value="{{ $key }}">{{ __('stock.' . $value) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-2">
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
                <div class="col-12 col-md-4 col-lg-2">
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
            <div class="row row-cards">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.inventory_from_date')" />
                        <input type="date" class="form-control" wire:model='inventory_from_date'>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.inventory_to_date')" />
                        <input type="date" class="form-control" wire:model='inventory_to_date'>
                    </div>
                </div>
            </div>
            <br>
            <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('transaction.invoice_date') }}</th>
                        <th> {{ __('stock.store') }}</th>
                        <th> {{ __('stock.inventory_type') }}</th>
                        <th> {{ __('msgs.added_by') }}</th>
                        <th>{{ __('setting.status') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    @forelse ($inventories as $inventory)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $inventory->inventory_date }}</td>
                            <td>
                                <span class="badge bg-blue-lt">{{ $inventory->store->name }}</span>
                            </td>
                            <td>
                                <span class="badge badge-outline text-pink">
                                    {{ __('stock.' . App\Models\StoreInventory::INVENTORYTYPE[$inventory->inventory_type]) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-purple-lt">
                                    {{ $inventory->addedBy->name }}
                                </span>
                            </td>
                            <td>
                                <div>
                                    <button class="btn position-relative pointer-events-none">
                                        {{ $inventory->is_closed ? __('stock.closed') : __('stock.opened') }}
                                        <span class="badge {{ $inventory->is_closed ? 'bg-red' : 'bg-green' }} badge-notification badge-blink"></span>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                    <div class="dropdown-menu dropdown-menu-end">

                                        @if ($inventory->is_closed == 0)
                                            <a href="{{ route('admin.stores-inventories.edit', ['stores_inventory' => $inventory]) }}" class="dropdown-item d-flex align-items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                                <span>{{ __('btns.edit') }}</span>
                                            </a>

                                            <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.stores-inventories.show', ['stores_inventory' => $inventory]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text text-primary∂" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M5 12l14 0" />
                                                </svg>
                                                <span>{{ __('transaction.add_items') }}</span>
                                            </a>

                                            <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $inventory->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon m-0 text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                                <span>{{ __('btns.delete') }}</span>
                                            </a>
                                        @else
                                            <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.stores-inventories.show', ['stores_inventory' => $inventory]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                                </svg>
                                                <span>{{ __('btns.details') }}</span>
                                            </a>
                                            <a href="javascript:;" class="dropdown-item d-flex align-items-center gap-1 cursor-not-allowed">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M3 3l18 18" />
                                                    <path d="M4 7h3m4 0h9" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 14l0 3" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l.077 -.923" />
                                                    <path d="M18.384 14.373l.616 -7.373" />
                                                    <path d="M9 5v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                                <span>{{ __('btns.delete') }}</span>
                                            </a>
                                        @endif
                                    </div>
                                </span>
                                <x-modal-delete :id="$inventory->id" :action="route('admin.stores-inventories.destroy', ['stores_inventory' => $inventory])" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <x-blank-section :content="__('transaction.service')" :url="route('admin.services.create')" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-3 mt-2">
                {{ $inventories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div class="card-footer">
    </div>
</div>
