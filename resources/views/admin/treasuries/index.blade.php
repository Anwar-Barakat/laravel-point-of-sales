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
                                <button class="table-sort" data-sort="sort-type"> {{ __('treasury.last_payment_receipt') }}</button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-score"> {{ __('treasury.last_payment_receipt') }}</button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-quantity"> {{ __('treasury.is_active') }}</button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-quantity"> {{ __('msgs.created_at') }}</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @forelse ($treasuries as $treasury)
                            <tr>
                                <td class="sort-name">{{ $loop->iteration }}</td>
                                <td class="sort-city">{{ $treasury->name }}</td>
                                <td class="sort-type">{{ $treasury->is_master }}</td>
                                <td class="sort-score">{{ $treasury->last_payment_receipt }}</td>
                                <td class="sort-date"> {{ $treasury->last_payment_collect }}</td>
                                <td class="sort-quantity"> {{ $treasury->is_active }}</td>
                                <td class="sort-progress"> {{ $treasury->created_at }} </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-master-layout>
