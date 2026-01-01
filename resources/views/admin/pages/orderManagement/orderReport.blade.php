<x-admin-app-layout :title="'Order Report'">

    <style>
        thead {
            font-weight: bold;
        }
    </style>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                    <h1 class="card-title text-white">Select Date To Generate Order Report</h1>
                    <input class="form-control form-control-solid w-250px" id="kt_daterangepicker_2"
                        placeholder="Pick date range">
                </div>

                <div class="card-body orderReportTable">
                    @include('admin.pages.orderManagement.partial.orderReportTable')
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function() {
                $('#kt_daterangepicker_2').daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                }, function(start, end) {
                    fetchReport(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
                });
            });

            function fetchReport(start, end) {
                $.get('{{ route('admin.orderReport') }}', {
                    start_date: start,
                    end_date: end
                }, function(res) {
                    $('.orderReportTable').html(res);
                });
            }

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                const dates = $('#kt_daterangepicker_2').val().split(' - ');
                $.get($(this).attr('href'), {
                    start_date: dates[0],
                    end_date: dates[1]
                }, function(res) {
                    $('.orderReportTable').html(res);
                });
            });
        </script>
        <script>
            function toggleSubtable(button) {
                // Get the closest row to the button
                var row = button.closest('tr');

                // Get the next sibling rows and toggle only the subtables
                var nextRow = row.nextElementSibling;
                var shouldShow = true;

                // Get the toggle-on and toggle-off elements
                var toggleOn = button.querySelector('.toggle-on');
                var toggleOff = button.querySelector('.toggle-off');

                // Ensure both toggle elements are found
                if (toggleOn && toggleOff) {
                    // Determine if we should show or hide the subtables
                    shouldShow = toggleOn.classList.contains('d-none');

                    while (nextRow) {
                        // If the next row is a subtable, toggle its visibility
                        if (nextRow.classList.contains('subtable')) {
                            if (shouldShow) {
                                nextRow.classList.remove('d-none');
                            } else {
                                nextRow.classList.add('d-none');
                            }
                        } else {
                            // Stop when we hit a non-subtable row
                            break;
                        }
                        nextRow = nextRow.nextElementSibling;
                    }

                    // Toggle the button icon visibility
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
    @endpush

</x-admin-app-layout>
