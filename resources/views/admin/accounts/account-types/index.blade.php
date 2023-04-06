<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('account.account_types')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('account.account_types')]))
    @section('breadcrumbSubtitle', __('account.accounts'))

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('msgs.all', ['name' => __('account.account_types')]) }}</h3>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-account-type">
                {{ __('msgs.create', ['name' => __('account.account_type')]) }}
            </a>
        </div>

        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> {{ __('account.account_type') }}</th>
                            <th> {{ __('account.related_to_internal_account') }}</th>
                            <th> {{ __('msgs.is_active') }}</th>
                            <th> {{ __('msgs.created_at') }}</th>
                            <th> {{ __('msgs.added_by') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @forelse ($account_types as $account_type)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $account_type->name }}</td>
                                <td>{{ $account_type->related_to_internal_account ? __('account.added_from_its_screen') : __('account.added_from_accounts_screen') }}</td>
                                <td>
                                    {{ $account_type->is_active }}
                                </td>
                                <td> {{ $account_type->created_at }} </td>
                                <td>
                                    <span class="badge bg-blue-lt">{{ $account_type->addedBy->name }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <x-blank-section :content="__('account.account_type')" :url="'#'" data-bs-toggle="modal" data-bs-target="#add-account-type" />
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $account_types->links() }}
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
