<x-frontend-app-layout :title="'Home Page'">
    <section class="ps-section--banner">
        {{-- <div class="ps-section__overlay">
            <div class="ps-section__loading"></div>
        </div> --}}
        <div class="main-banner">
            <img src="{{ asset('images/jutalagbe-main-banner.jpg') }}" alt="">
        </div>
    </section>
    <div class="ps-home ps-home--14 bg-white">
        @if (!empty(optional($special_offer)->slug) || !empty(optional($special_offer)->header_slogan))
            <div class="ps-noti h-marqee">
                <section>
                    <div class="marquee marquee--hover-pause enable-animation">
                        <div class="marquee__content">
                            @for ($i = 0; $i < 10; $i++)
                                <a href="{{ route('special.products', optional($special_offer)->slug) }}">
                                    <p class="text-white marquee-text mb-0 d-flex align-items-center">
                                        <span><img class="pr-3 img-fluid" width="60px"
                                                src="{{ asset('images/markque-icons.png') }}" alt=""></span>
                                        <span>{{ optional($special_offer)->header_slogan }}</span>
                                    </p>
                                </a>
                            @endfor
                        </div>
                        <div aria-hidden="true" class="marquee__content">
                            @for ($i = 0; $i < 10; $i++)
                                <a href="{{ route('special.products', optional($special_offer)->slug) }}">
                                    <p class="text-white marquee-text mb-0 d-flex align-items-center">
                                        <span><img class="pr-3 img-fluid" width="60px"
                                                src="{{ asset('images/markque-icons.png') }}" alt=""></span>
                                        <span>{{ optional($special_offer)->header_slogan }}</span>
                                    </p>
                                </a>
                            @endfor
                        </div>
                    </div>
                </section>
            </div>
        @endif
        @if ($categorys->count() > 0)
            <section class="ps-section--categories" style="background-color: #f3f2f257;">
                <div class="container px-0">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="ps-section__content section-category">
                                <div class="ps-categories__list owl-carousel">
                                    @foreach ($categorys as $category)
                                        <div class="ps-categories__item">
                                            <a class="ps-categories__link"
                                                href="{{ route('category.products', $category->slug) }}">
                                                @php
                                                    $logoPath = 'storage/' . $category->logo;
                                                    $logoSrc = file_exists(public_path($logoPath))
                                                        ? asset($logoPath)
                                                        : asset('frontend/img/no-category.png');
                                                @endphp
                                                <img src="{{ $logoSrc }}" alt="{{ $category->name }}"
                                                    onerror="this.onerror=null; this.src='frontend/img/no-category.png';">
                                            </a>
                                            <a class="ps-categories__name"
                                                href="{{ route('category.products', $category->slug) }}">
                                                {{ $category->name }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <div class="ps-home__content">
            @if ($latest_products->count() > 0)
                <section class="ps-section--latest-horizontal pt-0">
                    <section class="container px-0">
                        <h3 class="ps-section__title mb-0 py-4" style="font-size: 30px;">Latest Products <img
                                width="40px"
                                src="https://static.vecteezy.com/system/resources/previews/011/999/958/non_2x/fire-icon-free-png.png"
                                alt="" style="position: relative;top: -3px;left: -6px;">
                        </h3>
                        <div class="ps-section__content">
                            <div class="row m-0">
                                @foreach ($latest_products as $latest_product)
                                    <div class="col-6 col-md-4 col-lg-3 dot4 pr-0 pr-lg-3 pl-0 mb-3">
                                        <div class="ps-section__product">
                                            <div class="ps-product ps-product--standard">
                                                <div class="ps-product__thumbnail">
                                                    <a class="ps-product__image"
                                                        href="{{ route('product.details', $latest_product->slug) }}">
                                                        <figure>
                                                            @if (!empty($latest_product->thumbnail))
                                                                @php
                                                                    $thumbnailPath =
                                                                        'storage/' . $latest_product->thumbnail;
                                                                    $thumbnailSrc = file_exists(
                                                                        public_path($thumbnailPath),
                                                                    )
                                                                        ? asset($thumbnailPath)
                                                                        : asset('frontend/img/no-product.jpg');
                                                                @endphp
                                                                <img src="{{ $thumbnailSrc }}"
                                                                    alt="{{ $latest_product->meta_title }}"
                                                                    width="210" height="210" />
                                                            @else
                                                                @foreach ($latest_product->multiImages->slice(0, 2) as $image)
                                                                    @php
                                                                        $imagePath = 'storage/' . $image->photo;
                                                                        $imageSrc = file_exists(public_path($imagePath))
                                                                            ? asset($imagePath)
                                                                            : asset('frontend/img/no-product.jpg');
                                                                    @endphp
                                                                    <img src="{{ $imageSrc }}"
                                                                        alt="{{ $latest_product->meta_title }}"
                                                                        width="210" height="210" />
                                                                @endforeach
                                                            @endif
                                                        </figure>
                                                    </a>
                                                    {{-- Review End --}}
                                                    <div class="ps-product__actions">
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist">
                                                            <a class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $latest_product->id) }}"><i
                                                                    class="fa-solid fa-heart"></i></a>
                                                        </div>
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Quick view">
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#popupQuickview{{ $latest_product->id }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>
                                                        {{-- <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Add To Cart">
                                                            <a class="add_to_cart"
                                                                href="{{ route('cart.store', $latest_product->id) }}"
                                                                data-product_id="{{ $latest_product->id }}"
                                                                data-product_qty="1">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </a>
                                                        </div> --}}

                                                    </div>
                                                    @if (!empty($latest_product->unit_discount_price))
                                                        <div class="ps-product__badge">
                                                            <div class="ps-badge ps-badge--sale">
                                                                -
                                                                {{ !empty($latest_product->unit_discount_price) && $latest_product->unit_discount_price > 0 ? number_format((($latest_product->unit_price - $latest_product->unit_discount_price) / $latest_product->unit_price) * 100, 1) : 0 }}
                                                                % অফ
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ps-product__content">
                                                    <h5 class="ps-product__title">
                                                        <a
                                                            href="{{ route('product.details', $latest_product->slug) }}">
                                                            {{ implode(' ', array_slice(explode(' ', $latest_product->name), 0, 5)) }}
                                                        </a>
                                                    </h5>
                                                    <div class="pb-3">
                                                        @if (!empty($latest_product->unit_discount_price))
                                                            <div class="ps-product__meta">
                                                                <span class="ps-product__price sale fw-bold"
                                                                    style="font-weight:600;">দাম
                                                                    {{ $latest_product->unit_discount_price }}
                                                                    টাকা</span>
                                                                <span
                                                                    class="ps-product__del text-danger">{{ $latest_product->unit_price }}
                                                                    টাকা</span>
                                                            </div>
                                                        @else
                                                            <div class="ps-product__meta">
                                                                <span class="ps-product__price sale fw-bold"
                                                                    style="font-weight:600;">দাম
                                                                    {{ $latest_product->unit_price }}
                                                                    টাকা</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex align-items-center card-cart-btn">
                                                        <a href="{{ route('product.details', $latest_product->slug) }}"
                                                            class="btn btn-primary rounded-0 w-100">
                                                            <i class="fa-solid fa-basket-shopping pr-2"></i>
                                                            অর্ডার
                                                            করুন
                                                        </a>
                                                    </div>
                                                    <div class="ps-product__actions ps-product__group-mobile">
                                                        <div class="ps-product__quantity">
                                                            <div class="def-number-input number-input safari_only">
                                                                <button class="minus"
                                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                        class="icon-minus"></i>
                                                                </button>
                                                                <input class="quantity" min="0"
                                                                    name="quantity" value="1" type="number" />
                                                                <button class="plus"
                                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                        class="icon-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist"><a
                                                                class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $latest_product->id) }}"><i
                                                                    class="fa-solid fa-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </section>
            @endif
            {{-- <section class="mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 pl-0">
                            <div class="row banner-first-row">
                                <div class="col-lg-12 mb-4">
                                    <div class="image-container">
                                        <a href="">
                                            <img class="img-fluid"
                                                src="{{ asset('images/home-banner-side-one.png') }}" alt="">
                                            <span class="overlay-text">Your Text Here</span>
                                            <!-- Text that appears on hover -->
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="image-container">
                                        <a href="">
                                            <img class="img-fluid"
                                                src="{{ asset('images/home-banner-side-two.png') }}" alt="">
                                            <span class="overlay-text">Your Text Here</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2">
                            <div class="image-container">
                                <a href="" class="section-banner-main">
                                    <img class="img-fluid" src="{{ asset('images/home-banner-side-center.png') }}"
                                        alt="">
                                    <span class="overlay-text">Your Text Here</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 pr-3 pr-lg-0">
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <div class="image-container">
                                        <a href="">
                                            <img class="img-fluid"
                                                src="{{ asset('images/home-banner-side-three.png') }}"
                                                alt="">
                                            <span class="overlay-text">Your Text Here</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="image-container">
                                        <a href="">
                                            <img class="img-fluid"
                                                src="{{ asset('images/home-banner-side-four.png') }}" alt="">
                                            <span class="overlay-text">Your Text Here</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
            @if ($categoryone && $categoryoneproducts->count() > 0)
                <div class="container px-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between align-items-center pb-4 pb-lg-5">
                                <div class="">
                                    <h3 class="ps-section__title mb-0" style="font-size: 30px;">
                                        {{ optional($categoryone)->name }}</h3>
                                </div>
                                <div style="width: 900px" class="px-3">
                                    <span style="height: 1px; background-color:#c9c8c8; display: block"></span>
                                </div>
                                <div class="ps-delivery ps-delivery--info p-0">
                                    <a class="ps-delivery__more" href="http://127.0.0.1:8000/shop">আরো দেখুন <i
                                            class="fa-solid fa-"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ps-home--block">
                        <div class="ps-section__content">
                            <div class="row m-0">
                                @foreach ($categoryoneproducts as $categoryoneproduct)
                                    <div class="col-6 col-md-4 col-lg-3 dot4 pr-0 pr-lg-3 pl-0">
                                        <div class="ps-section__product border">
                                            <div class="ps-product ps-product--standard">
                                                <div class="ps-product__thumbnail">
                                                    <a class="ps-product__image"
                                                        href="{{ route('product.details', $categoryoneproduct->slug) }}">
                                                        <figure>
                                                            @if (!empty($categoryoneproduct->thumbnail))
                                                                @php
                                                                    $thumbnailPath =
                                                                        'storage/' . $categoryoneproduct->thumbnail;
                                                                    $thumbnailSrc = file_exists(
                                                                        public_path($thumbnailPath),
                                                                    )
                                                                        ? asset($thumbnailPath)
                                                                        : asset('frontend/img/no-product.jpg');
                                                                @endphp
                                                                <img src="{{ $thumbnailSrc }}"
                                                                    alt="{{ $categoryoneproduct->meta_title }}"
                                                                    width="210" height="210" />
                                                            @else
                                                                @foreach ($categoryoneproduct->multiImages->slice(0, 2) as $image)
                                                                    @php
                                                                        $imagePath = 'storage/' . $image->photo;
                                                                        $imageSrc = file_exists(public_path($imagePath))
                                                                            ? asset($imagePath)
                                                                            : asset('frontend/img/no-product.jpg');
                                                                    @endphp
                                                                    <img src="{{ $imageSrc }}"
                                                                        alt="{{ $categoryoneproduct->meta_title }}"
                                                                        width="210" height="210" />
                                                                @endforeach
                                                            @endif
                                                        </figure>
                                                    </a>
                                                    {{-- Review End --}}
                                                    <div class="ps-product__actions">
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist">
                                                            <a class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $categoryoneproduct->id) }}"><i
                                                                    class="fa-solid fa-heart"></i></a>
                                                        </div>
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Quick view">
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#popupQuickview{{ $categoryoneproduct->id }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>
                                                        {{-- <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Add To Cart">
                                                            <a class="add_to_cart"
                                                                href="{{ route('cart.store', $categoryoneproduct->id) }}"
                                                                data-product_id="{{ $categoryoneproduct->id }}"
                                                                data-product_qty="1">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </a>
                                                        </div> --}}

                                                    </div>
                                                    @if (!empty($categoryoneproduct->unit_discount_price))
                                                        <div class="ps-product__badge">
                                                            <div class="ps-badge ps-badge--sale">
                                                                -
                                                                {{ !empty($categoryoneproduct->unit_discount_price) && $categoryoneproduct->unit_discount_price > 0 ? number_format((($categoryoneproduct->unit_price - $categoryoneproduct->unit_discount_price) / $categoryoneproduct->unit_price) * 100, 1) : 0 }}
                                                                % অফ
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ps-product__content">
                                                    <h5 class="ps-product__title">
                                                        <a
                                                            href="{{ route('product.details', $categoryoneproduct->slug) }}">
                                                            {{ implode(' ', array_slice(explode(' ', $categoryoneproduct->name), 0, 5)) }}
                                                        </a>
                                                    </h5>
                                                    <div class="pb-3">
                                                        @if (!empty($categoryoneproduct->unit_discount_price))
                                                            <div class="ps-product__meta">
                                                                <span class="ps-product__price sale fw-bold"
                                                                    style="font-weight:600;">দাম
                                                                    {{ $categoryoneproduct->unit_discount_price }}
                                                                    টাকা</span>
                                                                <span
                                                                    class="ps-product__del text-danger">{{ $categoryoneproduct->unit_price }}
                                                                    টাকা</span>
                                                            </div>
                                                        @else
                                                            <div class="ps-product__meta">
                                                                <span class="ps-product__price sale fw-bold"
                                                                    style="font-weight:600;">দাম
                                                                    {{ $categoryoneproduct->unit_price }}
                                                                    টাকা</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex align-items-center card-cart-btn">
                                                        <a href="{{ route('product.details', $categoryoneproduct->slug) }}"
                                                            class="btn btn-primary rounded-0 w-100">
                                                            <i class="fa-solid fa-basket-shopping pr-2"></i>
                                                            অর্ডার
                                                            করুন
                                                        </a>
                                                    </div>
                                                    <div class="ps-product__actions ps-product__group-mobile">
                                                        <div class="ps-product__quantity">
                                                            <div class="def-number-input number-input safari_only">
                                                                <button class="minus"
                                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                        class="icon-minus"></i>
                                                                </button>
                                                                <input class="quantity" min="0"
                                                                    name="quantity" value="1" type="number" />
                                                                <button class="plus"
                                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                        class="icon-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist"><a
                                                                class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $categoryoneproduct->id) }}"><i
                                                                    class="fa-solid fa-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="container-fluid"
                style="background-image: linear-gradient(to right, #051937, #004d7a, #008793, #00bf72, #a8eb12);">
                <div class="container juta-delivery">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="ps-delivery ps-delivery--info">
                                <div class="ps-delivery__content">
                                    <div class="ps-delivery__text text-white">
                                        <i class="icon-shield-check"></i>
                                        <span>
                                            <strong>100% Secure Delivery</strong> Without Courier Communication.
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="delivery-icons">
                                <img class="img-fluid" src="{{ asset('images/delivery-icons.png') }}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($categorytwo && $categorytwoproducts->count() > 0)
                <section class="ps-section--latest mt-0">
                    <div class="container px-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between align-items-center py-4 pt-0 py-lg-5">
                                    <div class="">
                                        <h3 class="ps-section__title mb-0" style="font-size: 30px;">
                                            {{ optional($categorytwo)->name }}</h3>
                                    </div>
                                    <div style="width: 900px" class="px-3">
                                        <span style="height: 1px; background-color:#c9c8c8; display: block"></span>
                                    </div>
                                    <div class="ps-delivery ps-delivery--info p-0">
                                        <a class="ps-delivery__more" href="http://127.0.0.1:8000/shop">আরো দেখুন <i
                                                class="fa-solid fa-"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-section__carousel mb-0 pb-0">
                            <div class="takeway-slider owl-carousel owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage mb-4"
                                        style="transform: translate3d(-2228px, 0px, 0px); transition: 1s; width: 4952px;">
                                        @foreach ($categorytwoproducts as $categorytwoproduct)
                                            <div class="owl-item" style="width: 247.6px;">
                                                <div class="ps-section__product border">
                                                    <div class="ps-product ps-product--standard">
                                                        <div class="ps-product__thumbnail">
                                                            <a class="ps-product__image"
                                                                href="{{ route('product.details', $categorytwoproduct->slug) }}">
                                                                <figure>
                                                                    @if (!empty($categorytwoproduct->thumbnail))
                                                                        @php
                                                                            $thumbnailPath =
                                                                                'storage/' .
                                                                                $categorytwoproduct->thumbnail;
                                                                            $thumbnailSrc = file_exists(
                                                                                public_path($thumbnailPath),
                                                                            )
                                                                                ? asset($thumbnailPath)
                                                                                : asset('frontend/img/no-product.jpg');
                                                                        @endphp
                                                                        <img src="{{ $thumbnailSrc }}"
                                                                            alt="{{ $categorytwoproduct->meta_title }}"
                                                                            width="210" height="210" />
                                                                    @else
                                                                        @foreach ($categorytwoproduct->multiImages->slice(0, 2) as $image)
                                                                            @php
                                                                                $imagePath = 'storage/' . $image->photo;
                                                                                $imageSrc = file_exists(
                                                                                    public_path($imagePath),
                                                                                )
                                                                                    ? asset($imagePath)
                                                                                    : asset(
                                                                                        'frontend/img/no-product.jpg',
                                                                                    );
                                                                            @endphp
                                                                            <img src="{{ $imageSrc }}"
                                                                                alt="{{ $categorytwoproduct->meta_title }}"
                                                                                width="210" height="210" />
                                                                        @endforeach
                                                                    @endif
                                                                </figure>
                                                            </a>
                                                            {{-- Review --}}
                                                            @if (count($categorytwoproduct->reviews) > 0)
                                                                <div>
                                                                    @php
                                                                        $review =
                                                                            count($categorytwoproduct->reviews) > 0
                                                                                ? optional(
                                                                                        $categorytwoproduct->reviews,
                                                                                    )->sum('rating') /
                                                                                    count($categorytwoproduct->reviews)
                                                                                : 0;
                                                                    @endphp
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center my-2 rating-area px-3">
                                                                        <div style="color: var(--site-primary)">
                                                                            Reviews
                                                                            ({{ count($categorytwoproduct->reviews) }})
                                                                        </div>
                                                                        <div class="ps-product__rating">
                                                                            @if ($review > 0)
                                                                                <div
                                                                                    class="br-wrapper br-theme-fontawesome-stars">
                                                                                    <select class="ps-rating"
                                                                                        data-read-only="true"
                                                                                        style="display: none;">
                                                                                        @php
                                                                                            $maxRating = min(
                                                                                                5,
                                                                                                max(1, floor($review)),
                                                                                            ); // Get the highest full rating value
                                                                                        @endphp
                                                                                        @for ($i = 1; $i <= $maxRating; $i++)
                                                                                            <option
                                                                                                value="{{ $i }}">
                                                                                                {{ $i }}
                                                                                            </option>
                                                                                        @endfor
                                                                                    </select>
                                                                                </div>
                                                                            @else
                                                                                <span class="no-found">N/A</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <hr class="my-0">
                                                                </div>
                                                            @endif

                                                            {{-- Review End --}}
                                                            <div class="ps-product__actions">
                                                                <div class="ps-product__item" data-toggle="tooltip"
                                                                    data-placement="left" title="Wishlist">
                                                                    <a class="add_to_wishlist"
                                                                        href="{{ route('wishlist.store', $categorytwoproduct->id) }}"><i
                                                                            class="fa-solid fa-heart"></i></a>
                                                                </div>
                                                                <div class="ps-product__item" data-toggle="tooltip"
                                                                    data-placement="left" title="Quick view">
                                                                    <a href="#" data-toggle="modal"
                                                                        data-target="#popupQuickview{{ $categorytwoproduct->id }}">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                </div>
                                                                {{-- <div class="ps-product__item" data-toggle="tooltip"
                                                                    data-placement="left" title="Add To Cart">
                                                                    <a class="add_to_cart"
                                                                        href="{{ route('cart.store', $categorytwoproduct->id) }}"
                                                                        data-product_id="{{ $categorytwoproduct->id }}"
                                                                        data-product_qty="1">
                                                                        <i class="fa fa-shopping-cart"></i>
                                                                    </a>
                                                                </div> --}}

                                                            </div>
                                                            @if (!empty($categorytwoproduct->unit_discount_price))
                                                                <div class="ps-product__badge">
                                                                    <div class="ps-badge ps-badge--sale">
                                                                        -
                                                                        {{ !empty($categorytwoproduct->unit_discount_price) && $categorytwoproduct->unit_discount_price > 0 ? number_format((($categorytwoproduct->unit_price - $categorytwoproduct->unit_discount_price) / $categorytwoproduct->unit_price) * 100, 1) : 0 }}
                                                                        % অফ
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ps-product__content">
                                                            <h5 class="ps-product__title">
                                                                <a
                                                                    href="{{ route('product.details', $categorytwoproduct->slug) }}">
                                                                    {{ implode(' ', array_slice(explode(' ', $categorytwoproduct->name), 0, 5)) }}
                                                                </a>
                                                            </h5>
                                                            <div class="pb-3">
                                                                @if (!empty($categorytwoproduct->unit_discount_price))
                                                                    <div class="ps-product__meta">
                                                                        <span class="ps-product__price sale fw-bold"
                                                                            style="font-weight:600;">দাম
                                                                            {{ $categorytwoproduct->unit_discount_price }}
                                                                            টাকা</span>
                                                                        <span
                                                                            class="ps-product__del text-danger">{{ $categorytwoproduct->unit_price }}
                                                                            টাকা</span>
                                                                    </div>
                                                                @else
                                                                    <div class="ps-product__meta">
                                                                        <span class="ps-product__price sale fw-bold"
                                                                            style="font-weight:600;">দাম
                                                                            {{ $categorytwoproduct->unit_price }}
                                                                            টাকা</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="d-flex align-items-center card-cart-btn">
                                                                <a href="{{ route('product.details', $categorytwoproduct->slug) }}"
                                                                    class="btn btn-primary rounded-0 w-100">
                                                                    <i class="fa-solid fa-basket-shopping pr-2"></i>
                                                                    অর্ডার
                                                                    করুন
                                                                </a>
                                                            </div>
                                                            <div class="ps-product__actions ps-product__group-mobile">
                                                                <div class="ps-product__quantity">
                                                                    <div
                                                                        class="def-number-input number-input safari_only">
                                                                        <button class="minus"
                                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                                class="icon-minus"></i>
                                                                        </button>
                                                                        <input class="quantity" min="0"
                                                                            name="quantity" value="1"
                                                                            type="number" />
                                                                        <button class="plus"
                                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                                class="icon-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="ps-product__item" data-toggle="tooltip"
                                                                    data-placement="left" title="Wishlist"><a
                                                                        class="add_to_wishlist"
                                                                        href="{{ route('wishlist.store', $categorytwoproduct->id) }}"><i
                                                                            class="fa-solid fa-heart"></i></a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between align-items-center py-4 pt-0 py-lg-5">
                                <div class="">
                                    <h3 class="ps-section__title mb-0" style="font-size: 30px;">
                                        {{ optional($categoryone)->name }}</h3>
                                </div>
                                <div style="width: 900px" class="px-3">
                                    <span style="height: 1px; background-color:#c9c8c8; display: block"></span>
                                </div>
                                <div class="ps-delivery ps-delivery--info p-0">
                                    <a class="ps-delivery__more" href="http://127.0.0.1:8000/shop">আরো দেখুন <i
                                            class="fa-solid fa-"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row gx-2 pb-2 pb-lg-5">
                                <div class="col-6 col-lg-3 col-md-3 mb-3 px-1">
                                    <div class="card p-0 border-0 video-card-home rounded-4">
                                        <div class="card-body p-0 video-container-home">
                                            <iframe class="video-player" width="560" height="315"
                                                src="https://www.youtube.com/embed/QrxHb9_fQI0?enablejsapi=1&autohide=1&showinfo=0&controls=0&modestbranding=1&rel=0&fs=0"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                            </iframe>
                                            <div class="content">
                                                <div class="video-box-img">
                                                    <img class="img-fluid"
                                                        src="https://www.boat-lifestyle.com/cdn/shop/files/Artboard1_29f1ddec-efbb-495f-ba68-90084a1180e4_600x.png?v=1698315950"
                                                        alt="">
                                                </div>
                                                <p>boAt Airdopes 71</p>
                                                <p><span class="site-text">Tk899</span>
                                                    <del class="text-danger">₹3,990</del>
                                                    <span class="text-">77% off</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-3 mb-3 px-1">
                                    <div class="card p-0 border-0 video-card-home rounded-4">
                                        <div class="card-body p-0 video-container-home">
                                            <iframe class="video-player" width="560" height="315"
                                                src="https://www.youtube.com/embed/QrxHb9_fQI0?enablejsapi=1&autohide=1&showinfo=0&controls=0&modestbranding=1&rel=0&fs=0"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                            </iframe>
                                            <div class="content">
                                                <div class="video-box-img">
                                                    <img class="img-fluid"
                                                        src="https://www.boat-lifestyle.com/cdn/shop/files/Artboard1_29f1ddec-efbb-495f-ba68-90084a1180e4_600x.png?v=1698315950"
                                                        alt="">
                                                </div>
                                                <p>boAt Airdopes 71</p>
                                                <p><span class="site-text">Tk899</span>
                                                    <del class="text-danger">₹3,990</del>
                                                    <span class="text-">77% off</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-3 mb-3 px-1">
                                    <div class="card p-0 border-0 video-card-home rounded-4">
                                        <div class="card-body p-0 video-container-home">
                                            <iframe class="video-player" width="560" height="315"
                                                src="https://www.youtube.com/embed/QrxHb9_fQI0?enablejsapi=1&autohide=1&showinfo=0&controls=0&modestbranding=1&rel=0&fs=0"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                            </iframe>
                                            <div class="content">
                                                <div class="video-box-img">
                                                    <img class="img-fluid"
                                                        src="https://www.boat-lifestyle.com/cdn/shop/files/Artboard1_29f1ddec-efbb-495f-ba68-90084a1180e4_600x.png?v=1698315950"
                                                        alt="">
                                                </div>
                                                <p>boAt Airdopes 71</p>
                                                <p><span class="site-text">Tk899</span>
                                                    <del class="text-danger">₹3,990</del>
                                                    <span class="text-">77% off</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-3 mb-3 px-1">
                                    <div class="card p-0 border-0 video-card-home rounded-4">
                                        <div class="card-body p-0 video-container-home">
                                            <iframe class="video-player" width="560" height="315"
                                                src="https://www.youtube.com/embed/dJbOGAkVoZo?si=fKA3TT5HX-yqvzG5?enablejsapi=1&autohide=1&showinfo=0&controls=0&modestbranding=1&rel=0&fs=0"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                            </iframe>
                                            <div class="content">
                                                <div class="video-box-img">
                                                    <img class="img-fluid"
                                                        src="https://www.boat-lifestyle.com/cdn/shop/files/Artboard1_29f1ddec-efbb-495f-ba68-90084a1180e4_600x.png?v=1698315950"
                                                        alt="">
                                                </div>
                                                <p>boAt Airdopes 71</p>
                                                <p><span class="site-text">Tk899</span>
                                                    <del class="text-danger">₹3,990</del>
                                                    <span class="text-">77% off</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @if ($categorythree && $categorythreeproducts->count() > 0)
                <div class="container px-0 mb-5 pb-0 pb-lg-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between align-items-center pb-2 pb-lg-5">
                                <div class="">
                                    <h3 class="ps-section__title mb-0" style="font-size: 30px;">
                                        {{ optional($categorythree)->name }}</h3>
                                </div>
                                <div style="width: 900px" class="px-3">
                                    <span style="height: 1px; background-color:#c9c8c8; display: block"></span>
                                </div>
                                <div class="ps-delivery ps-delivery--info p-0">
                                    <a class="ps-delivery__more" href="http://127.0.0.1:8000/shop">আরো দেখুন <i
                                            class="fa-solid fa-"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ps-home--block">
                        <div class="ps-section__content">
                            <div class="row m-0">
                                @foreach ($categorythreeproducts as $categorythreeproduct)
                                    <div class="col-6 col-md-4 col-lg-3 dot4 pr-0 pr-lg-3 pl-0">
                                        <div class="ps-section__product border">
                                            <div class="ps-product ps-product--standard">
                                                <div class="ps-product__thumbnail">
                                                    <a class="ps-product__image"
                                                        href="{{ route('product.details', $categorythreeproduct->slug) }}">
                                                        <figure>
                                                            @if (!empty($categorythreeproduct->thumbnail))
                                                                @php
                                                                    $thumbnailPath =
                                                                        'storage/' . $categorythreeproduct->thumbnail;
                                                                    $thumbnailSrc = file_exists(
                                                                        public_path($thumbnailPath),
                                                                    )
                                                                        ? asset($thumbnailPath)
                                                                        : asset('frontend/img/no-product.jpg');
                                                                @endphp
                                                                <img src="{{ $thumbnailSrc }}"
                                                                    alt="{{ $categorythreeproduct->meta_title }}"
                                                                    width="210" height="210" />
                                                            @else
                                                                @foreach ($categorythreeproduct->multiImages->slice(0, 2) as $image)
                                                                    @php
                                                                        $imagePath = 'storage/' . $image->photo;
                                                                        $imageSrc = file_exists(public_path($imagePath))
                                                                            ? asset($imagePath)
                                                                            : asset('frontend/img/no-product.jpg');
                                                                    @endphp
                                                                    <img src="{{ $imageSrc }}"
                                                                        alt="{{ $categorythreeproduct->meta_title }}"
                                                                        width="210" height="210" />
                                                                @endforeach
                                                            @endif
                                                        </figure>
                                                    </a>
                                                    {{-- Review End --}}
                                                    <div class="ps-product__actions">
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist">
                                                            <a class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $categorythreeproduct->id) }}"><i
                                                                    class="fa-solid fa-heart"></i></a>
                                                        </div>
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Quick view">
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#popupQuickview{{ $categorythreeproduct->id }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>
                                                        {{-- <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Add To Cart">
                                                            <a class="add_to_cart"
                                                                href="{{ route('cart.store', $categorythreeproduct->id) }}"
                                                                data-product_id="{{ $categorythreeproduct->id }}"
                                                                data-product_qty="1">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </a>
                                                        </div> --}}

                                                    </div>
                                                    @if (!empty($categorythreeproduct->unit_discount_price))
                                                        <div class="ps-product__badge">
                                                            <div class="ps-badge ps-badge--sale">
                                                                -
                                                                {{ !empty($categorythreeproduct->unit_discount_price) && $categorythreeproduct->unit_discount_price > 0 ? number_format((($categorythreeproduct->unit_price - $categorythreeproduct->unit_discount_price) / $categorythreeproduct->unit_price) * 100, 1) : 0 }}
                                                                % অফ
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ps-product__content">
                                                    <h5 class="ps-product__title">
                                                        <a
                                                            href="{{ route('product.details', $categorythreeproduct->slug) }}">
                                                            {{ implode(' ', array_slice(explode(' ', $categorythreeproduct->name), 0, 5)) }}
                                                        </a>
                                                    </h5>
                                                    <div class="pb-3">
                                                        @if (!empty($categorythreeproduct->unit_discount_price))
                                                            <div class="ps-product__meta">
                                                                <span class="ps-product__price sale fw-bold"
                                                                    style="font-weight:600;">দাম
                                                                    {{ $categorythreeproduct->unit_discount_price }}
                                                                    টাকা</span>
                                                                <span
                                                                    class="ps-product__del text-danger">{{ $categorythreeproduct->unit_price }}
                                                                    টাকা</span>
                                                            </div>
                                                        @else
                                                            <div class="ps-product__meta">
                                                                <span class="ps-product__price sale fw-bold"
                                                                    style="font-weight:600;">দাম
                                                                    {{ $categorythreeproduct->unit_price }}
                                                                    টাকা</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex align-items-center card-cart-btn">
                                                        <a href="{{ route('product.details', $categorythreeproduct->slug) }}"
                                                            class="btn btn-primary rounded-0 w-100">
                                                            <i class="fa-solid fa-basket-shopping pr-2"></i>
                                                            অর্ডার
                                                            করুন
                                                        </a>
                                                    </div>
                                                    <div class="ps-product__actions ps-product__group-mobile">
                                                        <div class="ps-product__quantity">
                                                            <div class="def-number-input number-input safari_only">
                                                                <button class="minus"
                                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                        class="icon-minus"></i>
                                                                </button>
                                                                <input class="quantity" min="0"
                                                                    name="quantity" value="1" type="number" />
                                                                <button class="plus"
                                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                        class="icon-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist"><a
                                                                class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $categorythreeproduct->id) }}"><i
                                                                    class="fa-solid fa-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if ($deals->count() > 0 || $deal_products->count() > 0)
            <div class="container px-0">
                @if ($deals->count() > 0)
                    <h3 class="ps-section__title pb-3 pb-lg-5 mb-0" style="font-size: 30px;">This week deals</h3>
                    <div class="ps-promo ps-promo--home">
                        <!-- First Row: First Three Deals -->
                        <div class="row">
                            @foreach ($deals->slice(0, 3) as $deal)
                                <div class="col-6 col-md-4">
                                    <div class="ps-promo__item">
                                        <a href="{{ route('product.details', $deal->product->slug) }}">
                                            @if ($deal->image)
                                                <img class="ps-promo__banner"
                                                    src="{{ !empty($deal->image) && file_exists(public_path('storage/' . $deal->image)) ? asset('storage/' . $deal->image) : asset('images/no_image.png') }}"
                                                    alt="alt" />
                                            @endif
                                            <div class="ps-promo__content">
                                                @if ($deal->badge)
                                                    <span class="ps-promo__badge">
                                                        {{ $deal->badge ?? round(100 - ($deal->offer_price / $deal->price) * 100) . '%' }}
                                                    </span>
                                                @endif
                                                <h4 class="text-white ps-promo__name">
                                                    {{ $deal->title }}
                                                </h4>
                                                @if ($deal->subtitle)
                                                    <p>{{ $deal->subtitle }}</p>
                                                @endif
                                                @if ($deal->offer_price && $deal->price)
                                                    <div class="ps-promo__meta">
                                                        <p class="ps-promo__price text-warning">
                                                            ৳{{ $deal->offer_price }}
                                                        </p>
                                                        <p class="ps-promo__del text-white">৳{{ $deal->price }}
                                                        </p>
                                                    </div>
                                                @endif
                                                @if (!empty($deal->button_link))
                                                    <a class="btn-green ps-promo__btn"
                                                        href="{{ $deal->button_link }}">{{ $deal->button_name }}</a>
                                                @elseif (!empty($deal->product_id))
                                                    <a class="btn-green ps-promo__btn"
                                                        href="{{ route('product.details', $deal->product->slug) }}">Buy
                                                        now</a>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Second Row: Next Four Deals -->
                        <div class="row ps-promo--horizontal">
                            @foreach ($deals->slice(3, 4) as $deal)
                                <div class="col-12 col-md-3">
                                    <div class="ps-promo__item">
                                        @if ($deal->image)
                                            <img class="ps-promo__banner"
                                                src="{{ asset('storage/' . $deal->image) }}" alt="alt" />
                                        @endif
                                        <div class="ps-promo__content">
                                            <h4 class="text-dark ps-promo__name">
                                                {{ $deal->title }}
                                            </h4>
                                            @if ($deal->offer_price && $deal->price)
                                                <div class="ps-promo__meta">
                                                    <p class="ps-promo__price text-warning">
                                                        ৳ {{ number_format($deal->offer_price, 2) }}</p>
                                                    <p class="ps-promo__del text-dark">
                                                        ৳ {{ number_format($deal->price, 2) }}</p>
                                                </div>
                                            @endif
                                            @if (!empty($deal->button_link))
                                                <a class="btn-green ps-promo__btn"
                                                    href="{{ $deal->button_link }}">{{ $deal->button_name }}</a>
                                            @elseif (!empty($deal->product_id))
                                                <a class="btn-green ps-promo__btn"
                                                    href="{{ route('product.details', $deal->product->slug) }}">Buy
                                                    now</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($deal_products->count() > 0)
                    <section class="ps-section--deals">
                        <div class="ps-section__header">
                            <h3 class="ps-section__title  mb-0" style="font-size: 30px;">Best Deals of the
                                week!</h3>
                        </div>
                        <div class="ps-section__carousel">
                            <div class="dealCarousel owl-carousel">
                                @foreach ($deal_products as $deal_product)
                                    <div class="ps-section__product border">
                                        <div class="ps-product ps-product--standard">
                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image"
                                                    href="{{ route('product.details', $deal_product->slug) }}">
                                                    <figure>
                                                        @if (!empty($deal_product->thumbnail))
                                                            @php
                                                                $thumbnailPath = 'storage/' . $deal_product->thumbnail;
                                                                $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                                    ? asset($thumbnailPath)
                                                                    : asset('frontend/img/no-product.jpg');
                                                            @endphp
                                                            <img src="{{ $thumbnailSrc }}"
                                                                alt="{{ $deal_product->meta_title }}" width="210"
                                                                height="210" />
                                                        @else
                                                            @foreach ($deal_product->multiImages->slice(0, 2) as $image)
                                                                @php
                                                                    $imagePath = 'storage/' . $image->photo;
                                                                    $imageSrc = file_exists(public_path($imagePath))
                                                                        ? asset($imagePath)
                                                                        : asset('frontend/img/no-product.jpg');
                                                                @endphp
                                                                <img src="{{ $imageSrc }}"
                                                                    alt="{{ $deal_product->meta_title }}"
                                                                    width="210" height="210" />
                                                            @endforeach
                                                        @endif
                                                    </figure>
                                                </a>

                                                {{-- Review End --}}
                                                <div class="ps-product__actions">
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Wishlist">
                                                        <a class="add_to_wishlist"
                                                            href="{{ route('wishlist.store', $deal_product->id) }}"><i
                                                                class="fa-solid fa-heart"></i></a>
                                                    </div>
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Quick view">
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#popupQuickview{{ $deal_product->id }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                    {{-- <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Add To Cart">
                                                        <a class="add_to_cart"
                                                            href="{{ route('cart.store', $deal_product->id) }}"
                                                            data-product_id="{{ $deal_product->id }}"
                                                            data-product_qty="1">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </a>
                                                    </div> --}}

                                                </div>
                                                @if (!empty($deal_product->unit_discount_price))
                                                    <div class="ps-product__badge">
                                                        <div class="ps-badge ps-badge--sale">
                                                            -
                                                            {{ !empty($deal_product->unit_discount_price) && $deal_product->unit_discount_price > 0 ? number_format((($deal_product->unit_price - $deal_product->unit_discount_price) / $deal_product->unit_price) * 100, 1) : 0 }}
                                                            % অফ
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ps-product__content">
                                                <h5 class="ps-product__title">
                                                    <a href="{{ route('product.details', $deal_product->slug) }}">
                                                        {{ implode(' ', array_slice(explode(' ', $deal_product->name), 0, 5)) }}
                                                    </a>
                                                </h5>
                                                <div class="pb-3">
                                                    @if (!empty($deal_product->unit_discount_price))
                                                        <div class="ps-product__meta">
                                                            <span
                                                                class="ps-product__price sale">{{ $deal_product->unit_discount_price }}
                                                                টাকা</span>
                                                            <span
                                                                class="ps-product__del text-danger">{{ $deal_product->unit_price }}
                                                                টাকা</span>
                                                        </div>
                                                    @else
                                                        <div class="ps-product__meta">
                                                            <span
                                                                class="ps-product__price sale">{{ $deal_product->unit_price }}
                                                                টাকা</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center card-cart-btn">
                                                    <a href="{{ route('product.details', $deal_product->slug) }}"
                                                        class="btn btn-primary rounded-0 w-100">
                                                        <i class="fa-solid fa-basket-shopping pr-2"></i>
                                                        অর্ডার
                                                        করুন
                                                    </a>
                                                </div>
                                                <div class="ps-product__actions ps-product__group-mobile">
                                                    <div class="ps-product__quantity">
                                                        <div class="def-number-input number-input safari_only">
                                                            <button class="minus"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                    class="icon-minus"></i>
                                                            </button>
                                                            <input class="quantity" min="0" name="quantity"
                                                                value="1" type="number" />
                                                            <button class="plus"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                    class="icon-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Wishlist"><a
                                                            class="add_to_wishlist"
                                                            href="{{ route('wishlist.store', $deal_product->id) }}"><i
                                                                class="fa-solid fa-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
            </div>
        @endif
    </div>

    @include('frontend.layouts.HomeQuickViewModal')
    @push('scripts')
        <script>
            $(document).ready(function() {
                var iframe = $('.video-player')[0];
                var player;

                // YouTube API script
                var tag = document.createElement('script');
                tag.src = "https://www.youtube.com/iframe_api";
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                // Create YouTube player after API script is loaded
                window.onYouTubeIframeAPIReady = function() {
                    player = new YT.Player(iframe, {
                        events: {
                            'onReady': onPlayerReady
                        }
                    });
                };

                // Function to play the video when it's ready
                function onPlayerReady(event) {
                    // Allow immediate playback when hovering over the video container
                    $('.video-container-home').on('mouseenter', function() {
                        player.playVideo();
                    });

                    // Pause the video when mouse leaves the iframe
                    $('.video-container-home').on('mouseleave', function() {
                        player.pauseVideo();
                    });
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                // Initialize Owl Carousel
                $('.custom-carousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    dots: false,
                    autoplay: true,
                    autoplayTimeout: 3000,
                    autoplayHoverPause: true, // Pause on hover
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: 2
                        },
                        992: {
                            items: 3
                        },
                        1200: {
                            items: 4
                        }
                    },
                    navText: [
                        '<i class="fas fa-chevron-left"></i>',
                        '<i class="fas fa-chevron-right"></i>'
                    ]
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.dealCarousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    dots: true,
                    autoplay: false,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    navText: [
                        '<div class="dealCarousel-prev">←</div>',
                        '<div class="dealCarousel-next">→</div>'
                    ],
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 4
                        }
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $(".blog-slider").owlCarousel({
                    loop: true, // Enable continuous loop mode
                    margin: 10, // Space between items
                    nav: true, // Show next/prev buttons
                    items: 3,
                    dots: true, // Show dots for navigation
                    autoplay: true, // Enable autoplay
                    autoplayTimeout: 3000, // Delay for autoplay
                    responsive: {
                        0: {
                            items: 1, // 1 item at a time for small screens
                        },
                        600: {
                            items: 2, // 2 items at a time for medium screens
                        },
                        1000: {
                            items: 3, // 3 items at a time for large screens
                        },
                    },
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $(".takeway-slider").owlCarousel({
                    loop: true, // Enable continuous loop mode
                    margin: 10, // Space between items
                    nav: true, // Show next/prev buttons
                    items: 4,
                    dots: true, // Show dots for navigation
                    autoplay: true, // Enable autoplay
                    autoplayTimeout: 3000, // Delay for autoplay
                    responsive: {
                        0: {
                            items: 2, // 1 item at a time for small screens
                        },
                        600: {
                            items: 2, // 2 items at a time for medium screens
                        },
                        1000: {
                            items: 4, // 3 items at a time for large screens
                        },
                    },
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.ps-categories__list').owlCarousel({
                    items: 4,
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 4000,
                    autoplaySpeed: 4000,
                    smartSpeed: 2000,
                    autoplayHoverPause: true,
                    nav: false,
                    dots: true,
                    responsive: {
                        0: {
                            items: 3,
                        },
                        576: {
                            items: 3,
                        },
                        768: {
                            items: 3,
                        },
                        1024: {
                            items: 4,
                        },
                    },
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.testigmonial-slider').owlCarousel({
                    animateOut: 'animate__slideOutDown', // Animate.css class (use "animate__" prefix)
                    animateIn: 'animate__flipInX', // Animate.css class (use "animate__" prefix)
                    items: 1, // Default number of items
                    margin: 30, // Remove margin between items
                    stagePadding: 30, // Padding around the stage
                    smartSpeed: 500, // Transition speed in ms
                    dots: true, // Show dots navigation
                    loop: true, // Infinite loop
                    autoplay: true, // Auto-scroll slides
                    autoplayTimeout: 3000, // Time between auto-scroll
                    autoplayHoverPause: true, // Pause on hover
                    mouseDrag: true, // Enable mouse scroll/drag
                    touchDrag: true, // Enable touch support
                    responsive: {
                        0: {
                            items: 1, // Display 1 item on small screens (up to 480px)
                        },
                        768: {
                            items: 1, // Display 2 items on medium screens (up to 768px)
                        },
                        1024: {
                            items: 1, // Display 3 items on larger screens (up to 1024px)
                        },
                        1200: {
                            items: 1, // Display 4 items on extra-large screens (above 1200px)
                        },
                    },
                });
            });
        </script>
        <script>
            const text = document.querySelector(".text-rounde");
            text.innerHTML = text.innerText
                .split("")
                .map((char, i) => {
                    const character = char === " " ? "&nbsp;" : char; // Replace spaces with non-breaking spaces
                    return `<span style="transform:rotate(${i * 10.3}deg)">${character}</span>`;
                })
                .join("");
        </script>
    @endpush
</x-frontend-app-layout>
