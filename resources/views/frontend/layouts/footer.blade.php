<style>
    .ps-footer {
        position: relative;
        width: 100%;
        min-height: 300px;
        /* Adjust as needed */
        background-image: url('{{ asset('frontend/img/footer_bg.jpg') }}');
        background-size: containe;
        background-position: center;
        background-repeat: no-repeat;
        color: #fff;
        /* Sets text color to white for contrast */
    }

    .ps-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #f5f5f5c2;
        /* White overlay with 91% opacity */
        z-index: 1;
    }

    .ps-footer .container {
        position: relative;
        z-index: 2;
    }

    .ps-footer__link,
    .ps-footer__title,
    .ps-footer__email,
    .ps-block__list a {
        color: #fff;
    }

    .ps-footer__link:hover,
    .ps-block__list a:hover {
        color: #ff0;
    }

    .extra-color {
        color: #fff;
    }

    .ps-social__link:hover {
        color: #ff0;
    }
</style>
<footer class="ps-footer ps-footer--13 ps-footer--14">
    <div class="ps-footer--top">
        <div class="container">
            <div class="row m-0">
                <div class="col-12 col-sm-3 p-0">
                    <p class="text-center">
                        <span class="ps-footer__link">
                            <i class="icon-wallet"></i>Full Cash on Delivery
                        </span>
                    </p>
                </div>
                <div class="col-12 col-sm-2 p-0">
                    <p class="text-center">
                        <span class="ps-footer__link">
                            <i class="icon-truck"></i>In Dhaka- 70 TK
                        </span>
                    </p>
                </div>
                <div class="col-12 col-sm-3 p-0">
                    <p class="text-center">
                        <span class="ps-footer__link">
                            <i class="icon-truck"></i>Outside Dhaka- 150 TK
                        </span>
                    </p>
                </div>
                <div class="col-12 col-sm-4 p-0">
                    <p class="text-center">
                        <span class="ps-footer__link">
                            <i class="icon-check"></i>Check Product In Front Of Delivery Man
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="ps-footer__middle">
            <div class="row">
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="ps-footer--address">
                                <div class="ps-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ !empty(optional($setting)->site_logo_black) ? asset('storage/' . optional($setting)->site_logo_black) : asset('frontend/img/logo.png') }}"
                                            alt=""
                                            onerror="this.onerror=null; this.src='{{ asset('frontend/img/logo.png') }}';">
                                    </a>
                                </div>
                                <div class="ps-footer__title">Our store</div>
                                <p class="pb-3">
                                    {{ optional($setting)->address_line_one }}<br>{{ optional($setting)->address_line_two }}
                                </p>

                                <!-- In your Blade view (e.g., resources/views/your_view_name.blade.php) -->
                                <ul class="ps-social">
                                    @if (optional($setting)->facebook_url)
                                        <li>
                                            <a class="ps-social__link extra-color facebook"
                                                href="{{ optional($setting)->facebook_url }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fa fa-facebook"></i>
                                                <span class="ps-tooltip">Facebook</span>
                                            </a>
                                        </li>
                                    @endif

                                    @if (optional($setting)->instagram_url)
                                        <li>
                                            <a class="ps-social__link extra-color instagram"
                                                href="{{ optional($setting)->instagram_url }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fa fa-instagram"></i>
                                                <span class="ps-tooltip">Instagram</span>
                                            </a>
                                        </li>
                                    @endif

                                    @if (optional($setting)->youtube_url)
                                        <li>
                                            <a class="ps-social__link extra-color youtube"
                                                href="{{ optional($setting)->youtube_url }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fa fa-youtube-play"></i>
                                                <span class="ps-tooltip">YouTube</span>
                                            </a>
                                        </li>
                                    @endif

                                    @if (optional($setting)->pinterest_url)
                                        <li>
                                            <a class="ps-social__link extra-color pinterest"
                                                href="{{ optional($setting)->pinterest_url }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fa fa-pinterest-p"></i>
                                                <span class="ps-tooltip">Pinterest</span>
                                            </a>
                                        </li>
                                    @endif

                                    @if (optional($setting)->linkedin_url)
                                        <li>
                                            <a class="ps-social__link extra-color linkedin"
                                                href="{{ optional($setting)->linkedin_url }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fa fa-linkedin"></i>
                                                <span class="ps-tooltip">LinkedIn</span>
                                            </a>
                                        </li>
                                    @endif

                                    <!-- Add additional social media links similarly -->

                                    @if (optional($setting)->twitter_url)
                                        <li>
                                            <a class="ps-social__link extra-color twitter"
                                                href="{{ optional($setting)->twitter_url }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fa fa-twitter"></i>
                                                <span class="ps-tooltip">Twitter</span>
                                            </a>
                                        </li>
                                    @endif

                                    @if (optional($setting)->whatsapp_url)
                                        <li>
                                            <a class="ps-social__link extra-color whatsapp"
                                                href="{{ optional($setting)->whatsapp_url }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fa fa-whatsapp"></i>
                                                <span class="ps-tooltip">WhatsApp</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-7">
                            <div class="ps-footer--contact">
                                <h5 class="ps-footer__title">Need help</h5>
                                <div class="ps-footer__fax">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('images/whatsapp-icons.gif') }}" alt=""
                                            width="55px">
                                        {{ optional($setting)->primary_phone }}
                                    </div>

                                </div>
                                <p class="ps-footer__work">
                                    Saturday to Friday: 11 AM - 6PM
                                    <a
                                        href="mailto:{{ optional($setting)->contact_email }}">{{ optional($setting)->contact_email }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <div class="ps-footer--block">
                                <h5 class="ps-block__title">Account</h5>
                                <ul class="ps-block__list">
                                    <li><a href="{{ route('user.account.details') }}">My Account</a></li>
                                    <li><a href="{{ route('user.order.history') }}">My Orders</a></li>
                                    <li><a href="{{ route('user.quick.order') }}">Quick Order</a></li>
                                    <li><a href="{{ route('user.wishlist') }}">Shopping List</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="ps-footer--block">
                                <h5 class="ps-block__title">Policy</h5>
                                <ul class="ps-block__list">
                                    <li><a href="{{ asset('return-policy') }}">Returns</a></li>
                                    <li><a href="{{ asset('privacy/policy') }}">Privacy & Policy</a></li>
                                    <li><a href="{{ asset('terms-condition') }}">Terms & Conditions</a></li>
                                    <li><a href="{{ asset('faq') }}">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="ps-footer--block">
                                <h5 class="ps-block__title text-center mb-0">Visitor Count</h5>
                                <div class="visitor-box">
                                    <div class="main-counter">
                                        <h1 class="mb-0">{{ $getOnlineVisitorCount + 10 }}</h1>
                                        <div class="sub-counter">
                                            <p>ONLINE NOW</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center counter-container">
                                        {{-- <div class="today-count">
                                            <small class="mb-0 text-white">Today</small>
                                            <small class="mb-0 text-white fw-bold">{{ $getTodayVisitorCount + 500 }}</small>
                                        </div> --}}
                                        <div class="total-count">
                                            <small class="mb-0 text-white">Total Visitor</small>
                                            <small class="mb-0 text-white fw-bold">{{ getTotalVisitorCount() + 1000 }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-footer--bottom">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="{{ optional($setting)->copyright_url }}" target="_blank">
                            <p>{{ optional($setting)->copyright_title }}</p>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-end align-items-center">
                        {{-- <img src="{{ asset('frontend/img/payment.png') }}" alt>
                        <img class="payment-light" src="{{ asset('frontend/img/payment-light.png') }}" alt> --}}
                        {{-- <div class="">
                            <p style="margin: 5px 0; font-size: 10px;" class="text-right w-100">
                                Developed with ❤️ by
                                <strong>
                                    <a href="https://www.digiXsolve.com" class="pl-2"
                                        style="color: #252525; text-decoration: none;">digiXsolve</a>
                                </strong>
                            </p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
</footer>
