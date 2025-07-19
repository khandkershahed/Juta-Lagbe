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
                                    <span title="Out of Stock">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40"
                                            x="0" y="0" viewBox="0 0 60 60" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <path
                                                    d="m42.878 43.706.828-.828 6.326-6.326a2.021 2.021 0 0 0 .566-1.724 1.96 1.96 0 0 0-1.029-1.456 12 12 0 0 0-16.2 16.2 1.958 1.958 0 0 0 1.457 1.028 2.024 2.024 0 0 0 1.724-.566l6.326-6.326ZM40 42v-7.169a9.793 9.793 0 0 1 2-.636v7.571l-.233.234Zm8.62-6.864L44 39.763v-5.741a9.849 9.849 0 0 1 4.62 1.114ZM38 35.995V42h-3.8a9.971 9.971 0 0 1 3.8-6.005Zm-2.86 12.643A9.918 9.918 0 0 1 34.022 44h5.748ZM20 12h4a3 3 0 0 0 0-6h-4a3 3 0 0 0 0 6Zm0-4h4a1 1 0 0 1 0 2h-4a1 1 0 0 1 0-2Z"
                                                    fill="#FF0000" opacity="1" data-original="#000000"
                                                    class=""></path>
                                                <path
                                                    d="M44 28V12.952a3 3 0 0 0-1.606-2.652L23.4.351a2.961 2.961 0 0 0-2.794 0L1.6 10.3A3 3 0 0 0 0 12.952V42a2 2 0 0 0 2 2h26a16 16 0 1 0 16-16ZM2 12.952a1 1 0 0 1 .534-.885l19.007-9.953a.978.978 0 0 1 .925 0l18.995 9.946a1.008 1.008 0 0 1 .539.888v15.191a15.741 15.741 0 0 0-2 .388V16a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v26H2ZM38 18H6v-2h32ZM6 20h32v2H6Zm7 11a1 1 0 0 0 1-1v-2h2v6h-6v-6h2v2a1 1 0 0 0 1 1Zm-3 5h2v2a1 1 0 0 0 2 0v-2h2v6h-6Zm8 6v-6h2v2a1 1 0 0 0 2 0v-2h2v6Zm8 0v-6a2 2 0 0 0-2-2h-6v-6a2 2 0 0 0-2-2h-6a2 2 0 0 0-2 2v14H6V24h32v5.178A16.026 16.026 0 0 0 28.139 42Zm18 16a14 14 0 1 1 14-14 14.015 14.015 0 0 1-14 14Z"
                                                    fill="#FF0000" opacity="1" data-original="#000000"
                                                    class=""></path>
                                                <path
                                                    d="M51.45 37.966 37.966 51.45a2.021 2.021 0 0 0-.566 1.724 1.96 1.96 0 0 0 1.029 1.456A11.921 11.921 0 0 0 44.008 56a12.444 12.444 0 0 0 1.3-.069 12 12 0 0 0 9.316-17.5 1.958 1.958 0 0 0-1.45-1.031 2.021 2.021 0 0 0-1.724.566Zm2.492 7.134a9.991 9.991 0 0 1-14.562 7.76l13.48-13.5a10.016 10.016 0 0 1 1.082 5.74Z"
                                                    fill="#FF0000" opacity="1" data-original="#000000"
                                                    class=""></path>
                                            </g>
                                        </svg>
                                    </span>
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
