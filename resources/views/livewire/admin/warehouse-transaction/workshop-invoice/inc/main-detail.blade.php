<table class="table card-table table-vcenter table-striped-columns">
    <thead>
        <tr>
            <th>{{ __('msgs.column') }}</th>
            <th colspan="2">{{ __('btns.details') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>{{ __('transaction.workshop_invoice') }}</th>
            <td>#{{ $invoice->id }}</td>
        </tr>
        <tr>
            <th>{{ __('transaction.invoice_type') }}</th>
            <td>
                <span class="badge {{ $invoice->invoice_type == 0 ? 'bg-red-lt' : 'bg-green-lt' }}">
                    {{ $invoice->invoice_type ? __('transaction.delayed') : __('transaction.cash') }}
                </span>
            </td>
        </tr>
        <tr>
            <th>{{ __('transaction.invoice_date') }}</th>
            <td>{{ $invoice->invoice_date }}</td>
        </tr>
        <tr>
            <th>{{ __('account.workshop_name') }}</th>
            <td>{{ $invoice->workshop->name }}</td>
        </tr>
        <tr>
            <th>{{ __('account.account_number') }}</th>
            <td>{{ $invoice->workshop->account->number }}</td>
        </tr>
        <tr>
            <th>{{ __('transaction.items_cost') }}</th>
            <td>{{ $invoice->items_cost ?? '0' }}</td>
        </tr>
        <tr>
            <th>{{ __('transaction.tax') }}</th>
            <td>
                {{ $invoice->tax_value ?? '-' }}
                {{ $invoice->tax_type ? '$' : '%' }}
            </td>
        </tr>
        <tr>
            <th>{{ __('transaction.cost_before_discount') }}</th>
            <td>{{ $invoice->cost_before_discount ?? '0' }}</td>
        </tr>
        <tr>
            <th>{{ __('transaction.discount') }}</th>
            <td>
                {{ $invoice->discount_value ?? '-' }}
                {{ $invoice->discount_type ? '$' : '%' }}
            </td>
        </tr>
        <tr>
            <th>{{ __('transaction.grand_total') }}</th>
            <td>{{ $invoice->cost_after_discount ?? '0' }}</td>
        </tr>
        <tr>
            <th>{{ __('transaction.paid_amount') }}</th>
            <td class="text-green">{{ $invoice->paid ?? '0' }}</td>
        </tr>
        <tr>
            <th>{{ __('transaction.remain_amount') }}</th>
            <td class="text-red">{{ $invoice->remains ?? '0' }}</td>
        </tr>
        <tr>
            <th>{{ __('msgs.created_at') }}</th>
            <td>{{ $invoice->created_at }}</td>
        </tr>
        <tr>
            <th>{{ __('msgs.added_by') }}</th>
            <td>{{ $invoice->addedBy->name }}</td>
        </tr>
    </tbody>
</table>
