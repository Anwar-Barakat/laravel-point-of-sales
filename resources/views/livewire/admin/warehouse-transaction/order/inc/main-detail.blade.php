 <table class="table card-table table-vcenter table-striped-columns">
     <thead>
         <tr>
             <th>{{ __('msgs.column') }}</th>
             <th colspan="2">{{ __('btns.details') }}</th>
         </tr>
     </thead>
     <tbody>
         <tr>
             <th>{{ __('transaction.order_id') }}</th>
             <td>{{ $order->id }}</td>
         </tr>
         <tr>
             <th>{{ __('transaction.order_type') }}</th>
             <td>
                 <span class="badge bg-red-lt">{{ __('transaction.' . App\Models\Order::ORDERTYPE[$order->type]) }}</span>
             </td>
         </tr>
         <tr>
             <th>{{ __('transaction.invoice_type') }}</th>
             <td>
                 <span class="badge {{ $order->invoice_type == 0 ? 'bg-red-lt' : 'bg-green-lt' }}">
                     {{ $order->invoice_type ? __('transaction.delayed') : __('transaction.cash') }}
                 </span>
             </td>
         </tr>
         <tr>
             <th>{{ __('transaction.invoice_date') }}</th>
             <td>{{ $order->invoice_date }}</td>
         </tr>
         <tr>
             <th>{{ __('stock.vendor_name') }}</th>
             <td>{{ $order->vendor->name }}</td>
         </tr>
         <tr>
             <th>{{ __('stock.store') }}</th>
             <td>{{ $order->store->name }}</td>
         </tr>
         <tr>
             <th>{{ __('transaction.invoice_number') }}</th>
             <td>{{ $order->account->number }}</td>
         </tr>
         <tr>
             <th>{{ __('transaction.items_cost') }}</th>
             <td>{{ $order->items_cost ?? '0' }}</td>
         </tr>
         <tr>
             <th>{{ __('transaction.tax') }}</th>
             <td>
                 {{ $order->tax_value ?? '-' }}
                 {{ $order->tax_type ? '$' : '%' }}
             </td>
         </tr>
         <tr>
             <th>{{ __('transaction.cost_before_discount') }}</th>
             <td>{{ $order->cost_before_discount ?? '0' }}</td>
         </tr>
         <tr>
             <th>{{ __('transaction.discount') }}</th>
             <td>
                 {{ $order->discount_value ?? '-' }}
                 {{ $order->discount_type ? '$' : '%' }}
             </td>
         </tr>
         <tr>
             <th>{{ __('transaction.grand_total') }}</th>
             <td>{{ $order->cost_after_discount ?? '0' }}</td>
         </tr>
         <tr>
             <th>{{ __('transaction.paid_amount') }}</th>
             <td class="text-green">{{ $order->paid ?? '0' }}</td>
         </tr>
         <tr>
             <th>{{ __('transaction.remain_amount') }}</th>
             <td class="text-red">{{ $order->remains ?? '0' }}</td>
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
