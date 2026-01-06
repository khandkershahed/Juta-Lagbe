<x-admin-app-layout :title="'Order Report'">

    <style>
        thead {
            font-weight: bold;
        }
    </style>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-dark align-items-center d-flex justify-content-between">
                    <h1 class="card-title text-white mb-0">
                        Select Date To Generate Order Report
                    </h1>

                    <div class="d-flex align-items-center">

                        {{-- Search --}}
                        <div class="w-300px me-4">
                            <input type="text" id="orderSearchInput" class="form-control form-control-solid"
                                placeholder="Search by Order No, Name, Phone, Email..." autocomplete="off">
                        </div>

                        {{-- Date Range --}}
                        <div class="pe-3">
                            <input class="form-control form-control-solid w-100 rounded-2" placeholder="Pick date range"
                                id="kt_daterangepicker_2" />
                        </div>

                    </div>
                </div>

                <div class="card-body orderReportTable" id="orderReportTableContainer">
                    @include('admin.pages.orderManagement.partial.orderReportTable')
                </div>
            </div>
        </div>
    </div>

    {{-- Invoice Modal --}}
    <div class="modal fade" id="globalInvoiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="border-0 modal-header d-flex justify-content-center">
                    <h1 class="mb-0" id="globalInvoiceModalTitle"></h1>
                </div>

                <div class="pt-0 modal-body" id="globalInvoiceModalBody">
                    <div class="text-center py-10">
                        <span class="spinner-border spinner-border-sm me-2"></span> Loading...
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- ================= SEARCH (LIVE) ================= --}}
        <script>
            let searchTimer = null;
            let currentSearch = '';

            document.addEventListener('input', function(e) {
                if (!e.target.matches('#orderSearchInput')) return;

                clearTimeout(searchTimer);

                searchTimer = setTimeout(() => {
                    currentSearch = e.target.value.trim();
                    fetchOrders(currentStartDate, currentEndDate, null);
                }, 400);
            });
        </script>

        {{-- ================= SUBTABLE TOGGLE ================= --}}
        <script>
            function toggleSubtable(button) {
                var row = button.closest('tr');
                var nextRow = row.nextElementSibling;
                var toggleOn = button.querySelector('.toggle-on');
                var toggleOff = button.querySelector('.toggle-off');

                var shouldShow = toggleOn.classList.contains('d-none');

                while (nextRow && nextRow.classList.contains('subtable')) {
                    nextRow.classList.toggle('d-none', !shouldShow);
                    nextRow = nextRow.nextElementSibling;
                }

                toggleOn.classList.toggle('d-none', !shouldShow);
                toggleOff.classList.toggle('d-none', shouldShow);
            }
        </script>

        {{-- ================= DATE RANGE ================= --}}
        <script>
            var currentStartDate = moment().subtract(1, 'year').startOf('year').format('YYYY-MM-DD');
            var currentEndDate = moment().format('YYYY-MM-DD');

            $(function() {
                $('#kt_daterangepicker_2').daterangepicker({
                    opens: 'left',
                    startDate: moment(currentStartDate),
                    endDate: moment(currentEndDate),
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                }, function(start, end) {
                    currentStartDate = start.format('YYYY-MM-DD');
                    currentEndDate = end.format('YYYY-MM-DD');
                    fetchOrders(currentStartDate, currentEndDate, null);
                });
            });
        </script>

        {{-- ================= FETCH ORDERS ================= --}}
        <script>
            function fetchOrders(startDate, endDate, pageUrl) {
                var url = pageUrl ? pageUrl : '{{ route('admin.orderReport') }}';

                $('#orderReportTableContainer').html(`
                    <div class="text-center py-10">
                        <span class="spinner-border spinner-border-sm me-2"></span> Loading...
                    </div>
                `);

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        search: currentSearch
                    },
                    success: function(response) {
                        $('#orderReportTableContainer').html(response);
                    },
                    error: function() {
                        $('#orderReportTableContainer').html(`
                            <div class="alert alert-danger mb-0">
                                Failed to load orders
                            </div>
                        `);
                    }
                });
            }
        </script>

        {{-- ================= PAGINATION ================= --}}
        <script>
            $(document).on('click', '#orderReportTableContainer .pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                fetchOrders(currentStartDate, currentEndDate, url);
            });
        </script>

        {{-- ================= INVOICE MODAL ================= --}}
        <script>
            $(document).on('click', '.js-invoice-print-btn', function(e) {
                e.preventDefault();

                var url = $(this).data('url');

                $('#globalInvoiceModalTitle').html('');
                $('#globalInvoiceModalBody').html(`
                    <div class="text-center py-10">
                        <span class="spinner-border spinner-border-sm me-2"></span> Loading...
                    </div>
                `);

                var modal = new bootstrap.Modal(document.getElementById('globalInvoiceModal'));
                modal.show();

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        $('#globalInvoiceModalBody').html(html);
                    })
                    .catch(() => {
                        $('#globalInvoiceModalBody').html(`
                        <div class="alert alert-danger mb-0">
                            Failed to load invoice
                        </div>
                    `);
                    });
            });
        </script>
    @endpush

</x-admin-app-layout>
