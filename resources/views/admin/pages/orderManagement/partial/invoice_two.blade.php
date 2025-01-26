<div class="modal fade" id="printInovice{{ optional($order)->id }}" tabindex="-1"
    aria-labelledby="printInovice{{ optional($order)->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 d-flex justify-content-center">
                <h1 class="mb-0">#{{ optional($order)->order_number }} অর্ডার ইনভয়েস</h1>
            </div>
            <div class="modal-body pt-0">
                <div class="row mx-4 mt-4" id="invoiceContent{{ optional($order)->id }}">
                    <div class="card card-print shadow-sm px-0">
                        <div class="card-body px-0">
                            <div class="mx-auto w-100">
                                <div class="d-flex justify-content-between flex-column flex-sm-row mb-19 px-10">
                                    <h4 class="fw-bolder text-gray-800 fs-2qx pe-5 pb-7">INVOICE</h4>

                                    <div class="text-sm-end">
                                        <a href="#" class="d-block mw-150px ms-sm-auto">
                                            <img alt="Logo" src="{{ asset('images/default_logo.png') }}"
                                                class="w-100">
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
                                        <span class="fs-6">({{ optional($order->user)->email }} )</span>,<br>
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
                                            <span
                                                class="fs-5">{{ optional($order)->created_at->format('d M, Y') }}</span>
                                        </div>

                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">ইনভয়েস আইডি</span>
                                            <span class="fs-5">#{{ optional($order)->order_number }}</span>
                                        </div>

                                        {{-- <div class="flex-root d-flex flex-column">
                                                    <span class="text-muted">Shipment ID</span>
                                                    <span class="fs-5">#SHP-0025410</span>
                                                </div> --}}
                                    </div>

                                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">


                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Shipping Address</span>
                                            {{-- <span class="fs-6">
                                                {{ optional($order)->thana }}, {{ optional($order)->district }},
                                            </span> --}}
                                            <span class="fs-6">
                                                {{ optional($order)->thana }}, {{ optional($order)->address }},
                                            </span>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between flex-column">
                                        <div class="table-responsive border-bottom">
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                <thead style="background-color: #252525">
                                                    <tr class="border-bottom fs-6 fw-bold text-muted">
                                                        <th class="">প্রোডাক্ট</th>
                                                        <th class="text-end ">কোড</th>
                                                        <th class="text-end ">কোয়ান্টিটি</th>
                                                        <th class="text-end pl-5">টোটাল</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="fw-semibold text-gray-600">
                                                    @foreach (optional($order)->orderItems as $item)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        @php
                                                                            $thumbnailPath =
                                                                                'storage/' .
                                                                                optional($item->product)->thumbnail;
                                                                            $thumbnailSrc = file_exists(
                                                                                public_path($thumbnailPath),
                                                                            )
                                                                                ? asset($thumbnailPath)
                                                                                : asset('frontend/img/no-product.jpg');
                                                                        @endphp
                                                                        <img class="cart-img" src="{{ $thumbnailSrc }}"
                                                                            alt="{{ optional($item->product)->name }}">
                                                                    </div>

                                                                    <div class="ms-5 text-start">
                                                                        <div class="fw-bold text-start">
                                                                            {{ optional($item->product)->name }}
                                                                        </div>
                                                                        {{-- <div class="fs-7 text-muted">Delivery Date:
                                                                                    14/08/2024</div> --}}
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
                                                            {{-- {{ $order->total_amount + $order->shipping_charge }} --}}
                                                            ৳ {{ optional($order)->total_amount }} .00
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="text-end">
                                                            ভ্যাট (0%)
                                                        </td>
                                                        <td class="text-end">
                                                            ৳ 0.00
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="fs-3 text-gray-900 fw-bold text-end">
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
                        <div class="card-footer p-4 text-center border-0 text-white" style="background-color: #252525;">
                            © {{ optional($setting)->website_name }}, LTD 2024.
                        </div>
                    </div>
                </div>
                <div class="pt-10 d-flex justify-content-center align-items-center">
                    <button class="btn btn-dark ml-3 p-3 rounded-pill" onclick="downloadInvoice()">
                        <i class="fa-solid fa-file-download"></i> ইনভয়েস ডাউনলোড করুন
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function downloadInvoice() {
            const invoice = document.querySelector('.card-print'); // Select the invoice element
            html2pdf(invoice, {
                margin: 10,
                filename: `Invoice-${Date.now()}.pdf`,
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            });
        }
    </script>
@endpush
{{-- <script>
    function printInvoice() {
        const printContents = document.querySelector('.card-print').innerHTML;
        const originalContents = document.body.innerHTML;

        const printWindow = window.open('', '', 'height=800,width=600');
        printWindow.document.write('<html><head><title>Print Invoice</title>');
        printWindow.document.write('</head><body >');
        printWindow.document.write(printContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }
</script> --}}
