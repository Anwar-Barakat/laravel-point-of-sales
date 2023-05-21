<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('transaction.services_invoices')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('transaction.services_invoices')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    <div class="page-body">
        <div class="container-xl">
            <div class="card card-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="h3">
                                @if ($company->getFirstMediaUrl('company_logo'))
                                    <img src="{{ $company->getFirstMediaUrl('company_logo') }}" alt="{{ $company->name }}" width="100">
                                @else
                                    <img src="{{ asset('backend/static/square-default-image.jpeg') }}" alt="{{ $company->name }}" width="100">
                                @endif
                            </p>
                            <address>
                                {{ $company->name }}<br>
                                {{ $company->address }}<br>
                                {{ $company->email }}
                            </address>
                        </div>
                        <div class="col-6 text-end">
                            <p class="h3">{{ __('stock.vendor') }}</p>
                            <address>
                                {{ __('account.account_name') . ' :' }} {{ $services_invoice->account->name }} <br>
                                {{ __('account.account_number') . ' : ' }}{{ $services_invoice->account->number }}<br>
                            </address>
                        </div>
                        <div class="col-12 my-5">
                            <h1>{{ __('transaction.service_invoice') . ' #' . $services_invoice->id }}</h1>
                            <h2>{{ __('transaction.date') . ': ' . $services_invoice->invoice_date }}</h2>
                            <h2>{{ __('transaction.paid_amount') . ': ' . $services_invoice->paid }}</h2>
                            <h2>{{ __('transaction.remain_amount') . ': ' . $services_invoice->remains }}</h2>
                            <h2 class="d-flex items-center gap-2">
                                <span>{{ __('setting.service_type') . ': ' }}</span>
                                <span class="badge bg-red-lt mt-1">{{ __('setting.' . App\Models\Service::SERTICETYPE[$services_invoice->service_type]) }}</span>
                            </h2>
                        </div>
                    </div>
                    <table class="table table-transparent table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('setting.service') }}</th>
                                <th class="text-end">{{ __('transaction.total_amount') }}</th>
                            </tr>
                        </thead>
                        @foreach ($services_invoice->serviceInvoiceDetails as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-blue">{{ $detail->service->name }}</span>
                                </td>
                                <td class="text-end">{{ $detail->total }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="strong text-end">{{ __('transaction.total_price') }}</td>
                            <td class="text-end">{{ $services_invoice->services_cost }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="strong text-end">{{ __('transaction.tax') }}</td>
                            <td class="text-end">
                                {{ $services_invoice->tax_type == 0 ? '%' : '$' }}{{ $services_invoice->tax_value }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="strong text-end">{{ __('transaction.cost_before_discount') }}</td>
                            <td class="text-end">{{ $services_invoice->cost_before_discount }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="strong text-end">{{ __('transaction.discount') }}</td>
                            <td class="text-end">
                                {{ $services_invoice->discount_type == 0 ? '%' : '$' }}{{ $services_invoice->discount_value }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="font-weight-bold text-uppercase text-end">{{ __('transaction.final_price') }}</td>
                            <td class="font-weight-bold text-end">{{ $services_invoice->cost_after_discount }}</td>
                        </tr>
                    </table>
                    <p class="text-muted text-center mt-5">{{ __('msgs.thanks_for_sale_from_us') }}</p>
                    <div class="mt-4 text-center">
                        <button class="btn btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                            </svg>
                            {{ __('btns.print') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>
