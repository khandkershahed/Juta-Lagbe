<div class="modal fade rounded-0" id="order-product{{ $product->id }}" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered ps-quickview">
        <div class="modal-content">
            <div class="modal-header rounded-0" style="background-color: var(--site-primary);">
                <h5 class="modal-title text-white">
                    <span class="text-danger">*</span> অর্ডার করতে,অনুগ্রহ করে আপনার সম্পূর্ণ নাম, <br>
                        মোবাইল নম্বর, সম্পূর্ণ ঠিকানা লিখুন এবং  অর্ডার কনফার্ম
                            করুন
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="wrap-modal-slider container-fluid ps-quickview__body p-2">

                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('checkout.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="ps-form--review row">
                                    <div class="col-12 col-xl-6 pl-0">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="name">নাম<span class="text-danger">*</span>
                                            </label>
                                            <input id="name" class="form-control ps-form__input" type="text"
                                                name="name" value="{{ old('name', optional(Auth::user())->name) }}" autofocus=""
                                                autocomplete="name" placeholder="আপনার সম্পূর্ণ নাম" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 pr-0">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="phone">মোবাইল নম্বার<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input id="phone" class="form-control ps-form__input" type="text"
                                                name="phone" value="{{ old('phone',optional(Auth::user())->phone) }}"
                                                autofocus="" autocomplete="phone" placeholder="আপনার মোবাইল নম্বার"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 pl-0">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="thana">
                                                থানা
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input class="form-control ps-form__input" type="text"
                                                name="thana" value="{{ old('thana',optional(Auth::user())->thana) }}"
                                                autofocus="" autocomplete="thana" placeholder="আপনার থানা"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 pr-0">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="district">
                                                জেলা
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="district" class="form-select ps-form__input" required
                                                id="district">
                                                <option value="" disabled selected>জেলা সিলেক্ট করুন</option>
                                                <option value="Dhaka" @selected(old('district' == 'Dhaka'))>ঢাকা</option>
                                                <option value="Faridpur" @selected(old('district' == 'Faridpur'))>ফরিদপুর</option>
                                                <option value="Gazipur" @selected(old('district' == 'Gazipur'))>গাজীপুর</option>
                                                <option value="Gopalganj" @selected(old('district' == 'Gopalganj'))>গোপালগঞ্জ</option>
                                                <option value="Kishoreganj" @selected(old('district' == 'Kishoreganj'))>কিশোরগঞ্জ</option>
                                                <option value="Madaripur" @selected(old('district' == 'Madaripur'))>মাদারীপুর</option>
                                                <option value="Manikganj" @selected(old('district' == 'Manikganj'))>মানিকগঞ্জ</option>
                                                <option value="Munshiganj" @selected(old('district' == 'Munshiganj'))>মুন্সিগঞ্জ</option>
                                                <option value="Narayanganj" @selected(old('district' == 'Narayanganj'))>নারায়ণগঞ্জ
                                                </option>
                                                <option value="Narsingdi" @selected(old('district' == 'Narsingdi'))>নরসিংদী</option>
                                                <option value="Rajbari" @selected(old('district' == 'Rajbari'))>রাজবাড়ী</option>
                                                <option value="Shariatpur" @selected(old('district' == 'Shariatpur'))>শরীয়তপুর</option>
                                                <option value="Tangail" @selected(old('district' == 'Tangail'))>টাঙ্গাইল</option>
                                                <option value="Barguna" @selected(old('district' == 'Barguna'))>বরগুনা</option>
                                                <option value="Barisal" @selected(old('district' == 'Barisal'))>বরিশাল</option>
                                                <option value="Bhola" @selected(old('district' == 'Bhola'))>ভোলা</option>
                                                <option value="Jhalokati" @selected(old('district' == 'Jhalokati'))>ঝালকাঠি</option>
                                                <option value="Patuakhali" @selected(old('district' == 'Patuakhali'))>পটুয়াখালী</option>
                                                <option value="Pirojpur" @selected(old('district' == 'Pirojpur'))>পিরোজপুর</option>
                                                <option value="Bandarban" @selected(old('district' == 'Bandarban'))>বান্দরবান</option>
                                                <option value="Brahmanbaria" @selected(old('district' == 'Brahmanbaria'))>ব্রাহ্মণবাড়িয়া
                                                </option>
                                                <option value="Chandpur" @selected(old('district' == 'Chandpur'))>চাঁদপুর</option>
                                                <option value="Chittagong" @selected(old('district' == 'Chittagong'))>চট্টগ্রাম</option>
                                                <option value="Comilla" @selected(old('district' == 'Comilla'))>কুমিল্লা</option>
                                                <option value="Cox" @selected(old('district' == 'Cox')) s Bazar">কক্সবাজার</option>
                                                <option value="Feni" @selected(old('district' == 'Feni'))>ফেনী</option>
                                                <option value="Khagrachari" @selected(old('district' == 'Khagrachari'))>খাগড়াছড়ি
                                                </option>
                                                <option value="Lakshmipur" @selected(old('district' == 'Lakshmipur'))>লক্ষ্মীপুর</option>
                                                <option value="Noakhali" @selected(old('district' == 'Noakhali'))>নোয়াখালী</option>
                                                <option value="Rangamati" @selected(old('district' == 'Rangamati'))>রাঙ্গামাটি</option>
                                                <option value="Habiganj" @selected(old('district' == 'Habiganj'))>হবিগঞ্জ</option>
                                                <option value="Moulvibazar" @selected(old('district' == 'Moulvibazar'))>মৌলভীবাজার
                                                </option>
                                                <option value="Sylhet" @selected(old('district' == 'Sylhet'))>সিলেট</option>
                                                <option value="Jamalpur" @selected(old('district' == 'Jamalpur'))>জামালপুর</option>
                                                <option value="Mymensingh" @selected(old('district' == 'Mymensingh'))>ময়মনসিংহ</option>
                                                <option value="Netrokona" @selected(old('district' == 'Netrokona'))>নেত্রকোণা</option>
                                                <option value="Sherpur" @selected(old('district' == 'Sherpur'))>শেরপুর</option>
                                                <option value="Bogra" @selected(old('district' == 'Bogra'))>বগুড়া</option>
                                                <option value="Joypurhat" @selected(old('district' == 'Joypurhat'))>জয়পুরহাট</option>
                                                <option value="Naogaon" @selected(old('district' == 'Naogaon'))>নওগাঁ</option>
                                                <option value="Natore" @selected(old('district' == 'Natore'))>নাটোর</option>
                                                <option value="Chapainawabganj" @selected(old('district' == 'Chapainawabganj'))>
                                                    চাঁপাইনবাবগঞ্জ</option>
                                                <option value="Pabna" @selected(old('district' == 'Pabna'))>পাবনা</option>
                                                <option value="Rajshahi" @selected(old('district' == 'Rajshahi'))>রাজশাহী</option>
                                                <option value="Sirajganj" @selected(old('district' == 'Sirajganj'))>সিরাজগঞ্জ</option>
                                                <option value="Dinajpur" @selected(old('district' == 'Dinajpur'))>দিনাজপুর</option>
                                                <option value="Gaibandha" @selected(old('district' == 'Gaibandha'))>গাইবান্ধা</option>
                                                <option value="Kurigram" @selected(old('district' == 'Kurigram'))>কুড়িগ্রাম</option>
                                                <option value="Lalmonirhat" @selected(old('district' == 'Lalmonirhat'))>লালমনিরহাট
                                                </option>
                                                <option value="Nilphamari" @selected(old('district' == 'Nilphamari'))>নীলফামারী</option>
                                                <option value="Panchagarh" @selected(old('district' == 'Panchagarh'))>পঞ্চগড়</option>
                                                <option value="Rangpur" @selected(old('district' == 'Rangpur'))>রংপুর</option>
                                                <option value="Thakurgaon" @selected(old('district' == 'Thakurgaon'))>ঠাকুরগাঁও</option>
                                                <option value="Bagerhat" @selected(old('district' == 'Bagerhat'))>বাগেরহাট</option>
                                                <option value="Chuadanga" @selected(old('district' == 'Chuadanga'))>চুয়াডাঙ্গা</option>
                                                <option value="Jessore" @selected(old('district' == 'Jessore'))>যশোর</option>
                                                <option value="Jhenaidah" @selected(old('district' == 'Jhenaidah'))>ঝিনাইদহ</option>
                                                <option value="Khulna" @selected(old('district' == 'Khulna'))>খুলনা</option>
                                                <option value="Kushtia" @selected(old('district' == 'Kushtia'))>কুষ্টিয়া</option>
                                                <option value="Magura" @selected(old('district' == 'Magura'))>মাগুরা</option>
                                                <option value="Meherpur" @selected(old('district' == 'Meherpur'))>মেহেরপুর</option>
                                                <option value="Narail" @selected(old('district' == 'Narail'))>নড়াইল</option>
                                                <option value="Satkhira" @selected(old('district' == 'Satkhira'))>সাতক্ষীরা</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-12 px-0">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="address">সম্পূর্ণ ঠিকানা
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input id="address" class="form-control ps-form__input" type="text"
                                                name="address" value="{{ old('address') }}" autofocus="" autocomplete="address"
                                                placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-12 px-0">
                                        <div class="ps-form__group pt-4">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label" for="shipping_id">
                                                ডেলিভারি লোকেশন <span class="text-danger">*</span>
                                            </label>
                                            @foreach ($shippingmethods as $shippingmethod)
                                                <div class="checkout-checkbox">
                                                    <input
                                                        class="inp-cbx"
                                                        id="shipping_{{ $shippingmethod->id }}"
                                                        type="radio"
                                                        name="shipping_id"
                                                        value="{{ $shippingmethod->id }}"
                                                        @checked(old('shipping_id') == $shippingmethod->id)
                                                        data-shipping_price="{{ $shippingmethod->price }}"
                                                        required
                                                    />
                                                    <label class="cbx" for="shipping_{{ $shippingmethod->id }}">
                                                        <span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg>
                                                        </span>
                                                        <span>{{ $shippingmethod->title }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-12 px-0">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="payment_status">পেমেন্ট অপশন
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="checkout-checkbox">
                                                <input class="inp-cbx" id="cbx-006" type="radio"
                                                    name="payment_status" value="delivery_charge_paid" @checked(old('payment_status') == 'delivery_charge_paid')/>
                                                <label class="cbx" for="cbx-006"><span>
                                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                        </svg></span><span>শুধুমাত্র ডেলিভারি চার্জ পরিশোধ
                                                        করবো।</span>
                                                </label>
                                            </div>
                                            <div class="checkout-checkbox">
                                                <input class="inp-cbx" id="cbx-007" type="radio"
                                                    name="payment_status" value="completely_paid" @checked(old('payment_status') == 'completely_paid') />
                                                <label class="cbx" for="cbx-007"><span>
                                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                        </svg></span><span>ফুল পেমেন্ট এখনি করবো।</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 card p-0 mt-2">
                                        <div class="row align-items-center card-body p-2">
                                            <div class="col-lg-3">
                                                @php
                                                    $thumbnailPath = 'storage/' . $product->thumbnail;
                                                    $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                        ? asset($thumbnailPath)
                                                        : asset('frontend/img/no-product.jpg');
                                                @endphp
                                                <div class="">
                                                    <img src="{{ $thumbnailSrc }}" class="img-fluid"
                                                        alt="{{ $product->name }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-9 px-0">
                                                <p class="mb-0"><strong>নামঃ
                                                    </strong>{{ $product->name }}</p>
                                                <p class="mb-0"><strong>দামঃ </strong><span
                                                        class="text-success">{{ $product->unit_price }}
                                                        টাকা</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 px-0">
                                        <div class="card p-0 mt-3 rounded-0">
                                            <div class="card-body p-0 rounded-0">
                                                <div class="">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="mb-0 pl-2 pr-2">সাব টোটাল</p>
                                                        <p class="mb-0 pl-2 pr-2">{{ $product->unit_price }} টাকা</p>
                                                    </div>
                                                    <div
                                                        class="d-flex justify-content-between align-items-center pt-1">
                                                        <p class="mb-0 pl-2 pr-2">ডেলিভারি চার্জ</p>
                                                        <p class="mb-0 pl-2 pr-2"><span
                                                                id="shipping-price">0</span> টাকা</p>
                                                    </div>
                                                    <hr class="my-0 bg-white">
                                                    <div
                                                        class="d-flex justify-content-between align-items-center bg-light py-2">
                                                        <p class="mb-0 pl-2 pr-2" style="font-weight: 600;">সর্বমোট মূল্য</p>
                                                        <p class="mb-0 pl-2 pr-2"><strong><span
                                                                    id="total-price" style="font-weight: 600;">{{ $product->unit_price }}</span>
                                                                টাকা</strong></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mt-3">
                                            <input type="hidden" name="total_amount" id="total-input"
                                                    value="{{ number_format($product->unit_price, 2) }}">
                                            <button type="submit"
                                                class="btn btn-danger rounded-0 w-100 mr-3 py-3 fa-bounce"><i
                                                    class="fa-solid fa-shopping-cart pr-2"></i> অর্ডার কনফার্ম
                                                করুন</button>
                                        </div>
                                        <p class="pt-3 text-center mb-0">উপরের বাটনে ক্লিক করলে আপনার অর্ডারটি সাথে
                                            সাথে কনফার্ম হয়ে যাবে !</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // Bind to the 'shown.bs.modal' event to make sure the modal is fully visible before attaching events
            $('#order-product{{ $product->id }}').on('shown.bs.modal', function() {

                const subtotal = parseFloat('{{ $product->unit_price }}');
                const totalInput = $('#total-input');
                const totalPriceSpan = $('#total-price');
                const shippingPriceSpan = $('#shipping-price');
                const shippingSelect = $('#shipping_id'); // Select element for shipping methods

                // Check if the elements exist
                if (!totalInput.length || !totalPriceSpan.length || !shippingPriceSpan.length || !
                    shippingSelect.length) {
                    console.error("Error: Required elements not found in the modal.");
                    return;
                }

                // Attach event listener to shipping select dropdown
                shippingSelect.change(function() {
                    console.log('Shipping method selected!');

                    // Get selected shipping method price
                    const shippingPrice = parseFloat($(this).find(':selected').data(
                        'shipping_price')) || 0;
                    const total = subtotal + shippingPrice;

                    console.log('Shipping Price:', shippingPrice); // Debugging line
                    console.log('Calculated Total:', total); // Debugging line

                    // Update hidden field, shipping price, and total amount
                    totalInput.val(total.toFixed(2));
                    shippingPriceSpan.text(shippingPrice.toFixed(2));
                    totalPriceSpan.text(total.toFixed(2));
                });

                // Trigger the 'change' event on the currently selected shipping method (if any)
                const selectedShipping = shippingSelect.find(':selected');
                if (selectedShipping.length > 0) {
                    shippingSelect.trigger('change');
                } else {
                    // Default case: No shipping selected
                    shippingPriceSpan.text('0');
                    totalPriceSpan.text(subtotal.toFixed(2));
                }

            });

            // Reset modal content when hidden (close)
            $('#order-product{{ $product->id }}').on('hidden.bs.modal', function() {
                // Reset fields when modal is closed
                $('#total-input').val('{{ number_format($product->unit_price, 2) }}');
                $('#shipping-price').text('0');
                $('#total-price').text('{{ number_format($product->unit_price, 2) }}');
            });

        });
    </script>
@endpush
