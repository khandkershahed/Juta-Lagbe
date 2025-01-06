<style>
    @import url("https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap");

    body {
        font-family: "Rajdhani", sans-serif;
    }
</style>
<div style="margin: 0; padding: 0; background-color: #f8f9fa">
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f8f9fa; padding: 20px 0">
        <tr>
            <td align="center">
                <table class="container" width="600" cellspacing="0" cellpadding="0" border="0"
                    style="max-width: 480px;margin: 0 auto;background-color: #ffffff;padding: 0px;border: 1px solid #ddd;border-radius: 5px;">
                    <tr>
                        <td class="header"
                            style="text-align: center; padding: 0px; background-color: #500066; color: #ffffff; border-radius: 5px 5px 0 0;">
                            <table style="width: 100%; border-spacing: 0; text-align: center;">
                                <tr>
                                    <td>
                                        <img src="https://i.ibb.co.com/PrHfD92/Ardhanggini-logo-White.png"
                                            alt="Logo"
                                            style="max-width: 100%; height: 60px; margin: 20px auto; display: block;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="text-align: center; color: #fff; width: 75%; margin: auto; padding-top: 0px; padding-bottom: 30px;">
                                        <div style="padding-left: 5px; padding-right: 5px;">
                                            <h1>Your order is on the way!</h1>
                                            <p style="font-weight: 500; margin: 0;">
                                                We received your order today <span style="font-weight: bold;">"
                                                    {{ $data['order']->order_created_at }}"
                                                </span>.<br>Thank you for your order!
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <img style="height: 250px;width: 100%;object-fit: cover;margin-bottom: -6px;"
                                    src="{{ asset('frontend/img/order_mail.gif') }}" alt=""/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="content"
                            style="text-align: center;padding: 20px;background-color: #e0e0e04a;color: #ffffff;border-radius: 5px 5px 0 0;">
                            <h1 style="color: #252525">
                                Order Number : <span style="color: #9c27b0">{{ $data['order']->order_number }}</span>
                            </h1>
                            <div style="padding-bottom: 15px;">
                                <a class="" href="{{ route('user.order.history') }}"
                                    style="color: #252525; font-weight: bold">
                                    <p>See Your Order Details and History</p>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class=""
                                style="padding-left: 30px;padding-top: 30px;padding-bottom: 30px;padding-right: 30px;font-weight: 500;">
                                <p>Order Summary</p>
                                <div class="">
                                    <table class="table" style="width: 100%">
                                        <thead>
                                            <tr style="background-color: #eee">
                                                <th width="5%">Sl</th>
                                                <th width="60%" style="text-align: start; padding: 15px">
                                                    Product Name
                                                </th>
                                                <th width="10%" style="text-align: center">Qty</th>
                                                <th width="25%" style="text-align: end; padding-right: 10px">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['order_items'] as $item)
                                                <tr class="">
                                                    <td style="padding: 10px; text-align: start">{{ $loop->iteration }}
                                                    </td>
                                                    <td style="padding: 10px; text-align: start">
                                                        {{ $item->product_name }}
                                                    </td>
                                                    <td style="padding: 10px; text-align: center">{{ $item->quantity }}
                                                    </td>
                                                    <td style="text-align: end; padding-right: 10px">
                                                        ৳ {{ optional($item)->price }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                            {{-- <tr class="">
                                                <td style="text-align: end;font-weight: bold;padding: 10px;border-top: 1px solid #252525;"
                                                    colspan="3">
                                                    Total
                                                </td>
                                                <td
                                                    style="text-align: end;padding: 10px;border-top: 1px solid #252525;">
                                                    ৳ {{ number_format($data['order']->total_amount, 2) }}
                                                </td>
                                            </tr> --}}
                                            <tr class="">
                                                <td colspan="2"
                                                    style="text-align: end; font-weight: bold; padding: 10px;">
                                                    Delivery Charge ({{ ($data['shipping_charge'] > 0) ? $data['shipping_method'] : 'Free Shipping' }})
                                                </td>
                                                <td colspan="2" style="text-align: end; padding: 10px;">
                                                    ৳ {{ $data['shipping_charge'] }}
                                                </td>
                                            </tr>
                                            <tr class="">
                                                <td colspan="2"
                                                    style="text-align: end; font-weight: bold; padding: 10px; border-top: 1px solid #252525;">
                                                    Total
                                                </td>
                                                <td colspan="2"
                                                    style="text-align: end; padding: 10px; border-top: 1px solid #252525;">
                                                    ৳ {{ number_format($data['order']->total_amount, 2) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer"
                            style="text-align: center;padding: 10px 0;background-color: #eee;color: #252525;border-radius: 0 0 5px 5px;">
                            <p style="margin: 0; font-size: 16px; padding: 15px;">
                                &copy; Copyright @ 2024 Ardhanggini, All rights reserved <a
                                    href="ardhanggini.com">ardhanggini.com</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
