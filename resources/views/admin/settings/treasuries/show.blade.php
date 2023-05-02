<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('treasury.treasury')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('treasury.treasury')]))
    @section('breadcrumbSubtitle', __('partials.general_setting'))


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
                            <th>{{ __('msgs.is_it_master') }}</th>
                            <td>{{ $treasury->is_master ? __('msgs.master') : __('msgs.branch') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('partials.status') }}</th>
                            <td>{{ $treasury->is_active ? __('msgs.active') : __('msgs.not_active') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('treasury.last_payment_exchange') }}</th>
                            <td>{{ $treasury->last_payment_exchange }}</td>
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
                            <th>{{ __('msgs.updated_at') }}</th>
                            <td>{{ \Carbon\Carbon::parse($treasury->updated_at)->format('Y-m-d') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header d-grid">
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <ul class="p-0 m-0 list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <h3 class="card-title">{{ __('treasury.treasury_will_delivery_to_master') }}</h3>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-treasury-delivery">
                            {{ __('msgs.create', ['name' => __('treasury.treasury_delivery')]) }}
                        </a>
                    </div>
                </div>
                @include('admin.settings.treasuries.treasury-deliveries.index')
            </div>
        </div>
        <!-- Add treasury delivery modal -->
        @include('admin.settings.treasuries.treasury-deliveries.create', ['treasury' => $treasury, 'treasuries' => $treasuries])
    </div>
</x-master-layout>
