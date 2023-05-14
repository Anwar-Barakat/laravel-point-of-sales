<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('transaction.sale_invoice') }}</title>

    <link href="{{ asset('backend/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/dist/css/demo.min.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="page-body pb-4">
        <div class="container-xl">
            <div class="page-body">
                <div class="container-xl">
                    <div class="card card-lg">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p class="h3">{{ __('setting.company') }}</p>
                                    <address>
                                        {{ $company->getTranslation('name', 'en') }}<br>
                                        {{ $company->address }}<br>
                                        {{ $company->email }}
                                    </address>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="h3">{{ __('stock.customer') }}</p>
                                    <address>
                                        {{ $sale->customer->name }} <br>
                                        {{ $sale->customer->address }}<br>
                                        {{ $sale->customer->email }}
                                    </address>
                                </div>
                                <div class="col-12 my-5">
                                    <h1>{{ __('transaction.invoice') . ' #' . $sale->id }}</h1>
                                    <h2>{{ __('transaction.date') . ': ' . $sale->invoice_date }}</h2>
                                    <h2>{{ __('transaction.sale_type') . ': ' . __('transaction.' . App\Models\Sale::SALEINVOICETYPE[$sale->invoice_sale_type]) }}</h2>
                                    <h2>{{ __('transaction.paid_amount') . ':' . $sale->paid }}</h2>
                                    <h2>{{ __('transaction.remain_amount') . ':' . $sale->remains }}</h2>
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
                                            <p class="strong mb-1">{{ $product->item->name }}</p>
                                            <div class="text-muted">{{ __('stock.store') . ': ' . $product->store->getTranslation('name', 'en') }}</div>
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
                                        {{ $sale->tax_value }}
                                        {{ $sale->tax_type == 0 ? '%' : '$' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="strong text-end">{{ __('transaction.cost_before_discount') }}</td>
                                    <td class="text-end">{{ $sale->cost_before_discount }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="strong text-end">{{ __('transaction.discount') }}</td>
                                    <td class="text-end">
                                        {{ $sale->discount_value }}
                                        {{ $sale->discount_type == 0 ? '%' : '$' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="font-weight-bold text-uppercase text-end">{{ __('transaction.final_price') }}</td>
                                    <td class="font-weight-bold text-end">{{ $sale->cost_after_discount }}</td>
                                </tr>
                            </table>
                            <p class="text-muted text-center mt-5">{{ __('msgs.thanks_for_sale_from_us') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
    <script src="{{ asset('backend/dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}" defer></script>
    <script src="{{ asset('backend/dist/libs/jsvectormap/dist/maps/world.js') }}" defer></script>
    <script src="{{ asset('backend/dist/libs/jsvectormap/dist/maps/world-merc.js') }}" defer></script>
    <script src="{{ asset('backend/dist/libs/tom-select/dist/js/tom-select.base.min.js') }}" defer></script>
    <script src="{{ asset('backend/dist/js/custom-select.js') }}"></script>

    <!-- Tabler Core -->
    <script src="{{ asset('backend/dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('backend/dist/js/demo.min.js') }}" defer></script>

</body>

</html>
