<x-frontend-app-layout :title="'Home Page'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.css" />
    <style>
        /* Black overlay */
        .plyr__video-wrapper {
            height: 400px;
            border-radius: 24px;
        }

        .player-info-box {
            background: #00000000;
            position: relative;
            margin-top: -19px;
            border-bottom-right-radius: 24px;
            border-bottom-left-radius: 24px;
            color: white;
            display: flex;
            justify-content: center;
            height: 145px;
        }

        .plyr__video-wrapper::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 544px;
            border-radius: 24px;
            z-index: 2;
        }

        .video-card-ct {
            border-radius: 24px;
            position: relative;
        }

        .video-card-ct::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 24px;
            background-size: cover;
            z-index: 3;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }

        /* Hide image when video plays */
        .video-card-ct.playing::before {
            opacity: 0;
        }

        .logo-cat {
            background-color: #ffffff;
            border-radius: 8px;
            margin-right: 10px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid black;
            padding: 12px;
            margin-top: 18px;
        }

        .title-cat {
            margin-top: 18px;
        }

        .video-card-ct {
            position: relative;
            overflow: hidden;
        }

        .video-thumbnail {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            border-radius: 24px;
            z-index: 3;
            transition: opacity 0.3s ease-in-out;
        }

        /* Hide thumbnail when video starts playing */
        .video-card-ct.playing .video-thumbnail {
            opacity: 0;
        }
    </style>
    <section class="ps-section--banner">
        <div class="main-banner">
            <img src="{{ !empty($slider->bg_image) && public_path('storage/' . $slider->bg_image) ? asset('storage/' . $slider->bg_image) : asset('images/jutalagbe-main-banner.jpg') }}"
                alt="">
        </div>
        <div class="main-banner-mobile">
            <img src="{{ asset('images/Carousel-Banner_Juta-Lagbe(Mobile) Low.jpg') }}" alt="">
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
                            @php
                            // Extract only the YouTube video ID from whatever format is stored
                            preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $category->video_link, $matches);
                            $videoId = $matches[1] ?? $category->video_link; // if already ID, just use it
                            $logoPath = 'storage/' . $category->logo;
                            $logoSrc = file_exists(public_path($logoPath))
                            ? asset($logoPath)
                            : asset('frontend/img/no-category.png');
                            @endphp

                            <div class="py-4 ps-categories__item">
                                <a href="{{ route('category.products', $category->slug) }}">
                                    <div class="p-0 card video-card-ct">
                                        <div class="p-0 card-body">
                                            <iframe
                                                width="100%"
                                                height="430"
                                                src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&mute=1&loop=1&playlist={{ $videoId }}&controls=0&modestbranding=0&rel=0&iv_load_policy=3"
                                                frameborder="0"
                                                allow="autoplay; encrypted-media"
                                                allowfullscreen>
                                                style="border-radious: 24px"
                                            </iframe>
                                        </div>
                                        <div class="p-3 d-flex align-items-center player-info-box">
                                            <span class="logo-cat">
                                                <img style="width:50px; height:50px" src="{{ $logoSrc }}"
                                                    onerror="this.onerror=null; this.src='frontend/img/no-category.png';"
                                                    alt="{{ $category->name }}">
                                            </span>
                                            <span class="ps-3 text-muted title-cat">{{ $category->name }}</span>
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
                            <div class="spcial-product-box">
                                <h3 class="mb-0 text-white ps-section__title d-flex align-items-center text-uppercase"
                                    style="font-size: 30px;">
                                    সারপ্রাইজ অফার <img width="30px" class="pl-2 img-fluid"
                                        src="{{ asset('images/hour.png') }}" alt=""></h3>
                                <p class="text-white">সীমিত পণ্যে বিশেষ আকর্ষণীয় অফার</p>
                            </div>
                            <div style="width: 600px" class="px-3">
                                <span style="height: 1px; background-color:transparent; display: block"></span>
                            </div>
                            @if (!empty(optional($special_offer)->slug))
                            <div class="pt-3 ps-delivery--info pt-lg-0">
                                <a class="px-4 py-2 text-end"
                                    style="background-color: #fff !important;border-radius: 50px;color: #252525;"
                                    href="{{ route('special.products', optional($special_offer)->slug) }}">আরও দেখুন
                                    <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Category Product --}}
                @if ($specialproducts && $specialproducts->count() > 0)
                <div class="row surprice-row">
                    @foreach ($specialproducts as $specialproduct)
                    <div class="pl-0 pr-0 my-3 col-6 col-md-4 col-lg-3 dot4 pr-lg-3 product-grids">
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
                                        <div class="ps-product__item" data-toggle="tooltip"
                                            data-placement="left" title="Wishlist">
                                            <a class="add_to_wishlist"
                                                href="{{ route('wishlist.store', $specialproduct->id) }}"><i
                                                    class="fa-solid fa-heart"></i></a>
                                        </div>
                                        <div class="ps-product__item" data-toggle="tooltip"
                                            data-placement="left" title="Quick view">
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
                                    <div class="ps-product_actions ps-product_group-mobile">
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
                                        {{-- <div class="ps-product__item" data-toggle="tooltip"
                                                    data-placement="left" title="Wishlist"><a class="add_to_wishlist"
                                                        href="{{ route('wishlist.store', $specialproduct->id) }}"><i
                                            class="fa-solid fa-heart"></i></a>
                                    </div> --}}
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
                                সর্বশেষ ট্রেন্ডিং অফার
                            </h3>
                            <p>সেরা বিক্রিত পণ্য গুলো দেখুন</p>
                        </div>
                        <div style="width: 700px" class="px-3">
                            <span style="height: 1px; background-color:transparent; display: block"></span>
                        </div>
                        <div class="ps-delivery--info">
                            <a class="px-4 py-2 text-end"
                                style="background-color: #fff !important;border-radius: 50px;color: #000;"
                                href="{{ route('allproducts') }}">সকল প্রোডাক্ট <i
                                    class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Category Product --}}
            <div class="container px-0">
                <section class="pb-4 ps-section--deals">
                    <div class="ps-section__carousel">
                        <div class="trending-products owl-carousel surprice-row">
                            @foreach ($latestproducts as $latestproduct)
                            <div class="border ps-section__product latest-products">
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
                                                    alt="{{ $latestproduct->meta_title }}"
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
                                                    href="{{ route('wishlist.store', $latestproduct->id) }}"><i
                                                        class="fa-solid fa-heart"></i></a>
                                            </div>
                                            <div class="ps-product__item" data-toggle="tooltip"
                                                data-placement="left" title="Quick view">
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
                                        <div class="ps-product_actions ps-product_group-mobile">
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
                                            {{-- <div class="ps-product__item" data-toggle="tooltip"
                                                    data-placement="left" title="Wishlist"><a
                                                        class="add_to_wishlist"
                                                        href="{{ route('wishlist.store', $latestproduct->id) }}"><i
                                                class="fa-solid fa-heart"></i></a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
            </div>
            </section>
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
                                    <strong>১০০% সহজে ডেলিভারি নিন</strong> কুরিয়ারের সঙ্গে যোগাযোগ ছাড়াই।
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
    <div class="container px-3 pb-4 mt-0 mt-lg-5 px-lg-5 third-section">
        <div class="row">
            <div class="col-lg-12">
                <div class="pt-4 d-flex justify-content-between align-items-center pt-lg-5 home-header-title">
                    <div class="spcial-product-box">
                        <h3 class="mb-0 text-black ps-section__title d-flex align-items-center text-uppercase"
                            style="font-size: 30px;">
                            সকল প্রোডাক্ট দেখুন
                        </h3>
                        <p>স্টাইল দিয়ে হাঁটুন, কম খরচে কিনুন!</p>
                    </div>
                    <div style="width: 700px" class="px-3">
                        <span style="height: 1px; background-color:transparent; display: block"></span>
                    </div>
                    <div class="ps-delivery--info">
                        <a class="px-4 py-2 text-end"
                            style="background-color: #fff !important;border-radius: 50px;color: #000;"
                            href="{{ route('allproducts') }}">সকল প্রোডাক্ট <i
                                class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Category Product --}}
        <div class="row surprice-row">
            @foreach ($randomproducts as $randomproduct)
            <div class="pl-0 pr-0 my-3 col-6 col-md-4 col-lg-3 dot4 pr-lg-3 product-grids">
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
                            <div class="ps-product_actions ps-product_group-mobile">
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
                                {{-- <div class="ps-product__item" data-toggle="tooltip" data-placement="left"
                                                title="Wishlist"><a class="add_to_wishlist"
                                                    href="{{ route('wishlist.store', $randomproduct->id) }}"><i
                                    class="fa-solid fa-heart"></i></a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{-- Category Product End --}}
    </div>
    </div>
    </div>

    @include('frontend.layouts.HomeQuickViewModal')
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.polyfilled.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const players = Plyr.setup('.player', {
                muted: true, // Ensures autoplay works in all browsers
                controls: [],
                autoplay: true,
                loop: {
                    active: true
                }, // Enable looping
                youtube: {
                    muted: true,
                    rel: 0,
                    showinfo: 0,
                    modestbranding: 1, // Reduce YouTube branding
                },
            });

            // Ensure autoplay, muted, and looping work as intended
            players.forEach(player => {
                player.muted = true; // Keep the video muted
                player.autoplay = true;
                player.loop = true;
                player.play(); // Start playback immediately
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.trending-products').owlCarousel({
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
        $(document).ready(function() {
            $('.ps-categories__list').owlCarousel({
                items: 5,
                loop: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplaySpeed: 4000,
                smartSpeed: 2000,
                autoplayHoverPause: true,
                nav: false, // Default to false (navigation disabled)
                dots: true,
                responsive: {
                    0: {
                        items: 2,
                        mouseDrag: true,
                        touchDrag: true,
                        nav: false, // Ensure navigation is disabled on small devices
                    },
                    576: {
                        items: 2,
                        mouseDrag: true,
                        touchDrag: true,
                        nav: false,
                    },
                    768: {
                        items: 2,
                        mouseDrag: true,
                        touchDrag: true,
                        nav: false,
                    },
                    1024: {
                        items: 5,
                        mouseDrag: false, // Disabled for larger screens
                        touchDrag: false, // Disabled for larger screens
                        nav: true, // Enable navigation on larger screens
                    },
                },
            });
        });
    </script>


    <!-- <script>
        const text = document.querySelector(".text-rounde");
        text.innerHTML = text.innerText
            .split("")
            .map((char, i) => {
                const character = char === " " ? "&nbsp;" : char; // Replace spaces with non-breaking spaces
                return < span style = "transform:rotate(${i * 10.3}deg)" > $ {
                    character
                } < /span>;
            })
            .join("");
    </script> -->
    @endpush
</x-frontend-app-layout>