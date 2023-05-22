<div>
    <form wire:submit.prevent='submit' id="report-form">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">{{ __('msgs.all', ['name' => __('report.reports_of', ['name' => __('account.vendors')])]) }}</h3>
            </div>

            <div class="card-body">
                <div id="table-default" class="table-responsive">
                    <div class="row row-cards">
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('stock.vendor')" />
                                <select class="form-select" wire:model='vendor_id' required>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('vendor_id')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('report.report_type')" />
                                <select class="form-select" wire:model='report_type' required>
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="1">{{ __('report.total_account_statement') }}</option>
                                    <option value="2">{{ __('report.detailed_statement_of_account_within_a_period') }}</option>
                                    <option value="3">{{ __('report.purchase_account_statement_within_a_period') }}</option>
                                    <option value="4">{{ __('report.purchase_return_statement_within_a_period') }}</option>
                                    <option value="5">{{ __('report.monetory_statement_during_a_period') }}</option>
                                    <option value="6">{{ __('report.services_of', ['name' => __('stock.vendor')]) }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('report_type')" class="mt-2" />
                            </div>
                        </div>
                        @if ($date)
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('report.reports_from_date')" />
                                    <input type="date" class="form-control" wire:model='reports_from_date'>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('report.reports_to_date')" />
                                    <input type="date" class="form-control" wire:model='reports_to_date'>
                                </div>
                            </div>
                        @endif
                    </div>
                    <br>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary print-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path>
                        <path d="M18 12v-5a2 2 0 0 0 -2 -2h-2"></path>
                        <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                        <path d="M8 11h4"></path>
                        <path d="M8 15h3"></path>
                        <path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path>
                        <path d="M18.5 19.5l2.5 2.5"></path>
                    </svg>
                    {{ __('btns.display_report') }}
                </button>
            </div>
        </div>

    </form>

    @if ($purchases || $transactions || $general_purchase_returns || $services)
        <div class="mt-4">
            <div class="card card-lg border-b-0">
                <h1 class="text-center mt-3 text-blue card-title">
                    @if ($report_type == 1)
                        {{ __('report.total_account_statement') }}
                    @elseif($report_type == 2)
                        {{ __('report.detailed_statement_of_account_within_a_period') }}
                    @elseif($report_type == 3)
                        {{ __('report.purchase_account_statement_within_a_period') }}
                    @elseif($report_type == 4)
                        {{ __('report.purchase_return_statement_within_a_period') }}
                    @elseif($report_type == 5)
                        {{ __('report.monetory_statement_during_a_period') }}
                    @elseif($report_type == 6)
                        {{ __('report.services_of', ['name' => __('stock.vendor')]) }}
                    @endif
                </h1>

                <div class="card-header">
                    <h3 class="card-title text-blue">{{ __('msgs.details', ['name' => __('stock.the_vendor')]) }}</h3>
                </div>
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
                                {{ $vendor->name }} <br>
                                {{ $vendor->address }}<br>
                                {{ $vendor->email }}
                                {{ $vendor->mobile }}
                            </address>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="dataTables" class="table table-vcenter table-mobile-md card-table table-striped">
                            <tbody class="table-tbody">
                                <tr>
                                    <td>{{ __('stock.vendor_name') }}</td>
                                    <td>{{ $vendor->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('msgs.created_at') }}</td>
                                    <td>{{ $vendor->created_at->format('Y-M-d') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('account.account_number') }}</td>
                                    <td><span class="badge bg-info-lt">{{ $account->number }}</span></td>
                                </tr>
                                <tr>
                                    <td>{{ __('account.initial_balance') }}</td>
                                    <td>{{ $account->initial_balance }}</td>
                                </tr>
                                <tr App::getLocale()=='ar' ? style="direction: ltr; text-align:right" : ''>
                                    <td>{{ __('account.current_balamce') }} {{ $account->current_balance }}</td>
                                    <td>
                                        @include('layouts.balance-status', ['account' => $account])
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('report.numbers_of', ['name' => __('transaction.purchase_bills')]) }}</td>
                                    <td>({{ $purchases->count() }}) - {{ __('account.amount') . ': ' }} {{ abs($purchases->sum('money_for_account')) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('report.numbers_of', ['name' => __('transaction.general_orders_returns')]) }}</td>
                                    <td>({{ $general_purchase_returns->count() }}) - {{ __('account.amount') . ': ' }} {{ abs($general_purchase_returns->sum('money_for_account')) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('report.numbers_of', ['name' => __('transaction.services_invoices')]) }}</td>
                                    <td>({{ $services->count() }}) - {{ __('account.amount') . ': ' }} {{ abs($services->sum('money_for_account')) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('account.collect_transactions') }}</td>
                                    <td>{{ $transactions->where('money', '>', 0)->sum('money_for_account') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('account.exchange_transactions') }}</td>
                                    <td>{{ $transactions->where('money', '<', 0)->sum('money_for_account') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    {{--
                        <p class="text-muted text-center mt-5">{{ __('msgs.thanks_for_sale_from_us') }}</p>
                        <div class="mt-4 text-center">
                            <a class="btn btn-info print-btn" href="javascript:;" onclick="window.print()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                    <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                </svg>
                                {{ __('btns.print') }}
                            </a>
                        </div> --}}
                </div>
            </div>

            @if ($purchases && ($report_type == 3 || $report_type == 1 || $report_type == 2))
                <div class="card card-lg border-b-0">
                    <div class="card-header">
                        <h3 class="card-title text-blue">{{ __('transaction.purchase_bills') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordion-example">
                            @forelse ($purchases as $key => $order)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-1">
                                        <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $order->id }}" aria-expanded="true">
                                            {{ __('transaction.purchase_bill') }} #{{ $order->id }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $order->id }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" data-bs-parent="#accordion-example">
                                        <div class="accordion-body pt-0">
                                            <span>{{ __('transaction.invoice_date') . ' : ' }} <span class="text-gray-500">{{ $order->invoice_date }}</span></span> -
                                            <span>{{ __('transaction.invoice_type') . ' : ' }} {{ $order->invoice_type ? __('transaction.delayed') : __('transaction.cash') }}</span> -
                                            <span>{{ __('transaction.paid_amount') . ' : ' }} <span class="text-green-500">{{ $order->paid }}</span></span> -
                                            <span>{{ __('transaction.remain_amount') . ' : ' }} <span class="text-red-500">{{ $order->remains }}</span></span> -
                                            <span>{{ __('transaction.total_price') . ' : ' }} <span class="text-blue-500">{{ $order->cost_after_discount }}</span></span>.
                                            <table id="dataTables" class="table table-vcenter table-mobile-md card-table mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> {{ __('stock.item') }}</th>
                                                        <th> {{ __('stock.unit') }}</th>
                                                        <th>{{ __('transaction.qty') }}</th>
                                                        <th>{{ __('stock.unit_price') }}</th>
                                                        <th>{{ __('transaction.total_price') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-tbody">
                                                    @forelse ($order->orderProducts as $product)
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $product->item->name }}</td>
                                                        <td>{{ $product->unit->name }}</td>
                                                        <td>{{ $product->qty }}</td>
                                                        <td>{{ $product->unit_price }}</td>
                                                        <td>{{ $product->total_price }}</td>
                                                    @empty
                                                        <td colspan="6">{{ __('msgs.not_found') }}</td>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h3 class="text-center">
                                    {{ __('msgs.not_found') }}
                                </h3>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endif

            @if ($general_purchase_returns && ($report_type == 4 || $report_type == 1 || $report_type == 2))
                <div class="card card-lg border-b-0">
                    <div class="card-header">
                        <h3 class="card-title text-blue">{{ __('transaction.general_orders_returns') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordion-example">
                            @forelse ($general_purchase_returns as $key => $order)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-1">
                                        <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $order->id }}" aria-expanded="true">
                                            {{ __('transaction.purchase_bill') }} #{{ $order->id }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $order->id }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" data-bs-parent="#accordion-example">
                                        <div class="accordion-body pt-0">
                                            <span>{{ __('transaction.invoice_date') . ' : ' }} <span class="text-gray-500">{{ $order->invoice_date }}</span></span> -
                                            <span>{{ __('transaction.invoice_type') . ' : ' }} {{ $order->invoice_type ? __('transaction.delayed') : __('transaction.cash') }}</span> -
                                            <span>{{ __('transaction.paid_amount') . ' : ' }} <span class="text-green-500">{{ $order->paid }}</span></span> -
                                            <span>{{ __('transaction.remain_amount') . ' : ' }} <span class="text-red-500">{{ $order->remains }}</span></span> -
                                            <span>{{ __('transaction.total_price') . ' : ' }} <span class="text-blue-500">{{ $order->cost_after_discount }}</span></span>.
                                            <table id="dataTables" class="table table-vcenter table-mobile-md card-table mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> {{ __('stock.item') }}</th>
                                                        <th> {{ __('stock.unit') }}</th>
                                                        <th>{{ __('transaction.qty') }}</th>
                                                        <th>{{ __('stock.unit_price') }}</th>
                                                        <th>{{ __('transaction.total_price') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-tbody">
                                                    @forelse ($order->orderProducts as $product)
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $product->item->name }}</td>
                                                        <td>{{ $product->unit->name }}</td>
                                                        <td>{{ $product->qty }}</td>
                                                        <td>{{ $product->unit_price }}</td>
                                                        <td>{{ $product->total_price }}</td>
                                                    @empty
                                                        <td colspan="6">{{ __('msgs.not_found') }}</td>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h3 class="text-center">
                                    {{ __('msgs.not_found') }}
                                </h3>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endif

            @if ($services && ($report_type == 6 || $report_type == 1 || $report_type == 2))
                <div class="card card-lg border-b-0">
                    <div class="card-header">
                        <h3 class="card-title text-blue">{{ __('transaction.services_invoices') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordion-example">
                            @forelse ($services as $key => $service)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-1">
                                        <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $service->id }}" aria-expanded="true">
                                            {{ __('transaction.service_invoice') }} #{{ $service->id }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $service->id }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" data-bs-parent="#accordion-example">
                                        <div class="accordion-body pt-0">
                                            <span>{{ __('transaction.invoice_date') . ' : ' }} <span class="text-gray-500">{{ $service->invoice_date }}</span></span> -
                                            <span>{{ __('transaction.invoice_type') . ' : ' }} {{ $service->invoice_type ? __('transaction.delayed') : __('transaction.cash') }}</span> -
                                            <span>{{ __('transaction.paid_amount') . ' : ' }} <span class="text-green-500">{{ $service->paid }}</span></span> -
                                            <span>{{ __('transaction.remain_amount') . ' : ' }} <span class="text-red-500">{{ $service->remains }}</span></span> -
                                            <span>{{ __('transaction.total_price') . ' : ' }} <span class="text-blue-500">{{ $service->cost_after_discount }}</span></span>.
                                            <span>({{ __('setting.service_type') . ' : ' }} <span class="text-red-500">{{ __('setting.' . App\Models\Service::SERTICETYPE[$service->service_type]) }}</span>)</span>.

                                            <table id="dataTables" class="table table-vcenter table-mobile-md card-table mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> {{ __('setting.service') }}</th>
                                                        <th>{{ __('transaction.total_price') }}</th>
                                                        <th> {{ __('msgs.notes') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-tbody">
                                                    @forelse ($service->serviceInvoiceDetails as $detail)
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $detail->service->name }}</td>
                                                        <td>{{ $detail->total }}</td>
                                                        <td>{{ $detail->notes }}</td>
                                                    @empty
                                                        <td colspan="4">{{ __('msgs.not_found') }}</td>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h3 class="text-center">
                                    {{ __('msgs.not_found') }}
                                </h3>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endif

            @if ($transactions && ($report_type == 5 || $report_type == 1 || $report_type == 2))
                <div class="card card-lg border-b-0">
                    <div class="card-header">
                        <h3 class="card-title text-blue">{{ __('account.monetory_transactions') }}</h3>
                    </div>
                    <div class="card-body">
                        <table id="dataTables" class="table table-vcenter table-mobile-md card-table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('account.transaction_date') }}</th>
                                    <th>{{ __('treasury.treasury') }}</th>
                                    <th> {{ __('account.shift_type') }}</th>
                                    <th>{{ __('account.amount') }}</th>
                                    <th>{{ __('report.report') }}</th>
                                </tr>
                            </thead>
                            <tbody class="table-tbody">
                                @forelse ($transactions as $trans)
                                    <tr>
                                        <td>{{ $trans->id }}</td>
                                        <td>{{ $trans->transaction_date }}</td>
                                        <td>{{ $trans->treasury->name }}</td>
                                        <td><span class="badge bg-green">{{ $trans->shift_type->name }} </span></td>
                                        <td>
                                            {{ abs($trans->money_for_account) }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm" data-bs-placement="top" data-bs-toggle="popover" title="{{ __('account.report') }}" data-bs-content="{{ $trans->report }}">{{ __('account.click_here') }}</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            {{ __('msgs.not_found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>
