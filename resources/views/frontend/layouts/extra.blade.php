<div class="ps-navigation--footer">
    <div>
        <a href="{{ route('home') }}">
            <img src="{{ !empty(optional($setting)->site_logo_white) ? asset('storage/' . optional($setting)->site_logo_white) : asset('frontend/img/logo.png') }}"
                style="width: 80px; padding: 8px; border-radius: 12px"
                onerror="this.onerror=null; this.src='/images/default_logo-2.jpg';">
        </a>
    </div>
    <div class="d-flex align-items-center">
        <div class="ps-nav__item"><a href="{{ route('login') }}">
                <img src="{{ asset('images/icon-profile.svg') }}" style="width: 20px" alt="">
            </a>
        </div>
        <div class="ps-nav__item">
            <a href="{{ route('user.wishlist') }}">
                {{-- <i class="fa fa-heart-o"></i> --}}
                <img src="{{ asset('images/icon-heart.svg') }}" style="width: 20px" alt="">
                @php
                    $wishlistCount = 0; // Default value in case user is not authenticated
                    if (Auth::check()) {
                        $userId = Auth::id();
                        $wishlistCount = App\Models\Wishlist::where('user_id', $userId)->count();
                    }
                @endphp
                <span class="badge wishlistCount">{{ $wishlistCount }}</span>
            </a>
        </div>
        <div class="ps-nav__item">
            <a href="{{ route('cart') }}">
                <img src="{{ asset('images/icon-cart.svg') }}" style="width: 20px" alt="">
                <span class="badge cartCount">{{ Cart::instance('cart')->count() }}</span>
            </a>
        </div>
        <div class="ps-nav__item">
            <a href="#" id="open-menu">
                {{-- <i class="icon-menu"></i> --}}
                <i class="fa-solid fa-bars pt-2 text-white"></i>
            </a>
            <a href="#" id="close-menu">
                <i class="fa-solid fa-xmark text-white"></i>
            </a>
        </div>
    </div>
</div>
<div class="ps-menu--slidebar">
    <div class="ps-menu__content">
        <ul class="menu--mobile">

            @foreach ($categories as $category)
                <li class="has-mega-menu">
                    <a href="{{ route('category.products', $category->slug) }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
            <li class="has-mega-menu">
                <a href="{{ route('allproducts') }}">
                    Shop
                </a>
            </li>
            @if (!empty(optional($special_offer)->slug))
                <li>
                    <a href="{{ route('special.products', optional($special_offer)->slug) }}" class="button-new mt-2">
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

                        <span class="inner"><svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2.5">
                                <polyline
                                    points="13.18 1.37 13.18 9.64 21.45 9.64 10.82 22.63 10.82 14.36 2.55 14.36 13.18 1.37">
                                </polyline>
                            </svg>{{ optional($special_offer)->button_name }}</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <div class="ps-menu__footer">
        <div class="ps-menu__item">
            <div class="col-12 col-md-7">
                <div class="ps-footer--contact mobile-help">
                    <h5 class="ps-footer__title">Need help</h5>
                    <div class="ps-footer__fax number-mobile">
                        <div class="d-flex align-items-center">
                            <img class="" src="{{ asset('images/whatsapp-icons.gif') }}" alt=""
                                width="55px">
                            {{ optional($setting)->primary_phone }}
                        </div>

                    </div>
                    <p class="ps-footer__work">
                        Monday – Friday: 9:00-20:00<br>Saturday: 11:00 – 15:00 <br>
                        <a
                            href="mailto:{{ optional($setting)->contact_email }}">{{ optional($setting)->contact_email }}</a>
                    </p>
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
                                <li><a href="{{ asset('faq') }}">Faq</a></li>
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
                                <div class="d-flex justify-content-between align-items-center">
                                    {{-- <div class="today-count">
                                        <small class="mb-0 text-white">Today</small>
                                        <small class="mb-0 text-white fw-bold">70</small>
                                    </div> --}}
                                    <div class="total-count">
                                        <small class="mb-0 text-white">Total</small>
                                        <small class="mb-0 text-white fw-bold">{{ getTotalVisitorCount() + 1000 }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn scroll-top"><i class="fa fa-angle-double-up"></i></button>
