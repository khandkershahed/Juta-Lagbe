<style>
    .ps-footer {
        position: relative;
        width: 100%;
        min-height: 440px;
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
        background: #004d7ad1;
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
    .border-bottom-black {
    border-bottom: 2px solid white; /* Adjust thickness as needed */
    display: inline-block; /* Ensures the border is only as wide as the text */
    padding-bottom: 5px; /* Adds spacing between the text and the border */
}
</style>
<footer class="ps-footer ps-footer--13 ps-footer--14">
    <div class="ps-footer--top">
        <div class="container px-0" style="background-color: #fff;">
            <div class="row m-0">
                <div class="col-12 col-sm-3 p-0">
                    <p class="text-center">
                        <span class="ps-footer__link site-text">
                            <i class="icon-wallet site-text"></i>East To Order Place
                        </span>
                    </p>
                </div>
                <div class="col-12 col-sm-2 p-0">
                    <p class="text-center">
                        <span class="ps-footer__link site-text">
                            <i class="icon-truck site-text"></i>In Dhaka- 70 TK
                        </span>
                    </p>
                </div>
                <div class="col-12 col-sm-3 p-0">
                    <p class="text-center">
                        <span class="ps-footer__link site-text">
                            <i class="icon-truck site-text"></i>Outside Dhaka- 150 TK
                        </span>
                    </p>
                </div>
                <div class="col-12 col-sm-4 p-0">
                    <p class="text-center">
                        <span class="ps-footer__link site-text">
                            <i class="icon-check site-text"></i>Check Product In Front Of Delivery Man
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="ps-footer__middle">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="ps-footer--address">
                        <div class="ps-logo">
                            <a href="{{ route('home') }}">
                                <img width="250px"
                                    src="{{ !empty(optional($setting)->site_logo_white) ? asset('storage/' . optional($setting)->site_logo_white) : asset('frontend/img/logo.png') }}"
                                    alt=""
                                    onerror="this.onerror=null; this.src='{{ asset('frontend/img/logo.png') }}';">
                            </a>
                        </div>
                        <div class="ps-footer--contact pt-3">
                            <p class="ps-footer__work">Style Meets Comfort At JutaLagbe Shop.</p>
                        </div>
                        <img width="300px" class="payment-light" src="{{ asset('frontend/img/payment-light.png') }}"
                            alt>
                        <!-- In your Blade view (e.g., resources/views/your_view_name.blade.php) -->
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="ps-footer--contact">
                        <h5 class="ps-footer__title border-bottom-black">Need help</h5>
                        <div class="ps-footer__fax">
                            <div class="d-flex align-items-center">
                                <i class="fa-brands fa-whatsapp pl-3 text-white fa-bounce"></i>
                                <a href="tel:{{ optional($setting)->primary_phone }}" style="font-size: 20px">
                                    {{ optional($setting)->primary_phone }}
                                </a>
                            </div>
                        </div>
                        <p class="ps-footer__work pt-2">
                            Saturday to Friday: 11 AM - 09PM
                        </p>
                        <p class="ps-footer__work pt-2"><a href="mailto:{{ optional($setting)->contact_email }}">{{ optional($setting)->contact_email }}</a></p>
                        <p class="ps-footer__work pt-2"><i class="fa-solid fa-store"></i>
                            {{ optional($setting)->address_line_one }} {{ optional($setting)->address_line_two }}
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="ps-footer--block">
                        <h5 class="ps-block__title border-bottom-black">Account</h5>
                        <ul class="ps-block__list">
                            <li><a href="{{ route('user.account.details') }}">My Account</a></li>
                            <li><a href="{{ route('user.order.history') }}">My Orders</a></li>
                            <li><a href="{{ route('user.quick.order') }}">Quick Order</a></li>
                            <li><a href="{{ route('user.wishlist') }}">Shopping List</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="ps-footer--block">
                        <h5 class="ps-block__title border-bottom-black">Policy</h5>
                        <ul class="ps-block__list">
                            <li><a href="{{ asset('return-policy') }}">Returns</a></li>
                            <li><a href="{{ asset('privacy/policy') }}">Privacy & Policy</a></li>
                            <li><a href="{{ asset('terms-condition') }}">Terms & Conditions</a></li>
                            <li><a href="{{ asset('faq') }}">FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<section class="bg-white">
    <div class="container-fluid">
        <div class="container">
            <div class="ps-footer--bottom">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <a href="{{ optional($setting)->copyright_url }}" target="_blank">
                            <small class="site-text">{{ optional($setting)->copyright_title }} & Developed with ❤️ by
                                <strong>
                                    <a href="https://www.digiXsolve.com" class=""
                                        style="color: #252525; text-decoration: none;">digiXsolve</a>
                                </strong></small>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-end align-items-center">
                        <div class="pl-3">
                            <ul class="ps-social my-0">
                                @if (optional($setting)->facebook_url)
                                    <li class="my-0">
                                        <a class="ps-social__link extra-color facebook"
                                            href="{{ optional($setting)->facebook_url }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fa-brands fa-facebook"></i>
                                            <span class="ps-tooltip">Facebook</span>
                                        </a>
                                    </li>
                                @endif

                                @if (optional($setting)->instagram_url)
                                    <li class="my-0">
                                        <a class="ps-social__link extra-color instagram"
                                            href="{{ optional($setting)->instagram_url }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fa-brands fa-instagram"></i>
                                            <span class="ps-tooltip">Instagram</span>
                                        </a>
                                    </li>
                                @endif

                                @if (optional($setting)->youtube_url)
                                    <li class="my-0">
                                        <a class="ps-social__link extra-color youtube"
                                            href="{{ optional($setting)->youtube_url }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fa-brands fa-youtube"></i>
                                            <span class="ps-tooltip">YouTube</span>
                                        </a>
                                    </li>
                                @endif

                                @if (optional($setting)->pinterest_url)
                                    <li class="my-0">
                                        <a class="ps-social__link extra-color pinterest"
                                            href="{{ optional($setting)->pinterest_url }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fabrands fa-pinterest-p"></i>
                                            <span class="ps-tooltip">Pinterest</span>
                                        </a>
                                    </li>
                                @endif

                                @if (optional($setting)->linkedin_url)
                                    <li class="my-0">
                                        <a class="ps-social__link extra-color linkedin"
                                            href="{{ optional($setting)->linkedin_url }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fa-brands fa-linkedin"></i>
                                            <span class="ps-tooltip">LinkedIn</span>
                                        </a>
                                    </li>
                                @endif

                                <!-- Add additional social media links similarly -->

                                @if (optional($setting)->twitter_url)
                                    <li class="my-0">
                                        <a class="ps-social__link extra-color twitter"
                                            href="{{ optional($setting)->twitter_url }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fa-brands fa-twitter"></i>
                                            <span class="ps-tooltip">Twitter</span>
                                        </a>
                                    </li>
                                @endif

                                @if (optional($setting)->whatsapp_url)
                                    <li class="my-0">
                                        <a class="ps-social__link extra-color whatsapp"
                                            href="{{ optional($setting)->whatsapp_url }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fa-brands fa-whatsapp"></i>
                                            <span class="ps-tooltip">WhatsApp</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
