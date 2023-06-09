<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">{{ __('msgs.all', ['name' => __('stock.units')]) }}</h3>
        <a href="{{ route('admin.units.create') }}" class="btn btn-primary">
            {{ __('msgs.create', ['name' => __('stock.unit')]) }}
        </a>
    </div>

    <div class="card-body">
        <div id="table-default" class="table-responsive">
            <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> {{ __('stock.unit') }}</th>
                        <th> {{ __('setting.status') }}</th>
                        <th> {{ __('msgs.is_active') }}</th>
                        <th> {{ __('msgs.created_at') }}</th>
                        <th> {{ __('msgs.added_by') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    @forelse ($units as $unit)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $unit->name }}</td>
                            <td>
                                <span class="badge bg-{{ $unit->status == 'retail' ? 'blue' : 'green' }}">{{ __('stock.' . $unit->status) }}</span>
                            </td>
                            <td>
                                <div>
                                    <button wire:click='updateStatus({{ $unit->id }})' class="btn position-relative">
                                        {{ $unit->is_active ? __('msgs.active') : __('msgs.not_active') }}
                                        <span class="badge {{ $unit->is_active ? 'bg-green' : 'bg-red' }} badge-notification badge-blink"></span>
                                    </button>
                                </div>
                            </td>
                            <td> {{ $unit->created_at }} </td>
                            <td> <span class="badge bg-blue-lt">{{ $unit->addedBy->name }}</span></td>
                            <td>
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @php
                                            $unit_orders = App\Models\OrderProduct::where('unit_id', $unit->id)->count();
                                            $unit_sales = App\Models\SaleProduct::where('unit_id', $unit->id)->count();
                                        @endphp

                                        @if ($unit_orders > 0 || $unit_sales > 0)
                                            <a href="javascript:;" class="dropdown-item d-flex align-items-center gap-1 pointer-events-none text-decoration-line-through">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                    <path d="M10.507 10.498l-1.507 1.502v3h3l1.493 -1.498m2 -2.01l4.89 -4.907a2.1 2.1 0 0 0 -2.97 -2.97l-4.913 4.896"></path>
                                                    <path d="M16 5l3 3"></path>
                                                    <path d="M3 3l18 18"></path>
                                                </svg>
                                                <span>{{ __('btns.edit') }}</span>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.units.edit', ['unit' => $unit]) }}" class="dropdown-item d-flex align-items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                                <span>{{ __('btns.edit') }}</span>
                                            </a>
                                        @endif
                                        <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $unit->id }}">
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
                                <x-modal-delete :id="$unit->id" :action="route('admin.units.destroy', ['unit' => $unit])" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <x-blank-section :content="__('stock.unit')" :url="route('admin.categories.create')" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-3 mt-2">
                {{ $units->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div class="card-footer">
    </div>
</div>
