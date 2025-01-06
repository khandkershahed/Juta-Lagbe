<x-frontend-app-layout :title="'Home Page'">
    <section class="ps-section--banner">
        <div class="ps-section__overlay">
            <div class="ps-section__loading"></div>
        </div>
        <div class="owl-carousel-banner owl-carousel owl-loaded owl-drag" data-owl-auto="false" data-owl-loop="true"
            data-owl-speed="15000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1"
            data-owl-duration="1000" data-owl-mousedrag="on">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    @foreach ($sliders as $slider)
                        <div class="owl-item">
                            <div class="ps-banner hero-banner"
                                style="
                            background-image: url('{{ asset('storage/' . $slider->bg_image) }}');
                            background-repeat: no-repeat;
                            background-size: cover;
                            background-position: center center;
                            height: 600px;
                            width: 100%;
                        ">
                                <div class="container container-initial">
                                    <div class="ps-banner__block">
                                        <div class="ps-banner__content">
                                            <h2 class="ps-banner__title text-white">{{ $slider->title }}</h2>
                                            <div class="ps-banner__desc text-white">{{ $slider->subtitle }}</div>
                                            <div class="ps-banner__btn-group">
                                                <div class="ps-banner__btn text-white">{{ $slider->badge }}</div>
                                            </div>
                                            @if (!empty($slider->button_link) || !empty($slider->button_name))
                                                <a class="bg-warning ps-banner__shop" href="{{ $slider->button_link }}">
                                                    {{ $slider->button_name }}
                                                </a>
                                            @endif
                                            {{-- <div class="ps-banner__persen bg-yellow ps-top"><small>only</small>$25</div> --}}
                                        </div>
                                        <div class="ps-banner__thumnail">
                                            {{-- <img class="ps-banner__round"
                                                src="{{ asset('storage/' . $slider->bg_image) }}" alt="alt"> --}}
                                            {{-- <img class="ps-banner__image" src="{{ asset('storage/' . $slider->image) }}"
                                                alt="alt"> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="owl-nav">
                {{-- <button type="button" role="presentation" class="owl-prev">
                    <i class="fa fa-chevron-left text-white"></i>
                </button>
                <button type="button" role="presentation" class="owl-next">
                    <i class="fa fa-chevron-right text-white"></i>
                </button> --}}
            </div>
        </div>
    </section>
    <div class="ps-home ps-home--14">
        @if ($categorys->count() > 0)
            <section class="ps-section--categories top-up-section">
                <div class="container px-0" style="border-radius: 5px; background-color: #ffffffe6;">
                    {{-- <h3 class="ps-section__title py-5" style="font-size: 30px;">Popular Categories</h3> --}}
                    <div class="ps-section__content py-0 py-lg-5">
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
            </section>
        @endif
        <div class="ps-home__content">
            @if ($latest_products->count() > 0)
                <section class="ps-section--latest-horizontal pb-5">
                    <section class="container px-0">
                        <h3 class="ps-section__title pb-3 pb-lg-5 mb-0" style="font-size: 30px;">Latest products <img
                                width="40px"
                                src="https://static.vecteezy.com/system/resources/previews/011/999/958/non_2x/fire-icon-free-png.png"
                                alt="" style="position: relative;top: -3px;left: -6px;"></h3>
                        <div class="ps-section__content">
                            <div class="row m-0">
                                @foreach ($latest_products as $latest_product)
                                    <div class="col-6 col-md-4 col-lg-3 dot4 p-0">
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
                                                                            : // : asset('frontend/img/no-product.jpg');
                                                                            asset('frontend/img/no-product.jpg');
                                                                    @endphp
                                                                    <img src="{{ $imageSrc }}"
                                                                        alt="{{ $latest_product->meta_title }}"
                                                                        width="210" height="210" />
                                                                @endforeach
                                                            @endif
                                                        </figure>
                                                    </a>
                                                    <div class="ps-product__actions">
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist">
                                                            <a class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $latest_product->id) }}"><i
                                                                    class="fa fa-heart-o"></i></a>
                                                        </div>
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Quick view">
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#popupQuickview{{ $latest_product->id }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>

                                                    </div>
                                                    @if (!empty($latest_product->unit_discount_price))
                                                        <div class="ps-product__badge">
                                                            <div class="ps-badge ps-badge--sale">
                                                                -
                                                                {{ !empty($latest_product->unit_discount_price) && $latest_product->unit_discount_price > 0 ? number_format((($latest_product->unit_price - $latest_product->unit_discount_price) / $latest_product->unit_price) * 100, 1) : 0 }}
                                                                % Off
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
                                                    @php
                                                        $review =
                                                            count($latest_product->reviews) > 0
                                                                ? optional($latest_product->reviews)->sum('rating') /
                                                                    count($latest_product->reviews)
                                                                : 0;
                                                        // dd($latest_product->name, $review);
                                                    @endphp
                                                    <div class="d-flex justify-content-between align-items-center mb-3 rating-area">
                                                        <div class="ps-product__rating">
                                                            @if ($review > 0)
                                                                <div class="br-wrapper br-theme-fontawesome-stars">
                                                                    <select class="ps-rating" data-read-only="true"
                                                                        style="display: none;">
                                                                        @php
                                                                            $maxRating = min(5, max(1, floor($review))); // Get the highest full rating value
                                                                        @endphp
                                                                        @for ($i = 1; $i <= $maxRating; $i++)
                                                                            <option value="{{ $i }}">
                                                                                {{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            @else
                                                                <span class="no-found">N/A</span>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            @if (count($latest_product->reviews) > 0)
                                                                Reviews ({{ count($latest_product->reviews) }})
                                                            @else
                                                                <span class="no-found">N/A</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if (!empty($latest_product->unit_discount_price))
                                                        <div class="ps-product__meta pb-3">
                                                            <span
                                                                class="ps-product__price sale">৳{{ $latest_product->unit_discount_price }}</span>
                                                            <span
                                                                class="ps-product__del">৳{{ $latest_product->unit_price }}</span>
                                                        </div>
                                                    @else
                                                        <div class="ps-product__meta pb-3">
                                                            <span
                                                                class="ps-product__price sale">৳{{ $latest_product->unit_price }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="d-flex align-items-center card-cart-btn">
                                                        <a href="{{ route('buy.now', $latest_product->id) }}"
                                                            class="btn btn-primary mr-1 mr-lg-3">
                                                            Buy Now
                                                        </a>
                                                        <a href="{{ route('cart.store', $latest_product->id) }}"
                                                            class="btn btn-outline-primary add_to_cart"
                                                            data-product_id="{{ $latest_product->id }}"
                                                            data-product_qty="1">
                                                            Add To Cart
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

                                                        {{-- <div class="ps-product__item cart" data-toggle="tooltip"
                                                            data-placement="left" title="Add to cart"><a
                                                                href="#"><i class="fa fa-eye"></i></a>
                                                        </div> --}}
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist"><a
                                                                class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $latest_product->id) }}"><i
                                                                    class="fa fa-heart-o"></i></a>
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

            @if ($categoryone && $categoryoneproducts->count() > 0)
                <div class="container px-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-center align-items-center pb-4 pb-lg-5">
                                <div>
                                    <h3 class="ps-section__title mb-0" style="font-size: 30px;">
                                        {{ optional($categoryone)->name }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ps-home--block">
                        <div class="ps-section__content">
                            <div class="row m-0">
                                @foreach ($categoryoneproducts as $categoryoneproduct)
                                    <div class="col-6 col-md-4 col-lg-3 dot4 p-0">
                                        <div class="ps-section__product">
                                            <div class="ps-product ps-product--standard ctg-one-pr">
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
                                                                            : // : asset('frontend/img/no-product.jpg');
                                                                            asset('frontend/img/no-product.jpg');
                                                                    @endphp
                                                                    <img src="{{ $imageSrc }}"
                                                                        alt="{{ $categoryoneproduct->meta_title }}"
                                                                        width="210" height="210" />
                                                                @endforeach
                                                            @endif
                                                        </figure>
                                                    </a>
                                                    <div class="ps-product__actions">
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist">
                                                            <a class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $categoryoneproduct->id) }}"><i
                                                                    class="fa fa-heart-o"></i></a>
                                                        </div>
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Quick view">
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#popupQuickview{{ $categoryoneproduct->id }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>

                                                    </div>
                                                    @if (!empty($categoryoneproduct->unit_discount_price))
                                                        <div class="ps-product__badge">
                                                            <div class="ps-badge ps-badge--sale">
                                                                -
                                                                {{ !empty($categoryoneproduct->unit_discount_price) && $categoryoneproduct->unit_discount_price > 0 ? number_format((($categoryoneproduct->unit_price - $categoryoneproduct->unit_discount_price) / $categoryoneproduct->unit_price) * 100, 1) : 0 }}
                                                                % Off
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ps-product__content category-content-size">
                                                    <h5 class="ps-product__title">
                                                        <a
                                                            href="{{ route('product.details', $categoryoneproduct->slug) }}">
                                                            {{ implode(' ', array_slice(explode(' ', $categoryoneproduct->name), 0, 5)) }}
                                                        </a>
                                                    </h5>
                                                    @php
                                                        $review =
                                                            count($categoryoneproduct->reviews) > 0
                                                                ? optional($categoryoneproduct->reviews)->sum(
                                                                        'rating',
                                                                    ) / count($categoryoneproduct->reviews)
                                                                : 0;
                                                    @endphp
                                                    <div
                                                        class="d-flex justify-content-between align-items-center mb-3 rating-area">
                                                        <div class="ps-product__rating"
                                                            style="{{ $review <= 0 ? 'visibility: hidden;' : '' }}">
                                                            @if ($review > 0)
                                                                <div class="br-wrapper br-theme-fontawesome-stars">
                                                                    <select class="ps-rating" data-read-only="true"
                                                                        style="display: none;">
                                                                        @php
                                                                            $maxRating = min(5, max(1, floor($review)));
                                                                        @endphp
                                                                        @for ($i = 1; $i <= $maxRating; $i++)
                                                                            <option value="{{ $i }}">
                                                                                {{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            @else
                                                                <span class="no-found">N/A</span>
                                                            @endif
                                                        </div>
                                                        <div
                                                            style="{{ count($categoryoneproduct->reviews) == 0 ? 'visibility: hidden;' : '' }}">
                                                            @if (count($categoryoneproduct->reviews) > 0)
                                                                Reviews ({{ count($categoryoneproduct->reviews) }})
                                                            @else
                                                                <span class="no-found">N/A</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if (!empty($categoryoneproduct->unit_discount_price))
                                                        <div class="ps-product__meta pb-3">
                                                            <span
                                                                class="ps-product__price sale">৳{{ $categoryoneproduct->unit_discount_price }}</span>
                                                            <span
                                                                class="ps-product__del">৳{{ $categoryoneproduct->unit_price }}</span>
                                                        </div>
                                                    @else
                                                        <div class="ps-product__meta pb-3">
                                                            <span
                                                                class="ps-product__price sale">৳{{ $categoryoneproduct->unit_price }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="d-flex align-items-center card-cart-btn">
                                                        <a href="{{ route('buy.now', $categoryoneproduct->id) }}"
                                                            class="btn btn-primary mr-1 mr-lg-3 ">
                                                            Buy Now
                                                        </a>
                                                        <a href="{{ route('cart.store', $categoryoneproduct->id) }}"
                                                            class="btn btn-outline-primary add_to_cart py-2 buy-now-btn"
                                                            data-product_id="{{ $categoryoneproduct->id }}"
                                                            data-product_qty="1">
                                                            Add To Cart
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

                                                        <div class="ps-product__item cart" data-toggle="tooltip"
                                                            data-placement="left" title="Add to cart"><a
                                                                href="#"><i class="fa fa-eye"></i></a>
                                                        </div>
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist"><a
                                                                class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $categoryoneproduct->id) }}"><i
                                                                    class="fa fa-heart-o"></i></a>
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
            <div class="container px-0">
                <div class="ps-delivery ps-delivery--info my-3 my-lg-5"
                    data-background="{{ asset('images/delivery_banner.jpg') }}"
                    style="background-image: url({{ asset('images/delivery_banner.jpg') }});">
                    <div class="ps-delivery__content">
                        <div class="ps-delivery__text"> <i class="icon-shield-check"></i><span> <strong>100% Secure
                                    delivery </strong>without courier communication</span></div><a
                            class="ps-delivery__more" href="{{ route('allproducts') }}">Shop</a>
                    </div>
                </div>
            </div>
            @if ($categorytwo && $categorytwoproducts->count() > 0)
                <section class="ps-section--latest">
                    <div class="container px-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-center align-items-center pb-4 pb-lg-5">
                                    <div>
                                        <h3 class="ps-section__title mb-0" style="font-size: 30px;">
                                            {{ optional($categorytwo)->name }}</h3>
                                    </div>
                                    {{-- <div class="pl-3">
                                        <img class="" src="{{ asset('storage/' . $categorytwo->logo) }}"
                                            alt="{{ $categorytwo->name }}" width="50px">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="ps-section__carousel mb-0">
                            <div class="takeway-slider owl-carousel owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(-2228px, 0px, 0px); transition: 1s; width: 4952px;">
                                        @foreach ($categorytwoproducts as $categorytwoproduct)
                                            <div class="owl-item" style="width: 247.6px;">
                                                <div class="ps-section__product">
                                                    <div class="ps-product takeway-products ps-product--standard ctg-one-pr">
                                                        <div class="ps-product__thumbnail">
                                                            <a class="ps-product__image takeway-slider-img"
                                                                href="{{ route('product.details', $categorytwoproduct->slug) }}">
                                                                <figure>
                                                                    @if (!empty($categorytwoproduct->thumbnail))
                                                                        @php
                                                                            $thumbnailPath =
                                                                                'storage/' . $categorytwoproduct->thumbnail;
                                                                            $thumbnailSrc = file_exists(
                                                                                public_path($thumbnailPath),
                                                                            )
                                                                                ? asset($thumbnailPath)
                                                                                : asset('frontend/img/no-product.jpg');
                                                                        @endphp
                                                                        <img src="{{ $thumbnailSrc }}"
                                                                            alt="{{ $categorytwoproduct->meta_title }}"
                                                                            width="210" height="210" class=""/>
                                                                    @else
                                                                        @foreach ($categorytwoproduct->multiImages->slice(0, 2) as $image)
                                                                            @php
                                                                                $imagePath = 'storage/' . $image->photo;
                                                                                $imageSrc = file_exists(
                                                                                    public_path($imagePath),
                                                                                )
                                                                                    ? asset($imagePath)
                                                                                    : // : asset('frontend/img/no-product.jpg');
                                                                                    asset('frontend/img/no-product.jpg');
                                                                            @endphp
                                                                            <img src="{{ $imageSrc }}"
                                                                                alt="{{ $categorytwoproduct->meta_title }}"
                                                                                width="210" height="210" class=""/>
                                                                        @endforeach
                                                                    @endif
                                                                </figure>
                                                            </a>
                                                            <div class="ps-product__actions">
                                                                <div class="ps-product__item" data-toggle="tooltip"
                                                                    data-placement="left" title="Wishlist">
                                                                    <a class="add_to_wishlist"
                                                                        href="{{ route('wishlist.store', $categorytwoproduct->id) }}"><i
                                                                            class="fa fa-heart-o"></i></a>
                                                                </div>
                                                                <div class="ps-product__item" data-toggle="tooltip"
                                                                    data-placement="left" title="Quick view">
                                                                    <a href="#" data-toggle="modal"
                                                                        data-target="#popupQuickview{{ $categorytwoproduct->id }}">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                </div>

                                                            </div>
                                                            @if (!empty($categorytwoproduct->unit_discount_price))
                                                                <div class="ps-product__badge">
                                                                    <div class="ps-badge ps-badge--sale">
                                                                        -
                                                                        {{ !empty($categorytwoproduct->unit_discount_price) && $categorytwoproduct->unit_discount_price > 0 ? number_format((($categorytwoproduct->unit_price - $categorytwoproduct->unit_discount_price) / $categorytwoproduct->unit_price) * 100, 1) : 0 }}
                                                                        % Off
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
                                                            @php
                                                                $review =
                                                                    count($categorytwoproduct->reviews) > 0
                                                                        ? optional($categorytwoproduct->reviews)->sum(
                                                                                'rating',
                                                                            ) / count($categorytwoproduct->reviews)
                                                                        : 0;
                                                            @endphp
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-3 rating-area">
                                                                <div class="ps-product__rating"
                                                                    style="{{ $review <= 0 ? 'visibility: hidden;' : '' }}">
                                                                    @if ($review > 0)
                                                                        <div class="br-wrapper br-theme-fontawesome-stars">
                                                                            <select class="ps-rating"
                                                                                data-read-only="true"
                                                                                style="display: none;">
                                                                                @php
                                                                                    $maxRating = min(
                                                                                        5,
                                                                                        max(1, floor($review)),
                                                                                    );
                                                                                @endphp
                                                                                @for ($i = 1; $i <= $maxRating; $i++)
                                                                                    <option value="{{ $i }}">
                                                                                        {{ $i }}</option>
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                    @else
                                                                        <span class="no-found">N/A</span>
                                                                    @endif
                                                                </div>
                                                                <div
                                                                    style="{{ count($categorytwoproduct->reviews) == 0 ? 'visibility: hidden;' : '' }}">
                                                                    @if (count($categorytwoproduct->reviews) > 0)
                                                                        Reviews
                                                                        ({{ count($categorytwoproduct->reviews) }})
                                                                    @else
                                                                        <span class="no-found">N/A</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if (!empty($categorytwoproduct->unit_discount_price))
                                                                <div class="ps-product__meta ctg-two-prices">
                                                                    <span
                                                                        class="ps-product__price sale">৳{{ $categorytwoproduct->unit_discount_price }}</span>
                                                                    <span
                                                                        class="ps-product__del">৳{{ $categorytwoproduct->unit_price }}</span>
                                                                </div>
                                                            @else
                                                                <div class="ps-product__meta pb-3">
                                                                    <span
                                                                        class="ps-product__price sale">৳{{ $categorytwoproduct->unit_price }}</span>
                                                                </div>
                                                            @endif
                                                            <div class="d-flex align-items-center">
                                                                <a href="{{ route('buy.now', $categorytwoproduct->id) }}"
                                                                    class="btn btn-primary btn-block mr-1 mr-lg-3 ">
                                                                    Buy Now
                                                                </a>
                                                                <a href="{{ route('cart.store', $categorytwoproduct->id) }}"
                                                                    class="btn btn-outline-primary add_to_cart "
                                                                    data-product_id="{{ $categorytwoproduct->id }}"
                                                                    data-product_qty="1">
                                                                    Add To Cart
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
                                                                            name="quantity" value="1"
                                                                            type="number" />
                                                                        <button class="plus"
                                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                                class="icon-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                <div class="ps-product__item cart" data-toggle="tooltip"
                                                                    data-placement="left" title="Add to cart"><a
                                                                        href="#"><i class="fa fa-eye"></i></a>
                                                                </div>
                                                                <div class="ps-product__item" data-toggle="tooltip"
                                                                    data-placement="left" title="Wishlist"><a
                                                                        class="add_to_wishlist"
                                                                        href="{{ route('wishlist.store', $categorytwoproduct->id) }}"><i
                                                                            class="fa fa-heart-o"></i></a>
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
            @if ($categorythree && $categorythreeproducts->count() > 0)
                <div class="container px-0">
                    <div class="ps-home--block">
                        <h3 class="ps-section__title pb-3 pb-lg-5 mb-0 text-center" style="font-size: 30px;">
                            {{ optional($categorythree)->name }}</h3>
                        <div class="ps-section__content">
                            <div class="row m-0">
                                @foreach ($categorythreeproducts as $categorythreeproduct)
                                    <div class="col-6 col-md-4 col-lg-3 dot4 p-0">
                                        <div class="ps-section__product">
                                            <div class="ps-product ps-product--standard ctg-one-pr">
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
                                                                            : // : asset('frontend/img/no-product.jpg');
                                                                            asset('frontend/img/no-product.jpg');
                                                                    @endphp
                                                                    <img src="{{ $imageSrc }}"
                                                                        alt="{{ $categorythreeproduct->meta_title }}"
                                                                        width="210" height="210" />
                                                                @endforeach
                                                            @endif
                                                        </figure>
                                                    </a>
                                                    <div class="ps-product__actions">
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist">
                                                            <a class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $categorythreeproduct->id) }}"><i
                                                                    class="fa fa-heart-o"></i></a>
                                                        </div>
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Quick view">
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#popupQuickview{{ $categorythreeproduct->id }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>

                                                    </div>
                                                    @if (!empty($categorythreeproduct->unit_discount_price))
                                                        <div class="ps-product__badge">
                                                            <div class="ps-badge ps-badge--sale">
                                                                -
                                                                {{ !empty($categorythreeproduct->unit_discount_price) && $categorythreeproduct->unit_discount_price > 0 ? number_format((($categorythreeproduct->unit_price - $categorythreeproduct->unit_discount_price) / $categorythreeproduct->unit_price) * 100, 1) : 0 }}
                                                                % Off
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
                                                    @php
                                                        $review =
                                                            count($categorythreeproduct->reviews) > 0
                                                                ? optional($categorythreeproduct->reviews)->sum(
                                                                        'rating',
                                                                    ) / count($categorythreeproduct->reviews)
                                                                : 0;
                                                    @endphp
                                                    <div
                                                        class="d-flex justify-content-between align-items-center mb-3 rating-area">
                                                        <div class="ps-product__rating"
                                                            style="{{ $review <= 0 ? 'visibility: hidden;' : '' }}">
                                                            @if ($review > 0)
                                                                <div class="br-wrapper br-theme-fontawesome-stars">
                                                                    <select class="ps-rating" data-read-only="true"
                                                                        style="display: none;">
                                                                        @php
                                                                            $maxRating = min(5, max(1, floor($review)));
                                                                        @endphp
                                                                        @for ($i = 1; $i <= $maxRating; $i++)
                                                                            <option value="{{ $i }}">
                                                                                {{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            @else
                                                                <span class="no-found">N/A</span>
                                                            @endif
                                                        </div>
                                                        <div
                                                            style="{{ count($categorythreeproduct->reviews) == 0 ? 'visibility: hidden;' : '' }}">
                                                            @if (count($categorythreeproduct->reviews) > 0)
                                                                Reviews
                                                                ({{ count($categorythreeproduct->reviews) }})
                                                            @else
                                                                <span class="no-found">N/A</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if (!empty($categorythreeproduct->unit_discount_price))
                                                        <div class="ps-product__meta pb-3">
                                                            <span
                                                                class="ps-product__price sale">৳{{ $categorythreeproduct->unit_discount_price }}</span>
                                                            <span
                                                                class="ps-product__del">৳{{ $categorythreeproduct->unit_price }}</span>
                                                        </div>
                                                    @else
                                                        <div class="ps-product__meta pb-3">
                                                            <span
                                                                class="ps-product__price sale">৳{{ $categorythreeproduct->unit_price }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="d-flex align-items-center card-cart-btn">
                                                        <a href="{{ route('buy.now', $categorythreeproduct->id) }}"
                                                            class="btn btn-primary mr-1 mr-lg-3 ">
                                                            Buy Now
                                                        </a>
                                                        <a href="{{ route('cart.store', $categorythreeproduct->id) }}"
                                                            class="btn btn-outline-primary add_to_cart"
                                                            data-product_id="{{ $categorythreeproduct->id }}"
                                                            data-product_qty="1">
                                                            Add To Cart
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

                                                        <div class="ps-product__item cart" data-toggle="tooltip"
                                                            data-placement="left" title="Add to cart"><a
                                                                href="#"><i class="fa fa-eye"></i></a>
                                                        </div>
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist"><a
                                                                class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $categorythreeproduct->id) }}"><i
                                                                    class="fa fa-heart-o"></i></a>
                                                        </div>
                                                        {{-- <div class="ps-product__item rotate" data-toggle="tooltip"
                                                        data-placement="left" title="Add to compare"><a
                                                            href="compare.html"><i
                                                                class="fa fa-align-left"></i></a>
                                                    </div> --}}
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
        <section class="container-fluid section-bg">
            <!-- Circles Background -->
            <!-- Circles Background -->
            <ul class="circles">
                <!-- Add more circle elements -->
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>

            <!-- Foreground Content -->
            <div class="container position-relative py-5" style="z-index: 1;">
                <div class="row py-5 align-items-center testimonial-content">
                    <div class="col-lg-6">
                        <div>
                            <p class="text-white">Trusted by Thousands</p>
                            <h2 class="text-white fw-normal testi-monial-title">What Customers Say</h2>
                            <h1 class="text-white fw-bold">About Our Products</h1>
                            <p class="mb-5 text-white">Our customers love the quality, craftsmanship, and care we bring
                                to every product. At Ardhanggini, we go beyond expectations to deliver products that
                                inspire trust and satisfaction. Don’t just take our word for it—read their stories
                                below.</p>
                            <div class="d-flex align-items-center shop-btns">
                                <div class="pt-5">
                                    <a href="{{ route('allproducts') }}" class="tst-btn text-white px-5">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <div class="home-demo">
                                <div class="owl-carousel testigmonial-slider owl-theme">
                                    @foreach ($testimonials as $testimonial)
                                        <div class="card testi-card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-12">
                                                        <div class="d-flex">
                                                            <div>
                                                                <div>
                                                                    <p class="testimonial-message"
                                                                        id="testimonial-{{ $testimonial->id }}">
                                                                        <span class="testimonial-text">
                                                                            <i
                                                                                class="fa-solid fa-quote-left pr-3 testi-dots pb-4"></i>
                                                                            <br>
                                                                            <span>
                                                                                {{ $testimonial->message }}</span>
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mt-3 mt-lg-5 testimonial-author">
                                                            <div class="profile d-flex align-items-center">
                                                                <div>
                                                                    <img src="{{ !empty($testimonial->image) ? asset('storage/' . $testimonial->image) : asset('images/testimonial.png') }}"
                                                                        alt="">

                                                                </div>
                                                                <div class="pl-3 testimonial-content-de">
                                                                    <h4 class="text-white fw-semibold mb-0">
                                                                        {{ $testimonial->name }}</h4>
                                                                    <p class="text-white mb-0">
                                                                        <small>{{ $testimonial->company_name }}</small>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                @for ($i = 1; $i <= $testimonial->rating; $i++)
                                                                    <i class="fa-solid fa-star"
                                                                        style="color: goldenrod"></i>
                                                                @endfor
                                                                <span
                                                                    class="text-white pl-2">{{ $testimonial->rating }}.0</span>
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
                        {{-- <div class="circle-rounde">
                            <div class="logo-rounde"
                                style="background-image: url('{{ file_exists(public_path('storage/' . optional($setting)->site_logo_black)) ? asset('storage/' . optional($setting)->site_logo_black) : asset('frontend/img/logo.png') }}');">
                            </div>
                            <div class="text-rounde">
                                <p class="" style="text-decoration: uppercase; !important">
                                    STYLE WITH ELEGANCE YOUR LEGACY
                                </p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="area">
                <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </section>
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
                            <h3 class="ps-section__title pb-3 pb-lg-5 mb-0" style="font-size: 30px;">Best Deals of the week!</h3>
                        </div>
                        <div class="ps-section__carousel">
                            <div class="dealCarousel owl-carousel">
                                @foreach ($deal_products as $deal_product)
                                    <div class="ps-section__product">
                                        <div class="ps-product takeway-products ps-product--standard">
                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image takeway-slider-img"
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
                                                                alt="{{ $deal_product->meta_title }}"
                                                                class="product-img-main" />
                                                        @else
                                                            @foreach ($deal_product->multiImages->slice(0, 2) as $image)
                                                                @php
                                                                    $imagePath = 'storage/' . $image->photo;
                                                                    $imageSrc = file_exists(public_path($imagePath))
                                                                        ? asset($imagePath)
                                                                        : // : asset('frontend/img/no-product.jpg');
                                                                        asset('frontend/img/no-product.jpg');
                                                                @endphp
                                                                <img src="{{ $imageSrc }}"
                                                                    alt="{{ $deal_product->meta_title }}"
                                                                    class="product-img-main" />
                                                            @endforeach
                                                        @endif
                                                    </figure>
                                                </a>
                                                <div class="ps-product__actions">
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Wishlist">
                                                        <a class="add_to_wishlist"
                                                            href="{{ route('wishlist.store', $deal_product->id) }}">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a>
                                                    </div>
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Quick view"><a href="#"
                                                            data-toggle="modal"
                                                            data-target="#popupQuickview{{ $deal_product->id }}"><i
                                                                class="fa fa-eye"></i></a></div>

                                                </div>
                                                @if (!empty($deal_product->unit_discount_price))
                                                    <div class="ps-product__badge">
                                                        <div class="ps-badge ps-badge--sale">
                                                            -
                                                            {{ !empty($deal_product->unit_discount_price) && $deal_product->unit_discount_price > 0 ? number_format((($deal_product->unit_price - $deal_product->unit_discount_price) / $deal_product->unit_price) * 100, 1) : 0 }}
                                                            % Off
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
                                                @php
                                                    $review =
                                                        count($deal_product->reviews) > 0
                                                            ? optional($deal_product->reviews)->sum('rating') /
                                                                count($deal_product->reviews)
                                                            : 0;
                                                @endphp
                                                <div class="d-flex justify-content-between align-items-center mb-3 rating-area">
                                                    <div class="ps-product__rating"
                                                        style="{{ $review <= 0 ? 'visibility: hidden;' : '' }}">
                                                        @if ($review > 0)
                                                            <div class="br-wrapper br-theme-fontawesome-stars">
                                                                <select class="ps-rating" data-read-only="true"
                                                                    style="display: none;">
                                                                    @php
                                                                        $maxRating = min(5, max(1, floor($review)));
                                                                    @endphp
                                                                    @for ($i = 1; $i <= $maxRating; $i++)
                                                                        <option value="{{ $i }}">
                                                                            {{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        @else
                                                            <span class="no-found">N/A</span>
                                                        @endif
                                                    </div>
                                                    <div
                                                        style="{{ count($deal_product->reviews) == 0 ? 'visibility: hidden;' : '' }}">
                                                        @if (count($deal_product->reviews) > 0)
                                                            Reviews ({{ count($deal_product->reviews) }})
                                                        @else
                                                            <span class="no-found">N/A</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if (!empty($deal_product->unit_discount_price))
                                                    <div class="ps-product__meta mb-3">
                                                        <span
                                                            class="ps-product__price sale">৳{{ $deal_product->unit_discount_price }}</span>
                                                        <span
                                                            class="ps-product__del">৳{{ $deal_product->unit_price }}</span>
                                                    </div>
                                                @else
                                                    <div class="ps-product__meta mb-3">
                                                        <span
                                                            class="ps-product__price sale">৳{{ $deal_product->unit_price }}</span>
                                                    </div>
                                                @endif

                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('buy.now', $deal_product->id) }}"
                                                        class="btn btn-primary btn-block mr-1 mr-lg-3">
                                                        Buy Now
                                                    </a>
                                                    <a href="{{ route('cart.store', $deal_product->id) }}"
                                                        class="btn btn-outline-primary add_to_cart"
                                                        data-product_id="{{ $deal_product->id }}"
                                                        data-product_qty="1">
                                                        Add To Cart
                                                    </a>
                                                </div>

                                                <div class="ps-product__actions ps-product__group-mobile mt-3">
                                                    <div class="ps-product__item cart">
                                                        <a class="add_to_cart"
                                                            href="{{ route('cart.store', $deal_product->id) }}"
                                                            data-product_id="{{ $deal_product->id }}"
                                                            data-product_qty="1">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                    <div class="ps-product__item">
                                                        <a class="add_to_wishlist"
                                                            href="{{ route('wishlist.store', $deal_product->id) }}">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a>
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
                            items: 1, // 1 item at a time for small screens
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
                    items: 6, // Number of items visible
                    loop: true, // Enable infinite looping
                    autoplay: true, // Enable automatic sliding
                    autoplayTimeout: 4000, // Slide change interval (ms)
                    autoplaySpeed: 4000, // Slide transition speed (ms)
                    smartSpeed: 2000,
                    autoplayHoverPause: true, // Pause on hover
                    nav: false, // Navigation buttons (optional)
                    dots: false, // Dots indicator (optional)
                    responsive: {
                        0: {
                            items: 5, // 3 items on extra small screens
                        },
                        576: {
                            items: 5, // 3 items on small screens
                        },
                        768: {
                            items: 4, // 4 items on medium screens
                        },
                        1024: {
                            items: 6, // 6 items on large screens
                        },
                    },


                    // loop: true, // Enable infinite loop
                    // margin: 10, // Space between items
                    // nav: false, // Disable navigation arrows
                    // dots: false, // Disable dots
                    // autoplay: true, // Enable autoplay
                    // autoplayTimeout: 5000, // 4 seconds delay for sliding
                    // autoplaySpeed: 0, // Transition speed (2 seconds)
                    // smartSpeed: 5000, // Smooth transition between items
                    // slideTransition: 'linear', // Linear transition for smooth effect
                    // autoplayHoverPause: true, // Pause autoplay on hover
                    // responsive: {
                    //     0: {
                    //         items: 3, // 3 items on extra small screens
                    //     },
                    //     576: {
                    //         items: 3, // 3 items on small screens
                    //     },
                    //     768: {
                    //         items: 4, // 4 items on medium screens
                    //     },
                    //     1024: {
                    //         items: 6, // 6 items on large screens
                    //     },
                    // },
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
