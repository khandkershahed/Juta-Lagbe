<x-admin-app-layout :title="'Shipping Methods'">
    <div class="card card-flush mt-10">
        <div class="card-header bg-primary align-items-center">
            <h3 class="card-title text-white">Manage Your Shipping</h3>
            <div>
                <!-- Button trigger modal -->
                <a href="{{ route('admin.shipping-management.create') }}" class="btn btn-white btn btn-sm">
                    <i class="fa-solid fa-plus"></i> Create
                </a>
                {{-- <button type="button" class="btn btn-white btn btn-sm" data-bs-toggle="modal"
                    data-bs-target="#shipping_methodsAdd">
                    <i class="fa-solid fa-plus"></i> Create
                </button> --}}
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table my-datatable table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Duration</th>
                        <th>Min Weight</th>
                        <th>Max Weight</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipping_methods as $method)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $method->title }}</td>
                            <td>{{ $method->location }}</td>
                            <td>{{ $method->duration }}</td>
                            <td>{{ $method->min_weight }}</td>
                            <td>{{ $method->max_weight }}</td>
                            <td>৳{{ $method->price }}</td>
                            <td><span class="badge {{ $method->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $method->status == 'active' ? 'Active' : 'InActive' }}</span></td>
                            <td class="text-start">
                                <a href="{{ route('admin.shipping-management.edit', $method->id) }}"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="{{ route('admin.shipping-management.destroy', $method->id) }}"
                                    class="btn btn-icon btn-bg-light-danger btn-active-color-danger btn-sm me-1 delete"
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
    {{-- Shippng Create Modal --}}
    <!-- Modal -->
    <div class="modal fade" id="shipping_methodsAdd" tabindex="-1" aria-labelledby="shipping_methodsAddLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shipping_methodsAddLabel">Shipping Create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

            </div>
        </div>
    </div>
    @foreach ($shipping_methods as $method)
        <div class="modal fade" id="shipping_methodsEdit_{{ $method->id }}" tabindex="-1"
            aria-labelledby="shipping_methodsEditLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shipping_methodsEditLabel">Shipping Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
    {{-- Shippng Create Modal ENd --}}
    @push('scripts')
        <script>
            // Define form element
            const form = document.getElementById('kt_docs_formvalidation_text');

            // Init form validation rules
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'title': {
                            validators: {
                                notEmpty: {
                                    message: 'Title is required'
                                }
                            }
                        },
                        'zone': {
                            validators: {
                                notEmpty: {
                                    message: 'Zone is required'
                                }
                            }
                        },
                        'cost': {
                            validators: {
                                notEmpty: {
                                    message: 'Cost is required'
                                },
                                numeric: {
                                    message: 'Cost must be a number'
                                }
                            }
                        },
                        'status': {
                            validators: {
                                notEmpty: {
                                    message: 'Status is required'
                                }
                            }
                        }
                    },

                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    }
                }
            );

            // Handle modal data population
            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const title = this.getAttribute('data-title');
                    const zone = this.getAttribute('data-zone');
                    const cost = this.getAttribute('data-cost');
                    const status = this.getAttribute('data-status');

                    const form = document.getElementById('kt_docs_formvalidation_text');
                    form.querySelector('input[name="title"]').value = title;
                    form.querySelector('input[name="zone"]').value = zone;
                    form.querySelector('input[name="cost"]').value = cost;
                    form.querySelector('select[name="status"]').value = status;
                });
            });

            // Submit button handler
            const submitButton = document.getElementById('kt_docs_formvalidation_text_submit');
            submitButton.addEventListener('click', function(e) {
                e.preventDefault();

                if (validator) {
                    validator.validate().then(function(status) {
                        console.log('validated!');

                        if (status == 'Valid') {
                            submitButton.setAttribute('data-kt-indicator', 'on');
                            submitButton.disabled = true;

                            setTimeout(function() {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;

                                Swal.fire({
                                    text: "Form has been successfully submitted!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }, 2000);
                        }
                    });
                }
            });
        </script>
    @endpush
</x-admin-app-layout>
