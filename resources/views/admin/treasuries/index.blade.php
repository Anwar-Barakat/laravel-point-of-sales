<x-master-layout>
    @section('pageTitle', __('treasury.treasuries'))
    @section('breadcrumbTitle', __('treasury.treasuries'))

    <div class="card">
        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <button class="table-sort" data-sort="sort-name">
                                    #
                                </button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-name">
                                    {{ __('treasury.treasury') }}
                                </button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-city">
                                    {{ __('treasury.is_master') }}
                                </button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-type">
                                    {{ __('treasury.is_active') }}
                                </button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-score">
                                    {{ __('treasury.last_payment_receipt') }}
                                </button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-date">
                                    {{ __('treasury.last_payment_collect') }}
                                </button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-quantity">
                                    {{ __('msgs.updated_at') }}
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @forelse ($treasuries as $treasury)
                            <tr>
                                <td class="sort-name">{{ $loop->iteration }}</td>
                                <td class="sort-city">
                                    {{ $treasury->name }}
                                </td>
                                <td class="sort-type">{{ $treasury->is_master }}</td>
                                <td class="sort-score">{{ $treasury->last_payment_receipt }}</td>
                                <td class="sort-date">
                                    {{ $treasury->last_payment_collect }}
                                </td>
                                <td class="sort-quantity">
                                    @if (!$setting->updated_by)
                                        {{ __('msgs.not_found') }}
                                    @else
                                        {{ $setting->updatedBy->name ?? '' }}
                                        <b>{{ __('setting.on_the_date') }}</b>
                                        ({{ Carbon\Carbon::parse($setting->updated_at)->format('Y-m-d H:m A') }})
                                    @endif
                                </td>
                                <td class="sort-progress" data-progress="30">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-lg-auto">
                                            30%
                                        </div>
                                        <div class="col">
                                            <div class="progress" style="width: 5rem">
                                                <div class="progress-bar" style="width: 30%" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" aria-label="30% Complete">
                                                    <span class="visually-hidden">30% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-master-layout>
