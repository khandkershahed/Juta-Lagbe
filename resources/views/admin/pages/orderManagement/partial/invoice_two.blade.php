<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }

        .container {
            width: 100%;
        }

        .header {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .header-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .header-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            text-align: right;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin: 0;
        }

        .muted {
            color: #666;
        }

        .section {
            margin: 10px 0 15px;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-top: 10px;
        }

        .info-col {
            display: table-cell;
            width: 33.33%;
            vertical-align: top;
        }

        .separator {
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #252525;
            color: #fff;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        .text-end {
            text-align: right;
        }

        .footer {
            background: #252525;
            color: #fff;
            text-align: center;
            padding: 10px;
            margin-top: 15px;
        }

        .product-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 4px;
        }

        .bold {
            font-weight: bold;
        }

        .fs-16 {
            font-size: 16px;
        }

        .fs-18 {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <div class="title">INVOICE</div>
            </div>
            <div class="header-right">
                <div>
                    <img src="{{ public_path('images/default_logo.png') }}" style="max-width: 140px;">
                </div>
                <div class="muted" style="margin-top: 8px;">
                    <div>
                        {{ optional($setting)->address_line_one }}
                        @if (optional($setting)->address_line_two)
                            , {{ optional($setting)->address_line_two }}
                        @endif
                    </div>
                    <div>{{ optional($setting)->primary_phone }}</div>
                </div>
            </div>
        </div>

        <div class="section bold fs-16">
            Dear, <span>{{ optional($order->user)->name }}</span><br>
            <span class="muted">{{ optional($order->user)->email }}</span><br>
            <span class="muted">Here are your order details. Thank you for your purchase.</span>
        </div>

        <div class="separator"></div>

        <div class="info-row bold">
            <div class="info-col">
                <div class="muted">অর্ডার আইডি</div>
                <div>#{{ optional($order)->order_number }}</div>
            </div>
            <div class="info-col">
                <div class="muted">অর্ডার ডেট</div>
                <div>{{ optional($order)->created_at->format('d M, Y') }}</div>
            </div>
            <div class="info-col">
                <div class="muted">ইনভয়েস আইডি</div>
                <div>#{{ optional($order)->order_number }}</div>
            </div>
        </div>

        <div class="section">
            <div class="bold muted">Shipping Address</div>
            <div>{{ optional($order)->thana }}, {{ optional($order)->address }}</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>প্রোডাক্ট</th>
                    <th class="text-end">কোড</th>
                    <th class="text-end">কোয়ান্টিটি</th>
                    <th class="text-end">টোটাল</th>
                </tr>
            </thead>
            <tbody>
                @foreach (optional($order)->orderItems as $item)
                    <tr>
                        <td>
                            <div style="display: table; width: 100%;">
                                <div style="display: table-cell; width: 50px; vertical-align: middle;">
                                    @php
                                        $thumb = optional($item->product)->thumbnail
                                            ? public_path('storage/' . optional($item->product)->thumbnail)
                                            : null;
                                    @endphp
                                    @if ($thumb && file_exists($thumb))
                                        <img class="product-img" src="{{ $thumb }}">
                                    @endif
                                </div>
                                <div style="display: table-cell; vertical-align: middle;">
                                    <div class="bold">{{ optional($item->product)->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-end">{{ optional($item->product)->sku_code }}</td>
                        <td class="text-end">{{ optional($item)->quantity }}</td>
                        <td class="text-end">{{ optional($item)->quantity * optional($item)->price }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="3" class="text-end bold">প্রোডাক্টের দাম</td>
                    <td class="text-end">৳ {{ $order->total_amount - $order->shipping_charge }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end bold">ডেলিভারি চার্জ</td>
                    <td class="text-end">৳ {{ $order->shipping_charge }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end bold">পেইড এমাউন্ট</td>
                    <td class="text-end">
                        @if ($order->payment_status == 'delivery_charge_paid')
                            ৳ {{ $order->shipping_charge }}
                        @elseif ($order->payment_status == 'completely_paid')
                            ৳ {{ $order->total_amount }}
                        @elseif ($order->payment_status == 'cod')
                            ৳ 0
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end bold">ডিউ এমাউন্ট</td>
                    <td class="text-end">
                        @if ($order->payment_status == 'delivery_charge_paid')
                            ৳ {{ $order->total_amount - $order->shipping_charge }}
                        @elseif ($order->payment_status == 'completely_paid')
                            ৳ 0
                        @elseif ($order->payment_status == 'cod')
                            ৳ {{ $order->total_amount }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end bold fs-18">সর্ব মোট</td>
                    <td class="text-end bold fs-18">৳ {{ optional($order)->total_amount }}.00</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            © {{ optional($setting)->website_name }}, LTD 2024.
        </div>
    </div>
</body>

</html>
