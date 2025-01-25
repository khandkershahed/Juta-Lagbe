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
            <div class="row align-items-center gx-0 bg-white my-lg-5">
                <div class="col-lg-6 px-0">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 pl-5">
                                <div class="p-3">
                                    <div class="d-flex justify-content-center align-items-center mb-4">
                                        <a href="{{ route('home') }}" class="">
                                            <img class="img-fluid" width="200px"
                                                src="{{ !empty(optional($setting)->site_logo_black) ? asset('storage/' . optional($setting)->site_logo_black) : asset('frontend/img/logo.png') }}"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="text-lg-start text-center">
                                        <h2 class="ps-form__title mb-0">Welcome</h2>
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
                                <div class="ps-form--review row mb-3">
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
                                    <div class="ps-form__group col-12 col-xl-4 mt-3">
                                        <label class="ps-form__label" for="email">ইমেইল<span
                                                class="text-danger">*</span></label>
                                        <input id="email" class="form-control ps-form__input" type="email"
                                            name="email" placeholder="আপনার ইমেইল" value="{{ old('email') }}"
                                            autocomplete="email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Email -->
                                    <!-- Phone -->
                                    <div class="ps-form__group col-12 col-xl-4 mt-3">
                                        <x-input-label class="ps-form__label" for="phone" :value="__('ফোন নাম্বার')" />
                                        <div class="input-group">
                                            <input id="phone" class="form-control ps-form__input" type="tel"
                                                name="phone" placeholder="আপনার ফোন নাম্বার"
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
                                            <select name="district" class="form-select ps-form__input" required
                                                id="district">
                                                <option value="" disabled selected>জেলা সিলেক্ট করুন</option>
                                                <option value="Dhaka" data-name="Dhaka">ঢাকা</option>
                                                <option value="Faridpur" data-name="Faridpur">ফরিদপুর</option>
                                                <option value="Gazipur" data-name="Gazipur">গাজীপুর</option>
                                                <option value="Gopalganj" data-name="Gopalganj">গোপালগঞ্জ</option>
                                                <option value="Kishoreganj" data-name="Kishoreganj">কিশোরগঞ্জ</option>
                                                <option value="Madaripur" data-name="Madaripur">মাদারীপুর</option>
                                                <option value="Manikganj" data-name="Manikganj">মানিকগঞ্জ</option>
                                                <option value="Munshiganj" data-name="Munshiganj">মুন্সিগঞ্জ</option>
                                                <option value="Narayanganj" data-name="Narayanganj">নারায়ণগঞ্জ</option>
                                                <option value="Narsingdi" data-name="Narsingdi">নরসিংদী</option>
                                                <option value="Rajbari" data-name="Rajbari">রাজবাড়ী</option>
                                                <option value="Shariatpur" data-name="Shariatpur">শরীয়তপুর</option>
                                                <option value="Tangail" data-name="Tangail">টাঙ্গাইল</option>
                                                <option value="Barguna" data-name="Barguna">বরগুনা</option>
                                                <option value="Barisal" data-name="Barisal">বরিশাল</option>
                                                <option value="Bhola" data-name="Bhola">ভোলা</option>
                                                <option value="Jhalokati" data-name="Jhalokati">ঝালকাঠি</option>
                                                <option value="Patuakhali" data-name="Patuakhali">পটুয়াখালী</option>
                                                <option value="Pirojpur" data-name="Pirojpur">পিরোজপুর</option>
                                                <option value="Bandarban" data-name="Bandarban">বান্দরবান</option>
                                                <option value="Brahmanbaria" data-name="Brahmanbaria">ব্রাহ্মণবাড়িয়া
                                                </option>
                                                <option value="Chandpur" data-name="Chandpur">চাঁদপুর</option>
                                                <option value="Chittagong" data-name="Chittagong">চট্টগ্রাম</option>
                                                <option value="Comilla" data-name="Comilla">কুমিল্লা</option>
                                                <option value="Cox" data-name="Cox's Bazar">কক্সবাজার</option>
                                                <option value="Feni" data-name="Feni">ফেনী</option>
                                                <option value="Khagrachari" data-name="Khagrachari">খাগড়াছড়ি
                                                </option>
                                                <option value="Lakshmipur" data-name="Lakshmipur">লক্ষ্মীপুর</option>
                                                <option value="Noakhali" data-name="Noakhali">নোয়াখালী</option>
                                                <option value="Rangamati" data-name="Rangamati">রাঙ্গামাটি</option>
                                                <option value="Habiganj" data-name="Habiganj">হবিগঞ্জ</option>
                                                <option value="Moulvibazar" data-name="Moulvibazar">মৌলভীবাজার
                                                </option>
                                                <option value="Sylhet" data-name="Sylhet">সিলেট</option>
                                                <option value="Jamalpur" data-name="Jamalpur">জামালপুর</option>
                                                <option value="Mymensingh" data-name="Mymensingh">ময়মনসিংহ</option>
                                                <option value="Netrokona" data-name="Netrokona">নেত্রকোণা</option>
                                                <option value="Sherpur" data-name="Sherpur">শেরপুর</option>
                                                <option value="Bogra" data-name="Bogra">বগুড়া</option>
                                                <option value="Joypurhat" data-name="Joypurhat">জয়পুরহাট</option>
                                                <option value="Naogaon" data-name="Naogaon">নওগাঁ</option>
                                                <option value="Natore" data-name="Natore">নাটোর</option>
                                                <option value="Chapainawabganj" data-name="Chapainawabganj">
                                                    চাঁপাইনবাবগঞ্জ</option>
                                                <option value="Pabna" data-name="Pabna">পাবনা</option>
                                                <option value="Rajshahi" data-name="Rajshahi">রাজশাহী</option>
                                                <option value="Sirajganj" data-name="Sirajganj">সিরাজগঞ্জ</option>
                                                <option value="Dinajpur" data-name="Dinajpur">দিনাজপুর</option>
                                                <option value="Gaibandha" data-name="Gaibandha">গাইবান্ধা</option>
                                                <option value="Kurigram" data-name="Kurigram">কুড়িগ্রাম</option>
                                                <option value="Lalmonirhat" data-name="Lalmonirhat">লালমনিরহাট
                                                </option>
                                                <option value="Nilphamari" data-name="Nilphamari">নীলফামারী</option>
                                                <option value="Panchagarh" data-name="Panchagarh">পঞ্চগড়</option>
                                                <option value="Rangpur" data-name="Rangpur">রংপুর</option>
                                                <option value="Thakurgaon" data-name="Thakurgaon">ঠাকুরগাঁও</option>
                                                <option value="Bagerhat" data-name="Bagerhat">বাগেরহাট</option>
                                                <option value="Chuadanga" data-name="Chuadanga">চুয়াডাঙ্গা</option>
                                                <option value="Jessore" data-name="Jessore">যশোর</option>
                                                <option value="Jhenaidah" data-name="Jhenaidah">ঝিনাইদহ</option>
                                                <option value="Khulna" data-name="Khulna">খুলনা</option>
                                                <option value="Kushtia" data-name="Kushtia">কুষ্টিয়া</option>
                                                <option value="Magura" data-name="Magura">মাগুরা</option>
                                                <option value="Meherpur" data-name="Meherpur">মেহেরপুর</option>
                                                <option value="Narail" data-name="Narail">নড়াইল</option>
                                                <option value="Satkhira" data-name="Satkhira">সাতক্ষীরা</option>

                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('district')" class="mt-2" />
                                    </div>

                                    <!-- City/Country -->
                                    <div class="ps-form__group col-12 col-xl-6 mt-3">
                                        <label class="ps-form__label" for="City">থানা</label>
                                        <div class="input-group">
                                            <input id="address_two" class="form-control ps-form__input"
                                                type="text" name="address_two" placeholder="Enter Your City Name"
                                                value="{{ old('address_two') }}" autocomplete="address_two" />
                                        </div>
                                        <x-input-error :messages="$errors->get('address_two')" class="mt-2" />
                                    </div>
                                    <!-- House/Block/Road -->
                                    <div class="ps-form__group col-12 col-xl-12 mt-3">
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
                                            class="btn btn-sm btn-link text-gray fw-bold fs-6 site_text_color_links">Log
                                            In Now</a>
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
