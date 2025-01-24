<x-frontend-app-layout :title="'Special Offers'">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 px-0">
                <div class="special-banner-container">
                    {{-- <img class="special-banner img-fluid" src="{{ asset('storage/' . $special_offer->banner_image) }}"
                        onerror="this.onerror=null; this.src='{{ asset('images/Untitled-2.png') }}';"
                        alt="Special Banner"> --}}
                    <img class="w-100 img-fluid" src="{{ asset('images/special-banner.jpg') }}"alt="Special Banner">
                </div>
            </div>
        </div>
    </div>
    <div class="ps-categogy ps-categogy--separate" style="background: #f7f8fa;">
        <div class="ps-categogy__main">
            <div class="container px-0">
                <div class="ps-categogy__product">
                    <div class="row mb-4">
                        @if ($special_products)
                            @foreach ($special_products as $latest_product)
                                <div class="col-6 col-md-4 col-lg-3 dot4 p-0">
                                    <div class="ps-section__product pr-2">
                                        <div class="ps-product ps-product--standard">
                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image"
                                                    href="{{ route('product.details', $latest_product->slug) }}">
                                                    <figure>
                                                        @if (!empty($latest_product->thumbnail))
                                                            @php
                                                                $thumbnailPath =
                                                                    'storage/' . $latest_product->thumbnail;
                                                                $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                                    ? asset($thumbnailPath)
                                                                    : asset('frontend/img/no-product.jpg');
                                                            @endphp
                                                            <img src="{{ $thumbnailSrc }}"
                                                                alt="{{ $latest_product->meta_title }}" width="210"
                                                                height="210" />
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
                                                {{-- Review --}}
                                                @if (count($latest_product->reviews) > 0)
                                                    <div>
                                                        @php
                                                            $review =
                                                                count($latest_product->reviews) > 0
                                                                    ? optional($latest_product->reviews)->sum(
                                                                            'rating',
                                                                        ) / count($latest_product->reviews)
                                                                    : 0;
                                                        @endphp
                                                        <div
                                                            class="d-flex justify-content-between align-items-center my-2 rating-area px-3">
                                                            <div style="color: var(--site-primary)">
                                                                Reviews
                                                                ({{ count($latest_product->reviews) }})
                                                            </div>
                                                            <div class="ps-product__rating">
                                                                @if ($review > 0)
                                                                    <div class="br-wrapper br-theme-fontawesome-stars">
                                                                        <select class="ps-rating" data-read-only="true"
                                                                            style="display: none;">
                                                                            @php
                                                                                $maxRating = min(
                                                                                    5,
                                                                                    max(1, floor($review)),
                                                                                ); // Get the highest full rating value
                                                                            @endphp
                                                                            @for ($i = 1; $i <= $maxRating; $i++)
                                                                                <option value="{{ $i }}">
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
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Add To Cart">
                                                        <a class="add_to_cart"
                                                            href="{{ route('cart.store', $latest_product->id) }}"
                                                            data-product_id="{{ $latest_product->id }}"
                                                            data-product_qty="1">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </a>
                                                    </div>

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
                                                    <a href="{{ route('product.details', $latest_product->slug) }}">
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
                                                    <a href="{{ route('buy.now', $latest_product->id) }}"
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
                                                            href="{{ route('wishlist.store', $latest_product->id) }}"><i
                                                                class="fa-solid fa-heart"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12 text-center bg-white if-show-img">
                                <img class="" style="width: 320px;"
                                    src="{{ asset('frontend/img/no-products-category.jpg') }}" alt="">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
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
                            <img class="img-fluid" src="{{ asset('images/delivery-icons.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-app-layout>
