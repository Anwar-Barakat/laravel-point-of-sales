<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">{{ __('msgs.all', ['name' => __('stock.vendors')]) }}</h3>
        <a href="{{ route('admin.vendors.create') }}" class="btn btn-primary">
            {{ __('msgs.create', ['name' => __('stock.vendor')]) }}
        </a>
    </div>


    <div class="card-body">
        <div id="table-default" class="table-responsive">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.search_by_name')" />
                        <x-text-input class="form-control" placeholder="{{ __('btns.search') }}" wire:model="name" />
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('account.account_status')" />
                        <select class="form-select" wire:model='account_status'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('account.balanced') }}</option>
                            <option value="2">{{ __('account.credit') }}</option>
                            <option value="3">{{ __('account.debit') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.order_by')" />
                        <select class="form-select" wire:model='order_by'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="name">{{ __('stock.vendor_name') }}</option>
                            <option value="created_at">{{ __('msgs.created_at') }}</option>
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
            @if ($total_balances)
                @php
                    $alert = $total_balances < 0 ? 'danger' : 'success';
                @endphp
                <div class="alert alert-danger mt-2" role="alert">
                    <h4 class="alert-heading">
                        {{ $total_balances < 0 ? __('account.total_accounts_payable') : '' }}
                        {{ $total_balances > 0 ? __('account.total_accounts_receivable') : '' }}
                    </h4>
                    <p>
                        {{ __('account.amount') . ' : ' }}
                        {{ abs($total_balances) }}
                    </p>
                </div>
            @endif
            <br>
            <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th> {{ __('stock.vendor_name') }}</th>
                        <th> {{ __('account.account_number') }}</th>
                        <th>{{ __('stock.category') }}</th>
                        <th>{{ __('account.current_balamce') }}</th>
                        <th>{{ __('partials.status') }}</th>
                        <th>{{ __('msgs.created_at') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    @forelse ($vendors as $vendor)
                        <tr>
                            <td>{{ $vendor->name }}</td>
                            <td>
                                <a href="{{ route('admin.accounts.show', 'test') }}">
                                    <span class="badge bg-info-lt">
                                        {{ $vendor->account->number }}
                                    </span>
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-green">
                                    {{ $vendor->category->name }}
                                </span>
                            </td>
                            <td App::getLocale()=='ar' ? style="direction: ltr" : '' class="text-center">
                                @include('layouts.balance-status', ['account' => $vendor->account])
                            </td>
                            <td>
                                <div>
                                    <button wire:click='updateStatus({{ $vendor->id }})' class="btn position-relative">
                                        {{ $vendor->is_active ? __('msgs.is_active') : __('msgs.not_active') }}
                                        <span class="badge {{ $vendor->is_active ? 'bg-green' : 'bg-red' }} badge-notification badge-blink"></span>
                                    </button>
                                </div>
                            </td>
                            <td> {{ $vendor->created_at }} </td>
                            <td>
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ route('admin.vendors.edit', ['vendor' => $vendor]) }}" class="dropdown-item d-flex align-items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                            <span>{{ __('btns.edit') }}</span>
                                        </a>

                                        <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $vendor->id }}">
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
                                <x-modal-delete :id="$vendor->id" :action="route('admin.vendors.destroy', ['vendor' => $vendor])" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <x-blank-section :content="__('stock.vendor')" :url="route('admin.vendors.create')" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-3 mt-2">
                {{ $vendors->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div class="card-footer">
    </div>
</div>
