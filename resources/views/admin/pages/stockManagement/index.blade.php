<x-admin-app-layout :title="'Stock Management'">
    <style>
        td {
            height: 50px;
            vertical-align: middle;
        }
    </style>
    <div class="mt-10 card card-flush">
        <div class="card-header bg-dark align-items-center">
            <h3 class="text-white card-title">Product Stock Availability</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table border rounded my-datatable table-striped table-row-bordered gy-5 gs-7">
                <thead>
                    <tr class="text-center text-gray-800 fw-bold fs-6 px-7">
                        <th width="5%">ID</th>
                        <th width="10%">Image</th>
                        <th width="40%">Product Name</th>
                        <th width="35%">Size & QTY</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="symbol symbol-50px me-3">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class=""
                                        alt="">
                                </div>
                            </td>
                            <td class="text-start">{{ $product->name }}</td>

                            <td class="text-center">
                                @if ($product->sizes->count() > 0)
                                    @foreach ($product->sizes as $item)
                                        <span class="badge bg-dark">
                                            {{ $item->size }} = {{ $item->stock }} </span>
                                    @endforeach
                                @else
                                    <span class="badge bg-danger">No Sizes Available</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-transparent" data-bs-toggle="modal"
                                    data-bs-target="#stockMethodsEdit-{{ $product->id }}">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <div class="modal fade" id="stockMethodsEdit-{{ $product->id }}" tabindex="-1"
                                    aria-labelledby="stockMethodsEditLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="text-white modal-title" id="stockMethodsEditLabel">Stock
                                                    Methods
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form" method="POST"
                                                    action="{{ route('admin.stock.update', $product->id) }}"
                                                    autocomplete="off" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-lg-3 mb-7">
                                                            <div class="">
                                                                <div class="mb-3 image-input image-input-empty image-input-outline image-input-placeholder"
                                                                    data-kt-image-input="true">
                                                                    <div class="image-input-wrapper w-100px h-100px">
                                                                        <img class="w-100px h-100px"
                                                                            src="{{ asset('storage/' . $product->thumbnail) }}"
                                                                            alt="">
                                                                    </div>
                                                                    <label
                                                                        class="shadow btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body"
                                                                        data-kt-image-input-action="change"
                                                                        data-bs-toggle="tooltip" title="Change avatar">
                                                                        <i class="fa-solid fa-pencil fs-7">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                        </i>
                                                                        <input type="file" name="thumbnail"
                                                                            accept=".png, .jpg, .jpeg" />
                                                                        <input type="hidden" name="thumbnail_remove" />
                                                                    </label>
                                                                </div>
                                                                <div class="text-muted fs-7">
                                                                    Set the product thumbnail image. Only *.png, *.jpg
                                                                    and
                                                                    *.jpeg image
                                                                    files are accepted
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9 mb-7">
                                                            <x-metronic.label class="form-label">Product
                                                                Name</x-metronic.label>
                                                            <x-metronic.input type="text" name="name"
                                                                class="mb-2 form-control"
                                                                placeholder="Product name recommended"
                                                                :value="old('name', $product->name)">
                                                            </x-metronic.input>
                                                        </div>

                                                        <div class="mt-5 mb-7 col-lg-12">
                                                            <p>Product Size wise Stock</p>
                                                            <!--begin::Repeater-->
                                                            <div id="productSizeStock" class="text-start">
                                                                <!--begin::Form group-->
                                                                <div class="form-group">
                                                                    <div data-repeater-list="productSizeStock">
                                                                        @if (count($product->sizes) > 0)
                                                                            @foreach ($product->sizes as $size)
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-5">
                                                                                            <x-metronic.label
                                                                                                for="product_size"
                                                                                                class="col-form-label required fw-bold fs-6">
                                                                                                {{ __('Size') }}
                                                                                            </x-metronic.label>
                                                                                            <select name="product_size"
                                                                                                id="product_size"
                                                                                                class="form-select form-select-solid"
                                                                                                data-control="select2"
                                                                                                data-close-on-select="false"
                                                                                                data-placeholder="Select an option"
                                                                                                data-allow-clear="true">
                                                                                                <option>Choose Size
                                                                                                </option>
                                                                                                @for ($opt = 30; $opt <= 45; $opt++)
                                                                                                    <option
                                                                                                        value="{{ $opt }}"
                                                                                                        @selected(old('product_size', $size->size ?? null) == (string) $opt)>
                                                                                                        {{ $opt }}
                                                                                                    </option>
                                                                                                @endfor
                                                                                            </select>
                                                                                        </div>

                                                                                        <div class="col-md-4">
                                                                                            <x-metronic.label
                                                                                                for="product_stock"
                                                                                                class="col-form-label fw-bold fs-6 required">{{ __('Stock') }}
                                                                                            </x-metronic.label>
                                                                                            <x-metronic.input
                                                                                                class="form-control form-control-lg"
                                                                                                id="product_stock"
                                                                                                type="text"
                                                                                                name="product_stock"
                                                                                                value="{{ old('product_stock', $size->stock) }}"
                                                                                                placeholder="Stock Quantity, EG: 10,20,50.."></x-metronic.input>
                                                                                        </div>

                                                                                        <div class="col-md-1">
                                                                                            <div
                                                                                                class="pt-2 mt-5 text-end">
                                                                                                <a href="javascript:;"
                                                                                                    data-repeater-delete
                                                                                                    class="mt-5 btn btn-sm btn-danger mt-md-8">
                                                                                                    <i
                                                                                                        class="fas fa-trash fs-5"></i>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <div data-repeater-item>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-5">
                                                                                        <x-metronic.label
                                                                                            for="product_size"
                                                                                            class="col-form-label required fw-bold fs-6">
                                                                                            {{ __('Size') }}
                                                                                        </x-metronic.label>
                                                                                        <select name="product_size"
                                                                                            id="product_size"
                                                                                            class="form-select form-select-solid"
                                                                                            data-control="select2"
                                                                                            data-close-on-select="false"
                                                                                            data-placeholder="Select an option"
                                                                                            data-allow-clear="true">
                                                                                            <option>Choose Size</option>
                                                                                            @for ($size = 30; $size <= 45; $size++)
                                                                                                <option
                                                                                                    value="{{ $size }}"
                                                                                                    @selected(old('product_size') == $size)>
                                                                                                    {{ $size }}
                                                                                                </option>
                                                                                            @endfor
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <x-metronic.label
                                                                                            for="product_stock"
                                                                                            class="col-form-label fw-bold fs-6 required">{{ __('Stock') }}
                                                                                        </x-metronic.label>
                                                                                        <x-metronic.input
                                                                                            class="form-control form-control-lg"
                                                                                            id="product_stock"
                                                                                            type="text"
                                                                                            name="product_stock"
                                                                                            value="{{ old('product_stock') }}"
                                                                                            placeholder="Stock Quantity, EG: 10,20,50.."></x-metronic.input>
                                                                                    </div>

                                                                                    <div class="col-md-1">
                                                                                        <div
                                                                                            class="pt-2 mt-5 text-end">
                                                                                            <a href="javascript:;"
                                                                                                data-repeater-delete
                                                                                                class="mt-5 btn btn-sm btn-danger mt-md-8">
                                                                                                <i
                                                                                                    class="fas fa-trash fs-5"></i>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <!--end::Form group-->

                                                                <!--begin::Form group-->
                                                                <div class="mt-5 form-group">
                                                                    <a href="javascript:;" data-repeater-create
                                                                        class="btn btn-primary">
                                                                        <i class="fas fa-plus fs-3"></i>
                                                                        Add
                                                                    </a>
                                                                </div>
                                                                <!--end::Form group-->
                                                            </div>
                                                            <!--end::Repeater-->
                                                        </div>

                                                        <button id="kt_docs_formvalidation_text_submit" type="submit"
                                                            class="btn btn-primary w-175px">
                                                            <span class="indicator-label">
                                                                Update Stock
                                                            </span>
                                                            <span class="indicator-progress">
                                                                Please wait... <span
                                                                    class="align-middle spinner-border spinner-border-sm ms-2"></span>
                                                            </span>
                                                        </button>
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
    @push('scripts')
        <script>
            // Define form element
            const form = document.getElementById('kt_docs_formvalidation_text');

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'text_input': {
                            validators: {
                                notEmpty: {
                                    message: 'Text input is required'
                                }
                            }
                        },
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

            // Submit button handler
            const submitButton = document.getElementById('kt_docs_formvalidation_text_submit');
            submitButton.addEventListener('click', function(e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function(status) {
                        console.log('validated!');

                        if (status == 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-kt-indicator', 'on');

                            // Disable button to avoid multiple click
                            submitButton.disabled = true;

                            // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            setTimeout(function() {
                                // Remove loading indication
                                submitButton.removeAttribute('data-kt-indicator');

                                // Enable button
                                submitButton.disabled = false;

                                // Show popup confirmation
                                Swal.fire({
                                    text: "Form has been successfully submitted!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });

                                //form.submit(); // Submit form
                            }, 2000);
                        }
                    });
                }
            });
        </script>
    @endpush
    @push('scripts')
        <script>
            function calculatePrices() {
                const boxContains = parseFloat(document.querySelector('box_contains').value) || 0;
                const boxPrice = parseFloat(document.querySelector('unit_price').value) || 0;
                const boxDiscountPrice = parseFloat(document.querySelector('unit_discount_price').value) || 0;

                const unitPrice = boxContains ? (boxPrice / boxContains).toFixed(2) : 0;
                const unitDiscount = boxContains ? (boxDiscountPrice / boxContains).toFixed(2) : 0;

                document.getElementById('unit_price').value = unitPrice;
                document.getElementById('unit_discount').value = unitDiscount;
            }

            document.getElementById('box_contains').addEventListener('input', calculatePrices);
            document.getElementById('unit_price').addEventListener('input', calculatePrices);
            document.getElementById('unit_discount_price').addEventListener('input', calculatePrices);
        </script>
        <script>
            $('#productSizeStock').repeater({
                initEmpty: false,
                defaultValues: {
                    'text-input': '41'
                },
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        </script>
    @endpush
</x-admin-app-layout>
