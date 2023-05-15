<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);


        body {
            background: #E0E0E0;
            font-family: 'Roboto', sans-serif;
        }

        ::selection {
            background: #f31544;
            color: #FFF;
        }

        ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        .clearfix {
            display: flex;
            gap: 1rem;
            justify-content: space-between;
        }

        .col-left {
            display: flex;
            gap: 1rem
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .col-left {
            float: left;
        }

        .col-right {
            float: right;
        }



        #invoiceholder {
            width: 100%;
            height: 100%;
            padding: 50px 0;
        }

        #invoice {
            position: relative;
            margin: 0 auto;
            width: 700px;
            background: #FFF;
        }

        [id*='invoice-'] {
            /* Targets all id with 'col-' */
            /*  border-bottom: 1px solid #EEE;*/
            padding: 20px;
        }

        #invoice-top {
            border-bottom: 2px solid;
        }

        #invoice-mid {
            min-height: 110px;
        }

        #invoice-bot {
            min-height: 240px;
        }

        .logo {
            display: inline-block;
            vertical-align: middle;
            width: 110px;
            overflow: hidden;
        }

        .info {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
        }

        .logo img,
        .clientlogo img {
            width: 100%;
        }

        .clientlogo {
            display: inline-block;
            vertical-align: middle;
            width: 50px;
        }

        .clientinfo {
            display: inline-block;
            vertical-align: middle;
        }

        .title {
            float: right;
        }

        .title p {
            text-align: right;
        }

        #message {
            margin-bottom: 30px;
            display: block;
        }

        h2 {
            margin-bottom: 5px;
            color: #444;
        }

        .col-right td {
            color: #666;
            padding: 5px 8px;
            border: 0;
            font-size: 0.75em;
            border-bottom: 1px solid #eeeeee;
        }

        .col-right td label {
            margin-left: 5px;
            font-weight: 600;
            color: #444;
        }

        .cta-group a {
            display: inline-block;
            padding: 7px;
            border-radius: 4px;
            background: rgb(196, 57, 10);
            margin-right: 10px;
            min-width: 100px;
            text-align: center;
            color: #fff;
            font-size: 0.75em;
        }

        .cta-group .btn-primary {
            background: ;
        }

        .cta-group.mobile-btn-group {
            display: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #cccaca;
            font-size: 0.70em;
            text-align: left;
        }

        .tabletitle th {
            border-bottom: 2px solid #ddd;
            text-align: right;
        }

        .tabletitle th:nth-child(2) {
            text-align: left;
        }

        th {
            font-size: 0.7em;
            text-align: left;
            padding: 5px 10px;
        }

        .item {
            width: 50%;
        }



        .list-item td:nth-child(2) {
            text-align: left;
        }

        .total-row th,
        .total-row td {
            text-align: right;
            font-weight: 700;
            font-size: .75em;
            border: 0 none;
        }

        .table-main {}

        footer {
            border-top: 1px solid #eeeeee;
            ;
            padding: 15px 20px;
        }

        .effect2 {
            position: relative;
        }

        .effect2:before,
        .effect2:after {
            z-index: -1;
            position: absolute;
            content: "";
            bottom: 15px;
            left: 10px;
            width: 50%;
            top: 80%;
            max-width: 300px;
            background: #777;
            -webkit-box-shadow: 0 15px 10px #777;
            -moz-box-shadow: 0 15px 10px #777;
            box-shadow: 0 15px 10px #777;
            -webkit-transform: rotate(-3deg);
            -moz-transform: rotate(-3deg);
            -o-transform: rotate(-3deg);
            -ms-transform: rotate(-3deg);
            transform: rotate(-3deg);
        }

        .effect2:after {
            -webkit-transform: rotate(3deg);
            -moz-transform: rotate(3deg);
            -o-transform: rotate(3deg);
            -ms-transform: rotate(3deg);
            transform: rotate(3deg);
            right: 10px;
            left: auto;
        }

        @media screen and (max-width: 767px) {
            h1 {
                font-size: .9em;
            }

            #invoice {
                width: 100%;
            }

            #message {
                margin-bottom: 20px;
            }

            [id*='invoice-'] {
                padding: 20px 10px;
            }

            .logo {
                width: 140px;
            }

            .title {
                float: none;
                display: inline-block;
                vertical-align: middle;
                margin-left: 40px;
            }

            .title p {
                text-align: left;
            }

            .col-left,
            .col-right {
                width: 100%;
            }

            .table {
                margin-top: 20px;
            }

            table thead {
                border: 1px solid #cccaca
            }

            #table {
                white-space: nowrap;
                overflow: auto;
            }

            td {
                white-space: normal;
            }

            .cta-group {
                text-align: center;
            }

            .cta-group.mobile-btn-group {
                display: block;
                margin-bottom: 20px;
            }

            /*==================== Table ====================*/

            .table-main thead {
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
                border: 1px solid #cccaca;
            }

            .table-main tr {
                border-bottom: 2px solid #eee;
                display: block;
                margin-bottom: 20px;
            }

            .table-main td {
                font-weight: 700;
                display: block;
                padding-left: 40%;
                max-width: none;
                position: relative;
                border: 1px solid #cccaca;
                text-align: left;
            }

            .table-main td:before {
                /*
        * aria-label has no advantage, it won't be read inside a table
        content: attr(aria-label);
        */
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: normal;
                text-transform: uppercase;
            }

            .total-row th {
                display: none;
            }

            .total-row td {
                text-align: left;
            }

            footer {
                text-align: center;
            }


        }

        @import url('https://fonts.googleapis.com/css?family=Amarante');

        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
            outline: none;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        html {
            overflow-y: scroll;
        }

        body {
            background: #eee url('https://i.imgur.com/eeQeRmk.png');
            /* https://subtlepatterns.com/weave/ */
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 62.5%;
            line-height: 1;
            color: #585858;
            padding: 22px 10px;
            padding-bottom: 55px;
        }

        ::selection {
            background: #5f74a0;
            color: #fff;
        }

        ::-moz-selection {
            background: #5f74a0;
            color: #fff;
        }

        ::-webkit-selection {
            background: #5f74a0;
            color: #fff;
        }

        br {
            display: block;
            line-height: 1.6em;
        }

        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        ol,
        ul {
            list-style: none;
        }

        input,
        textarea {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            outline: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: '';
            content: none;
        }

        strong,
        b {
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        img {
            border: 0;
            max-width: 100%;
        }


        /** page structure **/
        #wrapper {
            display: block;
            background: #fff;
            margin: 0 auto;
            padding: 10px 17px;
        }

        #keywords {
            margin: 0 auto;
            font-size: 1.2em;
            margin-bottom: 15px;
        }


        #keywords thead {
            cursor: pointer;
            background: #c9dff0;
        }

        #keywords thead tr th {
            font-weight: bold;
            padding: 12px 9px;
            padding-left: 42px;
        }

        #keywords thead tr th span {
            padding-right: 20px;
            background-repeat: no-repeat;
            background-position: 100% 100%;
        }

        #keywords thead tr th.headerSortUp,
        #keywords thead tr th.headerSortDown {
            background: #acc8dd;
        }

        #keywords thead tr th.headerSortUp span {
            background-image: url('https://i.imgur.com/SP99ZPJ.png');
        }

        #keywords thead tr th.headerSortDown span {
            background-image: url('https://i.imgur.com/RkA9MBo.png');
        }


        #keywords tbody tr {
            color: #555;
        }

        #keywords tbody tr td {
            text-align: center;
            padding: 15px 10px;
        }

        #keywords tbody tr td.lalign {
            text-align: left;
        }

        h1 {
            font-size: 1.5em;
            color: #444;
        }

        h2 {
            font-size: .9em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .75em;
            color: #666;
            line-height: 1.2em;
        }

        a {
            text-decoration: none;
            color: ;
        }
    </style>
