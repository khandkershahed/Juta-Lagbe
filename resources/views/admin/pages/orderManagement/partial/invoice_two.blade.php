<div class="mx-4 mt-4 row" id="invoiceContent{{ optional($order)->id }}">
    <div class="col-12">
        <div id="card-print-{{ optional($order)->id }}" class="px-0 shadow-sm card card-print w-100">
            <div class="px-4 card-body">
                <div class="mx-auto w-100">
                    <div class="px-10 d-flex justify-content-between flex-column flex-sm-row mb-19">
                        <h4 class="text-gray-800 fw-bolder fs-2qx pe-5 pb-7">INVOICE</h4>

                        <div class="text-sm-end">
                            <a href="#" class="d-block mw-150px ms-sm-auto">
                                <img alt="Logo" src="{{ asset('images/default_logo.png') }}" class="w-100">
                            </a>

                            <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
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

                    <div class="d-flex flex-column gap-7 gap-md-10">
                        <div class="fw-bold fs-2">
                            Dear, <span class="text-info">{{ optional($order->user)->name }}</span> <br>
                            <span class="fs-6">{{ optional($order->user)->email }} </span>
                            <span class="text-muted fs-5">Here are your order details. Thank you for
                                your purchase.</span>
                        </div>

                        <div class="separator"></div>

                        <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">অর্ডার আইডি</span>
                                <span class="fs-5">#{{ optional($order)->order_number }}</span>
                            </div>

                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">অর্ডার ডেট</span>
                                <span class="fs-5">{{ optional($order)->created_at->format('d M, Y') }}</span>
                            </div>

                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">ইনভয়েস আইডি</span>
                                <span class="fs-5">#{{ optional($order)->order_number }}</span>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                            <div class="flex-root d-flex flex-column">
                                <span class="text-muted">Shipping Address</span>
                                <span class="fs-6">
                                    {{ optional($order)->thana }}, {{ optional($order)->address }},
                                </span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between flex-column">
                            <div class="table-responsive border-bottom">
                                <table class="table mb-0 align-middle table-row-dashed fs-6 gx-5 gy-5">
                                    <thead style="background-color: #252525">
                                        <tr class="border-bottom fs-6 fw-bold text-muted">
                                            <th class="">প্রোডাক্ট</th>
                                            <th class="text-end ">কোড</th>
                                            <th class="text-end ">কোয়ান্টিটি</th>
                                            <th class="pl-5 text-end">টোটাল</th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-gray-600 fw-semibold">
                                        @foreach (optional($order)->orderItems as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            @php
                                                                $thumbnailPath =
                                                                    'storage/' . optional($item->product)->thumbnail;
                                                                $thumbnailSrc = asset($thumbnailPath);
                                                            @endphp
                                                            <img class="cart-img" width="50"
                                                                src="{{ $thumbnailSrc }}"
                                                                alt="{{ optional($item->product)->name }}">
                                                        </div>

                                                        <div class="ms-5 text-start">
                                                            <div class="fw-bold text-start">
                                                                {{ optional($item->product)->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    {{ optional($item->product)->sku_code }} </td>
                                                <td class="text-end">
                                                    {{ optional($item)->quantity }}
                                                </td>
                                                <td class="text-end">
                                                    {{ optional($item)->quantity * optional($item)->price }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="text-end">
                                                প্রোডাক্টের দাম
                                            </td>
                                            <td class="text-end">
                                                ৳ {{ $order->total_amount - $order->shipping_charge }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end">
                                                ডেলিভারি চার্জ
                                            </td>
                                            <td class="text-end">
                                                ৳ {{ $order->shipping_charge }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end">
                                                পেইড এমাউন্ট
                                            </td>
                                            <td class="text-end">
                                                @if ($order->payment_status == 'delivery_charge_paid')
                                                    <span
                                                        class="text-info fw-bold">৳</span>{{ $order->shipping_charge }}
                                                @elseif ($order->payment_status == 'completely_paid')
                                                    <span class="text-info fw-bold">৳</span>{{ $order->total_amount }}
                                                @elseif ($order->payment_status == 'cod')
                                                    <span class="text-info fw-bold">৳</span>0
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end">
                                                ডিউ এমাউন্ট
                                            </td>
                                            <td class="text-end">
                                                @if ($order->payment_status == 'delivery_charge_paid')
                                                    <span
                                                        class="text-info fw-bold">৳</span>{{ $order->total_amount - $order->shipping_charge }}
                                                @elseif ($order->payment_status == 'completely_paid')
                                                    <span class="text-info fw-bold">৳</span>0
                                                @elseif ($order->payment_status == 'cod')
                                                    <span class="text-info fw-bold">৳</span>{{ $order->total_amount }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-gray-900 fs-3 fw-bold text-end">
                                                সর্ব মোট
                                            </td>
                                            <td class="text-gray-900 fs-3 fw-bolder text-end">
                                                ৳ {{ optional($order)->total_amount }}.00
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="p-4 text-center text-white border-0 card-footer" style="background-color: #252525;">
                © {{ optional($setting)->website_name }}, LTD 2024.
            </div>
        </div>
    </div>
</div>

<div class="pt-10 d-flex justify-content-center align-items-center">
    <button id="downloadInvoiceBtn" type="button"
        class="p-3 ml-3 btn btn-dark rounded-pill d-flex align-items-center gap-2 js-download-invoice">
        <span class="btn-text">
            <i class="fa-solid fa-file-download"></i>
            ইনভয়েস ডাউনলোড করুন
        </span>

        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
    </button>


</div>
