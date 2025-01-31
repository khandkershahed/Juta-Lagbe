<x-frontend-app-layout :title="'Home Page'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.css" />
    <section class="ps-section--banner">
        <div class="main-banner">
            <img src="{{ !empty($slider->bg_image) && public_path('storage/' . $slider->bg_image) ? asset('storage/' . $slider->bg_image) : asset('images/jutalagbe-main-banner.jpg')}}" alt="">
        </div>
    </section>
    <div class="bg-white ps-home ps-home--14">
        @if (!empty(optional($special_offer)->slug) || !empty(optional($special_offer)->header_slogan))
            <div class="ps-noti h-marqee">
                <section>
                    <div class="marquee marquee--hover-pause enable-animation">
                        <div class="marquee__content">
                            @for ($i = 0; $i < 10; $i++)
                                <a href="{{ route('special.products', optional($special_offer)->slug) }}">
                                    <p class="mb-0 text-white marquee-text d-flex align-items-center">
                                        <span><img class="pr-3 img-fluid" width="60px"
                                                src="{{ asset('images/markque-icons.png') }}" alt=""></span>
                                        <span>{{ optional($special_offer)->header_slogan ?? 'Step Into Style' }}</span>
                                    </p>
                                </a>
                            @endfor
                        </div>
                        <div aria-hidden="true" class="marquee__content">
                            @for ($i = 0; $i < 10; $i++)
                                <a href="{{ route('special.products', optional($special_offer)->slug) }}">
                                    <p class="mb-0 text-white marquee-text d-flex align-items-center">
                                        <span><img class="pr-3 img-fluid" width="60px"
                                                src="{{ asset('images/markque-icons.png') }}" alt=""></span>
                                        <span>{{ optional($special_offer)->header_slogan ?? 'Step Into Style' }}</span>
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
                <div class="container px-0 py-2 py-lg-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ps-categories__list owl-carousel">
                                @foreach ($categorys as $category)
                                    <div class="py-4 ps-categories__item">
                                        <a href="{{ route('category.products', $category->slug) }}">
                                            <div class="p-0 card video-box-pr">
                                                <div class="p-0 card-header">
                                                    <div class="player" data-plyr-provider="youtube"
                                                        data-plyr-embed-id="{{ $category->video_link }}">
                                                    </div>
                                                </div>
                                                <div class="category-box card-body">
                                                    <div class="video-category-info">
                                                        <div class="">
                                                            @php
                                                                $logoPath = 'storage/' . $category->logo;
                                                                $logoSrc = file_exists(public_path($logoPath))
                                                                    ? asset($logoPath)
                                                                    : asset('frontend/img/no-category.png');
                                                            @endphp
                                                            <img class="p-3 border shadow-sm"
                                                                src="{{ $logoSrc }}" alt="{{ $category->name }}"
                                                                onerror="this.onerror=null; this.src='frontend/img/no-category.png';">
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <h6 class="video-pr-title">{{ $category->name }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <div class="ps-home__content">
            <div class="container px-3 pb-4 mt-5 px-lg-5 first-section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pt-4 d-flex justify-content-between align-items-center pt-lg-5 home-header-title">
                            <div class="">
                                <h3 class="mb-0 text-white ps-section__title d-flex align-items-center text-uppercase"
                                    style="font-size: 30px;">
                                    Surprise <br> Offer <img width="30px" class="img-fluid"
                                        src="{{ asset('images/hour.png') }}" alt=""></h3>
                            </div>
                            <div style="width: 600px" class="px-3">
                                <span style="height: 1px; background-color:transparent; display: block"></span>
                            </div>
                            @if (!empty(optional($special_offer)->slug))
                                <div class="pt-3 ps-delivery--info pt-lg-0">
                                    <a class="px-4 py-2 text-end"
                                        style="background-color: #BD0909 !important;border-radius: 50px;color: white;"
                                        href="{{ route('special.products', optional($special_offer)->slug) }}">Live Now
                                        <i class="fa-solid fa-"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Category Product --}}
                @if ($specialproducts && $specialproducts->count() > 0)
                    <div class="row">
                        @foreach ($specialproducts as $specialproduct)
                            <div class="pl-0 pr-0 my-3 col-6 col-md-4 col-lg-3 dot4 pr-lg-3">
                                <div class="border ps-section__product">
                                    <div class="ps-product ps-product--standard">
                                        <div class="ps-product__thumbnail">
                                            <a class="ps-product__image"
                                                href="{{ route('product.details', $specialproduct->slug) }}">
                                                <figure>
                                                    @if (!empty($specialproduct->thumbnail))
                                                        @php
                                                            $thumbnailPath = 'storage/' . $specialproduct->thumbnail;
                                                            $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                                ? asset($thumbnailPath)
                                                                : asset('frontend/img/no-product.jpg');
                                                        @endphp
                                                        <img src="{{ $thumbnailSrc }}"
                                                            alt="{{ $specialproduct->meta_title }}" width="210"
                                                            height="210" />
                                                    @else
                                                        @foreach ($specialproduct->multiImages->slice(0, 2) as $image)
                                                            @php
                                                                $imagePath = 'storage/' . $image->photo;
                                                                $imageSrc = file_exists(public_path($imagePath))
                                                                    ? asset($imagePath)
                                                                    : asset('frontend/img/no-product.jpg');
                                                            @endphp
                                                            <img src="{{ $imageSrc }}"
                                                                alt="{{ $specialproduct->meta_title }}" width="210"
                                                                height="210" />
                                                        @endforeach
                                                    @endif
                                                </figure>
                                            </a>
                                            {{-- Review End --}}
                                            <div class="ps-product__actions">
                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left"
                                                    title="Wishlist">
                                                    <a class="add_to_wishlist"
                                                        href="{{ route('wishlist.store', $specialproduct->id) }}"><i
                                                            class="fa-solid fa-heart"></i></a>
                                                </div>
                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left"
                                                    title="Quick view">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#popupQuickview{{ $specialproduct->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>

                                            </div>
                                            @if (!empty($specialproduct->unit_discount_price))
                                                <div class="ps-product__badge">
                                                    <div class="ps-badge ps-badge--sale">
                                                        -
                                                        {{ !empty($specialproduct->unit_discount_price) && $specialproduct->unit_discount_price > 0 ? number_format((($specialproduct->unit_price - $specialproduct->unit_discount_price) / $specialproduct->unit_price) * 100, 1) : 0 }}
                                                        % অফ
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ps-product__content">
                                            <h5 class="ps-product__title">
                                                <a href="{{ route('product.details', $specialproduct->slug) }}">
                                                    {{ implode(' ', array_slice(explode(' ', $specialproduct->name), 0, 5)) }}
                                                </a>
                                            </h5>
                                            <div class="pb-3">
                                                @if (!empty($specialproduct->unit_discount_price))
                                                    <div class="ps-product__meta">
                                                        <span class="ps-product__price sale fw-bold"
                                                            style="font-weight:600;">দাম
                                                            {{ $specialproduct->unit_discount_price }}
                                                            টাকা</span>
                                                        <span
                                                            class="ps-product__del text-danger">{{ $specialproduct->unit_price }}
                                                            টাকা</span>
                                                    </div>
                                                @else
                                                    <div class="ps-product__meta">
                                                        <span class="ps-product__price sale fw-bold"
                                                            style="font-weight:600;">দাম
                                                            {{ $specialproduct->unit_price }}
                                                            টাকা</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center card-cart-btn">
                                                <a href="{{ route('product.details', $specialproduct->slug) }}"
                                                    class="btn btn-primary rounded-0 w-100">
                                                    <i class="pr-2 fa-solid fa-basket-shopping"></i>
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
                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left"
                                                    title="Wishlist"><a class="add_to_wishlist"
                                                        href="{{ route('wishlist.store', $specialproduct->id) }}"><i
                                                            class="fa-solid fa-heart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                {{-- Category Product End --}}
            </div>
            <div class="container px-3 pb-4 mt-0 mt-lg-5 px-lg-5 second-section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pt-4 d-flex justify-content-between align-items-center pt-lg-5 home-header-title">
                            <div class="">
                                <h3 class="mb-0 text-black ps-section__title d-flex align-items-center text-uppercase"
                                    style="font-size: 30px;">
                                    Trending Now Offer
                                </h3>
                                <p>Best Selling Products</p>
                            </div>
                            <div style="width: 700px" class="px-3">
                                <span style="height: 1px; background-color:transparent; display: block"></span>
                            </div>
                            <div class="ps-delivery--info">
                                <a class="px-4 py-2 text-end"
                                    style="background-color: #fff !important;border-radius: 50px;color: #000;"
                                    href="{{ route('allproducts') }}">See All <i
                                        class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Category Product --}}
                <div class="row">
                    @foreach ($latestproducts as $latestproduct)
                        <div class="pl-0 pr-0 my-3 col-6 col-md-4 col-lg-3 dot4 pr-lg-3">
                            <div class="border ps-section__product">
                                <div class="ps-product ps-product--standard">
                                    <div class="ps-product__thumbnail">
                                        <a class="ps-product__image"
                                            href="{{ route('product.details', $latestproduct->slug) }}">
                                            <figure>
                                                @if (!empty($latestproduct->thumbnail))
                                                    @php
                                                        $thumbnailPath = 'storage/' . $latestproduct->thumbnail;
                                                        $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                            ? asset($thumbnailPath)
                                                            : asset('frontend/img/no-product.jpg');
                                                    @endphp
                                                    <img src="{{ $thumbnailSrc }}"
                                                        alt="{{ $latestproduct->meta_title }}" width="210"
                                                        height="210" />
                                                @else
                                                    @foreach ($latestproduct->multiImages->slice(0, 2) as $image)
                                                        @php
                                                            $imagePath = 'storage/' . $image->photo;
                                                            $imageSrc = file_exists(public_path($imagePath))
                                                                ? asset($imagePath)
                                                                : asset('frontend/img/no-product.jpg');
                                                        @endphp
                                                        <img src="{{ $imageSrc }}"
                                                            alt="{{ $latestproduct->meta_title }}" width="210"
                                                            height="210" />
                                                    @endforeach
                                                @endif
                                            </figure>
                                        </a>
                                        {{-- Review End --}}
                                        <div class="ps-product__actions">
                                            <div class="ps-product__item" data-toggle="tooltip" data-placement="left"
                                                title="Wishlist">
                                                <a class="add_to_wishlist"
                                                    href="{{ route('wishlist.store', $latestproduct->id) }}"><i
                                                        class="fa-solid fa-heart"></i></a>
                                            </div>
                                            <div class="ps-product__item" data-toggle="tooltip" data-placement="left"
                                                title="Quick view">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#popupQuickview{{ $latestproduct->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>

                                        </div>
                                        @if (!empty($latestproduct->unit_discount_price))
                                            <div class="ps-product__badge">
                                                <div class="ps-badge ps-badge--sale">
                                                    -
                                                    {{ !empty($latestproduct->unit_discount_price) && $latestproduct->unit_discount_price > 0 ? number_format((($latestproduct->unit_price - $latestproduct->unit_discount_price) / $latestproduct->unit_price) * 100, 1) : 0 }}
                                                    % অফ
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ps-product__content">
                                        <h5 class="ps-product__title">
                                            <a href="{{ route('product.details', $latestproduct->slug) }}">
                                                {{ implode(' ', array_slice(explode(' ', $latestproduct->name), 0, 5)) }}
                                            </a>
                                        </h5>
                                        <div class="pb-3">
                                            @if (!empty($latestproduct->unit_discount_price))
                                                <div class="ps-product__meta">
                                                    <span class="ps-product__price sale fw-bold"
                                                        style="font-weight:600;">দাম
                                                        {{ $latestproduct->unit_discount_price }}
                                                        টাকা</span>
                                                    <span
                                                        class="ps-product__del text-danger">{{ $latestproduct->unit_price }}
                                                        টাকা</span>
                                                </div>
                                            @else
                                                <div class="ps-product__meta">
                                                    <span class="ps-product__price sale fw-bold"
                                                        style="font-weight:600;">দাম
                                                        {{ $latestproduct->unit_price }}
                                                        টাকা</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center card-cart-btn">
                                            <a href="{{ route('product.details', $latestproduct->slug) }}"
                                                class="btn btn-primary rounded-0 w-100">
                                                <i class="pr-2 fa-solid fa-basket-shopping"></i>
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
                                            <div class="ps-product__item" data-toggle="tooltip" data-placement="left"
                                                title="Wishlist"><a class="add_to_wishlist"
                                                    href="{{ route('wishlist.store', $latestproduct->id) }}"><i
                                                        class="fa-solid fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Category Product End --}}
            </div>
            <div class="container px-3 pb-4 mt-0 mt-lg-5 px-lg-5 third-section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pt-4 d-flex justify-content-between align-items-center pt-lg-5 home-header-title">
                            <div class="">
                                <h3 class="mb-0 text-black ps-section__title d-flex align-items-center text-uppercase"
                                    style="font-size: 30px;">
                                    All Products
                                </h3>
                                <p>Walk in Style, Pay Less!</p>
                            </div>
                            <div style="width: 700px" class="px-3">
                                <span style="height: 1px; background-color:transparent; display: block"></span>
                            </div>
                            <div class="ps-delivery--info">
                                <a class="px-4 py-2 text-end"
                                    style="background-color: #fff !important;border-radius: 50px;color: #000;"
                                    href="{{ route('allproducts') }}">See All <i
                                        class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Category Product --}}
                <div class="row">
                    @foreach ($randomproducts as $randomproduct)
                        <div class="pl-0 pr-0 my-3 col-6 col-md-4 col-lg-3 dot4 pr-lg-3">
                            <div class="border ps-section__product">
                                <div class="ps-product ps-product--standard">
                                    <div class="ps-product__thumbnail">
                                        <a class="ps-product__image"
                                            href="{{ route('product.details', $randomproduct->slug) }}">
                                            <figure>
                                                @if (!empty($randomproduct->thumbnail))
                                                    @php
                                                        $thumbnailPath = 'storage/' . $randomproduct->thumbnail;
                                                        $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                            ? asset($thumbnailPath)
                                                            : asset('frontend/img/no-product.jpg');
                                                    @endphp
                                                    <img src="{{ $thumbnailSrc }}"
                                                        alt="{{ $randomproduct->meta_title }}" width="210"
                                                        height="210" />
                                                @else
                                                    @foreach ($randomproduct->multiImages->slice(0, 2) as $image)
                                                        @php
                                                            $imagePath = 'storage/' . $image->photo;
                                                            $imageSrc = file_exists(public_path($imagePath))
                                                                ? asset($imagePath)
                                                                : asset('frontend/img/no-product.jpg');
                                                        @endphp
                                                        <img src="{{ $imageSrc }}"
                                                            alt="{{ $randomproduct->meta_title }}" width="210"
                                                            height="210" />
                                                    @endforeach
                                                @endif
                                            </figure>
                                        </a>
                                        {{-- Review End --}}
                                        <div class="ps-product__actions">
                                            <div class="ps-product__item" data-toggle="tooltip" data-placement="left"
                                                title="Wishlist">
                                                <a class="add_to_wishlist"
                                                    href="{{ route('wishlist.store', $randomproduct->id) }}"><i
                                                        class="fa-solid fa-heart"></i></a>
                                            </div>
                                            <div class="ps-product__item" data-toggle="tooltip" data-placement="left"
                                                title="Quick view">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#popupQuickview{{ $randomproduct->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>

                                        </div>
                                        @if (!empty($randomproduct->unit_discount_price))
                                            <div class="ps-product__badge">
                                                <div class="ps-badge ps-badge--sale">
                                                    -
                                                    {{ !empty($randomproduct->unit_discount_price) && $randomproduct->unit_discount_price > 0 ? number_format((($randomproduct->unit_price - $randomproduct->unit_discount_price) / $randomproduct->unit_price) * 100, 1) : 0 }}
                                                    % অফ
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ps-product__content">
                                        <h5 class="ps-product__title">
                                            <a href="{{ route('product.details', $randomproduct->slug) }}">
                                                {{ implode(' ', array_slice(explode(' ', $randomproduct->name), 0, 5)) }}
                                            </a>
                                        </h5>
                                        <div class="pb-3">
                                            @if (!empty($randomproduct->unit_discount_price))
                                                <div class="ps-product__meta">
                                                    <span class="ps-product__price sale fw-bold"
                                                        style="font-weight:600;">দাম
                                                        {{ $randomproduct->unit_discount_price }}
                                                        টাকা</span>
                                                    <span
                                                        class="ps-product__del text-danger">{{ $randomproduct->unit_price }}
                                                        টাকা</span>
                                                </div>
                                            @else
                                                <div class="ps-product__meta">
                                                    <span class="ps-product__price sale fw-bold"
                                                        style="font-weight:600;">দাম
                                                        {{ $randomproduct->unit_price }}
                                                        টাকা</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center card-cart-btn">
                                            <a href="{{ route('product.details', $randomproduct->slug) }}"
                                                class="btn btn-primary rounded-0 w-100">
                                                <i class="pr-2 fa-solid fa-basket-shopping"></i>
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
                                            <div class="ps-product__item" data-toggle="tooltip" data-placement="left"
                                                title="Wishlist"><a class="add_to_wishlist"
                                                    href="{{ route('wishlist.store', $randomproduct->id) }}"><i
                                                        class="fa-solid fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Category Product End --}}
            </div>

            <div class="container-fluid"
                style="background-image: linear-gradient(to right, #020024,#090979,#009DBD);">
                <div class="container juta-delivery">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="ps-delivery ps-delivery--info">
                                <div class="ps-delivery__content">
                                    <div class="text-white ps-delivery__text">
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
        </div>

        @if ($deal_products->count() > 0)
            <div class="container px-0">
                @if ($deal_products->count() > 0)
                    <section class="ps-section--deals">
                        <div class="ps-section__header">
                            <h3 class="mb-0 ps-section__title" style="font-size: 30px;">Best Deals of the
                                week!</h3>
                        </div>
                        <div class="ps-section__carousel">
                            <div class="dealCarousel owl-carousel">
                                @foreach ($deal_products as $deal_product)
                                    <div class="border ps-section__product">
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
                                                        <i class="pr-2 fa-solid fa-basket-shopping"></i>
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
        <script src="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.polyfilled.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                const players = Plyr.setup('.player', {
                    muted: false,
                    controls: [],
                    youtube: {
                        rel: 0,
                        showinfo: 0,
                        modestbranding: 1, // Reduce YouTube branding
                    },
                });

                // Add hover event listeners for each player
                players.forEach(player => {
                    const container = player.elements.container;

                    // Play the video on hover
                    container.addEventListener('mouseenter', () => {
                        player.play();
                    });

                    // Ensure autoplay and muted work as intended
                    players.forEach(player => {
                        player.muted = false; // Enforce muted autoplay
                    });
                    // Pause the video when hover ends
                    container.addEventListener('mouseleave', () => {
                        player.pause();
                    });
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
                            items: 2,
                        },
                        576: {
                            items: 2,
                        },
                        768: {
                            items: 2,
                        },
                        1024: {
                            items: 4,
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
