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
        background-image: linear-gradient(to right, #051937, #004d7a, #008793, #00bf72, #a8eb12);
        border-radius: var(--round);
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
        --space: 2px;
        background-image: linear-gradient(to right, #051937, #004d7a, #008793, #00bf72, #a8eb12);
    }

    .button-new:active {
        transform: scale(0.95);
    }

    .fold {
        z-index: 1;
        position: absolute;
        top: 0;
        right: 0;
        height: 1rem;
        /* width: 1rem; */
        display: inline-block;
        transition: all 0.5s ease-in-out;
        border-bottom-left-radius: 0.5rem;
        border-top-right-radius: var(--round);
    }

    .fold::after {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 150%;
        height: 150%;
        transform: rotate(45deg) translateX(0%) translateY(-18px);
        background-color: #e8e8e8;
        pointer-events: none;
    }

    .button-new:hover .fold {
        margin-top: -1rem;
        margin-right: -1rem;
    }

    .points_wrapper {
        overflow: hidden;
        width: 100%;
        height: 100%;
        pointer-events: none;
        position: absolute;
        z-index: 1;
    }

    .points_wrapper .point {
        bottom: -10px;
        position: absolute;
        animation: floating-points infinite ease-in-out;
        pointer-events: none;
        width: 2px;
        height: 2px;
        background-color: #fff;
        border-radius: 9999px;
    }

    @keyframes floating-points {
        0% {
            transform: translateY(0);
        }

        85% {
            opacity: 0;
        }

        100% {
            transform: translateY(-55px);
            opacity: 0;
        }
    }

    .points_wrapper .point:nth-child(1) {
        left: 10%;
        opacity: 1;
        animation-duration: 2.35s;
        animation-delay: 0.2s;
    }

    .points_wrapper .point:nth-child(2) {
        left: 30%;
        opacity: 0.7;
        animation-duration: 2.5s;
        animation-delay: 0.5s;
    }

    .points_wrapper .point:nth-child(3) {
        left: 25%;
        opacity: 0.8;
        animation-duration: 2.2s;
        animation-delay: 0.1s;
    }

    .points_wrapper .point:nth-child(4) {
        left: 44%;
        opacity: 0.6;
        animation-duration: 2.05s;
    }

    .points_wrapper .point:nth-child(5) {
        left: 50%;
        opacity: 1;
        animation-duration: 1.9s;
    }

    .points_wrapper .point:nth-child(6) {
        left: 75%;
        opacity: 0.5;
        animation-duration: 1.5s;
        animation-delay: 1.5s;
    }

    .points_wrapper .point:nth-child(7) {
        left: 88%;
        opacity: 0.9;
        animation-duration: 2.2s;
        animation-delay: 0.2s;
    }

    .points_wrapper .point:nth-child(8) {
        left: 58%;
        opacity: 0.8;
        animation-duration: 2.25s;
        animation-delay: 0.2s;
    }

    .points_wrapper .point:nth-child(9) {
        left: 98%;
        opacity: 0.6;
        animation-duration: 2.6s;
        animation-delay: 0.1s;
    }

    .points_wrapper .point:nth-child(10) {
        left: 65%;
        opacity: 1;
        animation-duration: 2.5s;
        animation-delay: 0.2s;
    }

    .inner {
        z-index: 2;
        gap: 6px;
        position: relative;
        width: 100%;
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 500;
        line-height: 1.5;
        transition: color 0.2s ease-in-out;
    }

    .inner svg.icon {
        width: 18px;
        height: 18px;
        transition: fill 0.1s linear;
    }

    .button-new:focus svg.icon {
        fill: white;
    }

    .button-new:hover svg.icon {
        fill: transparent;
        animation:
            dasharray 1s linear forwards,
            filled 0.1s linear forwards 0.95s;
    }

    @keyframes dasharray {
        from {
            stroke-dasharray: 0 0 0 0;
        }

        to {
            stroke-dasharray: 68 68 0 0;
        }
    }

    @keyframes filled {
        to {
            fill: white;
        }
    }

    .marquee-text {
        font-size: 14px;
        font-weight: 300;
    }
</style>
<header class="ps-header ps-header--2">
    <div class="ps-header__top">
        <div class="container">
            <div class="ps-header__text">
               <i class="fa-solid fa-location-dot"></i> {{ optional($setting)->address_line_one }},{{ optional($setting)->address_line_two }}
            </div>
            <div class="ps-top__right">
                <ul class="menu-top">
                    <li class="nav-item px-1">
                        {{-- Log Out --}}
                        <a class="nav-link" href="javascript:void(0)" id="login-modal">
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
                                        <p>Already Have An Account?</p>
                                        <a class="btn btn-primary w-100" href="{{ route('login') }}">
                                            Log in
                                        </a>
                                    </div>
                                    <div class="mt-3">
                                        <p>Don't Have An Account?</p>
                                        <a class="btn btn-primary w-100" href="{{ route('register') }}">
                                            Register
                                        </a>
                                    </div>
                                @endguest
                                {{-- If Logged In --}}
                                @auth
                                    <div>
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
                                    </div>
                                @endauth
                            </div>
                        @endauth
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-1" href="{{ route('user.wishlist') }}">
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
                        <a class="nav-link px-1" href="#" id="cart-mini">
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
                {{-- <div class="row">
                    <div class="col-lg-12">
                         <div class="ps-header__search">
                            <form action="{{ route('allproducts') }}">
                                <div class="ps-search-table">
                                    <div class="input-group rounded-pill">
                                        <input id="search_text" class="form-control ps-input search_text"
                                            type="text" placeholder="Ladies Bags">
                                        <div class="input-group-append">
                                            <a href="#"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div id="search_container" class="ps-search--result search_container d-none"
                                style="height: 50vh;overflow-y: auto;">
                                Search results will be injected here
                            </div>
                        </div>
                        @if (!empty(optional($setting)->primary_phone))
                            <div class="ps-middle__text">Need help?
                                <strong>{{ optional($setting)->primary_phone }}</strong>
                            </div>
                        @endif
                    </div>
                </div> --}}
                <div class="row align-items-center">
                    <div class="col-lg-9 pr-0">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="ps-navigation__left">
                                <nav class="ps-main-menu">
                                    <div class="menu-container">
                                        <ul class="menu">
                                            <li class="menu-item menus-items-head">
                                                <a href="{{ route('home') }}">Home</a>
                                            </li>
                                            @foreach ($categories as $index => $category)
                                                <li class="menu-item menus-items-head"
                                                    data-index="{{ $index }}">
                                                    <span class="text-white">| </span>
                                                    <a
                                                        href="{{ route('category.products', $category->slug) }}">{{ $category->name }}</a>
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
                                        </svg>{{ optional($special_offer)->button_name }}</span>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="ps-navigation">
        <div class="container-fluid text-center" style="border-bottom: 1px solid #f0f2f5;">
            <div class="container">

            </div>
        </div>
    </div> --}}
