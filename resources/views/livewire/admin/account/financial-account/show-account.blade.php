<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">{{ __('msgs.all', ['name' => __('account.financial_accounts')]) }}</h3>
        <a href="#" class="btn btn-primary">
            {{ __('msgs.create', ['name' => __('account.financial_account')]) }}
        </a>
    </div>

    <div class="card-body">
        <div id="table-default" class="table-responsive">
            <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th> {{ __('account.financial_account') }}</th>
                        <th> {{ __('account.account_type') }}</th>
                        <th> {{ __('account.account_number') }}</th>
                        <th> {{ __('account.is_parent_account') }}</th>
                        <th> {{ __('account.parent_account') }}</th>
                        <th>{{ __('msgs.is_active') }}</th>
                        <th>{{ __('msgs.created_at') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    @forelse ($financial_accounts as $financial_account)
                        <tr>
                            <td>{{ $financial_account->account_type }}</td>
                            <td>{{ $financial_account->account_number }}</td>
                            <td>{{ $financial_account->parent_id ? 'yes' : 'no' }}</td>
                            <td>
                                {{ $financial_account->is_active }}
                            </td>
                            <td> {{ $financial_account->created_at }} </td>
                            <td>
                                <span class="badge bg-blue-lt">{{ $financial_account->created_at }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <x-blank-section :content="__('account.financial_account')" :url="route('admin.financial-accounts.create')" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{-- {{ $financial_accounts->links() }} --}}
            </div>
        </div>
    </div>
</div>
