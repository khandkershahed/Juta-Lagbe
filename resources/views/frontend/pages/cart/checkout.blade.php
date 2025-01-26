<x-frontend-app-layout :title="'Checkout'">
    <div class="ps-checkout">
        <div class="container mb-5 px-0 pb-4">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Home</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page">
                    Checkout
                </li>
            </ul>
            <div class="ps-checkout__content">
                <form action="{{ route('checkout.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card border-0">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <h3 class="mb-0 site-text">অর্ডার সম্পূর্ণ করতে আপনার তথ্য দিন</h3>
                                <h3 class="mb-0 site-text">আপনার অর্ডার</h3>
                            </div>
                        </div>
                        <div class="card-body py-0 pr-0">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="ps-checkout__form border-0 mb-0 pb-0">
                                        <div class="row">
                                            <div class="col-12 col-xl-6 mb-3">
                                                <div class="ps-form__group pt-2">
                                                    <label class="block font-medium text-sm site-text ps-form__label"
                                                        for="name">নাম<span class="text-danger">*</span>
                                                    </label>
                                                    <input id="name" class="form-control ps-form__input"
                                                        type="text" name="name"
                                                        value="{{ old('name', optional(Auth::user())->name) }}"
                                                        autofocus="" autocomplete="name" placeholder="সম্পূর্ণ নাম"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-6 mb-3">
                                                <div class="ps-form__group pt-2">
                                                    <label class="block font-medium text-sm site-text ps-form__label"
                                                        for="phone">মোবাইল নম্বার<span class="text-danger">*</span>
                                                    </label>
                                                    <input id="phone" class="form-control ps-form__input"
                                                        type="number" name="phone"
                                                        value="{{ old('phone', optional(Auth::user())->phone) }}"
                                                        autofocus="" maxlength="11" autocomplete="phone"
                                                        placeholder="মোবাইল নম্বার" required>
                                                </div>
                                            </div>

                                            <div class="col-12 col-xl-6 mb-3">
                                                <div class="ps-form__group pt-2">
                                                    <label class="block font-medium text-sm site-text ps-form__label"
                                                        for="division">
                                                        বিভাগ
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="division" id="division"
                                                        class="form-control select ps-form__input" required>
                                                        <option value="" disabled selected>বিভাগ</option>
                                                        @foreach ($bd_divisions as $division)
                                                            <option value="{{ $division->bn_name }}"
                                                                @selected(old('division') == $division->bn_name)>{{ $division->bn_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 col-xl-6 mb-3">
                                                <div class="ps-form__group pt-2">
                                                    <label class="block font-medium text-sm site-text ps-form__label"
                                                        for="district">
                                                        জেলা
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="district" id="district"
                                                        class="form-control select ps-form__input" required>
                                                        <option value="" disabled selected>জেলা</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 col-xl-6 mb-3">
                                                <div class="ps-form__group pt-2">
                                                    <label class="block font-medium text-sm site-text ps-form__label"
                                                        for="thana">
                                                        থানা
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="thana" id="thana"
                                                        class="form-control ps-form__input" required>
                                                        <option value="" disabled selected>থানা</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 col-xl-12 mb-3">
                                                <div class="ps-form__group pt-2">
                                                    <label class="block font-medium text-sm site-text ps-form__label"
                                                        for="address">সম্পূর্ণ ঠিকানা
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input id="address" class="form-control ps-form__input"
                                                        type="text" name="address" value="{{ old('address') }}"
                                                        autofocus="" autocomplete="address"
                                                        placeholder="সম্পূর্ণ ঠিকানা" required>
                                                </div>
                                            </div>
                                            {{-- <div class="col-12 col-xl-12 mb-3">
                                                <div class="ps-form__group pt-4">
                                                    <label class="block font-medium text-sm site-text ps-form__label"
                                                        for="shipping_id">
                                                        ডেলিভারি লোকেশন <span class="text-danger">*</span>
                                                    </label>
                                                    @foreach ($shippingmethods as $shippingmethod)
                                                        <div class="checkout-checkbox">
                                                            <input class="inp-cbx"
                                                                id="shipping_{{ $shippingmethod->id }}" type="radio"
                                                                name="shipping_id" value="{{ $shippingmethod->id }}"
                                                                @checked(old('shipping_id') == $shippingmethod->id)
                                                                data-shipping_price="{{ $shippingmethod->price }}"
                                                                required />
                                                            <label class="cbx"
                                                                for="shipping_{{ $shippingmethod->id }}">
                                                                <span>
                                                                    <svg width="12px" height="10px"
                                                                        viewbox="0 0 12 10">
                                                                        <polyline points="1.5 6 4.5 9 10.5 1">
                                                                        </polyline>
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
                                            </div> --}}

                                            <div class="col-12 col-xl-12 mb-3">
                                                <div class="ps-form__group pt-4">
                                                    <label class="block font-medium text-sm site-text ps-form__label"
                                                        for="payment_status">পেমেন্ট অপশন
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="checkout-checkbox">
                                                        <input class="inp-cbx" id="cbx-006" type="radio"
                                                            name="payment_status" value="delivery_charge_paid"
                                                            @checked(old('payment_status') == 'delivery_charge_paid') />
                                                        <label class="cbx" for="cbx-006"><span>
                                                                <svg width="12px" height="10px"
                                                                    viewbox="0 0 12 10">
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
                                                                <svg width="12px" height="10px"
                                                                    viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </svg></span><span>ফুল পেমেন্ট এখনি করবো।</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <span class="middle-line"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="ps-checkout__order mb-0 rounded-0 border-0 pb-lg-4">
                                        <div class="ps-checkout__row bg-light" style="border-top: 1px solid #f0f2f5">
                                            <div class="ps-title pl-2">প্রোডাক্ট</div>
                                            <div class="ps-title pr-2">মূল্য</div>
                                        </div>
                                        @foreach ($cartItems as $cartItem)
                                            <div class="ps-checkout__row ps-product">
                                                <div class="ps-product__name d-flex align-items-center w-100">
                                                    <div>
                                                        @php
                                                            $thumbnailPath = 'storage/' . $cartItem->model->thumbnail;
                                                            $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                                ? asset($thumbnailPath)
                                                                : asset('frontend/img/no-product.jpg');
                                                        @endphp
                                                        <img class="cart-img" src="{{ $thumbnailSrc }}"
                                                            alt="{{ $cartItem->model->name }}">
                                                    </div>
                                                    <div class="">
                                                        <a
                                                            href="{{ route('product.details', $cartItem->model->slug) }}">{{ $cartItem->model->name }}</a><span
                                                            class="pl-3 pr-1">
                                                            <i class="fa-solid fa-close"></i></span><span
                                                            class="text-end">{{ convertToBangla($cartItem->qty) }}</span>
                                                    </div>
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
                                            <div class="ps-product__price">
                                                ৳{{ convertToBangla(number_format($subTotal, 2)) }}
                                            </div>
                                        </div>
                                        <div class="ps-checkout__row">
                                            <div class="ps-title">কুরিয়ার চার্জ</div>
                                            <div class="ps-product__price" id="shippingCharge">
                                                ৳{{ convertToBangla(0) }}
                                            </div>
                                        </div>
                                        <div class="ps-checkout__row">
                                            <div class="ps-title">সর্বমোট মূল্য</div>
                                            <div class="ps-product__price" id="total-price-container">
                                                <input type="hidden" name="shipping_id" id="shippingID"
                                                    value="">
                                                <input type="hidden" name="total_amount" id="total-input"
                                                    value="{{ number_format($subTotal, 2) }}">
                                                ৳<span id="total-price"
                                                    style="font-weight: 600;">{{ convertToBangla(number_format($subTotal, 2)) }}</span>
                                            </div>
                                        </div>
                                        <div class="check-faq">
                                            <div class="form-check pt-2">
                                                <input class="form-check-input" type="checkbox" id="agree-faq"
                                                    checked required />
                                                <label class="form-check-label" for="agree-faq">
                                                    আমি ওয়েবসাইটের শর্তাবলী পড়েছি এবং এতে সম্মত আছি *</label>
                                            </div>
                                        </div>
                                        <div class="pt-5 mt-2">
                                            <button type="submit"
                                                class="btn btn-primary w-100 mt-5 py-3 register-btns">
                                                <i class="fa-solid fa-clipboard-check pr-2"></i> আপনার অর্ডার কনফার্ম
                                                করতে ক্লিক করুন
                                            </button>
                                            <p class="text-info text-center pt-3 mb-0">উপরের বাটনে ক্লিক করলে আপনার
                                                অর্ডারটি সাথে সাথে কনফার্ম হয়ে যাবে !</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function convertToBangla(number) {
                const englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                const banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

                return number.replace(/[0-9]/g, function(digit) {
                    return banglaDigits[englishDigits.indexOf(digit)];
                });
            }
            $(document).ready(function() {
                $('#thana').change(function() {
                    var thanaName = $(this).val(); // Get the selected division
                    var subtotal = parseFloat('{{ $subTotal }}');
                    var totalInput = document.getElementById('total-input');
                    var shippingID = document.getElementById('shippingID');
                    var totalPriceSpan = document.getElementById('total-price');
                    var shippingCharge = document.getElementById('shippingCharge');
                    if (thanaName) {
                        $.ajax({
                            url: '{{ url('get-charge-by-thana') }}/' +
                                thanaName, // Call the controller method
                            type: 'GET',
                            success: function(data) {
                                // $('#district').empty(); // Clear current district options
                                var shippingPrice = parseFloat(data.price) || 0;
                                const total = subtotal + shippingPrice;
                                shippingCharge.textContent = convertToBangla(shippingPrice.toFixed(
                                    2));
                                // alert(data.id);
                                totalInput.value = total.toFixed(2); // Update hidden field value
                                shippingID.value = data.id; // Update hidden field value
                                totalPriceSpan.textContent = convertToBangla(total.toFixed(
                                    2)); // Update the visible total price
                            }
                        });
                    }

                });
            });
        </script>
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
