<x-admin-app-layout :title="'Experience Edit'">
    <div class="card card-flash">
        <!--begin::Card header-->
        <div class="card-header mt-6">
            <div class="card-title"></div>

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ route('admin.experiences.index') }}" class="btn btn-light-info rounded-2">
                    <!--begin::Svg Experience | path: experiences/duotune/general/gen035.svg-->
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
                    <!--end::Svg Experience-->Back to the list
                </a>
            </div>
        </div>
        <div class="card-body pt-0">
            <!--begin::Form-->
            <form class="form" action="{{ route('admin.experiences.update', $experience->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--begin::Input group-->
                <div class="row">

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="quote"
                            class="col-form-label fw-bold fs-6 required">{{ __('Quote') }}
                        </x-metronic.label>

                        <x-metronic.input id="quote" type="text" name="quote" :value="$experience->quote"
                            placeholder="Enter the Quote"></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="starting_year"
                            class="col-form-label fw-bold fs-6 required">{{ __('Starting Year') }}
                        </x-metronic.label>

                        <x-metronic.input id="starting_year" type="number" name="starting_year" :value="$experience->starting_year"
                            placeholder="Enter the Starting Year"></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="end_year"
                            class="col-form-label fw-bold fs-6 required">{{ __('End Year') }}
                        </x-metronic.label>

                        <x-metronic.input id="end_year" type="number" name="end_year" :value="$experience->end_year"
                            placeholder="Enter the End Year"></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="role"
                            class="col-form-label fw-bold fs-6 required">{{ __('Role') }}
                        </x-metronic.label>

                        <x-metronic.input id="role" type="text" name="role" :value="$experience->role"
                            placeholder="Enter the Role"></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="organization"
                            class="col-form-label fw-bold fs-6 required">{{ __('Organization') }}
                        </x-metronic.label>

                        <x-metronic.input id="organization" type="text" name="organization" :value="$experience->organization"
                            placeholder="Enter the Organization"></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="short_description"
                            class="col-form-label fw-bold fs-6 required">{{ __('Short Description') }}
                        </x-metronic.label>

                        <x-metronic.input id="short_description" type="text" name="short_description"
                            :value="$experience->short_description" placeholder="Enter the Short Description"></x-metronic.input>
                    </div>
                </div>
                <div class="text-center pt-15">
                    <x-metronic.button type="submit" class="primary">
                        {{ __('Update') }}
                    </x-metronic.button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</x-admin-app-layout>