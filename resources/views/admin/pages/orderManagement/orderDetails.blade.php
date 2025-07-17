<x-admin-app-layout :title="'Order Details'">
    <div class="mt-5 d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="py-3 app-toolbar py-lg-6 ">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack ">
                <div class="flex-wrap page-title d-flex flex-column justify-content-center me-3 ">
                    <ul class="pt-1 my-0 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">
                                Dashboard </a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bg-gray-500 bullet w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.order-management.index') }}" class="text-muted text-hover-primary">
                                Order List </a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bg-gray-500 bullet w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            Order Details (#{{ $order->order_number }}) </li>
                    </ul>
                    <h5 class="my-0 text-gray-900 page-heading d-flex fw-bold fs-3 flex-column justify-content-center">
                        Order Details (#{{ $order->order_number }})
                    </h5>

                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid ">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="mb-10 row">
                    <div class="col-xl-4">
                        <div class="py-4 card card-flush flex-row-fluid">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4>অর্ডার ডিটেইলস</h4>
                                </div>
                            </div>
                            <div class="pt-0 card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 align-middle table-row-bordered fs-6 gy-5 min-w-300px">
                                        <tbody class="text-gray-600 fw-semibold">
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-calendar fs-2 me-2"></i>
                                                        অর্ডার এর তারিখ
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $order->created_at->format('d M , Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-wallet fs-2 me-2">
                                                        </i>
                                                        পেমেন্ট এর মাধ্যম
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    {{ ucfirst($order->payment_method) }}
                                                    <img src="https://jutalagbe.octaedges.com/frontend/img/payment-light.png"
                                                        class="w-100px ms-2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-truck fs-2 me-2"></i>
                                                        ডেলিভারি এরিয়া
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    {{ optional($order->shippingCharge)->title }} <span
                                                        class="text-info">{{ optional($order->shippingCharge)->price }}
                                                        টাকা</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="py-4 card card-flush flex-row-fluid">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4>কাস্টোমার ডিটেইলস</h4>
                                </div>
                            </div>
                            <div class="pt-0 card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 align-middle table-row-bordered fs-6 gy-5 min-w-300px">
                                        <tbody class="text-gray-600 fw-semibold">
                                            <tr class="w-100">
                                                <td class="text-muted">
                                                    <p class="mb-0 d-flex align-items-center justify-content-start">
                                                        <i class="fa-solid fa-user pe-2"></i> কাস্টোমার
                                                    </p>
                                                </td>
                                                <td class="text-muted">
                                                    <p class="mb-0 d-flex justify-content-end">
                                                        <span>{{ optional($order->user)->name }}</span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-sms fs-2 me-2">
                                                        </i>
                                                        ইমেইল
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <a href="mailto:{{ optional($order->user)->email }}"
                                                        class="text-gray-600 text-hover-primary">
                                                        {{ optional($order->user)->email }} </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-phone fs-2 me-2"></i>
                                                        ফোন নাম্বার
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end"><a
                                                        href="tel:{{ optional($order->user)->phone }}">{{ optional($order->user)->phone }}</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="py-4 card card-flush flex-row-fluid">
                            <div class="pt-0 pb-0 mb-0 card-body">
                                <h4 class="pt-4 mb-0">ডেলিভারি ঠিকানা</h4>
                                <div class="pt-2 table-responsive">
                                    <table class="table mb-0 align-middle table-row-bordered fs-6 gy-5">
                                        <tbody class="text-gray-600 fw-semibold">
                                            <tr>
                                                <td class="text-muted">
                                                    <p class="mb-0 d-flex justify-content-between align-items-center">
                                                        ইনভয়েস <span># {{ $order->order_number }}</span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted w-100">
                                                    <p class="mb-0 d-flex justify-content-between text-end">
                                                        জেলা:
                                                        <span>{{ $order->district }}</span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted w-100">
                                                    <p class="mb-0 d-flex justify-content-between text-end">
                                                        থানা:
                                                        <span>{{ $order->thana }}</span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted w-100">
                                                    <p class="mb-0 d-flex justify-content-between text-end">
                                                        সম্পূর্ণ ঠিকানা:
                                                        <span>{{ $order->address }}</span>
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="d-flex flex-column gap-7 gap-lg-10">

                        <div class="py-4 overflow-hidden card card-flush flex-row-fluid">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Order #{{ $order->order_number }}</h2>
                                </div>

                            </div>
                            <div class="pt-0 card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-gray-500 text-start fw-bold fs-7 text-uppercase gs-0">
                                                <th width="5%" class="ps-5">সিরিয়াল</th>
                                                <th width="10" class="">ছবি</th>
                                                <th width="45" class="">প্রোডাক্ট বিবরন</th>
                                                <th width="10%" class="">সাইজ</th>
                                                <th width="10%" class="">কোয়ান্টিটি</th>
                                                <th width="10%" class="text-end">দাম</th>
                                                <th width="10%" class="text-end pe-5">মোট টাকা</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold">
                                            @foreach ($order->orderItems as $item)
                                                <tr>
                                                    <td class="ps-5">1</td>
                                                    <td>
                                                        <span>
                                                            <img width="50px" height="50px"
                                                                style="border-radius: 5px;"
                                                                src="{{ asset('storage/' . optional($item->product)->thumbnail) }}"
                                                                alt="">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>{{ Str::limit(optional($item->product)->name, 30) }}</span>
                                                    </td>

                                                    <td>
                                                        <span>{{ optional($item)->size }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ optional($item)->quantity }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span class="text-info">৳</span>{{ optional($item)->price }}
                                                    </td>
                                                    <td class="text-end pe-5">
                                                        <span
                                                            class="text-info">৳</span>{{ optional($item)->quantity * optional($item)->price }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr style="background-color: #eeeeee94;">
                                                <td colspan="6" class="text-end">
                                                    মোট
                                                </td>
                                                <td class="text-end pe-5">
                                                    ৳{{ optional($order)->sub_total }}
                                                </td>
                                            </tr>
                                            <tr style="background-color: #eeeeeed8;">
                                                <td colspan="6" class="text-end">
                                                    ডেলিভারি চার্জ
                                                </td>
                                                <td class="text-end pe-5">
                                                    ৳{{ optional($order)->shipping_charge }}.00
                                                </td>
                                            </tr>
                                            <tr style="background-color: #eeeeeed8;">
                                                <td colspan="6" class="text-end">
                                                    অগ্রিম পরিশোধ
                                                </td>
                                                <td class="text-end pe-5">
                                                    @if ($order->payment_status == 'delivery_charge_paid')
                                                            ৳{{ optional($order)->shipping_charge }}.00
                                                    @else
                                                        ৳ 00.00
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr style="background-color: #eee;">
                                                <td colspan="6" class="text-gray-900 fs-3 text-end">
                                                    সর্বমোট বকেয়া
                                                </td>
                                                <td class="text-gray-900 fs-3 fw-bolder text-end pe-5">
                                                    @if ($order->payment_status == 'delivery_charge_paid')
                                                        ৳ {{ optional($order)->total_amount - optional($order)->shipping_charge }}.00
                                                    @else
                                                        ৳ {{ optional($order)->total_amount }}.00
                                                    @endif

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Print Invoice Modal  --}}
    <!-- Modal -->
    {{-- @include('admin.pages.orderManagement.partial.invoice') --}}
    {{-- Print Invoice Modal End --}}
    {{-- view order Modal  --}}
    <!-- Modal -->
    <div class="modal fade" id="vieworderInovice" tabindex="-1" aria-labelledby="vieworderInoviceLabel"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Worder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Print Invoice Modal End --}}
</x-admin-app-layout>
