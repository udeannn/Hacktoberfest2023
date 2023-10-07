<html>

<head>
    <title>{{ $order->invoice_code }}</title>
    <style type="text/css">
        a,
        .no-print,
        .modal-open.wrapper,
        .main-footer,
        .view-link,
        .dataTables_length,
        .dataTables_filter {
            display: none !important;
        }

        .box {
            border-top: none !important;
        }

        .box-header.with-border {
            border-bottom: none;
        }

        .close,
        .btn {
            display: none !important
        }

        .text-right {
            text-align: right !important;
        }

        .print-btn {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 30px;
            z-index: 1251;
            background: #81ECFF;
            line-height: 30px;
            text-align: center;
            cursor: pointer;
        }

        /*Common CSS*/
        .receipt-template {
            width: 302px;
            margin: 0 auto;
        }

        .receipt-template .text-small {
            font-size: 10px;
        }

        .receipt-template .block {
            display: block;
        }

        .receipt-template .inline-block {
            display: inline-block;
        }

        .receipt-template .bold {
            font-weight: 700;
        }

        .receipt-template .italic {
            font-style: italic;
        }

        .receipt-template .align-right {
            text-align: right;
        }

        .receipt-template .align-center {
            text-align: center;
        }

        .receipt-template .main-title {
            font-size: 10px;
            font-weight: 700;
            text-align: center;
            margin: 10px 0 5px 0;
            padding: 0;
        }

        .receipt-template .heading {
            position: relation;
        }

        .receipt-template .title {
            font-size: 12px;
            font-weight: 700;
            margin: 10px 0 5px 0;
        }

        .receipt-template .sub-title {
            font-size: 12px;
            font-weight: 700;
            margin: 10px 0 5px 0;
        }

        .receipt-template table {
            width: 100%;
        }

        .receipt-template td,
        .receipt-template th {
            font-size: 10px;
        }

        .receipt-template .info-area {
            font-size: 12px;
            line-height: 1.222;
        }

        .receipt-template .listing-area {
            line-height: 1.222;
        }

        .receipt-template .listing-area table {
            margin-top: 5px;
        }

        .receipt-template .listing-area table thead tr {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            font-weight: 700;
        }

        .receipt-template .listing-area table tbody tr {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
        }

        .receipt-template .listing-area table tbody tr:last-child {
            border-bottom: none;
        }

        .receipt-template .listing-area table td {
            vertical-align: top;
        }

        .receipt-template .info-area table {}

        .receipt-template .info-area table thead tr {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }

        /*Receipt Heading*/
        .receipt-template .receipt-header {
            text-align: center;
        }

        .receipt-template .receipt-header .logo-area {
            width: 80px;
            height: 80px;
            margin: 0 auto;
        }

        .receipt-template .receipt-header .logo-area img.logo {
            display: inline-block;
            max-width: 100%;
            max-height: 100%;
        }

        .receipt-template .receipt-header .address-area {
            margin-bottom: 5px;
            line-height: 1;
        }

        .receipt-template .receipt-header .info {
            font-size: 10px;
        }

        .receipt-template .receipt-header .store-name {
            font-size: 10px;
            font-weight: 700;
            margin: 0;
            padding: 0;
        }


        /*Invoice Info Area*/
        .receipt-template .invoice-info-area {}

        /*Customer Customer Area*/
        .receipt-template .customer-area {
            margin-top: 10px;
        }

        /*Calculation Area*/
        .receipt-template .calculation-area {
            border-top: 2px solid #000;
            font-weight: bold;
        }

        .receipt-template .calculation-area table td {
            text-align: right;
        }

        .receipt-template .calculation-area table td:nth-child(2) {
            border-bottom: 1px dashed #000;
        }

        /*Item Listing*/
        .receipt-template .item-list table tr {}

        /*Barcode Area*/
        .receipt-template .barcode-area {
            margin-top: 10px;
            text-align: center;
        }

        .receipt-template .barcode-area img {
            max-width: 100%;
            display: inline-block;
        }

        /*Footer Area*/
        .receipt-template .footer-area {
            line-height: 1.222;
            font-size: 10px;
            margin-top: 10px;
        }

        /*Media Query*/
        @media print {
            .receipt-template {
                width: 100%;
            }
        }

        @media all and (max-width: 215px) {}
    </style>
