<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap"
    rel="stylesheet">

<style>
    /* ===== Bangla Fix for Invoice PDF ===== */

    .card-print,
    .card-print * {
        font-family: 'Noto Sans Bengali', system-ui, -apple-system, BlinkMacSystemFont, sans-serif !important;
        letter-spacing: 0 !important;
        word-spacing: 0 !important;
        line-height: 1.6 !important;

        /* CRITICAL */
        word-break: keep-all !important;
        overflow-wrap: normal !important;
        white-space: normal !important;
    }

    /* Prevent canvas text splitting */
    table,
    th,
    td,
    span,
    div {
        transform: translateZ(0);
    }
</style>

<div class="row" id="invoiceContent{{ $order->id }}">
    <div class="card card-print">
        <div class="card-body">
            <div class="mx-auto w-100">
                <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                    <h4 class="fw-bolder text-gray-800 fs-2qx pe-5 pb-7">INVOICE</h4>

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
                        Dear {{ optional($order->user)->first_name }} <span
                            class="fs-6">({{ optional($order->user)->email }} )</span>,<br>
                        <span class="text-muted fs-5">Here are your order details. Thank you for
                            your purchase.</span>
                    </div>

                    <div class="separator"></div>

                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">Order ID</span>
                            <span class="fs-5">#{{ $order->order_number }}</span>
                        </div>

                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">Date</span>
                            <span class="fs-5">{{ $order->created_at->format('d M, Y') }}</span>
                        </div>

                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">Invoice ID</span>
                            <span class="fs-5">#{{ $order->order_number }}</span>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">Billing Address</span>
                            <span class="fs-6">
                                {{ $order->billing_address }}
                            </span>
                        </div>

                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">Shipping Address</span>
                            <span class="fs-6">
                                {{ $order->shipping_address }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between flex-column">
                        <div class="table-responsive border-bottom mb-9">
                            <table class="table align-middle table-row-dashed fs-6 gx-5 gy-5 mb-0">
                                <thead>
                                    <tr class="border-bottom fs-6 fw-bold text-muted">
                                        <th class="min-w-175px pb-2 ps-5">Products</th>
                                        <th class="min-w-70px text-end pb-2">SKU</th>
                                        <th class="min-w-80px text-end pb-2">QTY</th>
                                        <th class="min-w-100px text-end pb-2 pe-5">Total</th>
                                    </tr>
                                </thead>

                                <tbody class="fw-semibold text-gray-600">
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0)" class="symbol symbol-50px">
                                                        <span class="symbol-label"
                                                            style="background-image:url({{ asset('storage/' . optional($item->product)->thumbnail) }});"></span>
                                                    </a>

                                                    <div class="ms-5">
                                                        <div class="fw-bold">
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
                                            মোট
                                        </td>
                                        <td class="text-end">
                                            ৳{{ optional($order)->sub_total }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">
                                            ডেলিভারি চার্জ
                                        </td>
                                        <td class="text-end">
                                            ৳{{ optional($order)->shipping_charge }}.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">
                                            অগ্রিম পরিশোধ
                                        </td>
                                        <td class="text-end">
                                            @if ($order->payment_status == 'delivery_charge_paid')
                                                ৳{{ optional($order)->shipping_charge }}.00
                                            @else
                                                ৳ 00.00
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="fs-3 text-gray-900 fw-bold text-end">
                                            সর্বমোট বকেয়া
                                        </td>
                                        <td class="text-gray-900 fs-3 fw-bolder text-end">
                                            @if ($order->payment_status == 'delivery_charge_paid')
                                                ৳
                                                {{ optional($order)->total_amount - optional($order)->shipping_charge }}.00
                                            @else
                                                ৳ {{ optional($order)->total_amount }}.00
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-info ml-3 p-3" onclick="downloadInvoice()">
                            <i class="fa-solid fa-file-download"></i> Download Invoice
                        </button>
                        <button class="btn btn-danger ml-3 p-3" data-bs-dismiss="modal" aria-label="close"> Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-footer p-4 text-center border-0" style="background-color: #e1ecff;">
            © {{ optional($setting)->website_name }}
        </div>
    </div>
</div>
