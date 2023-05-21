<div>
    <div class="card">
        <div class="row">
            <div class="col-12 d-flex flex-column">
                @if (has_open_shift())
                    <form wire:submit.prevent='submit' id="add-collect-transaction">
                        <div class="card-body">
                            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                            <div class="row row-cards">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('account.transaction_date')" />
                                        <x-text-input type="date" class="form-control" wire:model='transaction.transaction_date' />
                                        <x-input-error :messages="$errors->get('transaction.transaction_date')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('treasury.treasury')" />
                                        <x-text-input type="text" class="form-control" :value="has_open_shift()->treasury->name" readonly disabled />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('account.treasury_available_balance')" />
                                        <x-text-input type="number" placeholder="10.15" class="form-control" :value="$treasuryBalance" readonly disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cards">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('account.account')" />
                                        <select class="form-select" wire:model='transaction.account_id' id="select-tags-advanced">
                                            <option value="">{{ __('btns.select') }}</option>
                                            @foreach ($accounts as $account)
                                                <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->accountType->name }})</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('transaction.account_id')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('account.shift_type')" />
                                        <select class="form-select" wire:model='transaction.shift_type_id' id="select-tags-advanced">
                                            <option value="">{{ __('btns.select') }}</option>
                                            @foreach ($shiftTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('transaction.shift_type_id')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('account.amount_collected')" />
                                        <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='transaction.money' />
                                        <x-input-error :messages="$errors->get('transaction.money')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cards">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('dash.report')" />
                                        <textarea rows="3" class="form-control" wire:model='transaction.report' placeholder="{{ __('account.counterpart_collection') }}"></textarea>
                                        <x-input-error :messages="$errors->get('transaction.report')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            @if ($financial_account)
                                @php
                                    if ($financial_account->current_balance < 0):
                                        $alert = 'danger';
                                    elseif ($financial_account->current_balance > 0):
                                        $alert = 'success';
                                    else:
                                        $alert = 'secondary';
                                    endif;
                                @endphp
                                <div class="row row-cards">
                                    <div class="alert alert-{{ $alert }}" role="alert">
                                        <h4 class="alert-heading">
                                            {{ __('account.account') . ' : ' . $financial_account->name }}
                                        </h4>
                                        <p>
                                            {{ $financial_account->current_balance > 0 ? '(' . __('account.debit') . ')' : '' }}
                                            {{ $financial_account->current_balance < 0 ? '(' . __('account.credit') . ')' : '' }}
                                            {{ $financial_account->current_balance == 0 ? '(' . __('account.balanced') . ')' : '' }}
                                            ,{{ __('account.amount') . ' : ' }}
                                            {{ abs($financial_account->current_balance) }}
                                        </p>
                                    </div>
                                </div>
                            @endif
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
                @else
                    <div class="card-body">
                        <div class="alert alert-azure">
                            {{ __('account.dont_have_open_shift') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header w-100 d-flex align-items-center justify-content-between">
                    <h3 class="card-title">{{ __('account.collect_transactions') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row row-cards">
                        <div class="col-12 col-md-4 col-lg-2">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('msgs.order_by')" />
                                <select class="form-select" wire:model='order_by'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="created_at">{{ __('msgs.created_at') }}</option>
                                    <option value="transaction_date">{{ __('account.transaction_date') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-2">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('account.shift_type')" />
                                <select class="form-select" wire:model='shift_type_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach ($shiftTypes as $shift_type)
                                        <option value="{{ $shift_type->id }}">{{ $shift_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-2">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('treasury.treasury')" />
                                <select class="form-select" wire:model='treasury_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach (App\Models\Treasury::get() as $delegate)
                                        <option value="{{ $delegate->id }}">{{ $delegate->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-2">
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
                                <x-input-label class="form-label" :value="__('transaction.transactions_from_date')" />
                                <input type="date" class="form-control" wire:model='tranasctions_from_date'>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('transaction.transactions_to_date')" />
                                <input type="date" class="form-control" wire:model='tranasctions_to_date'>
                            </div>
                        </div>
                    </div>
                    <br>
                    <table class="table card-table table-vcenter table-striped-columns">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('setting.admin') }}</th>
                                <th>{{ __('treasury.treasury') }}</th>
                                <th>{{ __('account.shift_type') }}</th>
                                <th>{{ __('account.amount_collected') }}</th>
                                <th>{{ __('account.account') }}</th>
                                <th>{{ __('dash.report') }}</th>
                                <th>{{ __('msgs.created_at') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td><span class="badge bg-blue-lt">{{ $transaction->admin->name }}</span></td>
                                    <td><span class="badge bg-blue"> {{ $transaction->treasury->name }}</span></td>
                                    <td><span class="badge bg-green"> {{ $transaction->shift_type->name }}</span></td>
                                    <td>{{ $transaction->money }}</td>
                                    <td>
                                        <span class="badge bg-info-lt">
                                            {{ $transaction->account->name ?? '-' }}
                                            ({{ $transaction->account->number ?? '' }})
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm" data-bs-placement="top" data-bs-toggle="popover" title="{{ __('account.report') }}" data-bs-content="{{ $transaction->report }}">{{ __('account.click_here') }}</button>
                                    </td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <th>
                                        <div class="btn-list flex-nowrap flex justify-content-center">
                                            <a wire:click.prevent="edit({{ $transaction->id }})" href="#add-collect-transaction" class="btn d-flex justify-content-center align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">
                                        <x-blank-section :content="__('account.collect_transaction')" :url="'#add-collect-transaction'" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-3 mt-2">
                        {{ $transactions->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
