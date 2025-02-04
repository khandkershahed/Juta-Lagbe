<x-frontend-app-layout :title="'Sign Up'">
    <style>
        .register-bg {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        ::placeholder {
            color: #707070 !important;
            opacity: 1;
            font-size: 16px;
            /* Firefox */
        }

        .input-group-append {
            margin-left: -1px;
            position: relative;
            top: 0px;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 9px;
        }
    </style>
    <div class="pb-4 register-bg">
        <div class="container">
            <div class="bg-white row align-items-center gx-0 my-lg-5">
                <div class="px-0 col-lg-6">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="pl-5 col-lg-12">
                                <div class="p-3">
                                    <div class="mb-4 d-flex justify-content-center align-items-center">
                                        <a href="{{ route('home') }}" class="">
                                            <img class="img-fluid" width="200px"
                                                src="{{ !empty(optional($setting)->site_logo_black) ? asset('storage/' . optional($setting)->site_logo_black) : asset('frontend/img/logo.png') }}"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="text-center text-lg-start">
                                        <h2 class="mb-0 ps-form__title">Welcome</h2>
                                        <p>Register To Get Unlimited Access & Data</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <form method="POST" action="{{ route('register') }}" id="customerForm">
                            @csrf
                            <div class="p-5">
                                <div class="mb-3 ps-form--review row">
                                    <!-- First Name -->
                                    <div class="ps-form__group col-12 col-xl-12">
                                        <x-input-label class="ps-form__label" for="name">আপনার নাম<span
                                                class="text-danger">*</span></x-input-label>
                                        <input id="name" class="form-control ps-form__input" type="text"
                                            name="name" value="{{ old('name') }}" autofocus required
                                            autocomplete="name" placeholder="আপনার নাম" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <!-- Email -->
                                    {{-- <div class="mt-3 ps-form__group col-12 col-xl-4">
                                        <label class="ps-form__label" for="email">ইমেইল<span
                                                class="text-danger">*</span></label>
                                        <input id="email" class="form-control ps-form__input" type="email"
                                            name="email" placeholder="আপনার ইমেইল" value="{{ old('email') }}"
                                            autocomplete="email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div> --}}

                                    <!-- Confirm Email -->
                                    <!-- Phone -->
                                    <div class="mt-3 ps-form__group col-12 col-xl-6">
                                        <x-input-label class="ps-form__label" for="phone" :value="__('ফোন নাম্বার')" />
                                        <div class="input-group">
                                            <input id="phone" class="form-control ps-form__input" type="tel"
                                                name="phone" placeholder="আপনার ফোন নাম্বার"
                                                value="{{ old('phone') }}" autocomplete="tel" />
                                        </div>
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>
                                    <!-- Password -->

                                    <div class="mt-3 ps-form__group col-12 col-xl-6">
                                        <x-input-label class="ps-form__label" for="password" :value="__('Password')" />
                                        <div class="input-group">
                                            <input id="password" class="form-control ps-form__input" type="password"
                                                name="password" value="{{ old('password') }}"
                                                autocomplete="new-password" />
                                            <div class="input-group-append">
                                                <a class="fa fa-eye-slash toogle-password"
                                                    href="javascript:void(0);"></a>
                                            </div>
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <!-- Title -->
                                    <div class="mb-3 col-12 col-xl-4">
                                        <div class="pt-2 ps-form__group">
                                            <label class="block text-sm font-medium site-text ps-form__label" for="division">
                                                বিভাগ
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="division" id="division" class="form-control select ps-form__input" required>
                                                <option value="" disabled selected>বিভাগ</option>
                                                @foreach ($bd_divisions as $division)
                                                    <option value="{{ $division->bn_name }}" @selected(old('division') == $division->bn_name)>{{ $division->bn_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-12 col-xl-4">
                                        <div class="pt-2 ps-form__group">
                                            <label class="block text-sm font-medium site-text ps-form__label" for="district">
                                                জেলা
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="district" id="district" class="form-control select ps-form__input" required>
                                                <option value="" disabled selected>জেলা</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-12 col-xl-4">
                                        <div class="pt-2 ps-form__group">
                                            <label class="block text-sm font-medium site-text ps-form__label" for="thana">
                                                থানা
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="thana" id="thana" class="form-control ps-form__input" required>
                                                <option value="" disabled selected>থানা</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- House/Block/Road -->
                                    <div class="mt-3 ps-form__group col-12 col-xl-12">
                                        <label class="ps-form__label" for="House/Block/Road">ঠিকানা<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input id="address_one" class="form-control ps-form__input"
                                                type="text" value="{{ old('address_one') }}"
                                                placeholder="Enter Your Full Address" name="address_one"
                                                autocomplete="address_one" required />
                                        </div>
                                        <x-input-error :messages="$errors->get('address_one')" class="mt-2" />
                                    </div>
                                    <div class="col-12 col-xl-12">
                                        <p class="pt-4 ps-form__label ">শর্তাবলী ও নিয়মাবলী<span
                                                class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-12 col-xl-12">
                                        <div class="ml-0 form-check">
                                            <input type="checkbox" class="form-check-input" id="terms_condition"
                                                name="terms_condition" value="yes" required checked>
                                            <label class="form-check-label" for="terms_condition">I accept the
                                                Terms and Conditions & Privacy Policy. <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-12">
                                    <h6 class="">
                                        <span style="font-size: 16px">{{ __('Already have an accounts?') }}</span>
                                        <a href="{{ route('login') }}"
                                            class="btn btn-sm btn-link text-gray fw-bold fs-6 site_text_color_links">Log
                                            In Now</a>
                                    </h6>
                                </div>
                                <div class="pt-4 ps-form__submit">
                                    <x-primary-button class="btn btn-primary register-btns" type="submit">
                                        <i class="pr-2 fa-regular fa-id-badge"></i> {{ __('Register') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="px-0 col-lg-6">
                    <div>
                        <img class="img-fluid" src="{{ asset('images/login-banner.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.getElementById('customerForm').addEventListener('submit', function(event) {
                // Get form elements
                var name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var address_one = document.getElementById('address_one').value;
                var address_two = document.getElementById('address_two').value;
                var zipcode = document.getElementById('zipcode').value;
                var cityCountry = document.getElementById('cityCountry').value;
                var suppliers = document.getElementById('suppliers').value;
                var terms_condition = document.getElementById('terms_condition').checked;
                var customerType = document.getElementById('customerType').value;

                // Basic validation
                if (name.length < 2) {
                    alert('First Name must be at least 2 characters.');
                    event.preventDefault();
                    return;
                }

                if (!validateEmail(email)) {
                    alert('Please enter a valid email address.');
                    event.preventDefault();
                    return;
                }

                if (address_two.length < 5) {
                    alert('Address must be at least 5 characters.');
                    event.preventDefault();
                    return;
                }
                if (address_one.length < 5) {
                    alert('Address must be at least 5 characters.');
                    event.preventDefault();
                    return;
                }

                if (!/^\d{5}(-\d{4})?$/.test(zipcode)) {
                    alert('Zip Code must be in the format 12345 or 12345-6789.');
                    event.preventDefault();
                    return;
                }

                if (cityCountry.length < 2) {
                    alert('City/Country must be at least 2 characters.');
                    event.preventDefault();
                    return;
                }

                if (suppliers.length < 10) {
                    alert('Suppliers field must be at least 10 characters.');
                    event.preventDefault();
                    return;
                }

                if (!terms_condition) {
                    alert('You must accept the Terms and Conditions.');
                    event.preventDefault();
                    return;
                }

                if (!customerType) {
                    alert('Please select a Customer Type.');
                    event.preventDefault();
                    return;
                }
            });

            function validateEmail(email) {
                var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
        </script>
    @endpush
</x-frontend-app-layout>