</header>
<header class="ps-header ps-header--13 ps-header--mobile">
    <div class="ps-noti">
        {{-- <div class="">
           <a href="{{ route('special.products') }}"><p class="m-0">{{ optional($setting)->site_motto }}</p></a>
        </div> --}}
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
        {{-- <a class="ps-noti__close">
            <i class="icon-cross"></i>
        </a> --}}
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

</header>
<script>
    const placeholders = [
        "Tote Bag",
        "Office Bag",
        "Imported Bag",
        "Laptop Bag"
    ];
    let placeholderIndex = 0;
    const searchInput = document.getElementById("search_text");
    let placeholderInterval;

    // Function to change placeholder with slide animation
    function changePlaceholder() {
        if (searchInput.value === "") {
            // Add slide-out animation
            searchInput.classList.add("placeholder-animated", "fade-out");

            // Wait for slide-out to complete before changing placeholder
            setTimeout(() => {
                placeholderIndex = (placeholderIndex + 1) % placeholders.length;
                searchInput.placeholder = placeholders[placeholderIndex];

                // Remove fade-out and add fade-in for the next transition
                searchInput.classList.remove("fade-out");
                searchInput.classList.add("fade-in");
            }, 500); // Wait 0.5s for fade-out to complete

            // Remove fade-in class after the animation completes to reset for the next change
            setTimeout(() => {
                searchInput.classList.remove("fade-in");
            }, 1000); // 0.5s fade-out + 0.5s fade-in
        }
    }

    // Function to start the placeholder animation
    function startPlaceholderAnimation() {
        if (placeholderInterval) clearInterval(placeholderInterval);
        placeholderInterval = setInterval(changePlaceholder, 4000);
    }

    // Stop animation on focus
    searchInput.addEventListener("focus", () => {
        clearInterval(placeholderInterval);
        searchInput.classList.remove("placeholder-animated", "fade-out", "fade-in");
    });

    // Restart animation on blur, only if input is empty
    searchInput.addEventListener("blur", () => {
        if (searchInput.value === "") {
            startPlaceholderAnimation();
        }
    });

    // Start animation initially if input is empty
    if (searchInput.value === "") {
        startPlaceholderAnimation();
    }
</script>
