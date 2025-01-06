<x-admin-app-layout :title="'Testimonial Create'">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-flash">
                    <div class="card-header mt-6">
                        <div class="card-title"></div>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.testimonial.index') }}" class="btn btn-light-info">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
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
                        <form class="form" action="{{ route('admin.testimonial.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6 mb-7">
                                    <x-metronic.label for="name"
                                        class="col-form-label fw-bold fs-6 required">{{ __('Name') }}
                                    </x-metronic.label>
                                    <x-metronic.input id="name" type="text" name="name" :value="old('name')"
                                        placeholder="Enter the Name" required></x-metronic.input>
                                </div>

                                <div class="col-lg-6 mb-7">
                                    <x-metronic.label for="company_name"
                                        class="col-form-label fw-bold fs-6 required">{{ __('Company Name') }}
                                    </x-metronic.label>
                                    <x-metronic.input id="company_name" type="text" name="company_name" :value="old('company_name')"
                                        placeholder="Enter the Company"></x-metronic.input>
                                </div>

                                <div class="col-lg-4 mb-7">
                                    <x-metronic.label for="image"
                                        class="col-form-label fw-bold fs-6 ">{{ __('Profile Image') }}
                                    </x-metronic.label>
                                    <x-metronic.file-input id="image" name="image"
                                        :value="old('image')"></x-metronic.file-input>
                                </div>
                                <div class="col-lg-8 mb-7">
                                    <x-metronic.label for="message"
                                        class="col-form-label fw-bold fs-6 ">{{ __('Your Message') }}
                                    </x-metronic.label>
                                    <x-metronic.textarea id="message" name="message"></x-metronic.textarea>
                                </div>
                                <div class="col-lg-4 mb-7">
                                    <x-metronic.label for="rating" class="col-form-label required fw-bold fs-6">
                                        {{ __('Select a Rating ') }}</x-metronic.label>
                                    <x-metronic.select-option id="rating" name="rating" data-hide-search="true"
                                        data-placeholder="Select an option">
                                        <option></option>
                                        <option value="1" @selected(old('rating')=='1')>1</option>
                                        <option value="2" @selected(old('rating')=='2')>2</option>
                                        <option value="3" @selected(old('rating')=='3')>3</option>
                                        <option value="4" @selected(old('rating')=='4')>4</option>
                                        <option value="5" @selected(old('rating')=='5')>5</option>
                                    </x-metronic.select-option>
                                </div>
                                <div class="col-lg-4 mb-7">
                                    <x-metronic.label for="status" class="col-form-label required fw-bold fs-6">
                                        {{ __('Select a Status ') }}</x-metronic.label>
                                    <x-metronic.select-option id="status" name="status" data-hide-search="true"
                                        data-placeholder="Select an option">
                                        <option></option>
                                        <option value="active" @selected(old('status')=="active")>Active</option>
                                        <option value="inactive" @selected(old('status')=="inactive")>Inactive</option>
                                    </x-metronic.select-option>
                                </div>
                            </div>
                            <div class="text-center pt-15">
                                <x-metronic.button type="submit" class="primary">
                                    {{ __('Submit') }}
                                </x-metronic.button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
