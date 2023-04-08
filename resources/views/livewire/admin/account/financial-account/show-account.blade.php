<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">{{ __('msgs.all', ['name' => __('account.financial_accounts')]) }}</h3>
        <a href="{{ route('admin.financial-accounts.create') }}" class="btn btn-primary">
            {{ __('msgs.create', ['name' => __('account.financial_account')]) }}
        </a>
    </div>


    <div class="card-body">
        <div id="table-default" class="table-responsive">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.search_by_name')" />
                        <x-text-input class="form-control" placeholder="{{ __('btns.search') }}" wire:model="name" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('account.account_type')" />
                        <select id="" class="form-control" wire:model='account_type_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach (App\Models\AccountType::active()->get() as $admin)
                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.order_by')" />
                        <select id="" class="form-control" wire:model='order_by'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="name">{{ __('account.account_name') }}</option>
                            <option value="created_at">{{ __('msgs.created_at') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.per_page')" />
                        <select id="" class="form-control" wire:model='per_page'>
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
                        <select id="" class="form-control" wire:model='sort_by'>
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
                        <th> {{ __('account.account') }}</th>
                        <th> {{ __('account.account_type') }}</th>
                        <th> {{ __('account.account_number') }}</th>
                        <th> {{ __('account.is_parent_account') }}</th>
                        <th> {{ __('account.parent_account') }}</th>
                        <th>{{ __('msgs.is_active') }}</th>
                        <th>{{ __('msgs.created_at') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    @forelse ($financial_accounts as $financial_account)
                        <tr>
                            <td>{{ $financial_account->name }}</td>
                            <td>
                                <span class="badge bg-info-lt">
                                    {{ $financial_account->accountType->name }}
                                </span>
                            </td>
                            <td>{{ $financial_account->account_number }}</td>
                            <td>{{ $financial_account->is_parent ? __('msgs.yes') : __('msgs.no') }}</td>
                            <th>
                                <span class="badge bg-blue">
                                    {{ $financial_account->parentAccount->name ?? __('msgs.master') }}
                                </span>
                            </th>
                            <td>
                                <div>
                                    <button wire:click='updateStatus({{ $financial_account->id }})' class="btn position-relative">
                                        {{ $financial_account->is_archived ? __('account.not_archived') : __('account.is_archived') }}
                                        <span class="badge {{ $financial_account->is_archived ? 'bg-green' : 'bg-red' }} badge-notification badge-blink"></span>
                                    </button>
                                </div>
                            </td>
                            <td> {{ $financial_account->created_at }} </td>
                            <td>
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ route('admin.financial-accounts.edit', ['financial_account' => $financial_account]) }}" class="dropdown-item d-flex align-items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                            <span>{{ __('btns.edit') }}</span>
                                        </a>

                                        <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $financial_account->id }}">

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
                                <x-modal-delete :id="$financial_account->id" :action="route('admin.financial-accounts.destroy', ['financial_account' => $financial_account])" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <x-blank-section :content="__('account.financial_account')" :url="route('admin.financial-accounts.create')" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $financial_accounts->links() }}
            </div>
        </div>
    </div>
</div>
