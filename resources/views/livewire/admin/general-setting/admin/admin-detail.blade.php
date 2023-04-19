<div>
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
                            <th>{{ __('auth.name') }}</th>
                            <td>{{ $admin->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('auth.email') }}</th>
                            <td>{{ $admin->email }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('partials.status') }}</th>
                            <td>
                                <div class="text-{{ $admin->is_active ? 'success' : 'danger' }}">
                                    {{ $admin->is_active ? __('msgs.active') : __('msgs.not_active') }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 col-lg-8" id="add-items">
            @livewire('admin.general-setting.treasury.add-edit-treasury', ['admin' => $admin])
        </div>
    </div>


    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header w-100 d-flex align-items-center justify-content-between">
                    <h3 class="card-title">{{ __('stock.items') }}</h3>
                </div>
                <div class="card-body">
                    <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> {{ __('treasury.treasury') }}</th>
                                <th> {{ __('msgs.is_master') }}</th>
                                <th> {{ __('setting.status') }}</th>
                                <th> {{ __('treasury.last_payment_collect') }}</th>
                                <th> {{ __('treasury.last_payment_exchange') }}</th>
                                <th> {{ __('msgs.created_at') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @forelse ($treasuries as $treasury)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $treasury->name }}</td>
                                    <td>
                                        @if ($treasury->is_master)
                                            <span class="badge badge-outline text-green">{{ __('msgs.master') }}</span>
                                        @else
                                            <span class="badge badge-outline text-purple">{{ __('msgs.branch') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <button wire:click='updateStatus({{ $treasury->id }})' class="btn position-relative">
                                                {{ $treasury->is_active ? __('msgs.active') : __('msgs.not_active') }}
                                                <span class="badge {{ $treasury->is_active ? 'bg-green' : 'bg-red' }} badge-notification badge-blink"></span>
                                            </button>
                                        </div>
                                    </td>
                                    <td> {{ $treasury->last_payment_collect }}</td>
                                    <td>{{ $treasury->last_payment_exchange }}</td>
                                    <td> {{ $treasury->created_at }} </td>
                                    <td>
                                        <span class="dropdown">
                                            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.treasuries.edit', ['treasury' => $treasury]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                    <span>{{ __('btns.edit') }}</span>
                                                </a>
                                                <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.treasuries.show', ['treasury' => $treasury]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text text-info" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M13 5h8" />
                                                        <path d="M13 9h5" />
                                                        <path d="M13 15h8" />
                                                        <path d="M13 19h5" />
                                                        <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                                        <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                                    </svg>
                                                    <span>{{ __('btns.details') }}</span>
                                                </a>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <x-blank-section :content="__('treasury.treasury')" :url="route('admin.treasuries.create')" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $treasuries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
