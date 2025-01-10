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
            top: 10px;
        }
    </style>
    <div class=" register-bg">
        <div class="container">
            <div class="row align-items-center gx-0 py-5 mb-4">
                <div class="col-lg-6 px-0">
                    <div class="my-5">
                        <form method="POST" action="{{ route('register') }}" id="customerForm">
                            @csrf
                            <div class="bg-light p-5">
                                <div class="ps-form--review row mb-3">
                                    <!-- First Name -->
                                    <div class="ps-form__group col-12 col-xl-12">
                                        <x-input-label class="ps-form__label" for="first_name">আপনার নাম<span
                                                class="text-danger">*</span></x-input-label>
                                        <input id="first_name" class="form-control ps-form__input" type="text"
                                            name="first_name" value="{{ old('first_name') }}" autofocus required
                                            autocomplete="first_name" placeholder="Enter Your First Name" />
                                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>

                                    <!-- Email -->
                                    <div class="ps-form__group col-12 col-xl-4 mt-3">
                                        <label class="ps-form__label" for="email">ইমেইল<span
                                                class="text-danger">*</span></label>
                                        <input id="email" class="form-control ps-form__input" type="email"
                                            name="email" placeholder="Enter Your Email" value="{{ old('email') }}"
                                            autocomplete="email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Email -->
                                    <!-- Phone -->
                                    <div class="ps-form__group col-12 col-xl-4 mt-3">
                                        <x-input-label class="ps-form__label" for="phone" :value="__('ফোন নাম্বার')" />
                                        <div class="input-group">
                                            <input id="phone" class="form-control ps-form__input" type="tel"
                                                name="phone" placeholder="Enter Your Phone Number"
                                                value="{{ old('phone') }}" autocomplete="tel" />
                                        </div>
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>
                                    <!-- Password -->

                                    <div class="ps-form__group col-12 col-xl-4 mt-3">
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
                                    <div class="ps-form__group col-12 col-xl-6 mt-3">
                                        <div class="ps-checkout__group">
                                            <label class="ps-form__label">জেলা</label>
                                            <input class="form-control ps-form__input" type="text" name="state" />
                                        </div>
                                        <x-input-error :messages="$errors->get('state')" class="mt-2" />
                                    </div>

                                    <!-- City/Country -->
                                    <div class="ps-form__group col-12 col-xl-6 mt-3">
                                        <label class="ps-form__label" for="City">থানা</label>
                                        <div class="input-group">
                                            <input id="address_two" class="form-control ps-form__input" type="text"
                                                name="address_two" placeholder="Enter Your City Name"
                                                value="{{ old('address_two') }}" autocomplete="address_two" />
                                        </div>
                                        <x-input-error :messages="$errors->get('address_two')" class="mt-2" />
                                    </div>
                                    <!-- House/Block/Road -->
                                    <div class="ps-form__group col-12 col-xl-12 mt-3">
                                        <label class="ps-form__label" for="House/Block/Road">ঠিকানা<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input id="address_one" class="form-control ps-form__input" type="text"
                                                value="{{ old('address_one') }}" placeholder="Enter Your Full Address"
                                                name="address_one" autocomplete="address_one" required />
                                        </div>
                                        <x-input-error :messages="$errors->get('address_one')" class="mt-2" />
                                    </div>
                                    <div class="col-12 col-xl-12">
                                        <p class="pt-4 ps-form__label ">শর্তাবলী ও নিয়মাবলী<span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-12 col-xl-12">
                                        <div class="form-check ml-0">
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
                                            class="btn btn-sm btn-link text-gray fw-bold fs-6 site_text_color_links">Log In Now</a>
                                    </h6>
                                </div>
                                <div class="ps-form__submit pt-4">
                                    <x-primary-button class="btn btn-primary register-btns" type="submit">
                                        <i class="fa-regular fa-id-badge pr-2"></i> {{ __('Register') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 px-0">
                    <div>
                        <img class="img-fluid" src="{{ asset('images/login-side-banner.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.getElementById('customerForm').addEventListener('submit', function(event) {
                // Get form elements
                var first_name = document.getElementById('first_name').value;
                var email = document.getElementById('email').value;
                var address_one = document.getElementById('address_one').value;
                var address_two = document.getElementById('address_two').value;
                var zipcode = document.getElementById('zipcode').value;
                var cityCountry = document.getElementById('cityCountry').value;
                var suppliers = document.getElementById('suppliers').value;
                var terms_condition = document.getElementById('terms_condition').checked;
                var customerType = document.getElementById('customerType').value;

                // Basic validation
                if (first_name.length < 2) {
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
