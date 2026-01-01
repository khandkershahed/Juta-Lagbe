<x-admin-app-layout :title="'Order Report'">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        thead {
            font-weight: bold;
        }

        /* ===== Bangla Fix for Invoice PDF ===== */
        .card-print,
        .card-print * {
            font-family: 'Noto Sans Bengali', system-ui, -apple-system, BlinkMacSystemFont, sans-serif !important;

        }
    </style>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-dark align-items-center d-flex justify-content-between">
                    <h1 class="card-title text-white">Select Date To Generate Order Report</h1>
                    <div class="mb-0 d-flex align-items-center">
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
        <script>
            function toggleSubtable(button) {
                var row = button.closest('tr');
                var nextRow = row.nextElementSibling;
                var shouldShow = true;
                var toggleOn = button.querySelector('.toggle-on');
                var toggleOff = button.querySelector('.toggle-off');

                if (toggleOn && toggleOff) {
                    shouldShow = toggleOn.classList.contains('d-none');

                    while (nextRow) {
                        if (nextRow.classList.contains('subtable')) {
                            if (shouldShow) {
                                nextRow.classList.remove('d-none');
                            } else {
                                nextRow.classList.add('d-none');
                            }
                        } else {
                            break;
                        }
                        nextRow = nextRow.nextElementSibling;
                    }

                    if (shouldShow) {
                        toggleOn.classList.remove('d-none');
                        toggleOff.classList.add('d-none');
                    } else {
                        toggleOn.classList.add('d-none');
                        toggleOff.classList.remove('d-none');
                    }
                } else {
                    console.error('Toggle elements not found');
                }
            }
        </script>

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

            function fetchOrders(startDate, endDate, pageUrl) {
                var url = pageUrl ? pageUrl : '{{ route('admin.orderReport') }}';

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        $('#orderReportTableContainer').html(response);
                    }
                });
            }

            $(document).on('click', '#orderReportTableContainer .pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');

                $('#orderReportTableContainer').html(`
                    <div class="text-center py-10">
                        <span class="spinner-border spinner-border-sm me-2"></span> Loading...
                    </div>
                `);

                fetchOrders(currentStartDate, currentEndDate, url);
            });

            $(document).on('click', '.js-invoice-print-btn', function(e) {
                e.preventDefault();

                var url = $(this).data('url');

                $('#globalInvoiceModalTitle').html('');
                $('#globalInvoiceModalBody').html(`
                    <div class="text-center py-10">
                        <span class="spinner-border spinner-border-sm me-2"></span> Loading...
                    </div>
                `);

                var modalEl = document.getElementById('globalInvoiceModal');
                var modal = new bootstrap.Modal(modalEl);
                modal.show();

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Failed to load invoice');
                        return res.text();
                    })
                    .then(html => {
                        document.getElementById('globalInvoiceModalBody').innerHTML = html;
                    })
                    .catch(err => {
                        document.getElementById('globalInvoiceModalBody').innerHTML = `
                            <div class="alert alert-danger mb-0">
                                ${err.message ?? 'Something went wrong'}
                            </div>
                        `;
                    });
            });

           
        </script>
    @endpush
</x-admin-app-layout>
