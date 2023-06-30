 <div class="row row-deck row-cards">
     <div class="col-sm-6 col-lg-3">
         <div class="card">
             <div class="card-body">
                 <div class="d-flex align-items-center">
                     <div class="subheader">{{ __('transaction.purchase_bills') }}</div>
                     <div class="ms-auto lh-1">
                         <div class="dropdown">
                             <select class="form-select border-0" id="" wire:model='order_filter'>
                                 <option value="1">{{ __('dash.last_7_days') }}</option>
                                 <option value="2">{{ __('dash.last_month') }}</option>
                                 <option value="3">{{ __('dash.last_3_months') }}</option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="h1 mb-3">{{ $orders_result['total_orders'] ?? '0.00' }}</div>
                 <div>
                     <div class="d-flex mb-2">
                         <div>{{ __('transaction.paid_amount') }}</div>
                         <div class="ms-auto">
                             <span class="text-green d-inline-flex align-items-center lh-1">
                                 {{ $orders_result['paid_percentage'] }}%
                             </span>
                         </div>
                     </div>
                     <div class="progress progress-sm">
                         <div class="progress-bar bg-primary" style="width: {{ $orders_result['paid_percentage'] }}%" role="progressbar" aria-valuenow="{{ $orders_result['total_paid'] }}" aria-valuemin="0" aria-valuemax="{{ $orders_result['total_orders'] }}" aria-label="75% Complete">
                             <span class="visually-hidden">{{ $orders_result['total_paid'] }} Complete</span>
                         </div>
                     </div>
                 </div>
                 <div class="mt-4">
                     <div class="d-flex mb-2">
                         <div>{{ __('transaction.remain_amount') }}</div>
                         <div class="ms-auto">
                             <span class="text-red d-inline-flex align-items-center lh-1">
                                 {{ $orders_result['remaining_percentage'] }}%
                             </span>
                         </div>
                     </div>
                     <div class="progress progress-sm">
                         <div class="progress-bar bg-primary" style="width: {{ $orders_result['remaining_percentage'] }}%" role="progressbar" aria-valuenow="{{ $orders_result['total_paid'] }}" aria-valuemin="0" aria-valuemax="{{ $orders_result['total_orders'] }}" aria-label="75% Complete">
                             <span class="visually-hidden">{{ $orders_result['total_paid'] }} Complete</span>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-sm-6 col-lg-3">
         <div class="card">
             <div class="card-body">
                 <div class="d-flex align-items-center">
                     <div class="subheader">{{ __('transaction.sales_invoices') }}</div>
                     <div class="ms-auto lh-1">
                         <div class="dropdown">
                             <select class="form-select border-0" id="" wire:model='sale_filter'>
                                 <option value="1">{{ __('dash.last_7_days') }}</option>
                                 <option value="2">{{ __('dash.last_month') }}</option>
                                 <option value="3">{{ __('dash.last_3_months') }}</option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="h1 mb-3">{{ $sales_result['total_sales'] ?? '0.00' }}</div>
                 <div>
                     <div class="d-flex mb-2">
                         <div>{{ __('transaction.paid_amount') }}</div>
                         <div class="ms-auto">
                             <span class="text-green d-inline-flex align-items-center lh-1">
                                 {{ $sales_result['paid_percentage'] }}%
                             </span>
                         </div>
                     </div>
                     <div class="progress progress-sm">
                         <div class="progress-bar bg-primary" style="width: {{ $sales_result['paid_percentage'] }}%" role="progressbar" aria-valuenow="{{ $sales_result['total_paid'] }}" aria-valuemin="0" aria-valuemax="{{ $sales_result['total_sales'] }}" aria-label="75% Complete">
                             <span class="visually-hidden">{{ $sales_result['total_paid'] }} Complete</span>
                         </div>
                     </div>
                 </div>
                 <div class="mt-4">
                     <div class="d-flex mb-2">
                         <div>{{ __('transaction.remain_amount') }}</div>
                         <div class="ms-auto">
                             <span class="text-red d-inline-flex align-items-center lh-1">
                                 {{ $sales_result['remaining_percentage'] }}%
                             </span>
                         </div>
                     </div>
                     <div class="progress progress-sm">
                         <div class="progress-bar bg-primary" style="width: {{ $sales_result['remaining_percentage'] }}%" role="progressbar" aria-valuenow="{{ $sales_result['total_paid'] }}" aria-valuemin="0" aria-valuemax="{{ $sales_result['total_sales'] }}" aria-label="75% Complete">
                             <span class="visually-hidden">{{ $sales_result['total_paid'] }} Complete</span>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-sm-6 col-lg-3">
         <div class="card">
             <div class="card-body">
                 <div class="d-flex align-items-center">
                     <div class="subheader">{{ __('transaction.services_invoices') }}</div>
                     <div class="ms-auto lh-1">
                         <div class="dropdown">
                             <select class="form-select border-0" id="" wire:model='service_filter'>
                                 <option value="1">{{ __('dash.last_7_days') }}</option>
                                 <option value="2">{{ __('dash.last_month') }}</option>
                                 <option value="3">{{ __('dash.last_3_months') }}</option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="h1 mb-3">{{ $services_invoices['total_service_invoice'] ?? '0.00' }}</div>
                 <div>
                     <div class="d-flex mb-2">
                         <div>{{ __('transaction.paid_amount') }}</div>
                         <div class="ms-auto">
                             <span class="text-green d-inline-flex align-items-center lh-1">
                                 {{ $services_invoices['paid_percentage'] }}%
                             </span>
                         </div>
                     </div>
                     <div class="progress progress-sm">
                         <div class="progress-bar bg-primary" style="width: {{ $services_invoices['paid_percentage'] }}%" role="progressbar" aria-valuenow="{{ $services_invoices['total_paid'] }}" aria-valuemin="0" aria-valuemax="{{ $services_invoices['total_service_invoice'] }}" aria-label="75% Complete">
                             <span class="visually-hidden">{{ $services_invoices['total_paid'] }} Complete</span>
                         </div>
                     </div>
                 </div>
                 <div class="mt-4">
                     <div class="d-flex mb-2">
                         <div>{{ __('transaction.remain_amount') }}</div>
                         <div class="ms-auto">
                             <span class="text-red d-inline-flex align-items-center lh-1">
                                 {{ $services_invoices['remaining_percentage'] }}%
                             </span>
                         </div>
                     </div>
                     <div class="progress progress-sm">
                         <div class="progress-bar bg-primary" style="width: {{ $services_invoices['remaining_percentage'] }}%" role="progressbar" aria-valuenow="{{ $services_invoices['total_paid'] }}" aria-valuemin="0" aria-valuemax="{{ $services_invoices['total_service_invoice'] }}" aria-label="75% Complete">
                             <span class="visually-hidden">{{ $services_invoices['total_paid'] }} Complete</span>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-sm-6 col-lg-3">
         <div class="card">
             <div class="card-body">
                 <div class="d-flex align-items-center">
                     <div class="subheader">{{ __('transaction.workshops_invoices') }}</div>
                     <div class="ms-auto lh-1">
                         <div class="dropdown">
                             <select class="form-select border-0" id="" wire:model='workshop_invoice_filter'>
                                 <option value="1">{{ __('dash.last_7_days') }}</option>
                                 <option value="2">{{ __('dash.last_month') }}</option>
                                 <option value="3">{{ __('dash.last_3_months') }}</option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="h1 mb-3">{{ $workshops_invoices['total_workshops_invoices'] ?? '0.00' }}</div>
                 <div>
                     <div class="d-flex mb-2">
                         <div>{{ __('transaction.paid_amount') }}</div>
                         <div class="ms-auto">
                             <span class="text-green d-inline-flex align-items-center lh-1">
                                 {{ $workshops_invoices['paid_percentage'] }}%
                             </span>
                         </div>
                     </div>
                     <div class="progress progress-sm">
                         <div class="progress-bar bg-primary" style="width: {{ $workshops_invoices['paid_percentage'] }}%" role="progressbar" aria-valuenow="{{ $workshops_invoices['total_paid'] }}" aria-valuemin="0" aria-valuemax="{{ $workshops_invoices['total_workshops_invoices'] }}" aria-label="75% Complete">
                             <span class="visually-hidden">{{ $workshops_invoices['total_paid'] }} Complete</span>
                         </div>
                     </div>
                 </div>
                 <div class="mt-4">
                     <div class="d-flex mb-2">
                         <div>{{ __('transaction.remain_amount') }}</div>
                         <div class="ms-auto">
                             <span class="text-red d-inline-flex align-items-center lh-1">
                                 {{ $workshops_invoices['remaining_percentage'] }}%
                             </span>
                         </div>
                     </div>
                     <div class="progress progress-sm">
                         <div class="progress-bar bg-primary" style="width: {{ $workshops_invoices['remaining_percentage'] }}%" role="progressbar" aria-valuenow="{{ $workshops_invoices['total_paid'] }}" aria-valuemin="0" aria-valuemax="{{ $workshops_invoices['total_workshops_invoices'] }}" aria-label="75% Complete">
                             <span class="visually-hidden">{{ $workshops_invoices['total_paid'] }} Complete</span>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
