<x-frontend-app-layout :title="'Special Offers'">
    <style>
        /* .special-banner-container {
                height: 250px;
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #f8f9fa;
                overflow: hidden;
            }
        */
        .special-banner {
            height: 250px;
            width: 100%;
            object-fit: cover;
        }

        @media (max-width: 480px) {
            .special-banner {
                height: 75px;
                width: 100%;
                object-fit: cover;
                margin-top: 110px;
            }
        }
    </style>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="special-banner-container">
                    <img class="special-banner" src="{{ asset('storage/' . $special_offer->banner_image) }}"
                        onerror="this.onerror=null; this.src='{{ asset('images/no-preview2.png') }}';"
                        alt="Special Banner">
                </div>
            </div>
        </div>
    </div>
    <div class="ps-categogy ps-categogy--separate">
        <div class="container">
            <ul class="ps-breadcrumb faq-breadcumb">
                <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Home</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page">Shop</li>
            </ul>
        </div>
        <div class="ps-categogy__main mb-0">
            <div class="container px-0">
                <div class="ps-categogy__product">
                    <div class="row m-0">
                        @if ($special_products)
                            @foreach ($special_products as $latest_product)
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
                                                    <a href="{{ route('product.details', $latest_product->slug) }}">
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
                                                <div
                                                    class="d-flex justify-content-between align-items-center rating-area">
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
                                                    <div class="ps-product__meta mb-3">
                                                        <span
                                                            class="ps-product__price sale">৳{{ $latest_product->unit_discount_price }}</span>
                                                        <span
                                                            class="ps-product__del">৳{{ $latest_product->unit_price }}</span>
                                                    </div>
                                                @else
                                                    <div class="ps-product__meta mb-3">
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
                                                        class="btn btn-outline-primary add_to_cart p-2 p-lg-1" data-product_id="{{ $latest_product->id }}"
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
                                                            <input class="quantity" min="0" name="quantity"
                                                                value="1" type="number" />
                                                            <button class="plus"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                    class="icon-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="ps-product__item cart" data-toggle="tooltip"
                                                        data-placement="left" title="Add to cart"><a href="#"><i
                                                                class="fa fa-eye"></i></a>
                                                    </div>
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
                        @else
                            <div class="col-12 text-center bg-white if-show-img">
                                <img class="" style="width: 320px;"
                                    src="{{ asset('frontend/img/no-products-category.jpg') }}" alt="">
                            </div>
                        @endif
                    </div>
                    <div class="ps-pagination">
                        {{-- <ul class="pagination">
                            <li><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                        </ul> --}}
                        {{-- {{ $special_products->links() }} --}}
                    </div>
                    <div class="ps-delivery ps-delivery--info my-5"
                        data-background="{{ asset('images/delivery_banner.jpg') }}"
                        style="background-image: url({{ asset('images/delivery_banner.jpg') }});">
                        <div class="ps-delivery__content">
                            <div class="ps-delivery__text"> <i class="icon-shield-check"></i><span> <strong>100%
                                        Secure delivery </strong>without courier communication</span></div><a
                                class="ps-delivery__more" href="{{ route('allproducts') }}">Shop</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    @endpush
</x-frontend-app-layout>
