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
                                                name="phone" value="{{ optional(Auth::user())->phone }}" autofocus=""
                                                autocomplete="phone" placeholder="আপনার মোবাইল নম্বার" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="ps-form__group pt-2">
                                            <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                for="first_name">ডেলিভারি লোকেশন সিলেক্ট করুন।
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="title" class="form-select ps-form__input" required
                                                id="title">
                                                <option value="1" data-id="0" data-price="60.00">ঢাকা
                                                    মেট্রো সিটি
                                                    ( ৬০ Tk)</option>
                                                <option value="2" data-id="1" data-price="80.00">ডেমরা,
                                                    কামরাঙ্গীরচর ( ৮০ Tk)</option>
                                                <option value="4" data-id="2" data-price="100.00">সাভার,
                                                    গাজীপুর,
                                                    কেরানীগঞ্জ, নারায়ণগঞ্জ ( ১০০Tk )</option>
                                                <option value="5" data-id="3" data-price="130.00">
                                                    অন্যান্য জেলা,
                                                    উপজেলা, বিভাগ ( ১৩০ TK )</option>
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
                                                <option value="1" data-id="1" data-price="60.00"
                                                    data-name="Dhaka">ঢাকা</option>
                                                <option value="2" data-id="2" data-price="80.00"
                                                    data-name="Faridpur">ফরিদপুর</option>
                                                <option value="3" data-id="3" data-price="100.00"
                                                    data-name="Gazipur">গাজীপুর</option>
                                                <option value="4" data-id="4" data-price="100.00"
                                                    data-name="Gopalganj">গোপালগঞ্জ</option>
                                                <option value="5" data-id="5" data-price="130.00"
                                                    data-name="Kishoreganj">কিশোরগঞ্জ</option>
                                                <option value="6" data-id="6" data-price="130.00"
                                                    data-name="Madaripur">মাদারীপুর</option>
                                                <option value="7" data-id="7" data-price="130.00"
                                                    data-name="Manikganj">মানিকগঞ্জ</option>
                                                <option value="8" data-id="8" data-price="130.00"
                                                    data-name="Munshiganj">মুন্সিগঞ্জ</option>
                                                <option value="9" data-id="9" data-price="130.00"
                                                    data-name="Narayanganj">নারায়ণগঞ্জ</option>
                                                <option value="10" data-id="10" data-price="130.00"
                                                    data-name="Narsingdi">নরসিংদী</option>
                                                <option value="11" data-id="11" data-price="130.00"
                                                    data-name="Rajbari">রাজবাড়ী</option>
                                                <option value="12" data-id="12" data-price="130.00"
                                                    data-name="Shariatpur">শরীয়তপুর</option>
                                                <option value="13" data-id="13" data-price="130.00"
                                                    data-name="Tangail">টাঙ্গাইল</option>
                                                <option value="14" data-id="14" data-price="130.00"
                                                    data-name="Barguna">বরগুনা</option>
                                                <option value="15" data-id="15" data-price="130.00"
                                                    data-name="Barisal">বরিশাল</option>
                                                <option value="16" data-id="16" data-price="130.00"
                                                    data-name="Bhola">ভোলা</option>
                                                <option value="17" data-id="17" data-price="130.00"
                                                    data-name="Jhalokati">ঝালকাঠি</option>
                                                <option value="18" data-id="18" data-price="130.00"
                                                    data-name="Patuakhali">পটুয়াখালী</option>
                                                <option value="19" data-id="19" data-price="130.00"
                                                    data-name="Pirojpur">পিরোজপুর</option>
                                                <option value="20" data-id="20" data-price="130.00"
                                                    data-name="Bandarban">বান্দরবান</option>
                                                <option value="21" data-id="21" data-price="130.00"
                                                    data-name="Brahmanbaria">ব্রাহ্মণবাড়িয়া</option>
                                                <option value="22" data-id="22" data-price="130.00"
                                                    data-name="Chandpur">চাঁদপুর</option>
                                                <option value="23" data-id="23" data-price="130.00"
                                                    data-name="Chittagong">চট্টগ্রাম</option>
                                                <option value="24" data-id="24" data-price="130.00"
                                                    data-name="Comilla">কুমিল্লা</option>
                                                <option value="25" data-id="25" data-price="130.00"
                                                    data-name="Cox's Bazar">কক্সবাজার</option>
                                                <option value="26" data-id="26" data-price="130.00"
                                                    data-name="Feni">ফেনী</option>
                                                <option value="27" data-id="27" data-price="130.00"
                                                    data-name="Khagrachari">খাগড়াছড়ি</option>
                                                <option value="28" data-id="28" data-price="130.00"
                                                    data-name="Lakshmipur">লক্ষ্মীপুর</option>
                                                <option value="29" data-id="29" data-price="130.00"
                                                    data-name="Noakhali">নোয়াখালী</option>
                                                <option value="30" data-id="30" data-price="130.00"
                                                    data-name="Rangamati">রাঙ্গামাটি</option>
                                                <option value="31" data-id="31" data-price="130.00"
                                                    data-name="Habiganj">হবিগঞ্জ</option>
                                                <option value="32" data-id="32" data-price="130.00"
                                                    data-name="Moulvibazar">মৌলভীবাজার</option>
                                                <option value="33" data-id="33" data-price="130.00"
                                                    data-name="Sylhet">সিলেট</option>
                                                <option value="34" data-id="34" data-price="130.00"
                                                    data-name="Jamalpur">জামালপুর</option>
                                                <option value="35" data-id="35" data-price="130.00"
                                                    data-name="Mymensingh">ময়মনসিংহ</option>
                                                <option value="36" data-id="36" data-price="130.00"
                                                    data-name="Netrokona">নেত্রকোণা</option>
                                                <option value="37" data-id="37" data-price="130.00"
                                                    data-name="Sherpur">শেরপুর</option>
                                                <option value="38" data-id="38" data-price="130.00"
                                                    data-name="Bogra">বগুড়া</option>
                                                <option value="39" data-id="39" data-price="130.00"
                                                    data-name="Joypurhat">জয়পুরহাট</option>
                                                <option value="40" data-id="40" data-price="130.00"
                                                    data-name="Naogaon">নওগাঁ</option>
                                                <option value="41" data-id="41" data-price="130.00"
                                                    data-name="Natore">নাটোর</option>
                                                <option value="42" data-id="42" data-price="130.00"
                                                    data-name="Chapainawabganj">চাঁপাইনবাবগঞ্জ</option>
                                                <option value="43" data-id="43" data-price="130.00"
                                                    data-name="Pabna">পাবনা</option>
                                                <option value="44" data-id="44" data-price="130.00"
                                                    data-name="Rajshahi">রাজশাহী</option>
                                                <option value="45" data-id="45" data-price="130.00"
                                                    data-name="Sirajganj">সিরাজগঞ্জ</option>
                                                <option value="46" data-id="46" data-price="130.00"
                                                    data-name="Dinajpur">দিনাজপুর</option>
                                                <option value="47" data-id="47" data-price="130.00"
                                                    data-name="Gaibandha">গাইবান্ধা</option>
                                                <option value="48" data-id="48" data-price="130.00"
                                                    data-name="Kurigram">কুড়িগ্রাম</option>
                                                <option value="49" data-id="49" data-price="130.00"
                                                    data-name="Lalmonirhat">লালমনিরহাট</option>
                                                <option value="50" data-id="50" data-price="130.00"
                                                    data-name="Nilphamari">নীলফামারী</option>
                                                <option value="51" data-id="51" data-price="130.00"
                                                    data-name="Panchagarh">পঞ্চগড়</option>
                                                <option value="52" data-id="52" data-price="130.00"
                                                    data-name="Rangpur">রংপুর</option>
                                                <option value="53" data-id="53" data-price="130.00"
                                                    data-name="Thakurgaon">ঠাকুরগাঁও</option>
                                                <option value="54" data-id="54" data-price="130.00"
                                                    data-name="Bagerhat">বাগেরহাট</option>
                                                <option value="55" data-id="55" data-price="130.00"
                                                    data-name="Chuadanga">চুয়াডাঙ্গা</option>
                                                <option value="56" data-id="56" data-price="130.00"
                                                    data-name="Jessore">যশোর</option>
                                                <option value="57" data-id="57" data-price="130.00"
                                                    data-name="Jhenaidah">ঝিনাইদহ</option>
                                                <option value="58" data-id="58" data-price="130.00"
                                                    data-name="Khulna">খুলনা</option>
                                                <option value="59" data-id="59" data-price="130.00"
                                                    data-name="Kushtia">কুষ্টিয়া</option>
                                                <option value="60" data-id="60" data-price="130.00"
                                                    data-name="Magura">মাগুরা</option>
                                                <option value="61" data-id="61" data-price="130.00"
                                                    data-name="Meherpur">মেহেরপুর</option>
                                                <option value="62" data-id="62" data-price="130.00"
                                                    data-name="Narail">নড়াইল</option>
                                                <option value="63" data-id="63" data-price="130.00"
                                                    data-name="Satkhira">সাতক্ষীরা</option>

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
                                                name="address" value="" autofocus=""
                                                autocomplete="address" placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন" required>
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
                                                    name="payment_method" />
                                                <label class="cbx" for="cbx-006"><span>
                                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                        </svg></span><span>শুধুমাত্র ডেলিভারি চার্জ পরিশোধ
                                                        করবো।</span>
                                                </label>
                                            </div>
                                            <div class="checkout-checkbox">
                                                <input class="inp-cbx" id="cbx-007" type="radio"
                                                    name="payment_method" checked />
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
                                                        {{-- <p class="mb-0"><strong>সাইজঃ </strong>৪০</p>
                                                        <p class="mb-0"><strong>কত জোড়াঃ </strong>০১</p> --}}
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
                                                        <p class="mb-0 text-white">৬০.০০ টাকা</p>
                                                    </div>
                                                    <hr class="mb-1 bg-white">
                                                    <div
                                                        class="d-flex justify-content-between align-items-center pt-2">
                                                        <p class="mb-0 text-white">সর্বমোট মূল্য</p>
                                                        <p class="mb-0 text-white fw-bold"><strong>৯৫৯.০০
                                                                টাকা</strong></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mt-3">
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
