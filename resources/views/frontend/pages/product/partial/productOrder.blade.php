<div class="modal fade rounded-0" id="order-product{{ $product->id }}" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered ps-quickview">
        <div class="modal-content">
            <div class="modal-header rounded-0" style="background-color: var(--site-primary);">
                <h5 class="modal-title text-white">{{ $product->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="wrap-modal-slider container-fluid ps-quickview__body p-2">
                    {{-- Product ID: {{ $product->id }}
                    {{ $product->name }} --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <p style="font-size: large;text-align: center">
                                <span class="text-danger">*</span> অর্ডার করতে,অনুগ্রহ করে আপনার সম্পূর্ণ নাম,
                                মোবাইল নম্বর, সম্পূর্ণ ঠিকানা লিখুন এবং <span class="text-danger">অর্ডার কনফার্ম
                                    করুন</span> ক্লিক করুন
                            </p>
                        </div>
                        <div class="col-lg-12">
                            <form action="{{ route('checkout.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="ps-form--review row">
                                    <div class="col-12 col-xl-12">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="name">আপনার সম্পূর্ণ নাম<span class="text-danger">*</span>
                                            </label>
                                            <input id="name" class="form-control ps-form__input" type="text"
                                                name="name" value="{{ optional(Auth::user())->name }}" autofocus=""
                                                autocomplete="name" placeholder="আপনার সম্পূর্ণ নাম" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 pr-0">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="phone">আপনার মোবাইল নম্বার... 01...<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input id="phone" class="form-control ps-form__input" type="text"
                                                name="phone" value="{{ optional(Auth::user())->phone }}"
                                                autofocus="" autocomplete="phone" placeholder="আপনার মোবাইল নম্বার"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="first_name">ডেলিভারি লোকেশন সিলেক্ট করুন।
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="shipping_id" class="form-select ps-form__input" required
                                                id="shipping_id" data-placeholder="Select Shipping Location">
                                                <option value="">Select Shipping Location</option>
                                                @foreach ($shippingmethods as $shippingmethod)
                                                    <option value="{{ $shippingmethod->id }}"
                                                        data-shipping_price="{{ $shippingmethod->price }}">
                                                        {{ $shippingmethod->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="thana">
                                                থানা সিলেক্ট করুন।
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="thana" class="form-select ps-form__input" required
                                                id="thana">
                                                <option value="" disabled selected>থানা সিলেক্ট করুন</option>
                                                <!-- Dhaka District -->
                                                <optgroup label="ঢাকা (Dhaka)">
                                                    <option value="Dhanmondi" data-name="Dhanmondi">ধানমন্ডি
                                                        (Dhanmondi)</option>
                                                    <option value="Gulshan" data-name="Gulshan">গুলশান (Gulshan)
                                                    </option>
                                                    <option value="Mirpur" data-name="Mirpur">মিরপুর (Mirpur)
                                                    </option>
                                                    <option value="Uttara" data-name="Uttara">উত্তরা (Uttara)
                                                    </option>
                                                    <option value="Mohammadpur" data-name="Mohammadpur">
                                                        মোহাম্মদপুর (Mohammadpur)</option>
                                                    <option value="Savar" data-name="Savar">সাভার (Savar)
                                                    </option>
                                                    <option value="Keraniganj" data-name="Keraniganj">কেরানীগঞ্জ
                                                        (Keraniganj)</option>
                                                    <option value="Tejgaon" data-name="Tejgaon">তেজগাঁও (Tejgaon)
                                                    </option>
                                                </optgroup>

                                                <!-- Chattogram District -->
                                                <optgroup label="চট্টগ্রাম (Chattogram)">
                                                    <option value="Kotwali" data-name="Kotwali">কোতোয়ালী
                                                        (Kotwali)</option>
                                                    <option value="Panchlaish" data-name="Panchlaish">পাঁচলাইশ
                                                        (Panchlaish)</option>
                                                    <option value="Chandgaon" data-name="Chandgaon">চান্দগাঁও
                                                        (Chandgaon)</option>
                                                    <option value="Hathazari" data-name="Hathazari">হাটহাজারী
                                                        (Hathazari)</option>
                                                    <option value="Patenga" data-name="Patenga">পতেঙ্গা (Patenga)
                                                    </option>
                                                    <option value="Rangunia" data-name="Rangunia">রাঙ্গুনিয়া
                                                        (Rangunia)</option>
                                                </optgroup>

                                                <!-- Khulna District -->
                                                <optgroup label="খুলনা (Khulna)">
                                                    <option value="KhulnaSadar" data-name="Khulna Sadar">খুলনা সদর
                                                        (Khulna Sadar)</option>
                                                    <option value="Daulatpur" data-name="Daulatpur">দৌলতপুর
                                                        (Daulatpur)</option>
                                                    <option value="Rupsha" data-name="Rupsha">রূপসা (Rupsha)
                                                    </option>
                                                    <option value="Terokhada" data-name="Terokhada">তেরোখাদা
                                                        (Terokhada)</option>
                                                </optgroup>

                                                <!-- Rajshahi District -->
                                                <optgroup label="রাজশাহী (Rajshahi)">
                                                    <option value="Boalia" data-name="Boalia">বোয়ালিয়া (Boalia)
                                                    </option>
                                                    <option value="Rajpara" data-name="Rajpara">রাজপাড়া (Rajpara)
                                                    </option>
                                                    <option value="Motihar" data-name="Motihar">মতিহার (Motihar)
                                                    </option>
                                                    <option value="ShahMakhdum" data-name="Shah Makhdum">শাহ মখদুম
                                                        (Shah Makhdum)</option>
                                                </optgroup>

                                                <!-- Sylhet District -->
                                                <optgroup label="সিলেট (Sylhet)">
                                                    <option value="SylhetSadar" data-name="Sylhet Sadar">সিলেট সদর
                                                        (Sylhet Sadar)</option>
                                                    <option value="Beanibazar" data-name="Beanibazar">বিয়ানীবাজার
                                                        (Beanibazar)</option>
                                                    <option value="Golapganj" data-name="Golapganj">গোলাপগঞ্জ
                                                        (Golapganj)</option>
                                                    <option value="Jaintiapur" data-name="Jaintiapur">জৈন্তাপুর
                                                        (Jaintiapur)</option>
                                                </optgroup>

                                                <!-- Barisal District -->
                                                <optgroup label="বরিশাল (Barisal)">
                                                    <option value="BarishalSadar" data-name="Barisal Sadar">বরিশাল
                                                        সদর (Barisal Sadar)</option>
                                                    <option value="Banaripara" data-name="Banaripara">বানারীপাড়া
                                                        (Banaripara)</option>
                                                    <option value="Muladi" data-name="Muladi">মুলাদী (Muladi)
                                                    </option>
                                                    <option value="Mehendiganj" data-name="Mehendiganj">
                                                        মেহেন্দিগঞ্জ (Mehendiganj)</option>
                                                </optgroup>

                                                <!-- Mymensingh District -->
                                                <optgroup label="ময়মনসিংহ (Mymensingh)">
                                                    <option value="MymensinghSadar" data-name="Mymensingh Sadar">
                                                        ময়মনসিংহ সদর (Mymensingh Sadar)</option>
                                                    <option value="Muktagachha" data-name="Muktagachha">মুক্তাগাছা
                                                        (Muktagachha)</option>
                                                    <option value="Phulpur" data-name="Phulpur">ফুলপুর (Phulpur)
                                                    </option>
                                                    <option value="Trishal" data-name="Trishal">ত্রিশাল (Trishal)
                                                    </option>
                                                </optgroup>

                                                <!-- Rangpur District -->
                                                <optgroup label="রংপুর (Rangpur)">
                                                    <option value="RangpurSadar" data-name="Rangpur Sadar">রংপুর
                                                        সদর (Rangpur Sadar)</option>
                                                    <option value="Pirganj" data-name="Pirganj">পীরগঞ্জ (Pirganj)
                                                    </option>
                                                    <option value="Mithapukur" data-name="Mithapukur">মিঠাপুকুর
                                                        (Mithapukur)</option>
                                                    <option value="Gangachara" data-name="Gangachara">গঙ্গাচড়া
                                                        (Gangachara)</option>
                                                </optgroup>

                                                <!-- Comilla District -->
                                                <optgroup label="কুমিল্লা (Comilla)">
                                                    <option value="ComillaSadar" data-name="Comilla Sadar">
                                                        কুমিল্লা সদর (Comilla Sadar)</option>
                                                    <option value="Debidwar" data-name="Debidwar">দেবিদ্বার
                                                        (Debidwar)</option>
                                                    <option value="Daudkandi" data-name="Daudkandi">দাউদকান্দি
                                                        (Daudkandi)</option>
                                                    <option value="Homna" data-name="Homna">হোমনা (Homna)
                                                    </option>
                                                </optgroup>

                                                <!-- Madaripur District -->
                                                <optgroup label="মাদারীপুর (Madaripur)">
                                                    <option value="MadaripurSadar" data-name="Madaripur Sadar">
                                                        মাদারীপুর সদর (Madaripur Sadar)</option>
                                                    <option value="Kalkini" data-name="Kalkini">কালকিনি (Kalkini)
                                                    </option>
                                                    <option value="Ranishankail" data-name="Ranishankail">
                                                        রাণীশংকাইল (Ranishankail)</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="district">
                                                জেলা সিলেক্ট করুন।
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="district" class="form-select ps-form__input" required
                                                id="district">
                                                <option value="" disabled selected>জেলা সিলেক্ট করুন</option>
                                                <option value="Dhaka">ঢাকা</option>
                                                <option value="Faridpur">ফরিদপুর</option>
                                                <option value="Gazipur">গাজীপুর</option>
                                                <option value="Gopalganj">গোপালগঞ্জ</option>
                                                <option value="Kishoreganj">কিশোরগঞ্জ</option>
                                                <option value="Madaripur">মাদারীপুর</option>
                                                <option value="Manikganj">মানিকগঞ্জ</option>
                                                <option value="Munshiganj">মুন্সিগঞ্জ</option>
                                                <option value="Narayanganj">নারায়ণগঞ্জ
                                                </option>
                                                <option value="Narsingdi">নরসিংদী</option>
                                                <option value="Rajbari">রাজবাড়ী</option>
                                                <option value="Shariatpur">শরীয়তপুর</option>
                                                <option value="Tangail">টাঙ্গাইল</option>
                                                <option value="Barguna">বরগুনা</option>
                                                <option value="Barisal">বরিশাল</option>
                                                <option value="Bhola">ভোলা</option>
                                                <option value="Jhalokati">ঝালকাঠি</option>
                                                <option value="Patuakhali">পটুয়াখালী</option>
                                                <option value="Pirojpur">পিরোজপুর</option>
                                                <option value="Bandarban">বান্দরবান</option>
                                                <option value="Brahmanbaria">ব্রাহ্মণবাড়িয়া
                                                </option>
                                                <option value="Chandpur">চাঁদপুর</option>
                                                <option value="Chittagong">চট্টগ্রাম</option>
                                                <option value="Comilla">কুমিল্লা</option>
                                                <option value="Cox" s Bazar">কক্সবাজার</option>
                                                <option value="Feni">ফেনী</option>
                                                <option value="Khagrachari">খাগড়াছড়ি
                                                </option>
                                                <option value="Lakshmipur">লক্ষ্মীপুর</option>
                                                <option value="Noakhali">নোয়াখালী</option>
                                                <option value="Rangamati">রাঙ্গামাটি</option>
                                                <option value="Habiganj">হবিগঞ্জ</option>
                                                <option value="Moulvibazar">মৌলভীবাজার
                                                </option>
                                                <option value="Sylhet">সিলেট</option>
                                                <option value="Jamalpur">জামালপুর</option>
                                                <option value="Mymensingh">ময়মনসিংহ</option>
                                                <option value="Netrokona">নেত্রকোণা</option>
                                                <option value="Sherpur">শেরপুর</option>
                                                <option value="Bogra">বগুড়া</option>
                                                <option value="Joypurhat">জয়পুরহাট</option>
                                                <option value="Naogaon">নওগাঁ</option>
                                                <option value="Natore">নাটোর</option>
                                                <option value="Chapainawabganj">
                                                    চাঁপাইনবাবগঞ্জ</option>
                                                <option value="Pabna">পাবনা</option>
                                                <option value="Rajshahi">রাজশাহী</option>
                                                <option value="Sirajganj">সিরাজগঞ্জ</option>
                                                <option value="Dinajpur">দিনাজপুর</option>
                                                <option value="Gaibandha">গাইবান্ধা</option>
                                                <option value="Kurigram">কুড়িগ্রাম</option>
                                                <option value="Lalmonirhat">লালমনিরহাট
                                                </option>
                                                <option value="Nilphamari">নীলফামারী</option>
                                                <option value="Panchagarh">পঞ্চগড়</option>
                                                <option value="Rangpur">রংপুর</option>
                                                <option value="Thakurgaon">ঠাকুরগাঁও</option>
                                                <option value="Bagerhat">বাগেরহাট</option>
                                                <option value="Chuadanga">চুয়াডাঙ্গা</option>
                                                <option value="Jessore">যশোর</option>
                                                <option value="Jhenaidah">ঝিনাইদহ</option>
                                                <option value="Khulna">খুলনা</option>
                                                <option value="Kushtia">কুষ্টিয়া</option>
                                                <option value="Magura">মাগুরা</option>
                                                <option value="Meherpur">মেহেরপুর</option>
                                                <option value="Narail">নড়াইল</option>
                                                <option value="Satkhira">সাতক্ষীরা</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-12">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="address">আপনার সম্পূর্ণ ঠিকানা লিখুন
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input id="address" class="form-control ps-form__input" type="text"
                                                name="address" value="" autofocus="" autocomplete="address"
                                                placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-12">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="payment_status">পেমেন্ট অপশন
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="checkout-checkbox">
                                                <input class="inp-cbx" id="cbx-006" type="radio"
                                                    name="payment_status" value="delivery_charge_paid" />
                                                <label class="cbx" for="cbx-006"><span>
                                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                        </svg></span><span>শুধুমাত্র ডেলিভারি চার্জ পরিশোধ
                                                        করবো।</span>
                                                </label>
                                            </div>
                                            <div class="checkout-checkbox">
                                                <input class="inp-cbx" id="cbx-007" type="radio"
                                                    name="payment_status" value="completely_paid" checked />
                                                <label class="cbx" for="cbx-007"><span>
                                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                        </svg></span><span>ফুল পেমেন্ট এখনি করবো।</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card p-0 mt-3 rounded-0">
                                            <div class="card-body p-0 rounded-0">
                                                <div class="row align-items-center">
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

                                                <div class="px-3 py-2" style="background-color: var(--site-primary)">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="mb-0 text-white">সাব টোটাল</p>
                                                        <p class="mb-0 text-white">{{ $product->unit_price }} টাকা</p>
                                                    </div>
                                                    <div
                                                        class="d-flex justify-content-between align-items-center pt-1">
                                                        <p class="mb-0 text-white">ডেলিভারি চার্জ</p>
                                                        <p class="mb-0 text-white"><span
                                                                id="shipping-price">0</span>টাকা</p>
                                                    </div>
                                                    <hr class="mb-1 bg-white">
                                                    <div
                                                        class="d-flex justify-content-between align-items-center pt-2">
                                                        <p class="mb-0 text-white">সর্বমোট মূল্য</p>
                                                        <p class="mb-0 text-white fw-bold"><strong><span
                                                                    id="total-price">{{ $product->unit_price }}</span>
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
