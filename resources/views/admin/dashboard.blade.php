<x-admin-app-layout>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row gx-5 gx-xl-10 mb-xl-10">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="card card-flush mb-5 mb-xl-10">
                                <div class="card-header pt-5">
                                    <div class="card-title d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">৳</span>
                                            <span
                                                class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ number_format($earningsCurrentMonth, 2) }}</span>
                                            <span class="badge badge-light-success fs-base">
                                                <i class="fa-solid fa-arrow-up fs-5 text-success ms-n1"></i>
                                                {{ number_format($earningsChange, 2) }}%
                                            </span>
                                        </div>
                                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Current Month Earnings</span>
                                    </div>
                                </div>
                                <div class="card-body pt-2 pb-4 d-flex align-items-center">
                                    <div class="d-flex flex-center me-5 pt-2">
                                        <div id="kt_card_widget_4_chart" style="min-width: 70px; min-height: 70px"
                                            data-kt-size="70" data-kt-line="11"><span></span><canvas height="70"
                                                width="70"></canvas></div>
                                    </div>

                                    <div class="d-flex flex-column content-justify-center w-100">
                                        @foreach ($categoryWiseSales as $categoryWiseSale)
                                            <div class="d-flex fs-6 fw-semibold align-items-center">
                                                <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>

                                                <div class="text-gray-500 flex-grow-1 me-4">{{ $categoryWiseSale->name }}
                                                </div>

                                                <div class="fw-bolder text-gray-700 text-xxl-end">
                                                    ৳{{ number_format($categoryWiseSale->total_sales, 2) }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="card card-flush mb-xl-10">

                                <div class="card-header pt-5">
                                    <div class="card-title d-flex flex-column">
                                        <span
                                            class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ number_format($newCustomersCurrentMonth) }}</span>
                                        <span class="text-gray-500 pt-1 fw-semibold fs-6">New Customers This Month</span>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ number_format($ordersCurrentMonth) }}</span>
                                        <span class="badge badge-light-danger fs-base">
                                            <i class="fa-solid fa-arrow-down fs-5 text-danger ms-n1"></i>
                                            {{ number_format($ordersChange, 2) }}%
                                        </span>
                                    </div>
                                    <span class="text-gray-500 pt-1 fw-semibold fs-6">Orders This Month</span>
                                    <div class="d-flex align-items-center flex-column mt-3 w-100">
                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                            <span
                                                class="fw-bolder fs-6 text-gray-900">{{ number_format($ordersCurrentMonth - $ordersLastMonth) }}
                                                to Goal</span>
                                            <span
                                                class="fw-bold fs-6 text-gray-500">{{ number_format($ordersChange, 2) }}%</span>
                                        </div>
                                        <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                            <div class="bg-success rounded h-8px" role="progressbar"
                                                style="width: {{ min($ordersChange, 100) }}%" aria-valuenow="50"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card card-flush mb-5 mb-xl-10">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">৳</span>
                                        <span
                                            class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ number_format($averageDailySales, 2) }}</span>
                                        <span class="badge badge-light-success fs-base">
                                            <i class="fa-solid fa-arrow-up fs-5 text-success ms-n1"></i>
                                            {{ number_format(($averageDailySales / ($earningsCurrentMonth > 0 ? $earningsCurrentMonth : 1)) * 100, 2) }}%
                                        </span>
                                    </div>
                                    <span class="text-gray-500 pt-1 fw-semibold fs-6">Average Daily Sales</span>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end px-0 pb-0">
                                <div id="dailySalesChart" class="w-100" style="height: 80px"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Sales This Month Chart -->
                <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                    <div class="card card-flush overflow-hidden h-md-100">
                        <div class="card-header py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Sales This Month</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-6">Users from all channels</span>
                            </h3>
                            <div class="card-toolbar">
                                <button
                                    class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                    data-kt-menu-overflow="true">
                                    <i class="fa-solid fa-dots-square fs-1"></i>
                                </button>

                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                            <div class="px-9 mb-5">
                                <div class="d-flex mb-2">
                                    <span class="fs-4 fw-semibold text-gray-500 me-1">৳</span>
                                    <span
                                        class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{ number_format($earningsCurrentMonth, 2) }}</span>
                                </div>
                                {{-- <span class="fs-6 fw-semibold text-gray-500">Another
                                    {{ number_format($totalGoal - $earningsCurrentMonth, 2) }} to Goal</span> --}}
                            </div>
                            <div id="monthlySalesChart" class="ps-4 pe-6" style="height: 300px"></div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row gy-5 g-xl-10">
                <div class="col-xl-12">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-7">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Manage Orders</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-6">All Recent Order You
                                    Found Here.</span>
                            </h3>

                            <div class="card-toolbar">
                                <a href="{{ route('admin.order-management.index') }}"
                                    class="btn btn-sm btn-light">Order Details</a>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            <table class="table my-datatable table-striped table-row-bordered gy-5 gs-7">
                                <thead class="bg-light-dark">
                                    <tr class="fw-semibold fs-6 text-gray-800">
                                        <th width="5%">SL</th>
                                        <th width="10%">Order ID</th>
                                        <th width="15%">Customer</th>
                                        <th width="15%">Created</th>
                                        <th width="15%">Total Price</th>
                                        <th width="10%">Qty</th>
                                        <th width="10%">Payment Status</th>
                                        <th width="10%">Status</th>
                                        <th width="10%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="text-center">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.orderDetails', $order->id) }}">
                                                    {{ $order->order_number }}
                                                </a>
                                            </td>
                                            <td>{{ $order->user->first_name }}
                                                {{ $order->user->last_name }}</td>
                                            <td>{{ $order->created_at->format('d M, Y') }}</td>
                                            <td><span class="text-info fw-bold">৳</span>{{ $order->total_amount }}
                                            </td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>
                                                @if ($order->payment_status == 'unpaid')
                                                    <span class="badge py-3 px-4 fs-7 badge-danger">Unpaid</span>
                                                @elseif ($order->payment_status == 'paid')
                                                    <span class="badge py-3 px-4 fs-7 badge-light-success">Paid</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($order->status == 'pending')
                                                    <span
                                                        class="badge py-3 px-4 fs-7 badge-light-primary">Pending</span>
                                                @elseif ($order->status == 'processing')
                                                    <span
                                                        class="badge py-3 px-4 fs-7 badge-light-warning">Processing</span>
                                                @elseif ($order->status == 'shipped')
                                                    <span
                                                        class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                                                @elseif ($order->status == 'delivered')
                                                    <span
                                                        class="badge py-3 px-4 fs-7 badge-light-success">Delivered</span>
                                                @elseif ($order->status == 'cancelled')
                                                    <span
                                                        class="badge py-3 px-4 fs-7 badge-light-dangered">Cancelled</span>
                                                @elseif ($order->status == 'returned')
                                                    <span
                                                        class="badge py-3 px-4 fs-7 badge-light-dangered">Returned</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#printInovice{{ $order->id }}">
                                                    <i class="fa-solid fa-print"></i>
                                                </button>
                                                <a href="{{ route('admin.orderDetails', $order->id) }}"
                                                    class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px">
                                                    <i class="fa-solid fa-eye" title="Order Details"></i>
                                                </a>
                                                {{-- <button type="button"
                                                    class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                                    data-kt-docs-datatable-subtable="expand_row">
                                                    <span class="svg-icon fs-3 m-0 toggle-off">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                    <span class="svg-icon fs-3 m-0 toggle-on">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </span>
                                                </button> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
        <script>
            (function() {
                var e = document.getElementById("monthlySalesChart");

                // Define colors
                var t = "#6c757d"; // Gray color
                var a = "#e9ecef"; // Light gray
                var o = "#500066"; // Info color
                var s = "#d1ecf1"; // Light info color

                // Get data from Blade
                var months = @json($months);
                var sales = @json($sales);

                if (e) {
                    new ApexCharts(e, {
                        series: [{
                            name: "Sales",
                            data: sales
                        }],
                        chart: {
                            fontFamily: "inherit",
                            type: "area",
                            height: 350,
                            toolbar: {
                                show: false
                            },
                        },
                        plotOptions: {},
                        legend: {
                            show: false
                        },
                        dataLabels: {
                            enabled: false
                        },
                        fill: {
                            type: "solid",
                            opacity: 1
                        },
                        stroke: {
                            curve: "smooth",
                            width: 3,
                            colors: [o]
                        },
                        xaxis: {
                            categories: months,
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            labels: {
                                style: {
                                    colors: t,
                                    fontSize: "12px"
                                }
                            },
                            crosshairs: {
                                position: "front",
                                stroke: {
                                    color: o,
                                    width: 1,
                                    dashArray: 3
                                },
                            },
                            tooltip: {
                                enabled: true,
                                formatter: undefined,
                                offsetY: 0,
                                style: {
                                    fontSize: "12px"
                                },
                            },
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: t,
                                    fontSize: "12px"
                                }
                            }
                        },
                        states: {
                            normal: {
                                filter: {
                                    type: "none",
                                    value: 0
                                }
                            },
                            hover: {
                                filter: {
                                    type: "none",
                                    value: 0
                                }
                            },
                            active: {
                                allowMultipleDataPointsSelection: false,
                                filter: {
                                    type: "none",
                                    value: 0
                                },
                            },
                        },
                        tooltip: {
                            style: {
                                fontSize: "12px"
                            },
                            y: {
                                formatter: function(e) {
                                    return "$" + e;
                                },
                            },
                        },
                        colors: [s],
                        grid: {
                            borderColor: a,
                            strokeDashArray: 4,
                            yaxis: {
                                lines: {
                                    show: true
                                }
                            },
                        },
                        markers: {
                            strokeColor: o,
                            strokeWidth: 3
                        },
                    }).render();
                }
            })();


            (function() {
                var salesData = @json($salesData);
                var dates = @json($dates);
                var e = document.getElementById("dailySalesChart"),
                    t =
                    (parseInt(KTUtil.css(e, "height")),
                        KTUtil.getCssVariableValue("--bs-gray-500")),
                    a = KTUtil.getCssVariableValue("--bs-gray-200"),
                    o = KTUtil.getCssVariableValue("--bs-primary"),
                    s = KTUtil.getCssVariableValue("--bs-info");
                e &&
                    new ApexCharts(e, {
                        series: [{
                            name: "Net Profit",
                            data: salesData,
                        }, ],
                        chart: {
                            fontFamily: "inherit",
                            type: "bar",
                            stacked: !0,
                            height: 250,
                            toolbar: {
                                show: !1
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: !1,
                                columnWidth: ["12%"],
                                borderRadius: [6, 6],
                            },
                        },
                        legend: {
                            show: !1
                        },
                        // dataLabels: {
                        //     enabled: !1
                        // },
                        stroke: {
                            show: !0,
                            width: 2,
                            colors: ["transparent"]
                        },
                        xaxis: {
                            categories: dates,
                            axisBorder: {
                                show: !1
                            },
                            axisTicks: {
                                show: !1
                            },
                            labels: {
                                style: {
                                    colors: t,
                                    fontSize: "8px"
                                }
                            },
                        },
                        yaxis: {
                            min: -80,
                            max: 80,
                            labels: {
                                style: {
                                    display: "none",
                                    colors: t,
                                    fontSize: "12px"
                                }
                            },
                        },
                        fill: {
                            opacity: 1
                        },
                        states: {
                            normal: {
                                filter: {
                                    type: "none",
                                    value: 0
                                }
                            },
                            hover: {
                                filter: {
                                    type: "none",
                                    value: 0
                                }
                            },
                            active: {
                                allowMultipleDataPointsSelection: !1,
                                filter: {
                                    type: "none",
                                    value: 0
                                },
                            },
                        },
                        tooltip: {
                            style: {
                                fontSize: "8px"
                            },
                            // y: {
                            //     formatter: function(e) {
                            //         return "$" + e + " thousands";
                            //     },
                            // },
                        },
                        colors: [o, s],
                        grid: {
                            borderColor: a,
                            strokeDashArray: 4,
                            yaxis: {
                                lines: {
                                    show: !0
                                }
                            },
                        },
                    }).render();
            })();
        </script>
    @endpush
</x-admin-app-layout>
