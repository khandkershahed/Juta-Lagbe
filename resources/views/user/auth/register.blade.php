<x-frontend-app-layout :title="'Sign Up'">
    <style>
        .register-bg {
            background-position: center;
            background-size: contain;
            background-image: url('{{ asset('frontend/img/bg3.png') }}');
            background-repeat: no-repeat;
        }

        ::placeholder {
            color: #707070 !important;
            opacity: 1;
            font-size: 16px;
            /* Firefox */
        }
    </style>
    <div class="ps-account register-bg">
        <div class="container">
            <div class="row my-5 align-items-center pb-5">
                <div class="col-lg-12">
                    <div class="text-center pb-5">
                        <h1>Please Complete the Form Below, <br> to Register for an Account.</h1>
                    </div>
                </div>
                <div class="col-12 col-md-8 offset-lg-2 mx-auto">
                    <form method="POST" action="{{ route('register') }}" id="customerForm">
                        @csrf
                        <div class="bg-light p-5">
                            <div class="ps-form--review row mb-5">
                                <div class="ps-form__group col-12 col-xl-2">
                                    <x-input-label class="ps-form__label" for="title" :value="__('Title')" />
                                    <div class="input-group">
                                        <select name="title" class="form-select ps-form__input" id="title">
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Ms">Ms</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <!-- First Name -->
                                <div class="ps-form__group col-12 col-xl-5">
                                    <x-input-label class="ps-form__label" for="first_name">First Name <span
                                            class="text-danger">*</span></x-input-label>
                                    <input id="first_name" class="form-control ps-form__input" type="text"
                                        name="first_name" value="{{ old('first_name') }}" autofocus required
                                        autocomplete="first_name" placeholder="Enter Your First Name" />
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>

                                <!-- Last Name -->
                                <div class="ps-form__group col-12 col-xl-5">
                                    <x-input-label class="ps-form__label" for="last_name" :value="__('Last Name')" />
                                    <input id="last_name" class="form-control ps-form__input" type="text"
                                        name="last_name" placeholder="Enter Your Last Name" value="{{ old('last_name') }}" autofocus autocomplete="last_name" />
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>

                                <!-- Email -->
                                <div class="ps-form__group col-12 col-xl-6">
                                    <label class="ps-form__label" for="email">Email<span
                                            class="text-danger">*</span></label>
                                    <input id="email" class="form-control ps-form__input" type="email"
                                        name="email" placeholder="Enter Your Email" value="{{ old('email') }}" autocomplete="email" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Confirm Email -->
                                <!-- Phone -->
                                <div class="ps-form__group col-12 col-xl-6">
                                    <x-input-label class="ps-form__label" for="phone" :value="__('Phone')" />
                                    <div class="input-group">
                                        <input id="phone" class="form-control ps-form__input" type="tel"
                                            name="phone" placeholder="Enter Your Phone Number" value="{{ old('phone') }}" autocomplete="tel" />
                                    </div>
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                                <!-- Password -->

                                <div class="ps-form__group col-12 col-xl-6">
                                    <x-input-label class="ps-form__label" for="password" :value="__('Password')" />
                                    <div class="input-group">
                                        <input id="password" class="form-control ps-form__input" type="password"
                                            name="password" value="{{ old('password') }}" autocomplete="new-password" />
                                        <div class="input-group-append">
                                            <a class="fa fa-eye-slash toogle-password" href="javascript:void(0);"></a>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="ps-form__group col-12 col-xl-6">
                                    <x-input-label class="ps-form__label" for="password_confirmation"
                                        :value="__('Confirm Password')" />
                                    <div class="input-group">
                                        <input id="password_confirmation" class="form-control ps-form__input"
                                            type="password" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}" autocomplete="new-password" />
                                        <div class="input-group-append">
                                            <a class="fa fa-eye-slash toogle-password" href="javascript:void(0);"></a>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                                <!-- Title -->
                                <div class="col-12 col-xl-12">
                                    <p>Address Details</p>
                                </div>
                                <!-- House/Block/Road -->
                                <div class="ps-form__group col-12 col-xl-8">
                                    <label class="ps-form__label" for="House/Block/Road">Full Address<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="address_one" class="form-control ps-form__input" type="text"
                                            value="{{ old('address_one') }}" placeholder="Enter Your Full Address"  name="address_one" autocomplete="address_one"
                                            required />
                                    </div>
                                    <x-input-error :messages="$errors->get('address_one')" class="mt-2" />
                                </div>
                                <div class="ps-form__group col-12 col-xl-4">
                                    <div class="ps-checkout__group">
                                        <label class="ps-form__label">District</label>
                                        <input class="form-control ps-form__input" type="text" name="state" />
                                    </div>
                                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                                </div>

                                <!-- State -->
                                {{-- <div class="ps-form__group col-4">
                                    <x-input-label class="ps-form__label" for="state" :value="__('State')" />
                                    <div class="input-group">
                                        <input id="state" class="form-control ps-form__input" type="text"
                                            name="state" :value="old('state')" autocomplete="state" />
                                    </div>
                                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                                </div> --}}

                                <!-- City/Country -->
                                <div class="ps-form__group col-12 col-xl-4">
                                    <label class="ps-form__label" for="City">City</label>
                                    <div class="input-group">
                                        <input id="address_two" class="form-control ps-form__input" type="text"
                                            name="address_two" placeholder="Enter Your City Name" value="{{ old('address_two') }}" autocomplete="address_two"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('address_two')" class="mt-2" />
                                </div>
                                <!-- Zip Code -->
                                <div class="ps-form__group col-12 col-xl-4">
                                    <label class="ps-form__label" for="Zip Code">Upazila</label>
                                    <div class="input-group">
                                        <input id="zipcode" class="form-control ps-form__input" type="text"
                                            value="{{ old('zipcode') }}" placeholder="Enter Your Upazila" name="zipcode" autocomplete="zipcode" />
                                    </div>
                                    <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
                                </div>
                                <div class="ps-form__group col-12 col-xl-4">
                                    <label class="ps-form__label" for="Country">Country<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select name="country" class="form-select ps-form__input" id="country">
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Åland Islands">Åland Islands</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh" selected>Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean
                                                Territory</option>
                                            <option value="British Virgin Islands">British Virgin Islands</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo - Brazzaville">Congo - Brazzaville</option>
                                            <option value="Congo - Kinshasa">Congo - Kinshasa</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Côte d’Ivoire">Côte d’Ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands">Falkland Islands</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories
                                            </option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and McDonald Islands">Heard Island and McDonald
                                                Islands</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong SAR China">Hong Kong SAR China</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Laos">Laos</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macau SAR China">Macau SAR China</option>
                                            <option value="Macedonia">Macedonia</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia">Micronesia</option>
                                            <option value="Moldova">Moldova</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar [Burma]">Myanmar [Burma]</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="North Korea">North Korea</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territories">Palestinian Territories</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn Islands">Pitcairn Islands</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Réunion">Réunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Barthélemy">Saint Barthélemy</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Martin">Saint Martin</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon
                                            </option>
                                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the
                                                Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia">South Georgia</option>
                                            <option value="South Korea">South Korea</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-Leste">Timor-Leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United State" >United State</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="U.S. Minor Outlying Islands">U.S. Minor Outlying Islands
                                            </option>
                                            <option value="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Vatican City">Vatican City</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                </div>

                                <div class="col-12 col-xl-12">
                                    <p class="pt-3">Newsletter Preferences</p>
                                </div>
                                <div class="col-12 col-xl-12">
                                    <div class="form-check ml-0">
                                        <input type="radio" class="form-check-input" id="newsletterYes"
                                            name="newsletter_preference" value="yes">
                                        <label class="form-check-label" for="newsletterYes">Yes please,
                                            send me email newsletters</label>
                                    </div> <br>
                                    <div class="form-check ml-0">
                                        <input type="radio" class="form-check-input" id="newsletterNo"
                                            name="newsletter_preference" value="no" checked>
                                        <label class="form-check-label" for="newsletterNo">No thanks,
                                            please don't send me email newsletters</label>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-12">
                                    <p class="pt-3">Terms & Conditions <span class="text-danger">*</span></p>
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
                            <div class="col-12 col-xl-12 my-3">
                                <h6 class="">
                                    <span class="fs-bold">{{ __('Already have an accounts?') }}</span>
                                    <a href="{{ route('login') }}"
                                        class="btn btn-sm btn-link text-gray fw-bold fs-6 site_text_color_links">Log In
                                        Now</a>
                                </h6>
                            </div>
                            <div class="ps-form__submit pt-3">
                                <x-primary-button class="btn btn-primary register-btns" type="submit">
                                    <i class="fa-regular fa-id-badge pr-2"></i>  {{ __('Register') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
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
