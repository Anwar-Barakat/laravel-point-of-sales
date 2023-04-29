<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">{{ __('msgs.all', ['name' => __('movement.sales_invoices')]) }}</h3>
        <a href="{{ route('admin.sales.create') }}" class="btn btn-primary">
            {{ __('msgs.create', ['name' => __('movement.sale_invoice')]) }}
        </a>
    </div>


    <div class="card-body">
        <div id="table-default" class="table-responsive">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.order_by')" />
                        <select class="form-select" wire:model='order_by'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="created_at">{{ __('msgs.created_at') }}</option>
                            <option value="invoice_date">{{ __('movement.invoice_date') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.customer')" />
                        <select class="form-select" wire:model='customer_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach (App\Models\Customer::get() as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.vendor')" />
                        <select class="form-select" wire:model='customer_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach (App\Models\Delegate::get() as $delegate)
                                <option value="{{ $delegate->id }}">{{ $delegate->name }}</option>
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
                            <option value="15">10</option>
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
                        <th> {{ __('stock.customer_name') }}</th>
                        <th> {{ __('movement.delegate_name') }}</th>
                        <th> {{ __('account.account_number') }}</th>
                        <th>{{ __('movement.invoice_type') }}</th>
                        <th>{{ __('movement.invoice_date') }}</th>
                        <th>{{ __('movement.total_price') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    @forelse ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>
                                <a href="{{ route('admin.customers.show', ['customer' => $sale->customer]) }}">
                                    <span class="badge bg-blue">
                                        {{ $sale->customer->name }}
                                    </span>
                                </a>
                            </td>
                            <td>
                                <a href="">
                                    <span class="badge bg-blue-lt">
                                        {{ $sale->delegate->name }}
                                    </span>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.accounts.show', ['account' => $sale->account]) }}">
                                    <span class="badge bg-green-lt">
                                        {{ $sale->account->number }}
                                    </span>
                                </a>
                            </td>
                            <td>
                                {{ $sale->invoice_type ? __('movement.delayed') : __('movement.cash') }}
                            </td>
                            <td>
                                {{ $sale->invoice_date }}
                            </td>
                            <td>
                                <span class="text-green-600">{{ $sale->cost_after_discount }}</span>
                            </td>
                            <td>
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @if ($sale->is_approved == 0)
                                            <a href="{{ route('admin.sales.edit', ['sale' => $sale]) }}" class="dropdown-item d-flex align-items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                                <span>{{ __('btns.edit') }}</span>
                                            </a>
                                        @endif

                                        <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.sales.show', ['sale' => $sale]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text text-primary∂" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                            </svg>
                                            <span>{{ __('movement.add_items') }}</span>
                                        </a>

                                        <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $sale->id }}">
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
                                    </div>
                                </span>
                                <x-modal-delete :id="$sale->id" :action="route('admin.sales.destroy', ['sale' => $sale])" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <x-blank-section :content="__('movement.sale_invoice')" :url="route('admin.sales.create')" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-3 mt-2">
                {{ $sales->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
