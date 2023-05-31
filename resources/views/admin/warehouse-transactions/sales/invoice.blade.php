<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('transaction.' . App\Models\SALE::SALETYPE[$sale->type])]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('transaction.' . App\Models\SALE::SALETYPE[$sale->type])]))
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
                            <p class="h3">{{ __('transaction.the_customer') }}</p>
                            <address>
                                {{ $sale->customer->name }} <br>
                                {{ $sale->customer->address }}<br>
                                {{ $sale->customer->email }}
                            </address>
                        </div>
                        <div class="col-12 my-5">
                            @php
                                if ($sale->type == 1) {
                                    $type = __('transaction.sale_invoice');
                                } elseif ($sale->type == 3) {
                                    $type = __('transaction.general_sale_return');
                                }
                            @endphp
                            <h1>{{ $type . ' #' . $sale->id }}</h1>
                            <h2>{{ __('transaction.date') . ': ' . $sale->invoice_date }}</h2>
                            <h2>{{ __('transaction.sale_type') . ': ' . __('transaction.' . App\Models\Sale::SALEINVOICETYPE[$sale->invoice_sale_type]) }}</h2>
                            <h2>{{ __('transaction.paid_amount') . ': ' . $sale->paid }}</h2>
                            <h2>{{ __('transaction.remain_amount') . ': ' . $sale->remains }}</h2>
                        </div>
                    </div>
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
                        @foreach ($sale->saleProducts as $product)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="strong mb-1">
                                        {{ $product->item->name }}

                                    </div>
                                    @if ($product->production_date)
                                        <div class="text-muted">{{ __('transaction.production_date') . ' : ' }} {{ $product->production_date }}</div>
                                        <div class="text-muted">{{ __('transaction.expiration_date') . ' : ' }} {{ $product->expiration_date }}</div>
                                    @endif
                                    <div class="text-muted">{{ __('stock.store') . ': ' . $product->store->name }}</div>

                                    <div class="mt-3">
                                        @php
                                            echo DNS1D::getBarcodeHTML($product->item->barcode, 'C39');
                                        @endphp
                                    </div>
                                </td>
                                <td class="text-center">{{ $product->qty }}
                                </td>
                                <td class="text-end">{{ $product->unit_price }}</td>
                                <td class="text-end">{{ $product->total_price }}</td>
                            </tr>
                        @endforeach
                        <tr>
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
                        </tr>
                    </table>
                    <p class="text-muted text-center mt-5">{{ __('msgs.thanks_for_sale_from_us') }}</p>
                    <div class="mt-4 text-center">
                        <a class="btn btn-info" href="{{ route('admin.sales.invoice.pdf', ['sale' => $sale]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                            </svg>
                            {{ __('btns.print') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>
