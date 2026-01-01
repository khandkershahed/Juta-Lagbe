<x-admin-app-layout :title="'Order Report'">

    {{-- SUMMARY --}}
    <div class="row">
        <div class="mx-auto col-xl-4">
            <div class="card card-flush shadow-sm">
                <div class="card-body p-0">
                    <div class="d-flex flex-stack justify-content-between">
                        <div class="d-flex align-items-center me-3 p-8 rounded-3 bg-dark">
                            <span class="p-3 bg-black rounded-3 me-3">
                                <i class="fa-brands fa-product-hunt fs-3 text-white"></i>
                            </span>
                            <div>
                                <span class="text-white fw-bold fs-5">Total Order</span>
                                <span class="text-white fs-6 d-block">{{ date('d M Y') }}</span>
                            </div>
                        </div>
                        <span class="fs-3x fw-bold">{{ $orders->total() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto col-xl-4">
            <div class="card card-flush shadow-sm">
                <div class="card-body p-0">
                    <div class="d-flex flex-stack justify-content-between">
                        <div class="d-flex align-items-center me-3 p-8 rounded-3 bg-dark">
                            <span class="p-3 bg-black rounded-3 me-3">
                                <i class="fa-solid fa-clock-rotate-left fs-3 text-white"></i>
                            </span>
                            <div>
                                <span class="text-white fw-bold fs-5">Pending</span>
                                <span class="text-white fs-6 d-block">{{ date('d M Y') }}</span>
                            </div>
                        </div>
                        <span class="fs-3x fw-bold">{{ $pendingOrdersCount }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto col-xl-4">
            <div class="card card-flush shadow-sm">
                <div class="card-body p-0">
                    <div class="d-flex flex-stack justify-content-between">
                        <div class="d-flex align-items-center me-3 p-8 rounded-3 bg-dark">
                            <span class="p-3 bg-black rounded-3 me-3">
                                <i class="fa-solid fa-truck fs-3 text-white"></i>
                            </span>
                            <div>
                                <span class="text-white fw-bold fs-5">Delivered</span>
                                <span class="text-white fs-6 d-block">{{ date('d M Y') }}</span>
                            </div>
                        </div>
                        <span class="fs-3x fw-bold">{{ $deliveredOrdersCount }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="mt-8 card">
        <div class="card-header bg-dark">
            <h1 class="mb-0 text-white text-center">Manage Your Orders</h1>
        </div>

        <div class="card-body table-responsive" id="orderIndexTable">
            <table class="table my-datatable table-striped table-row-bordered gy-5 gs-7">
                <thead>
                    <tr class="text-center fw-semibold">
                        <th>Sl</th>
                        <th>Product</th>
                        <th>Cost</th>
                        <th>Qty</th>
                        <th>Order</th>
                        <th>Phone</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Due</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                @include('admin.pages.orderManagement.partial.indexTable')
            </table>
        </div>
    </div>

    {{-- GLOBAL INVOICE MODAL --}}
    <div class="modal fade" id="invoiceModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body" id="invoiceModalBody">
                    <div class="text-center p-5">
                        <span class="spinner-border"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            $.get($(this).attr('href'), function(res) {
                $('#orderIndexTable').html(res);
            });
        });

        function loadInvoice(orderId) {
            $('#invoiceModal').modal('show');
            $('#invoiceModalBody').html('<div class="text-center p-5"><span class="spinner-border"></span></div>');
            fetch(`/admin/orders/${orderId}/invoice`)
                .then(r => r.text())
                .then(html => $('#invoiceModalBody').html(html));
        }
    </script>
    @endpush

</x-admin-app-layout>