</head>

<body style="background:#ffffff;">
    <div class="col-xs-12 col-md-12">

        <section class="receipt-template">

            <header class="receipt-header">
                <div class="logo-area">
                    <img class="logo" src="{{ $setting->logo }}">
                </div>
                {{-- <h3 class="store-name">{{ $setting?->store_name ?? 'SimplePos' }}</h3> --}}
                <div class="address-area">
                    <span class="info address">{{ $setting?->address ?? '-' }}</span>
                    <div class="block">
                        <span class="info phone">Mobile: {{ $setting?->phone_number ?? '-' }}</span>
                        <br>
                        <span class="info email">Email:
                            {{ $setting?->email ?? '-' }}</span>
                    </div>
                </div>
            </header>

            <section class="info-area">
                <table>
                    <tbody>
                        <tr>
                            <td class="w-30"><span>Invoice Code:</span></td>
                            <td>{{ $order->invoice_code }}</td>
                        </tr>
                        <tr>
                            <td class="w-30"><span>Date:</span></td>
                            <td>{{ dateFormater($order->created_at) }}</td>
                        </tr>
                        <tr>
                            <td class="w-30">Customer:</td>
                            <td>{{ $order->customer?->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="w-30">Phone:</td>
                            <td>{{ $order->customer?->phone_number ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="w-30">Address:</td>
                            <td>{{ $order->customer?->address ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            {{-- <h4 class="main-title">INVOICE</h4> --}}

            <section class="listing-area item-list">
                <table>
                    <thead>
                        <tr>
                            <td class="w-40 text-center">Name</td>
                            <td class="w-15 text-center">Qty</td>
                            <td class="w-15 text-right">Price</td>
                            <td class="w-20 text-right">Amount</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalAmount = 0;
                        @endphp
                        @foreach ($order->detail as $item)
                            @php
                                $amountPerItem = $item->stock->qty * $item->stock->selling_price;
                                $totalAmount += $amountPerItem;
                            @endphp
                            <tr>
                                <td>{{ substr($item->stock->product->name, 0, 15) }}
                                <td class="text-right">{{ rupiah($item->stock->qty, '') }}</td>
                                <td class="text-right">{{ rupiah($item->stock->selling_price, '') }}</td>
                                <td class="text-right">{{ rupiah($amountPerItem, '') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

            <section class="info-area calculation-area">
                <table>
                    <tbody>
                        <tr>
                            <td class="w-70">Sub Total:</td>
                            <td>{{ rupiah($totalAmount, '') }}</td>
                        </tr>
                        <tr>
                            <td class="w-70">Discount:</td>
                            <td>{{ rupiah($order->discount, '') }}</td>
                        </tr>
                        <tr>
                            <td class="w-70">Total Due:</td>
                            <td>{{ rupiah($totalAmount - $order->discount, '') }}</td>
                        </tr>
                        <tr>
                            <td class="w-70">Paid:</td>
                            <td>{{ rupiah($order->paid, '') }}</td>
                        </tr>
                        <tr>
                            <td class="w-70">Change:</td>
                            <td>{{ rupiah($order->paid - ($totalAmount - $order->discount), '') }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            {{-- <section class="info-area italic">
                <span class="text-small"><b>In Text:</b> One Hundred Fifty only</span><br>
            </section> --}}


            {{-- <section class="listing-area payment-list">
                <div class="heading">
                    <h2 class="sub-title">Payments</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td class="w-10 text-center">Sl.</td>
                            <td class="w-50 text-center">Payment Method</td>
                            <td class="w-20 text-right">Amount</td>
                            <td class="w-20 text-right">Balance</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>Cash on Delivery by Your Name on 7 Apr 2023 3:48 AM</td>
                            <td class="text-right">200.00</td>
                            <td class="text-right">50.00</td>
                        </tr>

                    </tbody>
                </table>
            </section> --}}

            <section class="info-area align-center footer-area">
                <span class="block bold">Thank you for shopping with us.</span>
            </section>

        </section>
    </div>
    <script>
        window.print();
        window.onafterprint = back;

        function back() {
            // redirect back & reload page
            window.history.back();
            location.reload();
        }
    </script>
</body>

</html>