</head>

<body>

    <body>
        <div id="invoiceholder">
            <div id="invoice" class="effect2">

                <div id="invoice-top">
                    <div>
                        <h1>{{ $company->getTranslation('name', 'en') }}</h1>
                    </div>
                    <div class="title">
                        @php
                            $type = $sale->type == 1 ? __('transaction.sale_invoice') : __('transaction.general_order_return');
                        @endphp
                        <h1>{{ $type }} #<span class="invoiceVal invoice_num">{{ $sale->id }}</span></h1>
                        <p>Invoice Date: <span id="invoice_date">{{ $sale->invoice_date }}</span><br>
                        </p>
                    </div>
                    <!--End Title-->
                </div>
                <!--End InvoiceTop-->



                <div id="invoice-mid">
                    <div id="message">
                        <h2>Hello {{ $sale->customer->name }},</h2>
                        <p>The {{ $type }} with invoice number #<span id="invoice_num">{{ $sale->id }}</span> is created for
                            <span id="supplier_name">{{ $company->getTranslation('name', 'en') }}</span> which is 100% matched with PO.
                        </p>
                    </div>

                    <div class="clearfix">
                        <div class="col-left">
                            <div class="clientlogo">
                                <img src="https://cdn3.iconfinder.com/data/icons/daily-sales/512/Sale-card-address-512.png" alt="Sup" />
                            </div>
                            <div class="clientinfo">
                                <h2 id="supplier">{{ $company->getTranslation('name', 'en') }}</h2>
                                <p>
                                    <span id="address">{{ $company->address }}</span> <br>
                                    <span id="tax_num">{{ $company->email }}</span><br>
                                    <span id="tax_num">{{ $company->mobile }}</span><br>
                                </p>
                            </div>
                        </div>
                        <div class="col-right">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><span>Invoice Total</span><label id="invoice_total">{{ $sale->cost_after_discount }}</label></td>
                                        <td><span>Currency</span><label id="currency">EUR</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><span>Sale type</span>: <label id="note">{{ App\Models\Sale::SALEINVOICETYPE[$sale->invoice_sale_type] }}</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><span>Note</span>: <label id="note">{{ $sale->notes ?? '' }}</label></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--End Invoice Mid-->

                <div id="wrapper">
                    <table id="keywords" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th><span>Item</span></th>
                                <th><span>Store</span></th>
                                <th><span>QTY</span></th>
                                <th><span>Unit Price</span></th>
                                <th><span>Total</span></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->saleProducts as $product)
                                <tr class="lalign">
                                    <td data-label="Type" class="tableitem">
                                        {{ $product->item->name }}
                                        @if ($product->production_date)
                                            Production date : {{ $product->production_date }} - <br>
                                            Expiry date :{{ $product->expiration_date }}
                                        @endif
                                    </td>
                                    <td data-label="Quantity" class="tableitem">{{ $product->store->name }}</td>
                                    <td data-label="Quantity" class="tableitem">{{ $product->qty }}</td>
                                    <td data-label="Unit Price" class="tableitem">{{ $product->unit_price }}</td>
                                    <td data-label="Total" class="tableitem">{{ $product->total_price }}</td>
                                </tr>
                            @endforeach
                            <tr class="lalign total-row">
                                <th colspan="4" class="tableitem">Items cost</th>
                                <td data-label="Grand Total" class="tableitem">{{ $sale->items_cost }}</td>
                            </tr>
                            <tr class="lalign total-row">
                                <th colspan="4" class="tableitem">Tax</th>
                                <td data-label="Grand Total" class="tableitem">{{ $sale->tax_type == 0 ? '%' : '$' }}{{ $sale->tax_value }}</td>
                            </tr>
                            <tr class="lalign total-row">
                                <th colspan="4" class="tableitem">Cost before Discount</th>
                                <td data-label="Grand Total" class="tableitem">{{ $sale->cost_before_discount }}</td>
                            </tr>
                            <tr class="lalign total-row">
                                <th colspan="4" class="tableitem">Discount</th>
                                <td data-label="Grand Total" class="tableitem"> {{ $sale->discount_type == 0 ? '%' : '$' }}{{ $sale->discount_value }}</td>
                            </tr>
                            <tr class="lalign total-row">
                                <th colspan="4" class="tableitem">Grand Price</th>
                                <td data-label="Grand Total" class="tableitem"> {{ $sale->cost_after_discount }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <footer>
                        <div id="legalcopy" class="clearfix">
                            <p class="col-right">Our mailing address is:
                                <span class="email"><a href="mailto:supplier.portal@almonature.com">{{ $company->email }}</a></span>
                            </p>
                        </div>
                    </footer>
                </div>
                <!--End InvoiceBot-->
            </div>
            <!--End Invoice-->
        </div><!-- End Invoice Holder-->
    </body>
</body>

</html>
