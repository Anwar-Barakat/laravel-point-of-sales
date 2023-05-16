<div>
    <form wire:submit.prevent='submit'>
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">{{ __('msgs.all', ['name' => __('report.reports_of', ['name' => __('account.vendors')])]) }}</h3>
            </div>

            <div class="card-body">
                <div id="table-default" class="table-responsive">
                    <div class="row row-cards">
                        <div class="col-sm-12 col-md-4 col-lg-3">
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
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('report.report_type')" />
                                <select class="form-select" wire:model='report_type' required>
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="1">{{ __('report.total_account_statement') }}</option>
                                    <option value="2">{{ __('report.detailed_statement_of_account_within_a_period') }}</option>
                                    <option value="3">{{ __('report.purchase_account_statement_within_a_period') }}</option>
                                    <option value="4">{{ __('report.purchase_return_statement_within_a_period') }}</option>
                                    <option value="5">{{ __('report.monetory_statement_during_a_period') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('report_type')" class="mt-2" />
                            </div>
                        </div>
                        @if ($date)
                            <div class="col-sm-12 col-md-4 col-lg-3">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('report.reports_from_date')" />
                                    <input type="date" class="form-control" wire:model='reports_from_date'>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-3">
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
                <button type="submit" class="btn btn-primary">
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

    @if ($purchases)
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
                            {{-- <div class="col-6 text-end">
                                <p class="h3">{{ __('transaction.the_customer') }}</p>
                                <address>
                                    {{ $sale->customer->name }} <br>
                                    {{ $sale->customer->address }}<br>
                                    {{ $sale->customer->email }}
                                </address>
                            </div> --}}
                            <div class="col-12 my-5">

                                {{-- <h1>{{ $type . ' #' . $sale->id }}</h1>
                                <h2>{{ __('transaction.date') . ': ' . $sale->invoice_date }}</h2>
                                <h2>{{ __('transaction.sale_type') . ': ' . __('transaction.' . App\Models\Sale::SALEINVOICETYPE[$sale->invoice_sale_type]) }}</h2>
                                <h2>{{ __('transaction.paid_amount') . ': ' . $sale->paid }}</h2>
                                <h2>{{ __('transaction.remain_amount') . ': ' . $sale->remains }}</h2> --}}
                            </div>
                        </div>
                        <table id="dataTables" class="table table-vcenter table-mobile-md card-table table-striped">
                            <tbody class="table-tbody">
                                <tr>
                                    <td>{{ __('stock.vendor_name') }}</td>
                                    <td>{{ $vendor->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('account.account_number') }}</td>
                                    <td><span class="badge bg-info-lt">{{ $vendor->account->number }}</span></td>
                                </tr>
                                <tr>
                                    <td>{{ __('account.initial_balance') }}</td>
                                    <td>{{ $vendor->account->initial_balance }}</td>
                                </tr>
                                <tr App::getLocale()=='ar' ? style="direction: ltr; text-align:right" : ''>
                                    <td>{{ __('account.current_balamce') }}</td>
                                    <td>
                                        <span>
                                            {{ number_format($vendor->account->current_balance, 1) > 0 ? '(' . __('account.debit') . ')' : '' }}
                                            {{ number_format($vendor->account->current_balance, 2) < 0 ? '(' . __('account.credit') . ')' : '' }}
                                            {{ number_format($vendor->account->current_balance, 2) == 0 ? '(' . __('account.balanced') . ')' : '' }}
                                            <span class="badge badge-dark">{{ $vendor->account->current_balance }}</span>
                                        </span>
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
                                    <td>{{ __('account.collect_transactions') }}</td>
                                    <td>{{ $collect_transactions->sum('money_for_account') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('account.exchange_transactions') }}</td>
                                    <td>{{ $exchange_transactions->sum('money_for_account') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-transparent table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>{{ __('stock.item') }}</th>
                                    <th class="text-center">{{ __('transaction.qty') }}</th>
                                    <th class="text-end">{{ __('stock.unit_price') }}</th>
                                    <th class="text-end">{{ __('transaction.total_amount') }}</th>
                                </tr>
                            </thead>
                            {{-- @foreach ($sale->saleProducts as $product)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <p class="strong mb-1">{{ $product->item->name }}</p>
                                        @if ($product->production_date)
                                            <div class="text-muted">{{ __('transaction.production_date') . ' : ' }} {{ $product->production_date }}</div>
                                            <div class="text-muted">{{ __('transaction.expiration_date') . ' : ' }} {{ $product->expiration_date }}</div>
                                        @endif
                                        <div class="text-muted">{{ __('stock.store') . ': ' . $product->store->name }}</div>
                                    </td>
                                    <td class="text-center">{{ $product->qty }}
                                    </td>
                                    <td class="text-end">{{ $product->unit_price }}</td>
                                    <td class="text-end">{{ $product->total_price }}</td>
                                </tr>
                            @endforeach --}}
                            {{-- <tr>
                                <td colspan="4" class="strong text-end">{{ __('transaction.total_price') }}</td>
                                <td class="text-end">{{ $sale->items_cost }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="strong text-end">{{ __('transaction.tax') }}</td>
                                <td class="text-end">
                                    {{ $sale->tax_type == 0 ? '%' : '$' }}{{ $sale->tax_value }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="strong text-end">{{ __('transaction.cost_before_discount') }}</td>
                                <td class="text-end">{{ $sale->cost_before_discount }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-weight-bold strong text-end">{{ __('transaction.discount') }}</td>
                                <td class="text-end">
                                    {{ $sale->discount_type == 0 ? '%' : '$' }}{{ $sale->discount_value }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-weight-bold text-uppercase text-end">{{ __('transaction.final_price') }}</td>
                                <td class="font-weight-bold text-end">{{ $sale->cost_after_discount }}</td>
                            </tr> --}}
                        </table>
                        <p class="text-muted text-center mt-5">{{ __('msgs.thanks_for_sale_from_us') }}</p>
                        {{-- <div class="mt-4 text-center">
                            <a class="btn btn-info" href="{{ route('admin.sales.invoice.pdf', ['sale' => $sale]) }}">
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
            </div>
        </div>
    @endif
</div>
