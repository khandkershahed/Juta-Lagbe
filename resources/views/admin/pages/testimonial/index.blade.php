<x-admin-app-layout :title="'Testimonials Lists'">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-flush mt-10">
                    <div class="card-header bg-primary align-items-center">
                        <h3 class="card-title text-white">Testimonials List</h3>
                        <div>
                            <a class="btn btn-sm btn-light-primary rounded-0"
                                href="{{ route('admin.testimonial.create') }}">
                                Add New
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table my-datatable table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th width="5%" class="text-center">SL.</th>
                                    <th width="10%">Image</th>
                                    <th width="15%">Name</th>
                                    <th width="15%">Company Name</th>
                                    <th width="35%">Message</th>
                                    <th width="10%">Status</th>
                                    <th width="20%" class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $testimonial)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td><img class="w-65px" src="{{ asset('storage/' . $testimonial->logo) }}"
                                                alt="{{ $testimonial->name }}"></td>
                                        <td>{{ ucfirst($testimonial->name) }}</td>
                                        <td>{{ ucfirst($testimonial->company_name) }}</td>
                                        <td>{{ ucfirst($testimonial->message) }}</td>
                                        <td>
                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input status-toggle" type="checkbox"
                                                    id="status_toggle_{{ $testimonial->id }}"
                                                    @checked($testimonial->status == 'active') data-id="{{ $testimonial->id }}" />
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.testimonial.edit', $testimonial->id) }}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <a href="{{ route('admin.testimonial.destroy', $testimonial->id) }}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete"
                                                data-kt-docs-table-filter="delete_row">
                                                <i class="fa-solid fa-trash-can-arrow-up"></i>
                                            </a>
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
    @push('scripts')
        <script>
            $(document).on('change', '.status-toggle', function() {
                const id = $(this).data('id');
                const route = "{{ route('admin.testimonial.toggle-status', ':id') }}".replace(':id', id);
                toggleStatus(route, id);
            });

            function toggleStatus(route, id) {
                $.ajax({
                    url: route,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Status updated successfully!');
                            table.ajax.reload(null, false); // Reload the DataTable
                        } else {
                            alert('Failed to update status.');
                        }
                    },
                    error: function() {
                        alert('An error occurred while updating the status.');
                    }
                });
            }
        </script>
    @endpush
</x-admin-app-layout>
