<div>
    <div class="row">
        <div class="col-12 col-lg-4 mb-3">
            <div class="card">
                <div class="card-header flex justify-content-between items-center">
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
                            <th>{{ __('stock.inventory_number') }}</th>
                            <td>{{ $inventory->id }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('stock.inventory_date') }}</th>
                            <td>{{ $inventory->inventory_date }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('stock.inventory_type') }}</th>
                            <td>
                                <span class="badge badge-outline text-purple">
                                    {{ __('stock.' . App\Models\StoreInventory::INVENTORYTYPE[$inventory->inventory_type]) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('stock.store') }}</th>
                            <td>{{ $inventory->store->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('stock.total_batches') }}</th>
                            <td>{{ $inventoryItems->sum('total_price') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('msgs.created_at') }}</th>
                            <td>{{ $inventory->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer border-top-0"></div>
            </div>
        </div>
        @if ($inventory->is_closed == 0)
            <div class="col-12 col-lg-8 mb-3" id="add-items">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('stock.add_items_to_inventory') }}</h3>
                    </div>
                    <form wire:submit.prevent='submit'>
                        <div class="card-body">
                            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                            <div class="row row-cards">
                                <div class="row row-cards">
                                    @include('livewire.admin.inc.batches', ['batches' => $batches])
                                    @if ($batch)
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <x-input-label class="form-label" :value="__('stock.batch_qty')" />
                                                <x-text-input type="number" class="form-control" wire:model="product.old_qty" readonly disabled />
                                                <x-input-error :messages="$errors->get('product.old_qty')" class="mt-2" />
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row row-cards">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('stock.new_qty')" />
                                        <x-text-input type="number" class="form-control" wire:model.defer="product.new_qty" placeholder="13" />
                                        <x-input-error :messages="$errors->get('product.new_qty')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cards">
                                <div class="col-12 col-12">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('stock.the_reason_for_the_increase_or_decrease')" />
                                        <textarea rows="3" class="form-control" wire:model.defer='product.notes' placeholder="{{ __('msgs.at_least_ten_ch') }}"></textarea>
                                        <x-input-error :messages="$errors->get('product.notes')" class="mt-2" />
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
                <div class="card-header w-100 d-flex align-items-center justify-content-between">
                    <h3 class="card-title">{{ __('stock.items_added_to_the', ['name' => __('stock.store_inventory')]) }}</h3>
                </div>
                <div>
                    <table class="table card-table table-vcenter table-striped-columns">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('validation.attributes.item_batch_id') }}</th>
                                <th>{{ __('stock.item') }}</th>
                                <th>{{ __('stock.qty_in_batch') }}</th>
                                <th>{{ __('stock.new_qty') }}</th>
                                <th>{{ __('stock.subtract') }}</th>
                                <th>{{ __('stock.unit_price') }}</th>
                                <th>{{ __('stock.cost_price') }}</th>
                                <th>{{ __('msgs.notes') }}</th>
                                @if ($inventory->is_closed == 0)
                                    <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($inventoryItems as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->item_batch->id }}</td>
                                    <td><span class="badge bg-blue">{{ $item->item->name }}</span></td>
                                    <td>{{ $item->old_qty }}</td>
                                    <td>{{ $item->new_qty }}</td>
                                    <td>{{ $item->subtract }}</td>
                                    <td>{{ $item->unit_price }}</td>
                                    <td>{{ $item->total_price }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm" data-bs-placement="top" data-bs-toggle="popover" title="{{ __('msgs.notes') }}" data-bs-content="{{ $item->notes }}">{{ __('account.click_here') }}</button>
                                    </td>
                                    @if ($inventory->is_closed == 0)
                                        <td>
                                            <div class="btn-list flex-nowrap justify-content-center">
                                                <a wire:click.prevent="edit({{ $item }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center" title="{{ __('btns.edit') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                </a>
                                                <a wire:click.prevent="edit({{ $item }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center" title="{{ __('stock.approving_and_reply') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-info" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 3a7 7 0 0 1 7 7v4l-3 -3" />
                                                        <path d="M22 11l-3 3" />
                                                        <path d="M8 15.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                        <path d="M3 12.5v5.5l5 3" />
                                                        <path d="M8 15.545l5 -3.03" />
                                                    </svg>
                                                </a>
                                                <a wire:click.prevent="delete({{ $item }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center" title="{{ __('btns.delete') }}">
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
                    @if ($inventoryItems->count() > 0)
                        <div class="p-3 mt-2">
                            {{ $inventoryItems->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
                <div class="card-footer border-top-0">
                </div>
            </div>
        </div>
    </div>
</div>
