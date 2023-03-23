<x-master-layout>
    @section('pageTitle', __('treasury.treasuries'))
    @section('breadcrumbTitle', __('treasury.treasuries'))

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('msgs.all', ['name' => __('treasury.treasuries')]) }}</h3>
            <a href="{{ route('admin.treasuries.create') }}" class="btn btn-primary">{{ __('msgs.create', ['name' => __('treasury.treasury')]) }}</a>
        </div>
        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table class="table table-vcenter table-mobile-md card-table">
                    <thead>
                        <tr>
                            <th>
                                <button class="table-sort" data-sort="sort-name">#</button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-name"> {{ __('treasury.treasury') }}</button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-city"> {{ __('treasury.is_master') }}</button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-quantity"> {{ __('treasury.is_active') }}</button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-type"> {{ __('treasury.last_payment_receipt') }}</button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-score"> {{ __('treasury.last_payment_receipt') }}</button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-quantity"> {{ __('msgs.created_at') }}</button>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @forelse ($treasuries as $treasury)
                            <tr>
                                <td class="sort-name">{{ $loop->iteration }}</td>
                                <td class="sort-city">{{ $treasury->name }}</td>
                                <td class="sort-quantity">
                                    @if ($treasury->is_master)
                                        <span class="badge badge-outline text-green">{{ __('treasury.master') }}</span>
                                    @else
                                        <span class="badge badge-outline text-blue">{{ __('treasury.branch') }}</span>
                                    @endif

                                </td>
                                <td class="sort-type">
                                    @if ($treasury->is_active)
                                        <button class="btn position-relative">{{ __('treasury.active') }}
                                            <span class="badge bg-green badge-notification badge-blink"></span>
                                        </button>
                                    @else
                                        <button class="btn position-relative">{{ __('treasury.not_active') }}
                                            <span class="badge bg-red badge-notification badge-blink"></span>
                                        </button>
                                    @endif
                                </td>
                                <td class="sort-score">{{ $treasury->last_payment_receipt }}</td>
                                <td class="sort-date"> {{ $treasury->last_payment_collect }}</td>
                                <td class="sort-progress"> {{ $treasury->created_at }} </td>
                                <td>
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{ route('admin.treasuries.edit', $treasury) }}">
                                                <span class="text text-success"><i class="fas fa-times"></i></span>
                                                {{ __('btns.edit') }}
                                            </a>
                                        </div>
                                    </span>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $treasuries->links() }}
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
