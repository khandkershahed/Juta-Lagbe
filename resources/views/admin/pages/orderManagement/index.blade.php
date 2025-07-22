<x-admin-app-layout :title="'Order Report'">
    <div class="row">
        <div class="mx-auto col-xl-4">
            <div class="shadow-sm card card-flush">
                <div class="p-0 card-body">
                    <div class="d-flex flex-stack justify-content-between">
                        <div class="p-8 d-flex align-items-center me-3 rounded-3 bg-dark">
                            <a href="javascript:void(0)">
                                <span class="p-3 bg-black rounded-3 me-3"><i
                                        class="text-white fa-brands fa-product-hunt fs-3" aria-hidden="true"></i></span>
                            </a>
                            <div class="flex-grow-1">
                                <a href="#" class="text-white fs-5 fw-bold lh-0">Total Order
                                    <span class="pt-4 text-white fw-semibold d-block fs-6">{{ date('d M Y') }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center pe-4">
                            <div>
                                <span class="text-gray-800 fs-3x fw-bold me-2 lh-1 ls-n2">{{ $orders->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto col-xl-4">
            <div class="shadow-sm card card-flush">
                <div class="p-0 card-body">
                    <div class="d-flex flex-stack justify-content-between">
                        <div class="p-8 d-flex align-items-center me-3 rounded-3 bg-dark">
                            <a href="javascript:void(0)">
                                <span class="p-3 bg-black rounded-3 me-3"><i
                                        class="text-white fa-solid fa-clock-rotate-left fs-3"
                                        aria-hidden="true"></i></span>
                            </a>
                            <div class="flex-grow-1">
                                <a href="#" class="text-white fs-5 fw-bold lh-0">Total Order Pending
                                    <span class="pt-4 text-white fw-semibold d-block fs-6">{{ date('d M Y') }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center pe-4">
                            <div>
                                <span
                                    class="text-gray-800 fs-3x fw-bold me-2 lh-1 ls-n2">{{ $pendingOrdersCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto col-xl-4">
            <div class="shadow-sm card card-flush">
                <div class="p-0 card-body">
                    <div class="d-flex flex-stack justify-content-between">
                        <div class="p-8 d-flex align-items-center me-3 rounded-3 bg-dark">
                            <a href="javascript:void(0)">
                                <span class="p-3 bg-black rounded-3 me-3"><i class="text-white fa-solid fa-truck fs-3"
                                        aria-hidden="true"></i></span>
                            </a>
                            <div class="flex-grow-1">
                                <a href="#" class="text-white fs-5 fw-bold lh-0">Total Order Delivered
                                    <span class="pt-4 text-white fw-semibold d-block fs-6">{{ date('d M Y') }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center pe-4">
                            <div>
                                <span
                                    class="text-gray-800 fs-3x fw-bold me-2 lh-1 ls-n2">{{ $deliveredOrdersCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 card">
        <div class="card-header bg-dark align-items-center d-flex justify-content-between">
            <div>
                <h1 class="mb-0 text-center text-white w-100">Manage Your Orders</h1>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table border rounded my-datatable table-striped table-row-bordered gy-5 gs-7">
                <thead>
                    <tr class="text-center text-gray-800 fw-semibold fs-6">
                        <th style="width: 4%;">Sl</th>
                        <th style="width: 10%;">Product</th>
                        <th style="width: 8%;">Cost</th>
                        <th style="width: 6%;">QTy</th>
                        <th style="width: 10%;">Order Number</th>
                        <th style="width: 7%;">Phone</th>
                        <th style="width: 7%;">Customer</th>
                        <th style="width: 8%;">Created At</th>
                        <th style="width: 7%;">Total Price</th>
                        <th style="width: 7%;">Paid</th>
                        <th style="width: 7%;">Due</th>
                        <th style="width: 6%;">Status</th>
                        <th style="width: 13%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @php
                            $firstItem = $order->orderItems->first();
                            $statusClassMap = [
                                'pending' => 'badge-light-primary',
                                'processing' => 'badge-light-warning',
                                'shipped' => 'badge-light-success',
                                'delivered' => 'badge-light-success',
                                'cancelled' => 'badge-light-dangered',
                                'returned' => 'badge-light-dangered',
                            ];
                        @endphp
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>

                            {{-- First Order Item --}}
                            <td colspan="1">
                                @if ($firstItem)
                                    <div class="gap-3 ">
                                        <a href="#" class="bg-opacity-25 rounded symbol symbol-50px bg-secondary">
                                            <img src="{{ asset('storage/' . optional($firstItem->product)->thumbnail) }}"
                                                alt="" />
                                        </a>
                                        <div class="d-flex flex-column text-muted">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary">
                                                {{ optional($firstItem->product)->name }}
                                            </a>
                                            {{-- <div class="fs-7">
                                                {{ optional($firstItem->product)->name }}
                                            </div> --}}
                                        </div>
                                    </div>
                                @else
                                    <em>No items found</em>
                                @endif
                            </td>

                            <td class="text-end">
                                @if ($firstItem)
                                    <div class="fs-7 fw-bold text-muted">৳ {{ $firstItem->price }}</div>
                                @endif
                            </td>
                            <td class="text-end">
                                @if ($firstItem)
                                    <div class="fs-7 fw-bold text-muted">{{ $firstItem->quantity }}</div>
                                @endif
                            </td>

                            {{-- Order Info --}}
                            <td>
                                <a href="{{ route('admin.orderDetails', $order->id) }}">
                                    {{ $order->order_number }}
                                </a>
                            </td>
                            <td>
                                <span class="fw-bold text-info"><i class="fas fa-phone"></i></span>
                                <a href="tel:{{ $order->phone }}">
                                    {{ $order->phone }}
                                </a>
                            </td>
                            <td>{{ optional($order->user)->name }}</td>
                            <td>{{ $order->created_at->format('d M, Y') }}</td>

                            {{-- Amount Breakdown --}}
                            <td>
                                <span class="fw-bold text-info">৳</span>
                                {{ $order->total_amount - $order->shipping_charge }} + {{ $order->shipping_charge }}
                            </td>

                            {{-- Payment Status: Amount Paid --}}
                            <td>
                                @if ($order->payment_status == 'delivery_charge_paid')
                                    <span class="text-info fw-bold">৳</span>{{ $order->shipping_charge }}
                                @elseif ($order->payment_status == 'completely_paid')
                                    <span class="text-info fw-bold">৳</span>{{ $order->total_amount }}
                                @elseif ($order->payment_status == 'paid')
                                    <span class="text-info fw-bold">৳</span>{{ $order->total_amount }}
                                @elseif ($order->payment_status == 'cod')
                                    <span class="text-info fw-bold">৳</span>0.00
                                @endif
                            </td>

                            {{-- Payment Status: Remaining Amount --}}
                            <td>
                                @if ($order->payment_status == 'delivery_charge_paid')
                                    <span
                                        class="fw-bold text-info">৳</span>{{ $order->total_amount - $order->shipping_charge }}
                                @elseif ($order->payment_status == 'completely_paid')
                                    <span class="fw-bold text-info">৳</span>0
                                @elseif ($order->payment_status == 'paid')
                                    <span class="fw-bold text-info">৳</span>0
                                @elseif ($order->payment_status == 'cod')
                                    <span class="fw-bold text-info">৳</span>{{ $order->total_amount }}
                                @endif
                            </td>

                            {{-- Order Status --}}


                            <td>
                                <span
                                    class="badge fs-7 px-4 py-3 {{ $statusClassMap[$order->status] ?? 'badge-light-secondary' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td>
                                {{-- Print Invoice --}}
                                <button type="button"
                                    class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                    data-bs-toggle="modal" data-bs-target="#printInovice{{ $order->id }}">
                                    <i class="fa-solid fa-print"></i>
                                </button>

                                @include('admin.pages.orderManagement.partial.invoice_two')

                                {{-- View Details --}}
                                <a href="{{ route('admin.orderDetails', $order->id) }}"
                                    class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                    title="Order Details">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                {{-- Delete Order --}}
                                <a href="{{ route('admin.order.destroy', $order->id) }}"
                                    class="btn btn-sm btn-icon btn-light btn-active-light-danger toggle h-25px w-25px delete"
                                    title="Order Delete">
                                    <i class="fa-solid fa-trash-alt text-danger"></i>
                                </a>

                                {{-- Change Delivery Status --}}
                                <button type="button"
                                    class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                    data-bs-toggle="modal" data-bs-target="#changeDeliveryStatus-{{ $order->id }}"
                                    title="Change Delivery Status">
                                    <i class="fa-solid fa-cog"></i>
                                </button>

                                {{-- Modal: Change Delivery Status --}}
                                <div class="modal fade" id="changeDeliveryStatus-{{ $order->id }}" tabindex="-1"
                                    aria-labelledby="changeDeliveryStatusLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changeDeliveryStatusLabel">
                                                    Change Delivery Status (Order Number: #{{ $order->order_number }})
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST"
                                                    action="{{ route('admin.order.update', $order->id) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="pt-0 card-body text-start">
                                                        <x-metronic.label class="col-lg-12">Change The Delivery
                                                            Status</x-metronic.label>
                                                        <x-metronic.select-option
                                                            id="kt_ecommerce_add_product_status_select"
                                                            class="mb-2 form-select" data-control="select2"
                                                            data-hide-search="true" name="status"
                                                            data-placeholder="Select an option">
                                                            <option></option>
                                                            <option value="processing" @selected($order->status == 'processing')>
                                                                Processing
                                                            </option>
                                                            <option value="shipped" @selected($order->status == 'shipped')>
                                                                Shipped
                                                            </option>
                                                            <option value="delivered" @selected($order->status == 'delivered')>
                                                                Delivered
                                                            </option>
                                                            <option value="cancelled" @selected($order->status == 'cancelled')>
                                                                Cancelled
                                                            </option>
                                                            <option value="returned" @selected($order->status == 'returned')>
                                                                Returned
                                                            </option>
                                                        </x-metronic.select-option>
                                                    </div>
                                                    <div class="card-footer">
                                                        <x-metronic.button type="submit"
                                                            class="primary">{{ __('Update') }}</x-metronic.button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
    <!-- Button trigger modal -->
</x-admin-app-layout>
