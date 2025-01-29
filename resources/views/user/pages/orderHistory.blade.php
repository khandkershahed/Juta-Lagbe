<x-frontend-app-layout :title="'Your Order History'">
    <div class="breadcrumb-wrap">
        <div class="banner b-top bg-size bread-img">
            <img class="bg-img bg-top" src="img/banner-p.jpg" alt="banner" style="display: none;">
            <div class="container-lg">
                <div class="breadcrumb-box">
                    <div class="title-box3 text-center">
                        <h1>
                            <span class="text-info">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                            <br>Welcome To Your Dashboard
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ps-account">
        <section class="user-dashboard py-0 py-lg-8">
            <div class="container">
                <div class="row g-3 g-xl-4 tab-wrap">
                    <div class="col-lg-4 col-xl-3 sticky">
                        <!-- Sidebar here -->
                        @include('user.layouts.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="row bg-white py-3">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <h4>Order History & Track Order</h4>
                                    <p class="mb-5">
                                        Click the 'Track' button to check the status of your order delivery.
                                    </p>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped order-history-table">
                                        <thead>
                                            <tr>
                                                <th>অর্ডার নাম্বার</th>
                                                <th>তারিখ</th>
                                                <th>মোট টাকা (কুরিয়ার চার্জ সহ)</th>
                                                <th>পরিশোধ</th>
                                                <th>বকেয়া</th>
                                                <th class="text-center">ইনভয়েস</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Example Row -->
                                            @foreach ($orders as $order)
                                                <tr class="text-start">
                                                    <td>{{ $order->order_number }}</td>
                                                    <td>{{ $order->created_at->format('d M, Y') }}</td>
                                                    <td>
                                                        <span
                                                            class="text-info fw-bold">৳</span>{{ $order->total_amount }}
                                                        + {{ $order->shipping_charge }}
                                                    </td>
                                                    <td>
                                                        @if ($order->payment_status == 'delivery_charge_paid')
                                                            <span
                                                                class="text-info fw-bold">৳</span>{{ $order->shipping_charge }}
                                                        @elseif ($order->payment_status == 'completely_paid')
                                                            <span
                                                                class="text-info fw-bold">৳</span>{{ $order->total_amount + $order->shipping_charge }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($order->payment_status == 'delivery_charge_paid')
                                                            <span
                                                                class="text-info fw-bold">৳</span>{{ $order->total_amount }}
                                                        @elseif ($order->payment_status == 'completely_paid')
                                                            <span class="text-info fw-bold">৳</span>0
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#showInvoice-{{ $order->id }}">
                                                            <i class="fa-solid fa-print"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <!-- Additional rows go here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    @foreach ($orders as $order)
        <div class="modal fade" id="showInvoice-{{ $order->id }}" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="showInvoiceLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showInvoiceLabel">Order Invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        @include('frontend.layouts.invoice')
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-frontend-app-layout>
