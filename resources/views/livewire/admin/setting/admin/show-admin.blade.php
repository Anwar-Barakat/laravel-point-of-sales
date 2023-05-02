<div class="card-body">
    <div id="table-default" class="table-responsive">
        <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th> {{ __('auth.name') }}</th>
                    <th> {{ __('auth.email') }}</th>
                    <th> {{ __('setting.status') }}</th>
                    <th> {{ __('msgs.created_at') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-tbody">
                @forelse ($admins as $admin)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $admin->name }}</td>
                        <td><span class="badge badge-info">{{ $admin->email }}</span></td>
                        <td>
                            <div>
                                <button wire:click='updateStatus({{ $admin->id }})' class="btn position-relative">
                                    {{ $admin->is_active ? __('msgs.is_active') : __('msgs.not_active') }}
                                    <span class="badge {{ $admin->is_active ? 'bg-green' : 'bg-red' }} badge-notification badge-blink"></span>
                                </button>
                            </div>
                        </td>
                        <td> {{ $admin->created_at }} </td>
                        <td>
                            <span class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.admins.edit', ['admin' => $admin]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                        <span>{{ __('btns.edit') }}</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.admins.show', ['admin' => $admin]) }}">
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
                        <td colspan="6">
                            <x-blank-section :content="__('admin.admin')" :url="route('admin.admins.create')" />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $admins->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
