<style>
    .dropdown-item {
        font-size: 16px !important;
    }

    ::placeholder {
        color: #000 !important;
        opacity: 1;
        /* Firefox */
    }

    .menu-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        margin: 0 auto;
    }

    .menu {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        justify-content: center;
        flex-grow: 1;
        gap: 10px;
    }

    .menu-item {
        display: none;
        /* Default display for JS-managed visibility */
    }

    .button-nav-arrow-prev {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        position: relative;
        top: 1px;
        font-size: 14px;
        left: 10px;
        z-index: 5;
    }

    .button-nav-arrow {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        position: relative;
        top: 2px;
        font-size: 14px;
    }

    /* Placeholder color */
    #search_text::placeholder {
        color: #979797 !important;
        opacity: 1;
        /* Ensures color applies fully across browsers */
    }

    /* Placeholder animation classes */
    .placeholder-animated.fade-out {
        animation: slide-up 0.5s forwards;
    }

    .placeholder-animated.fade-in {
        animation: slide-down 0.5s forwards;
    }

    /* Keyframes for slide-up and slide-down */
    @keyframes slide-up {
        0% {
            transform: translateY(0);
            opacity: 1;
        }

        100% {
            transform: translateY(-20px);
            opacity: 0;
        }
    }

    @keyframes slide-down {
        0% {
            transform: translateY(20px);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* New Button */
    .button-new {
        --h-button: 48px;
        --w-button: 102px;
        --round: 0.35rem;
        cursor: pointer;
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: all 0.25s ease;
        background-image: linear-gradient(to right top, #ff0000, #f30405, #e7080a, #dc0c0d, #d00f10, #c40f11, #b81011, #ac1011, #9d0f10, #8f0e0f, #800d0e, #720c0c);
        /* border-radius: var(--round); */
        border: none;
        outline: none;
        padding: 10px 7px;
    }

    .button-new::before,
    .button-new::after {
        content: "";
        position: absolute;
        inset: var(--space);
        transition: all 0.5s ease-in-out;
        border-radius: calc(var(--round) - var(--space));
        z-index: 0;
    }

    .button-new::before {
        --space: 1px;
    }

    .button-new::after {
        --space: 1px;
        background-image: linear-gradient(to right top, #ff0000, #f30405, #e7080a, #dc0c0d, #d00f10, #c40f11, #b81011, #ac1011, #9d0f10, #8f0e0f, #800d0e, #720c0c);
    }

    .button-new:active {
        transform: scale(0.95);
    }

    /* Ensure parents allow scrolling */
    body,
    html {
        overflow: visible;
    }
</style>
<div class="ps-header ps-header--2">
    <div class="ps-header__top">
        <div class="container">
            <div class="ps-header__text">
                <i class="fa-solid fa-location-dot"></i>
                {{ optional($setting)->address_line_one }},{{ optional($setting)->address_line_two }}
            </div>
            <div class="ps-top__right">
                <ul class="menu-top">
                    <li class="nav-item px-1">
                        {{-- Log Out --}}
                        <a class="nav-link cust-link" href="javascript:void(0)" id="login-modal">
                            <i class="fa-solid fa-user header-icons"></i>
                        </a>
                        @auth
                            <div class="ps-login--modal">
                                <!-- If the user is authenticated, show these options -->
                                <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                                <!-- Hidden logout form -->
                                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        @else
                            <div class="ps-login--modal">
                                @guest
                                    <div>
                                        <p>Welcome! Choose an option:</p>
                                        <div class="d-flex align-items-center">
                                            <a class="btn btn-primary rounded-0 mr-2" href="{{ route('login') }}">
                                                Log in
                                            </a>
                                            <a class="btn btn-primary rounded-0" href="{{ route('register') }}">
                                                Register
                                            </a>
                                        </div>
                                    </div>
                                @endguest
                                {{-- If Logged In --}}
                                @auth
                                    <div>
                                        <p>Welcome! Choose an option:</p>
                                        <div class="d-flex align-items-center">
                                            <a class="btn btn-primary rounded-0 mr-2" href="{{ route('dashboard') }}">
                                                Dashboard
                                            </a>
                                            <a class="btn btn-primary rounded-0" href="#"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Log Out
                                            </a>
                                            <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                    {{-- <div>
                                        <p>Manage Your Dashboard?</p>
                                        <a class="btn btn-primary w-100" href="{{ route('dashboard') }}">
                                            Dashboard
                                        </a>
                                    </div>
                                    <div>
                                        <p>Want to Log Out?</p>
                                        <a class="btn btn-primary w-100" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Log Out
                                        </a>
                                        <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div> --}}
                                @endauth
                            </div>
                        @endauth
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cust-link px-1" href="{{ route('user.wishlist') }}">
                            <i class="fa-solid fa-heart header-icons"></i>
                            @php
                                $wishlistCount = 0; // Default value in case user is not authenticated
                                if (Auth::check()) {
                                    $userId = Auth::id();
                                    $wishlistCount = App\Models\Wishlist::where('user_id', $userId)->count();
                                }
                            @endphp
                            <span class="top-badge badge wishlistCount">{{ $wishlistCount }}</span>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cust-link px-1" href="#" id="cart-mini">
                            <i class="fa-solid fa-shopping-cart header-icons"></i>
                            <span class="top-badge badge cartCount">{{ Cart::instance('cart')->count() }}</span>
                        </a>
                        <div class="ps-cart--mini miniCart">
                            @include('frontend.pages.cart.partials.minicart')
                        </div>
                    </li>
                </ul>
                @if (!empty(optional($setting)->primary_phone))
                    <div class="ps-header__text">Need help? <strong>{{ optional($setting)->primary_phone }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="sticky-top">
    <header class="ps-header ps-header--2">
        <div class="ps-header__middle">
            <div class="container">
                <div class="ps-logo">
                    <a href="{{ route('home') }}">
                        <img class="rounded-2"
                            src="{{ !empty(optional($setting)->site_logo_white) ? asset('storage/' . optional($setting)->site_logo_white) : asset('frontend/img/logo.png') }}"
                            alt="" onerror="this.onerror=null; this.src='/images/default_logo-2.png';">
                        <img class="sticky-logo rounded-2"
                            src="{{ !empty(optional($setting)->site_logo_black) ? asset('storage/' . optional($setting)->site_logo_black) : asset('frontend/img/logo.png') }}"
                            alt="" onerror="this.onerror=null; this.src='/images/default_logo-2.png';">
                    </a>
                </div>
                <a class="ps-menu--sticky" href="#">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="ps-header__right">
                    <div class="row align-items-center">
                        <div class="col-lg-9 pr-0">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="ps-navigation__left">
                                    <nav class="ps-main-menu">
                                        <div class="menu-container">
                                            <ul class="menu">
                                                <li class="menu-item menus-items-head">
                                                    <a class="fromCenter {{ Route::currentRouteName() === 'home' ? 'active-menu' : '' }} mb-0"
                                                        href="{{ route('home') }}">
                                                        HOME
                                                    </a>
                                                </li>
                                                @foreach ($categories as $index => $category)
                                                    <li class="menu-item menus-items-head"
                                                        data-index="{{ $index }}">
                                                        <a class="fromCenter {{ request()->is('category/' . $category->slug) ? 'active-menu' : '' }}"
                                                            href="{{ route('category.products', $category->slug) }}">
                                                            {{ $category->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        @if (!empty(optional($special_offer)->slug))
                            <div class="col-lg-3">
                                <div class="text-right">
                                    {{-- <a href="#" class="animated-button">11:11 SALE</a> --}}
                                    <a href="{{ route('special.products', optional($special_offer)->slug) }}"
                                        class="button-new">
                                        <span class="fold"></span>
                                        <div class="points_wrapper">
                                            <i class="point"></i>
                                            <i class="point"></i>
                                        <i class="point"></i>
                                            <i class="point"></i>
                                            <i class="point"></i>
                                            <i class="point"></i>
                                            <i class="point"></i>
                                            <i class="point"></i>
                                            <i class="point"></i>
                                            <i class="point"></i>
                                        </div>

                                        <span class="inner"><svg class="icon" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5">
                                                <polyline
                                                    points="13.18 1.37 13.18 9.64 21.45 9.64 10.82 22.63 10.82 14.36 2.55 14.36 13.18 1.37">
                                                </polyline>
                                            </svg>{{ optional($special_offer)->button_name }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
<div class="ps-header ps-header--13 ps-header--mobile">
    <div class="ps-noti">
        @if (!empty(optional($special_offer)->slug) || !empty(optional($special_offer)->header_slogan))
            <section>
                <div class="marquee marquee--hover-pause">
                    <ul class="marquee__content">
                        @for ($i = 0; $i < 8; $i++)
                            <li>
                                <a href="{{ route('special.products', optional($special_offer)->slug) }}">
                                    <p class="text-white marquee-text mb-0 d-flex align-items-center">
                                        <span><i class="fa-solid fa-cart-shopping pr-3"></i></span>
                                        <span>{{ optional($special_offer)->header_slogan }}</span>
                                    </p>
                                </a>
                            </li>
                        @endfor
                    </ul>

                    <ul aria-hidden="true" class="marquee__content">
                        @for ($i = 0; $i < 8; $i++)
                            <li>
                                <a href="{{ route('special.products', optional($special_offer)->slug) }}">
                                    <p class="text-white marquee-text mb-0 d-flex align-items-center">
                                        <span><i class="fa-solid fa-cart-shopping pr-3"></i></span>
                                        <span>{{ optional($special_offer)->header_slogan }}</span>
                                    </p>
                                </a>
                            </li>
                        @endfor
                    </ul>
                </div>
            </section>
        @endif
    </div>
    <div class="ps-header__middle">
        <div class="container">
            <div class="ps-header__left">
                <ul class="ps-header__icons">
                    <li>
                        <a class="ps-header__item open-search" href="#">
                            <i class="fa fa-search" aria-hidden="true" style="font-family: 'FontAwesome';">
                            </i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="ps-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ !empty(optional($setting)->site_logo_black) ? asset('storage/' . optional($setting)->site_logo_black) : asset('frontend/img/logo.png') }}"
                        alt="">
                </a>
            </div>
            <div class="ps-header__right">
                <ul class="ps-header__icons">
                    <li>
                        <a class="ps-header__item" href="{{ asset('mycart') }}">
                            <i class="icon-cart-empty"></i>
                            <span class="badge cartCount">{{ Cart::instance('cart')->count() }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="ps-header__item" href="#">
                            <i class="icon-menu"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
