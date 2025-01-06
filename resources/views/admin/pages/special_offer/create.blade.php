<x-admin-app-layout :title="'Special Offer Add'">
    <div class="card card-flash">

        <div class="card-header mt-6">
            <div class="card-title"></div>
            <div class="card-toolbar">
                <a href="{{ route('admin.special-offer.index') }}" class="btn btn-light-info">
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

                    Back to the list
                </a>
            </div>
        </div>
        <div class="card-body pt-0">

            <form class="form" action="{{ route('admin.special-offer.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Update for brand_id -->
                    <div class="col-lg-12 col-12 mb-7">
                        <x-metronic.label for="product_id" class="col-form-label fw-bold fs-6">{{ __('Select a product') }}</x-metronic.label>
                        <x-metronic.select-option id="product_id" name="product_id[]" multiple multiselect-search="true"
                            multiselect-select-all="true" data-control="select2" data-placeholder="Select an option"
                            data-allow-clear="true">
                            <option></option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" @selected(in_array($product->id, old('product_id', [])))>{{ $product->name }}</option>
                            @endforeach
                        </x-metronic.select-option>
                    </div>




                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="name"
                            class="col-form-label fw-bold fs-6 required">{{ __('Name') }}
                        </x-metronic.label>

                        <x-metronic.input id="name" type="text" name="name" :value="old('name')"
                            placeholder="Enter the Name" required></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="button_name" class="col-form-label fw-bold fs-6">{{ __('Button Name') }}
                        </x-metronic.label>

                        <x-metronic.input id="button_name" type="text" name="button_name" :value="old('button_name')"
                            placeholder="Button Name"></x-metronic.input>
                    </div>

                    {{-- <div class="col-lg-4 mb-7">
                        <x-metronic.label for="button_link" class="col-form-label fw-bold fs-6">{{ __('Button Link') }}
                        </x-metronic.label>

                        <x-metronic.input id="button_link" type="text" name="button_link" :value="old('button_link')"
                            placeholder="Button Link"></x-metronic.input>
                    </div> --}}

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="header_slogan" class="col-form-label fw-bold fs-6">{{ __('Header Slogan') }}
                        </x-metronic.label>

                        <x-metronic.input id="header_slogan" type="text" name="header_slogan" :value="old('header_slogan')"
                            placeholder="Button Link"></x-metronic.input>
                    </div>




                    <!-- Update for date fields -->
                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="start_date"
                            class="col-form-label fw-bold fs-6 required">{{ __('Start Date') }}</x-metronic.label>
                        <x-metronic.input id="start_date" type="date" name="start_date"
                            :value="old('start_date')"></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="end_date"
                            class="col-form-label fw-bold fs-6 required">{{ __('End Date') }}
                        </x-metronic.label>

                        <x-metronic.input id="end_date" type="date" name="end_date"
                            :value="old('end_date')"></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="date"
                            class="col-form-label fw-bold fs-6 required">{{ __('Date') }}
                        </x-metronic.label>

                        <x-metronic.input id="date" type="date" name="date"
                            :value="old('date')"></x-metronic.input>
                    </div>


                    <div class="col-lg-3 mb-7">
                        <x-metronic.label for="logo" class="col-form-label fw-bold fs-6 ">{{ __('Logo') }}
                        </x-metronic.label>

                        <x-metronic.file-input id="logo" name="logo" :value="old('logo')"></x-metronic.file-input>
                    </div>

                    <div class="col-lg-3 mb-7">
                        <x-metronic.label for="image"
                            class="col-form-label fw-bold fs-6">{{ __('Thumbnail Image') }}
                        </x-metronic.label>

                        <x-metronic.file-input id="image" name="image"
                            :value="old('image')"></x-metronic.file-input>
                    </div>

                    <div class="col-lg-3 mb-7">
                        <x-metronic.label for="banner_image"
                            class="col-form-label fw-bold fs-6 ">{{ __('Banner Image') }}
                        </x-metronic.label>

                        <x-metronic.file-input id="banner_image" :value="old('banner_image')"
                            name="banner_image"></x-metronic.file-input>
                    </div>

                    <div class="col-lg-3 mb-7">
                        <x-metronic.label for="footer_banner"
                            class="col-form-label fw-bold fs-6 ">{{ __('Footer Banner Image') }}
                        </x-metronic.label>

                        <x-metronic.file-input id="footer_banner" :value="old('footer_banner')"
                            name="footer_banner"></x-metronic.file-input>
                    </div>



                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="status" class="col-form-label required fw-bold fs-6">
                            {{ __('Select a Status ') }}</x-metronic.label>
                        <x-metronic.select-option id="status" name="status" data-hide-search="true"
                            data-placeholder="Select an option">
                            <option></option>
                            <option value="active" @selected(old('status') == 'active')>Active</option>
                            <option value="inactive" @selected(old('status') == 'inactive')>Inactive</option>
                        </x-metronic.select-option>
                    </div>


                </div>
                <div class="float-end pt-15">
                    <x-metronic.button type="submit" class="primary">
                        {{ __('Submit') }}
                    </x-metronic.button>
                </div>

            </form>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // The DOM elements you wish to replace with Tagify
            var input1 = document.querySelector("#tags");
            // Initialize Tagify components on the above inputs
            new Tagify(input1);
        });
    </script>
</x-admin-app-layout>
