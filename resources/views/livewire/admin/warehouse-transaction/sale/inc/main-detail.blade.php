 <table class="table card-table table-vcenter table-striped-columns">
     <thead>
         <tr>
             <th>{{ __('msgs.column') }}</th>
             <th colspan="2">{{ __('btns.details') }}</th>
         </tr>
     </thead>
     <tbody>
         <tr>
             <th>{{ __('transaction.sale_invoice') }}</th>
             <td>#{{ $sale->id }}</td>
         </tr>
         <tr>
             <th>{{ __('transaction.sale_type') }}</th>
             <td>
                 <span class="badge bg-red-lt">
                     @if ($sale->type == 1)
                         {{ __('transaction.sales') }}
                     @elseif($sale->type == 3)
                         {{ __('transaction.general_sale_return') }}
                     @endif
                 </span>
             </td>
         </tr>
         <tr>
             <th>{{ __('transaction.invoice_type') }}</th>
             <td>
                 <span class="badge {{ $sale->invoice_type == 0 ? 'bg-red-lt' : 'bg-green-lt' }}">
                     {{ $sale->invoice_type ? __('transaction.delayed') : __('transaction.cash') }}
                 </span>
             </td>
         </tr>
         <tr>
             <th>{{ __('transaction.invoice_date') }}</th>
             <td>{{ $sale->invoice_date }}</td>
         </tr>
         <tr>
             <th>{{ __('stock.customer_name') }}</th>
             <td>{{ $sale->customer->name }}</td>
         </tr>

         <tr>
             <th>{{ __('transaction.invoice_number') }}</th>
             <td>{{ $sale->account->number }}</td>
         </tr>
         <tr>
             <th>{{ __('transaction.items_cost') }}</th>
             <td>{{ $sale->items_cost ?? '0' }}</td>
         </tr>
         <tr>
             <th>{{ __('transaction.tax') }}</th>
             <td>
                 {{ $sale->tax_value ?? '-' }}
                 {{ $sale->tax_type ? '$' : '%' }}
             </td>
         </tr>
         <tr>
             <th>{{ __('transaction.cost_before_discount') }}</th>
             <td>{{ $sale->cost_before_discount ?? '0' }}</td>
         </tr>
         <tr>
             <th>{{ __('transaction.discount') }}</th>
             <td>
                 {{ $sale->discount_value ?? '-' }}
                 {{ $sale->discount_type ? '$' : '%' }}
             </td>
         </tr>
         <tr>
             <th>{{ __('transaction.grand_total') }}</th>
             <td>{{ $sale->cost_after_discount ?? '0' }}</td>
         </tr>
         @if ($sale->type == 1)
             <tr>
                 <th>{{ __('transaction.delegate_name') }}</th>
                 <td>{{ $sale->delegate->name }}</td>
             </tr>
             <tr>
                 <th>{{ __('stock.commission_value') }}</th>
                 <td class="flex items-center justify-between gap-1">
                     <span>{{ abs($sale->commission_value) ?? '0' }}</span>
                     @php
                         $commission = 0;
                         if ($sale->invoice_sale_type == 1) {
                             $commission = $sale->delegate->commission_for_sectoral;
                         } elseif ($sale->invoice_sale_type == 2) {
                             $commission = $sale->delegate->commission_for_half_block;
                         } elseif ($sale->invoice_sale_type == 3) {
                             $commission = $sale->delegate->commission_for_block;
                         }
                     @endphp
                     @if ($commission > 0)
                         <span class="badge badge-info">
                             {{ $commission }}
                             {{ $sale->commission_type == 0 ? '%' : '$' }}
                         </span>
                     @endif
                 </td>
             </tr>
         @endif

         <tr>
             <th>{{ __('transaction.paid_amount') }}</th>
             <td class="text-green">{{ $sale->paid ?? '0' }}</td>
         </tr>
         <tr>
             <th>{{ __('transaction.remain_amount') }}</th>
             <td class="text-red">{{ $sale->remains ?? '0' }}</td>
         </tr>
         <tr>
             <th>{{ __('msgs.created_at') }}</th>
             <td>{{ $sale->created_at }}</td>
         </tr>
         <tr>
             <th>{{ __('msgs.added_by') }}</th>
             <td>{{ $sale->addedBy->name }}</td>
         </tr>
     </tbody>
 </table>
