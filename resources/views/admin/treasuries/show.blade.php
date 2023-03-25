<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('treasury.treasury')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('treasury.treasury')]))
    @section('breadcrumbSubtitle', __('treasury.treasuries'))


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
                            <th>{{ __('treasury.treasury_name') }}</th>
                            <td>{{ $treasury->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('treasury.is_it_master') }}</th>
                            <td>{{ $treasury->is_master ? __('treasury.master') : __('treasury.branch') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('treasury.is_it_active') }}</th>
                            <td>{{ $treasury->is_active ? __('treasury.active') : __('treasury.not_active') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('treasury.last_payment_receipt') }}</th>
                            <td>{{ $treasury->last_payment_receipt }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('treasury.last_payment_collect') }}</th>
                            <td>{{ $treasury->last_payment_collect }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('msgs.created_at') }}</th>
                            <td>{{ \Carbon\Carbon::parse($treasury->created_at)->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('treasury.added_by') }}</th>
                            <td>{{ $treasury->addedBy->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('msgs.updated_at') }}</th>
                            <td>{{ \Carbon\Carbon::parse($treasury->updated_at)->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('setting.updated_by') }}</th>
                            <td>{{ $treasury->updatedBy->name ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('treasury.treasury_will_delivery_to_master') }}</h3>
                </div>
                <div class="card-table table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('treasury.treasury_name') }}</th>
                                <th>{{ __('treasury.added_by') }}</th>
                                <th>{{ __('msgs.created_at') }}</th>
                                <th colspan="2">Bounce rate</th>
                            </tr>
                        </thead>
                        @forelse ($treasury->treasuriesDelivery as $branch)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $branch->treasuryDelivered->name }}</td>
                                <td>{{ $branch->treasuryDelivered->addedBy->name }}</td>
                                <td>{{ $branch->treasuryDelivered->addedBy->created_at }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
