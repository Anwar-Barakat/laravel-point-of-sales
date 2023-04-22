<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">{{ __('msgs.all', ['name' => __('movement.treasuries_shifts')]) }}</h3>
        @if (!$admin_has_opened_shift)
            <a href="{{ route('admin.shifts.create') }}" class="btn btn-primary">
                {{ __('msgs.create', ['name' => __('movement.treasury_shifts')]) }}
            </a>
        @endif
    </div>


    <div class="card-body">
        <div id="table-default" class="table-responsive">
            <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> {{ __('treasury.treasury_name') }}</th>
                        <th> {{ __('setting.admin') }}</th>
                        <th> {{ __('movement.date_opened') }}</th>
                        <th> {{ __('movement.date_closed') }}</th>
                        <th> {{ __('partials.status') }}</th>
                        <th>{{ __('movement.review_status') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    @forelse ($shifts as $shift)
                        <tr>
                            <td>{{ $shift->id }}
                                @if (
                                    $shift->admin_id ==
                                        auth()->guard('admin')->id())
                                    <div class="text-info">{{ __('movement.my_shift') }}</div>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-blue">
                                    {{ $shift->treasury->name }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-blue-lt">
                                    {{ $shift->admin->name }}
                                </span>
                            </td>
                            <td>{{ $shift->date_opened ?? '000-00-00' }}</td>
                            <td>{{ $shift->date_closed ?? '000-00-00' }}</td>
                            <td>
                                <span class="color-{{ $shift->is_finished ? 'green' : 'rose' }}-500 color-green-500">
                                    {{ $shift->is_finished ? __('movement.finished') : __('movement.not_finished') }}
                                </span>
                            </td>
                            <td>
                                @if ($shift->is_reviewed)
                                    <span class="color-green-500">{{ __('movement.is_reviewed') }}</span>
                                @else
                                    {{ $shift->is_finished ? __('movement.waiting_for_review') : __('movement.opened_shift') }}
                                @endif
                                </span>
                            </td>
                            <td>
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ route('admin.shifts.edit', ['shift' => $shift]) }}" class="dropdown-item d-flex align-items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                            <span>{{ __('btns.edit') }}</span>
                                        </a>

                                        <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.shifts.show', ['shift' => $shift]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text text-primary∂" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                            </svg>
                                            <span>{{ __('movement.add_items') }}</span>
                                        </a>

                                        <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $shift->id }}">
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
                                <x-modal-delete :id="$shift->id" :action="route('admin.shifts.destroy', ['shift' => $shift])" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <x-blank-section :content="__('movement.treasury_shifts')" :url="route('admin.shifts.create')" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-3 mt-2">
                {{ $shifts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
