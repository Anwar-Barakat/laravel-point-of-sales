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
                        <th>{{ __('movement.order_id') }}</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('movement.invoice_type') }}</th>
                        <td>{{ $order->invoice_type ? __('movement.delayed') : __('movement.cash') }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('stock.vendor_name') }}</th>
                        <td>{{ $order->vendor->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('movement.invoice_number') }}</th>
                        <td>{{ $order->account->number }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('stock.vendor_name') }}</th>
                        <td>{{ $order->vendor->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('stock.vendor_name') }}</th>
                        <td>{{ $order->vendor->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('movement.discount_type') }}</th>
                        <td>{{ $order->discount_type ? __('movement.fixed') : __('movement.percentage') }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('msgs.created_at') }}</th>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('msgs.added_by') }}</th>
                        <td>{{ $order->addedBy->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 col-lg-8">
        <div class="card">

        </div>
    </div>
</div>
