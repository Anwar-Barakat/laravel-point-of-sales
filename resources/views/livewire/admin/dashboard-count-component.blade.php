 <div class="row row-deck row-cards">
     <div class="col-12">
         <div class="row row-cards">
             <div class="col-sm-6 col-lg-4">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-bitbucket text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-money" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                         <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                         <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                         <path d="M12 17v1m0 -8v1"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('dash.purchases') }} ({{ $orders_count ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     {{ $orders_waiting_payment ?? 0 }} {{ __('dash.waiting_payment') }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-4">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-green text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                         <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                         <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                         <path d="M17 17h-11v-14h-2" />
                                         <path d="M6 5l14 1l-1 7h-13" />
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('transaction.sales') }} ({{ $sales_count ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     {{ $sales_has_shipped ?? 0 }} {{ __('dash.has_shipped') }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-4">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-muted text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-24-hours" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                         <path d="M4 13a8.094 8.094 0 0 0 3 5.24"></path>
                                         <path d="M11 15h2a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-1a1 1 0 0 0 -1 1v1a1 1 0 0 0 1 1h2"></path>
                                         <path d="M17 15v2a1 1 0 0 0 1 1h1"></path>
                                         <path d="M20 15v6"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('transaction.services_invoices') }} ({{ App\Models\ServiceInvoice::count() ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     {{ App\Models\ServiceInvoice::where('remains', '!=', 0)->count() ?? 0 }} {{ __('dash.waiting_payment') }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-4">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-facebook text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-asset" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M9 15m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0"></path>
                                         <path d="M9 15m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                         <path d="M19 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                         <path d="M14.218 17.975l6.619 -12.174"></path>
                                         <path d="M6.079 9.756l12.217 -6.631"></path>
                                         <path d="M9 15m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('transaction.production_lines') }} ({{ App\Models\ProductionLine::count() ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     {{ __('transaction.approved') }} {{ App\Models\ProductionLine::where('is_approved', 1)->count() ?? 0 }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-4">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-twitter text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-arch" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M3 21l18 0"></path>
                                         <path d="M4 21v-15a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v15"></path>
                                         <path d="M9 21v-8a3 3 0 0 1 6 0v8"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('transaction.workshops_invoices') }} ({{ App\Models\WorkshopInvoice::count() ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     {{ __('transaction.approved') }} {{ App\Models\WorkshopInvoice::where('is_approved', 1)->count() ?? 0 }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-4">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-pink text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                         <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                         <path d="M10 14h4"></path>
                                         <path d="M12 12v4"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('transaction.products_receive') }} ({{ App\Models\ProductReceive::count() ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     {{ __('transaction.approved') }} {{ App\Models\ProductReceive::where('is_approved', 1)->count() ?? 0 }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-12">
         <div class="row row-cards">
             <div class="col-sm-6 col-lg-3">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-bitbucket-lt text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                         <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                                         <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                         <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                                         <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                         <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('stock.customers') }} ({{ App\Models\Customer::count() ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     <div class="flex justify-between gap-1">
                                         <span>
                                             @php
                                                 $customers_credit = App\Models\Customer::join('accounts', 'customers.id', '=', 'accounts.customer_id')
                                                     ->where('accounts.current_balance', '<', 0)
                                                     ->sum('accounts.current_balance');
                                             @endphp
                                             {{ __('account.credit') }}
                                             {{ $customers_credit ?? 0 }}
                                         </span>
                                         <span>
                                             @php
                                                 $customers_debit = App\Models\Customer::join('accounts', 'customers.id', '=', 'accounts.customer_id')
                                                     ->where('accounts.current_balance', '>', 0)
                                                     ->sum('accounts.current_balance');
                                             @endphp
                                             {{ __('account.debit') }}
                                             {{ $customers_debit ?? 0 }}
                                         </span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-3">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-green-lt text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                         <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                         <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                         <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('stock.vendors') }} ({{ App\Models\Vendor::count() ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     <div class="flex justify-between gap-1">
                                         <span>
                                             @php
                                                 $vendors_credit = App\Models\Vendor::join('accounts', 'vendors.id', '=', 'accounts.vendor_id')
                                                     ->where('accounts.current_balance', '<', 0)
                                                     ->sum('accounts.current_balance');
                                             @endphp
                                             {{ __('account.credit') }}
                                             {{ $vendors_credit ?? 0 }}
                                         </span>
                                         <span>
                                             @php
                                                 $vendors_debit = App\Models\Vendor::join('accounts', 'vendors.id', '=', 'accounts.vendor_id')
                                                     ->where('accounts.current_balance', '>', 0)
                                                     ->sum('accounts.current_balance');
                                             @endphp
                                             {{ __('account.debit') }}
                                             {{ $vendors_debit ?? 0 }}
                                         </span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-3">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-muted-lt text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-bolt" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                         <path d="M6 21v-2a4 4 0 0 1 4 -4h4c.267 0 .529 .026 .781 .076"></path>
                                         <path d="M19 16l-2 3h4l-2 3"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('stock.delegates') }} ({{ App\Models\Delegate::count() ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     <div class="flex justify-between gap-1">
                                         <span>
                                             @php
                                                 $delegates_credit = App\Models\Delegate::join('accounts', 'delegates.id', '=', 'accounts.delegate_id')
                                                     ->where('accounts.current_balance', '<', 0)
                                                     ->sum('accounts.current_balance');
                                             @endphp
                                             {{ __('account.credit') }}
                                             {{ $delegates_credit ?? 0 }}
                                         </span>
                                         <span>
                                             @php
                                                 $delegates_debit = App\Models\Delegate::join('accounts', 'delegates.id', '=', 'accounts.delegate_id')
                                                     ->where('accounts.current_balance', '>', 0)
                                                     ->sum('accounts.current_balance');
                                             @endphp
                                             {{ __('account.debit') }}
                                             {{ $delegates_debit ?? 0 }}
                                         </span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-3">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-facebook-lt text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z"></path>
                                         <path d="M7 20l10 0"></path>
                                         <path d="M9 16l0 4"></path>
                                         <path d="M15 16l0 4"></path>
                                         <path d="M8 12l3 -3l2 2l3 -3"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('account.workshops') }} ({{ App\Models\Workshop::count() ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     <div class="flex justify-between gap-1">
                                         <span>
                                             @php
                                                 $workshops_credit = App\Models\Workshop::join('accounts', 'workshops.id', '=', 'accounts.workshop_id')
                                                     ->where('accounts.current_balance', '<', 0)
                                                     ->sum('accounts.current_balance');
                                             @endphp
                                             {{ __('account.credit') }}
                                             {{ $workshops_credit ?? 0 }}
                                         </span>
                                         <span>
                                             @php
                                                 $workshops_debit = App\Models\Workshop::join('accounts', 'workshops.id', '=', 'accounts.workshop_id')
                                                     ->where('accounts.current_balance', '>', 0)
                                                     ->sum('accounts.current_balance');
                                             @endphp
                                             {{ __('account.debit') }}
                                             {{ $workshops_debit ?? 0 }}
                                         </span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
