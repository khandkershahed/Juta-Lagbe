<x-admin-app-layout :title="'Offer List'">

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // Configure Toastr
        toastr.options = {
            "closeButton": true, // Add a close button
            "debug": false,
            "newestOnTop": false,
            "progressBar": true, // Show a progress bar
            "positionClass": "toast-top-right", // Position of the toast
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300", // Show duration in milliseconds
            "hideDuration": "1000", // Hide duration in milliseconds
            "timeOut": "5000", // Time to show the notification (5000ms = 5 seconds)
            "extendedTimeOut": "1000", // Time to extend the notification on hover
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>


    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        /* The slider before it is checked */
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            border-radius: 50%;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
        }

        /* Change background color when checked */
        input:checked+.slider {
            background-color: #49c464;
            /* Green color for active */
        }

        /* Move the slider handle when checked */
        input:checked+.slider:before {
            transform: translateX(26px);
        }

        /* When the switch is inactive (danger color) */
        input:not(:checked)+.slider {
            background-color: #f44336;
            /* Red color for inactive */
        }

        /* Rounded slider */
        .slider.round {
            border-radius: 34px;
        }

        /* Rounded slider handle */
        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <div class="card card-flash">
        <div class="card-header mt-6">
            <div class="card-title"><h1>Special Offer Product</h1></div>
            <div class="card-toolbar">
                <a href="{{ route('admin.special-offer.create') }}" class="btn btn-light-primary">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5"
                                fill="currentColor" />
                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
                                fill="currentColor" />
                        </svg>
                    </span>
                    Add Offer
                </a>
            </div>
        </div>

        <div class="card-body pt-10">
            <div class="table-responsive">
                <table class="table table-striped gy-5 gs-7 rounded">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="5%">Image</th>
                            <th width="8%">Name</th>
                            <th width="5%">Start Day</th>
                            <th width="5%">End Day</th>
                            <th width="5%">Added By</th>
                            <th width="5%">Status</th>
                            <th width="5%">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">

                        @foreach ($items as $key => $offer)
                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td class="">
                                    <img src="{{ !empty($offer->image) ? url('storage/' . $offer->image) : 'https://ui-avatars.com/api/?name=' . urlencode($offer->name) }}"
                                        height="40" width="40" alt="{{ $offer->name }}">

                                </td>

                                <td class="text-start">{{ $offer->name }}</td>
                                <td class="text-start">{{ $offer->start_date }}</td>
                                <td class="text-start">{{ $offer->end_date }}</td>

                                <td class="text-start">{{ optional($offer->added)->name }}</td>

                                <td class="text-start">
                                    <label class="switch">
                                        <input type="checkbox" class="status-toggle" data-id="{{ $offer->id }}"
                                            {{ $offer->status == 'active' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>


                                <td>
                                    <a href="{{ route('admin.special-offer.edit', $offer->id) }}" class="text-primary">
                                        <i class="fa-solid fa-pencil text-primary"></i>
                                    </a>

                                    <a href="{{ route('admin.special-offer.destroy', $offer->id) }}" class="delete">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            $("#kt_datatable_example_5").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.status-toggle').change(function() {
                    var offerId = $(this).data('id');
                    var newStatus = $(this).is(':checked') ? 'active' : 'inactive';

                    $.ajax({
                        url: '/admin/special-offer/status/' + offerId,
                        method: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: newStatus
                        },
                        success: function(response) {
                            if (newStatus === 'active') {
                                toastr.success('Special Offer has been activated successfully.');
                            } else {
                                toastr.error('Special Offer has been deactivated successfully.');
                            }
                        },
                        error: function(xhr) {
                            toastr.error('An error occurred while updating the status.');
                        }
                    });
                });
            });
        </script>
    @endpush

</x-admin-app-layout>
