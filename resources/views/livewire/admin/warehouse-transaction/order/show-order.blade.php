<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">{{ __('msgs.all', ['name' => __('transaction.purchase_bills')]) }}</h3>
        @php
            if ($order_type == 1) {
                $create = route('admin.orders.create');
                $create_name = __('transaction.purchase_bill');
            } elseif ($order_type == 3) {
                $create = route('admin.general-order-returns.create');
                $create_name = __('transaction.general_order_return');
            }
        @endphp

        <a href="{{ $create }}"class="btn btn-primary">
            {{ __('msgs.create', ['name' => $create_name]) }}
        </a>
    </div>

    <div class="card-body">
        <div id="table-default" class="table-responsive">
            <div class="row row-cards">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.order_by')" />
                        <select class="form-select" wire:model='order_by'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="created_at">{{ __('msgs.created_at') }}</option>
                            <option value="invoice_date">{{ __('transaction.invoice_date') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.vendor')" />
                        <select class="form-select" wire:model='vendor_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach (App\Models\Vendor::get() as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
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
            <div class="row row-cards">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('transaction.invoices_from_date')" />
                        <input type="date" class="form-control" wire:model='invoices_from_date'>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('transaction.invoices_to_date')" />
                        <input type="date" class="form-control" wire:model='invoices_to_date'>
                    </div>
                </div>
            </div>
            <br>
            <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> {{ __('stock.vendor_name') }}</th>
                        <th> {{ __('stock.store') }}</th>
                        <th> {{ __('account.account_number') }}</th>
                        <th>{{ __('transaction.invoice_type') }}</th>
                        <th>{{ __('transaction.invoice_date') }}</th>
                        <th>{{ __('transaction.total_price') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('admin.vendors.show', ['vendor' => $order->vendor]) }}">
                                    <span class="badge bg-blue">
                                        {{ $order->vendor->name }}
                                    </span>
                                </a>
                            </td>
                            <td>{{ $order->store->name }}</td>
                            <td>
                                <a href="{{ route('admin.accounts.show', ['account' => $order->account]) }}">
                                    <span class="badge bg-green-lt">
                                        {{ $order->account->number }}
                                    </span>
                                </a>
                            </td>

                            <td>{{ $order->invoice_type ? __('transaction.delayed') : __('transaction.cash') }} </td>
                            <td>{{ $order->invoice_date }}</td>
                            <td><span class="text-gray-600">{{ $order->cost_after_discount }}</span></td>
                            <td>
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @php
                                            if ($order_type == 1) {
                                                $edit = route('admin.orders.edit', ['order' => $order]);
                                                $delete = route('admin.orders.destroy', ['order' => $order]);
                                            } elseif ($order_type == 3) {
                                                $edit = route('admin.general-order-returns.edit', ['general_order_return' => $order]);
                                                $delete = route('admin.general-order-returns.destroy', ['general_order_return' => $order]);
                                            }
                                        @endphp

                                        @if ($order->is_approved == 0)
                                            <a href="{{ $edit }}" class="dropdown-item d-flex align-items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                                <span>{{ __('btns.edit') }}</span>
                                            </a>
                                        @endif

                                        @if ($order->is_approved == 0)
                                            <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.orders.show', ['order' => $order]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text text-primary∂" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M5 12l14 0" />
                                                </svg>
                                                <span>{{ __('transaction.add_items') }}</span>
                                            </a>
                                            <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $order->id }}">
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
                                            <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.orders.show', ['order' => $order]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                                </svg>
                                                <span>{{ __('btns.details') }}</span>
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.orders.invoice', ['order' => $order]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-info" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                    <path d="M9 7l1 0" />
                                                    <path d="M9 13l6 0" />
                                                    <path d="M13 17l2 0" />
                                                </svg>
                                                <span>{{ __('transaction.invoice') }}</span>
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center gap-1" href="">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                                    <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                                </svg>
                                                {{ __('btns.print') }}
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
                                <x-modal-delete :id="$order->id" :action="$delete" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <x-blank-section :content="__('transaction.order')" :url="route('admin.orders.create')" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-3 mt-2">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div class="card-footer">
    </div>
</div>
