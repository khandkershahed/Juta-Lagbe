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
        /* background-image: linear-gradient(to right top, #ff0000, #f30405, #e7080a, #dc0c0d, #d00f10, #c40f11, #b81011, #ac1011, #9d0f10, #8f0e0f, #800d0e, #720c0c); */
        background-color: white;
        /* border-radius: var(--round); */
        border: none;
        outline: none;
        padding: 10px 7px;
        border: 1px solid #004d7a;
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
        /* background-image: linear-gradient(to right top, #ff0000, #f30405, #e7080a, #dc0c0d, #d00f10, #c40f11, #b81011, #ac1011, #9d0f10, #8f0e0f, #800d0e, #720c0c); */
        background-color: white;
    }

    .button-new:active {
        transform: scale(0.95);
    }
</style>
{{-- <div class="ps-header ps-header--2">
    <div class="ps-header__top">
        <div class="container">
            <div class="ps-header__text">
                <i class="fa-solid fa-location-dot"></i>
                {{ optional($setting)->address_line_one }},{{ optional($setting)->address_line_two }}
            </div>
            <div class="ps-top__right">
                <ul class="menu-top">
                    <li class="px-1 nav-item">
                        <a class="nav-link cust-link" href="javascript:void(0)" id="login-modal">
                            <i class="fa-solid fa-user header-icons"></i>
                        </a>
                        @auth
                            <div class="ps-login--modal">
                                <div>
                                    <p>Welcome! Choose an option:</p>
                                    <div class="d-flex align-items-center">
                                        <a class="mr-2 btn btn-primary rounded-0"
                                            href="{{ route('dashboard') }}">Dashboard</a>
                                        <a class="btn btn-primary rounded-0" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Log Out') }}
                                        </a>
                                        <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="ps-login--modal">
                                @guest
                                    <div>
                                        <p>Welcome! Choose an option:</p>
                                        <div class="d-flex align-items-center">
                                            <a class="mr-2 btn btn-primary rounded-0" href="{{ route('login') }}">
                                                Log in
                                            </a>
                                            <a class="btn btn-primary rounded-0" href="{{ route('register') }}">
                                                Register
                                            </a>
                                        </div>
                                    </div>
                                @endguest
                                @auth
                                    <div>
                                        <p>Welcome! Choose an option:</p>
                                        <div class="d-flex align-items-center">
                                            <a class="mr-2 btn btn-primary rounded-0" href="{{ route('dashboard') }}">
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
                                @endauth
                            </div>
                        @endauth
                    </li>
                    <li class="nav-item">
                        <a class="px-1 nav-link cust-link" href="{{ route('user.wishlist') }}">
                            <i class="fa-solid fa-heart header-icons"></i>
                            @php
                                $wishlistCount = 0;
                                if (Auth::check()) {
                                    $userId = Auth::id();
                                    $wishlistCount = App\Models\Wishlist::where('user_id', $userId)->count();
                                }
                            @endphp
                            <span class="top-badge badge wishlistCount">{{ $wishlistCount }}</span>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="px-1 nav-link cust-link" href="#" id="cart-mini">
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
</div> --}}
<div id="promo-banner" style="background-color: var(--primary-color)">
    <div class="container py-2">
        <div class="row">
            <div class="col-11">
                <div class="d-flex align-items-center justify-content-center">
                    <p class="mb-0 text-white pe-2">Sign up and get 20% off to your first order.</p>
                    <a href="{{ route('register') }}" class="pl-2 text-white fw-bold"
                        style="font-weight: 600; text-decoration: underline">Sign Up Now</a>
                </div>
            </div>
            <div class="col-1">
                <div class="d-flex justify-content-end">
                    <a href="javascript:void(0)" id="close-banner">
                        <i class="text-white fa-solid fa-close"></i>
                    </a>
                </div>
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
                            src="{{ !empty(optional($setting)->site_logo_black) ? asset('storage/' . optional($setting)->site_logo_black) : asset('frontend/img/logo.png') }}"
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
                        <div class="pr-0 col-lg-8">
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
                                                <li class="menu-item menus-items-head">
                                                    <a class="fromCenter {{ Route::currentRouteName() === 'allproducts' ? 'active-menu' : '' }} mb-0"
                                                        href="{{ route('allproducts') }}">
                                                        SHOP
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
                        {{-- @if (!empty(optional($special_offer)->slug))
                            <div class="col-lg-3">
                                <div class="text-right">
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
                        @endif --}}
                        <div class="col-lg-4">
                            <div class="d-flex justify-content-end">
                                <ul class="menu-top">
                                    <li class="px-1 nav-item">
                                        <a class="nav-link cust-link" href="javascript:void(0)" id="login-modal">
                                            <i class="fa-solid fa-user header-icons"></i>
                                        </a>
                                        @auth
                                            <div class="ps-login--modal">
                                                <div>
                                                    <p>Welcome! Choose an option:</p>
                                                    <div class="d-flex align-items-center">
                                                        <a class="mr-2 btn btn-primary rounded-0"
                                                            href="{{ route('dashboard') }}">Dashboard</a>
                                                        <a class="btn btn-primary rounded-0" href="#"
                                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            {{ __('Log Out') }}
                                                        </a>
                                                        <form id="logout-form" method="POST"
                                                            action="{{ route('logout') }}" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="ps-login--modal">
                                                @guest
                                                    <div>
                                                        <p>Welcome! Choose an option:</p>
                                                        <div class="d-flex align-items-center">
                                                            <a class="mr-2 btn btn-primary rounded-0"
                                                                href="{{ route('login') }}">
                                                                Log in
                                                            </a>
                                                            <a class="btn btn-primary rounded-0"
                                                                href="{{ route('register') }}">
                                                                Register
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endguest
                                                @auth
                                                    <div>
                                                        <p>Welcome! Choose an option:</p>
                                                        <div class="d-flex align-items-center">
                                                            <a class="mr-2 btn btn-primary rounded-0"
                                                                href="{{ route('dashboard') }}">
                                                                Dashboard
                                                            </a>
                                                            <a class="btn btn-primary rounded-0" href="#"
                                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                Log Out
                                                            </a>
                                                            <form id="logout-form" method="POST"
                                                                action="{{ route('logout') }}" style="display: none;">
                                                                @csrf
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endauth
                                            </div>
                                        @endauth
                                    </li>
                                    <li class="nav-item">
                                        <a class="px-1 nav-link cust-link heart-icons"
                                            href="{{ route('user.wishlist') }}">
                                            <i class="fa-solid fa-heart header-icons"></i>
                                            @php
                                                $wishlistCount = 0;
                                                if (Auth::check()) {
                                                    $userId = Auth::id();
                                                    $wishlistCount = App\Models\Wishlist::where(
                                                        'user_id',
                                                        $userId,
                                                    )->count();
                                                }
                                            @endphp
                                            <span class="top-badge badge wishlistCount">{{ $wishlistCount }}</span>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="px-1 nav-link cust-link" href="#" id="cart-mini">
                                            <i class="fa-solid fa-shopping-cart header-icons"></i>
                                            <span
                                                class="top-badge badge cartCount">{{ Cart::instance('cart')->count() }}</span>
                                        </a>
                                        <div class="ps-cart--mini miniCart">
                                            @include('frontend.pages.cart.partials.minicart')
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
<div class="shadow-sm ps-header ps-header--13 ps-header--mobile">
    @if (!empty(optional($special_offer)->slug) || !empty(optional($special_offer)->header_slogan))
        <div class="ps-noti">
            <section>
                <div class="marquee marquee--hover-pause">
                    <ul class="marquee__content">
                        @for ($i = 0; $i < 8; $i++)
                            <li>
                                <a href="{{ route('special.products', optional($special_offer)->slug) }}">
                                    <p class="mb-0 text-white marquee-text d-flex align-items-center">
                                        <span><i class="pr-3 fa-solid fa-cart-shopping"></i></span>
                                        <span>{{ optional($special_offer)->header_slogan ?? 'Step Into Style' }}</span>
                                    </p>
                                </a>
                            </li>
                        @endfor
                    </ul>

                    <ul aria-hidden="true" class="marquee__content">
                        @for ($i = 0; $i < 8; $i++)
                            <li>
                                <a href="{{ route('special.products', optional($special_offer)->slug) }}">
                                    <p class="mb-0 text-white marquee-text d-flex align-items-center">
                                        <span><i class="pr-3 fa-solid fa-cart-shopping"></i></span>
                                        <span>{{ optional($special_offer)->header_slogan ?? 'Step Into Style' }}</span>
                                    </p>
                                </a>
                            </li>
                        @endfor
                    </ul>
                </div>
            </section>
        </div>
    @endif

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

<script>
    document.getElementById("close-banner").addEventListener("click", function() {
        document.getElementById("promo-banner").style.display = "none";
    });
</script>
