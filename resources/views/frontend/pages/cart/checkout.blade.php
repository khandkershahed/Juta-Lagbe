<x-frontend-app-layout :title="'Checkout'">
    <div class="ps-checkout">
        <div class="container mb-5">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Home</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page">
                    Checkout
                </li>
            </ul>
            <h3 class="ps-checkout__title">Checkout</h3>
            <div class="ps-checkout__content">
                <form action="{{ route('checkout.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="ps-checkout__form">
                                <div class="row">
                                    <div class="col-12 col-xl-6 mb-3">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="name">নাম<span class="text-danger">*</span>
                                            </label>
                                            <input id="name" class="form-control ps-form__input" type="text"
                                                name="name" value="{{ old('name', optional(Auth::user())->name) }}"
                                                autofocus="" autocomplete="name" placeholder="আপনার সম্পূর্ণ নাম"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-3">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="phone">মোবাইল নম্বার<span class="text-danger">*</span>
                                            </label>
                                            <input id="phone" class="form-control ps-form__input" type="number"
                                                name="phone" value="{{ old('phone', optional(Auth::user())->phone) }}"
                                                autofocus="" maxlength="11" autocomplete="phone"
                                                placeholder="আপনার মোবাইল নম্বার(017536...)" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6 mb-3">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="district">
                                                জেলা
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="district" class="form-control select ps-form__input" required
                                                id="district">
                                                <option value="" disabled selected>জেলা সিলেক্ট করুন</option>
                                                <option value="Dhaka" @selected(old('district' == 'Dhaka'))>ঢাকা</option>
                                                <option value="Faridpur" @selected(old('district' == 'Faridpur'))>ফরিদপুর</option>
                                                <option value="Gazipur" @selected(old('district' == 'Gazipur'))>গাজীপুর</option>
                                                <option value="Gopalganj" @selected(old('district' == 'Gopalganj'))>গোপালগঞ্জ
                                                </option>
                                                <option value="Kishoreganj" @selected(old('district' == 'Kishoreganj'))>কিশোরগঞ্জ
                                                </option>
                                                <option value="Madaripur" @selected(old('district' == 'Madaripur'))>মাদারীপুর
                                                </option>
                                                <option value="Manikganj" @selected(old('district' == 'Manikganj'))>মানিকগঞ্জ
                                                </option>
                                                <option value="Munshiganj" @selected(old('district' == 'Munshiganj'))>মুন্সিগঞ্জ
                                                </option>
                                                <option value="Narayanganj" @selected(old('district' == 'Narayanganj'))>নারায়ণগঞ্জ
                                                </option>
                                                <option value="Narsingdi" @selected(old('district' == 'Narsingdi'))>নরসিংদী</option>
                                                <option value="Rajbari" @selected(old('district' == 'Rajbari'))>রাজবাড়ী</option>
                                                <option value="Shariatpur" @selected(old('district' == 'Shariatpur'))>শরীয়তপুর
                                                </option>
                                                <option value="Tangail" @selected(old('district' == 'Tangail'))>টাঙ্গাইল</option>
                                                <option value="Barguna" @selected(old('district' == 'Barguna'))>বরগুনা</option>
                                                <option value="Barisal" @selected(old('district' == 'Barisal'))>বরিশাল</option>
                                                <option value="Bhola" @selected(old('district' == 'Bhola'))>ভোলা</option>
                                                <option value="Jhalokati" @selected(old('district' == 'Jhalokati'))>ঝালকাঠি</option>
                                                <option value="Patuakhali" @selected(old('district' == 'Patuakhali'))>পটুয়াখালী
                                                </option>
                                                <option value="Pirojpur" @selected(old('district' == 'Pirojpur'))>পিরোজপুর</option>
                                                <option value="Bandarban" @selected(old('district' == 'Bandarban'))>বান্দরবান
                                                </option>
                                                <option value="Brahmanbaria" @selected(old('district' == 'Brahmanbaria'))>
                                                    ব্রাহ্মণবাড়িয়া
                                                </option>
                                                <option value="Chandpur" @selected(old('district' == 'Chandpur'))>চাঁদপুর</option>
                                                <option value="Chittagong" @selected(old('district' == 'Chittagong'))>চট্টগ্রাম
                                                </option>
                                                <option value="Comilla" @selected(old('district' == 'Comilla'))>কুমিল্লা</option>
                                                <option value="Cox" @selected(old('district' == 'Cox')) s Bazar">কক্সবাজার
                                                </option>
                                                <option value="Feni" @selected(old('district' == 'Feni'))>ফেনী</option>
                                                <option value="Khagrachari" @selected(old('district' == 'Khagrachari'))>খাগড়াছড়ি
                                                </option>
                                                <option value="Lakshmipur" @selected(old('district' == 'Lakshmipur'))>লক্ষ্মীপুর
                                                </option>
                                                <option value="Noakhali" @selected(old('district' == 'Noakhali'))>নোয়াখালী
                                                </option>
                                                <option value="Rangamati" @selected(old('district' == 'Rangamati'))>রাঙ্গামাটি
                                                </option>
                                                <option value="Habiganj" @selected(old('district' == 'Habiganj'))>হবিগঞ্জ</option>
                                                <option value="Moulvibazar" @selected(old('district' == 'Moulvibazar'))>মৌলভীবাজার
                                                </option>
                                                <option value="Sylhet" @selected(old('district' == 'Sylhet'))>সিলেট</option>
                                                <option value="Jamalpur" @selected(old('district' == 'Jamalpur'))>জামালপুর</option>
                                                <option value="Mymensingh" @selected(old('district' == 'Mymensingh'))>ময়মনসিংহ
                                                </option>
                                                <option value="Netrokona" @selected(old('district' == 'Netrokona'))>নেত্রকোণা
                                                </option>
                                                <option value="Sherpur" @selected(old('district' == 'Sherpur'))>শেরপুর</option>
                                                <option value="Bogra" @selected(old('district' == 'Bogra'))>বগুড়া</option>
                                                <option value="Joypurhat" @selected(old('district' == 'Joypurhat'))>জয়পুরহাট
                                                </option>
                                                <option value="Naogaon" @selected(old('district' == 'Naogaon'))>নওগাঁ</option>
                                                <option value="Natore" @selected(old('district' == 'Natore'))>নাটোর</option>
                                                <option value="Chapainawabganj" @selected(old('district' == 'Chapainawabganj'))>
                                                    চাঁপাইনবাবগঞ্জ</option>
                                                <option value="Pabna" @selected(old('district' == 'Pabna'))>পাবনা</option>
                                                <option value="Rajshahi" @selected(old('district' == 'Rajshahi'))>রাজশাহী</option>
                                                <option value="Sirajganj" @selected(old('district' == 'Sirajganj'))>সিরাজগঞ্জ
                                                </option>
                                                <option value="Dinajpur" @selected(old('district' == 'Dinajpur'))>দিনাজপুর
                                                </option>
                                                <option value="Gaibandha" @selected(old('district' == 'Gaibandha'))>গাইবান্ধা
                                                </option>
                                                <option value="Kurigram" @selected(old('district' == 'Kurigram'))>কুড়িগ্রাম
                                                </option>
                                                <option value="Lalmonirhat" @selected(old('district' == 'Lalmonirhat'))>লালমনিরহাট
                                                </option>
                                                <option value="Nilphamari" @selected(old('district' == 'Nilphamari'))>নীলফামারী
                                                </option>
                                                <option value="Panchagarh" @selected(old('district' == 'Panchagarh'))>পঞ্চগড়
                                                </option>
                                                <option value="Rangpur" @selected(old('district' == 'Rangpur'))>রংপুর</option>
                                                <option value="Thakurgaon" @selected(old('district' == 'Thakurgaon'))>ঠাকুরগাঁও
                                                </option>
                                                <option value="Bagerhat" @selected(old('district' == 'Bagerhat'))>বাগেরহাট
                                                </option>
                                                <option value="Chuadanga" @selected(old('district' == 'Chuadanga'))>চুয়াডাঙ্গা
                                                </option>
                                                <option value="Jessore" @selected(old('district' == 'Jessore'))>যশোর</option>
                                                <option value="Jhenaidah" @selected(old('district' == 'Jhenaidah'))>ঝিনাইদহ
                                                </option>
                                                <option value="Khulna" @selected(old('district' == 'Khulna'))>খুলনা</option>
                                                <option value="Kushtia" @selected(old('district' == 'Kushtia'))>কুষ্টিয়া
                                                </option>
                                                <option value="Magura" @selected(old('district' == 'Magura'))>মাগুরা</option>
                                                <option value="Meherpur" @selected(old('district' == 'Meherpur'))>মেহেরপুর
                                                </option>
                                                <option value="Narail" @selected(old('district' == 'Narail'))>নড়াইল</option>
                                                <option value="Satkhira" @selected(old('district' == 'Satkhira'))>সাতক্ষীরা
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-3">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="thana">
                                                থানা
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input class="form-control ps-form__input" type="text" name="thana"
                                                value="{{ old('thana', optional(Auth::user())->thana) }}"
                                                autofocus="" autocomplete="thana" placeholder="আপনার থানা"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-12 mb-3">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="address">সম্পূর্ণ ঠিকানা
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input id="address" class="form-control ps-form__input" type="text"
                                                name="address" value="{{ old('address') }}" autofocus=""
                                                autocomplete="address" placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-3">
                                        <div class="ps-form__group pt-4">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="shipping_id">
                                                ডেলিভারি লোকেশন <span class="text-danger">*</span>
                                            </label>
                                            @foreach ($shippingmethods as $shippingmethod)
                                                <div class="checkout-checkbox">
                                                    <input class="inp-cbx" id="shipping_{{ $shippingmethod->id }}"
                                                        type="radio" name="shipping_id"
                                                        value="{{ $shippingmethod->id }}" @checked(old('shipping_id') == $shippingmethod->id)
                                                        data-shipping_price="{{ $shippingmethod->price }}" required />
                                                    <label class="cbx" for="shipping_{{ $shippingmethod->id }}">
                                                        <span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg>
                                                        </span>
                                                        <span>{{ $shippingmethod->title }}
                                                            {{ $shippingmethod->duration }}
                                                            [৳{{ number_format($shippingmethod->price, 2) }}]
                                                        </span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-3">
                                        <div class="ps-form__group pt-4">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="payment_status">পেমেন্ট অপশন
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="checkout-checkbox">
                                                <input class="inp-cbx" id="cbx-006" type="radio"
                                                    name="payment_status" value="delivery_charge_paid"
                                                    @checked(old('payment_status') == 'delivery_charge_paid') />
                                                <label class="cbx" for="cbx-006"><span>
                                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                        </svg></span><span>শুধুমাত্র ডেলিভারি চার্জ পরিশোধ
                                                        করবো।</span>
                                                </label>
                                            </div>
                                            <div class="checkout-checkbox">
                                                <input class="inp-cbx" id="cbx-007" type="radio"
                                                    name="payment_status" value="completely_paid"
                                                    @checked(old('payment_status') == 'completely_paid') />
                                                <label class="cbx" for="cbx-007"><span>
                                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                        </svg></span><span>ফুল পেমেন্ট এখনি করবো।</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="ps-checkout__order mb-2">
                                <h3 class="ps-checkout__heading">আপনার অর্ডার</h3>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">প্রোডাক্ট</div>
                                    <div class="ps-title">মূল্য</div>
                                </div>
                                @foreach ($cartItems as $cartItem)
                                    <div class="ps-checkout__row ps-product">
                                        <div class="ps-product__name">
                                            <a
                                                href="{{ route('product.details', $cartItem->model->slug) }}">{{ $cartItem->model->name }}</a>
                                            x <span>{{ convertToBangla($cartItem->qty) }}</span>
                                        </div>
                                        <div class="ps-product__price">
                                            ৳{{ convertToBangla(number_format($cartItem->price * $cartItem->qty, 2)) }}
                                        </div>
                                    </div>
                                @endforeach
                                <div class="ps-checkout__row">
                                    <div class="ps-title">মূল্য</div>
                                    <input type="hidden" name="sub_total" id="sub_total"
                                        value="{{ $subTotal }}">
                                    <div class="ps-product__price">৳{{ convertToBangla(number_format($subTotal, 2)) }}
                                    </div>
                                </div>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">কুরিয়ার চার্জ</div>
                                    <div class="ps-product__price" id="shippingCharge">৳{{ convertToBangla(0) }}
                                    </div>
                                </div>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">সর্বমোট মূল্য</div>
                                    <div class="ps-product__price" id="total-price-container">
                                        <input type="hidden" name="total_amount" id="total-input"
                                            value="{{ number_format($subTotal, 2) }}">
                                        ৳<span id="total-price"
                                            style="font-weight: 600;">{{ convertToBangla(number_format($subTotal, 2)) }}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="ps-checkout__payment">
                                <div class="check-faq">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="agree-faq" checked
                                            required />
                                        <label class="form-check-label" for="agree-faq">
                                            I have read and agree to the website terms and conditions *</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-4 register-btns">
                                    <i class="fa-solid fa-clipboard-check pr-2"></i> Place order
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                const subtotal = parseFloat('{{ $subTotal }}');
                const totalInput = document.getElementById('total-input');
                const totalPriceSpan = document.getElementById('total-price');

                document.querySelectorAll('input[name="shipping_id"]').forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        const shippingPrice = parseFloat(this.getAttribute('data-shipping_price')) || 0;
                        const total = subtotal + shippingPrice;

                        console.log('Shipping Price:', shippingPrice);
                        console.log('Calculated Total:', total);

                        totalInput.value = total.toFixed(2);
                        totalPriceSpan.textContent = total.toFixed(2);
                    });
                });
            });
        </script> --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function convertToBangla(number) {
                    const englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                    const banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

                    return number.replace(/[0-9]/g, function(digit) {
                        return banglaDigits[englishDigits.indexOf(digit)];
                    });
                }
                const subtotal = parseFloat('{{ $subTotal }}');
                const totalInput = document.getElementById('total-input');
                const totalPriceSpan = document.getElementById('total-price');
                const shippingCharge = document.getElementById('shippingCharge');

                document.querySelectorAll('input[name="shipping_id"]').forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        const shippingPrice = parseFloat(this.getAttribute('data-shipping_price')) || 0;
                        const total = subtotal + shippingPrice;
                        shippingCharge.textContent = convertToBangla(shippingPrice.toFixed(2));

                        totalInput.value = total.toFixed(2); // Update hidden field value
                        totalPriceSpan.textContent = convertToBangla(total.toFixed(
                            2)); // Update the visible total price
                    });
                });
                const defaultShippingRadio = document.querySelector('input[name="shipping_id"]:checked');
                if (defaultShippingRadio) {
                    defaultShippingRadio.dispatchEvent(new Event('change'));
                }

            });
        </script>
    @endpush
</x-frontend-app-layout>
