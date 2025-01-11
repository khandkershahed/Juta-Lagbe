<x-frontend-app-layout :title="'Product Details'" :product="$product">
    @push('heads')
        @php
            $isProductPage = true; // Flag to indicate this is a product details page
            $metaTitle = $product->meta_title ?? $product->name;
            $metaDescription = $product->meta_description ?? substr($product->description, 0, 150);
            $metaImage = $product->thumbnail ?? ''; // Default image
        @endphp
    @endpush
    <style>
        .slider-nav-thumbnails {
            margin-top: 10px;
        }

        .slider-nav-thumbnails .slick-slide {
            cursor: pointer;
            outline: none;
        }

        .slider-nav-thumbnails .slick-slide.slick-current.slick-active {
            opacity: 1;
        }

        .slider-nav-thumbnails .slick-slide img {
            padding: 5px;
            background: transparent;
        }

        .slider-nav-thumbnails .slick-slide.slick-current.slick-active img {
            background: #500066;
        }

        .slider-nav-thumbnails img {
            width: 100px;
            object-fit: cover;
            margin: 0 5px;
        }

        .slider-nav-thumbnails .slick-slide:first-child img {
            margin-left: 0;
        }

        .slider-nav-thumbnails .slick-slide:last-child img {
            margin-right: 0;
        }

        .main_product_img img {
            width: 530px;
            height: 430px;
            object-fit: contain;
        }
    </style>
    <div class="ps-page--product3">
        <div class="container">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Home</a></li>
                <li class="ps-breadcrumb__item"><a href="{{ route('allproducts') }}">All Products</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page">{{ $product->name }}</li>
            </ul>
            <div class="ps-page__content">
                <div class="ps-product--detail">
                    <div class="row">
                        <div class="col-12 col-md-9">
                            <div class="row">
                                <div class="col-12 col-xl-6">

                                    <div class="videos-slider-2">
                                        <div class="main_product_img">
                                            <img class="img-fluid" src="{{ asset('storage/' . $product->thumbnail) }}"
                                                alt="{{ $product->meta_title }}" />
                                        </div>
                                        @foreach ($product->multiImages as $image)
                                            <div class="main_product_img">
                                                <img class="img-fluid" src="{{ asset('storage/' . $image->photo) }}"
                                                    alt="{{ $product->meta_title }}"
                                                    onerror="this.onerror=null;this.src='{{ asset('images/no-preview.png') }}';" />
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="slider-nav-thumbnails">
                                        <div>
                                            <img class="img-fluid" src="{{ asset('storage/' . $product->thumbnail) }}"
                                                alt="{{ $product->meta_title }}"
                                                onerror="this.onerror=null;this.src='{{ asset('images/no-preview.png') }}';" />
                                        </div>
                                        @foreach ($product->multiImages as $image)
                                            <div>
                                                <img class="img-fluid" src="{{ asset('storage/' . $image->photo) }}"
                                                    alt="{{ $product->meta_title }}"
                                                    onerror="this.onerror=null;this.src='{{ asset('images/no-preview.png') }}';" />
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- <div class="ps-product--gallery">
                                        <div class="ps-product__thumbnail">
                                            @foreach ($product->multiImages as $image)
                                                <div class="slide">
                                                    <img src="{{ asset('storage/' . $image->photo) }}"
                                                        alt="{{ $product->meta_title }}" />
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="ps-gallery--image">
                                            @foreach ($product->multiImages as $image)
                                                <div class="slide">
                                                    <div class="ps-gallery__item">
                                                        <img src="{{ asset('storage/' . $image->photo) }}"
                                                            alt="{{ $product->meta_title }}" />
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="ps-product__info">
                                        <div class="text-22 text-dark" style="height: auto;">
                                            {{ $product->name }}
                                        </div>
                                        <table class="table ps-table ps-table--oriented m-0">
                                            <tbody>
                                                @if (!empty($product->sku_code))
                                                    <tr>
                                                        <th class="ps-table__th">CODE</th>
                                                        <td>{{ $product->sku_code }}</td>
                                                    </tr>
                                                @endif
                                                @if (!empty(optional($product->brand)->name))
                                                    <tr>
                                                        <th class="ps-table__th">BRAND </th>
                                                        <td>{{ optional($product->brand)->name }}</td>
                                                    </tr>
                                                @endif
                                                @if (!empty($product->stock) && !empty($product->contains))
                                                    <tr>
                                                        <th class="ps-table__th">PALLET QUANTITY </th>
                                                        <td>{{ $product->stock * $product->contains }}</td>
                                                    </tr>
                                                @endif
                                                {{-- @if (!empty($product->weight))
                                                    <tr>
                                                        <th class="ps-table__th">Weight </th>
                                                        <td>{{ $product->weight }} gm</td>
                                                    </tr>
                                                @endif --}}
                                                {{-- @if (!empty($product->length))
                                                    <tr>
                                                        <th class="ps-table__th">Height </th>
                                                        <td>{{ $product->length }} cm</td>
                                                    </tr>
                                                @endif --}}
                                                @if (!empty($product->width))
                                                    <tr>
                                                        <th class="ps-table__th">Width </th>
                                                        <td>{{ $product->width }} cm</td>
                                                    </tr>
                                                @endif
                                                @if (!empty($product->height))
                                                    <tr>
                                                        <th class="ps-table__th">Height </th>
                                                        <td>{{ $product->height }} cm</td>
                                                    </tr>
                                                @endif
                                                {{-- @if (!empty($product->stock))
                                                    <tr>
                                                        <th class="ps-table__th">NO. OF CARTONS </th>
                                                        <td>{{ $product->stock }}</td>
                                                    </tr>
                                                @endif --}}

                                            </tbody>
                                        </table>
                                        <div class="ps-product__group mt-20">
                                            {{-- <table class="table ps-table ps-table--oriented m-0">
                                                <tr>
                                                    <th>Carton / Box</th>
                                                    <th>Unit Price</th>
                                                    <th>Stock</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $product->contains }}</td>
                                                    <td>
                                                        {{ $product->unit_price }}
                                                    </td>
                                                    <td>
                                                        @if (!empty($product->stock) && $product->stock > 0)
                                                            <i class="fa fa-check"></i>
                                                        @else
                                                            <span class="text-danger">X</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table> --}}
                                            <div>
                                                <p>{!! \Illuminate\Support\Str::words($product->overview, 30) !!}</p>
                                            </div>

                                            <div class="pt-4">
                                                <p class="fw-bold">Color Variation</p>
                                                <div class="color-one">
                                                    @php
                                                        // Decode the JSON string if it's not already an array
                                                        $colors = is_string($product->color)
                                                            ? json_decode($product->color, true)
                                                            : $product->color;
                                                    @endphp

                                                    @if (is_array($colors) && !empty($colors))
                                                        <div class="color-options">
                                                            <!-- Multi-select dropdown -->
                                                            <select name="color" id="color-select"
                                                                class="form-control select">
                                                                @foreach ($colors as $color)
                                                                    <option value="{{ strtolower($color['value']) }}">
                                                                        {{ ucfirst($color['value']) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @else
                                                        <p class="site-color">No colors available</p>
                                                    @endif
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="ps-product__feature">
                                @if (!empty($product->stock) && $product->stock > 0)
                                    <div class="mb-0"><span class="ps-badge bg-success">{{ $product->stock }} In
                                            Stock</span></div>
                                @else
                                    <div class="mb-0"><span class="ps-badge ps-badge--outstock">Out Of
                                            Stock</span></div>
                                @endif
                                @if (!empty($product->unit_discount_price))
                                    <div class="ps-product__meta py-3 pr-details-price mt-3">
                                        <span
                                            class="ps-product__price sale">৳{{ $product->unit_discount_price }}</span>
                                        <span class="ps-product__del">৳{{ $product->unit_price }}</span>
                                    </div>
                                @else
                                    <div class="ps-product__meta py-3 pr-details-price mt-3">
                                        <span class="ps-product__price sale">৳{{ $product->unit_price }}</span>
                                    </div>
                                @endif

                                <div class="ps-product__quantity">
                                    <h6>Quantity</h6>
                                    <div class="def-number-input number-input safari_only">
                                        <button class="minus"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                class="icon-minus"></i></button>
                                        <input class="quantity" min="1" name="quantity" value="1"
                                            type="number" data-product_id="{{ $product->id }}" />
                                        <button class="plus"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                class="icon-plus"></i></button>
                                    </div>
                                </div>

                                {{-- <a class="ps-btn ps-btn--warning add_to_cart_btn_product_single"
                                    data-product_id="{{ $product->id }}" href="#">Add to cart</a> --}}

                                <div class="d-flex align-items-center">
                                    <a class="btn btn-primary mr-1 mr-lg-3"
                                        href="{{ route('buy.now',$product->id) }}">Buy Now</a>
                                    <a class="btn btn-outline-primary add_to_cart_btn_product_single"
                                        data-product_id="{{ $product->id }}" href="#">Add to cart</a>
                                </div>

                                <ul class="ps-product__bundle">
                                    <li><i class="icon-bag2"></i>Full cash on delivery</li>
                                    <li><i class="icon-truck"></i>Inside Dhaka-70 TK (24-48 hrs)</li>
                                    <li><i class="icon-truck"></i>Outside Dhaka-150 TK (2-4 Days)</li>
                                    </li>
                                    <li><i class="icon-truck"></i>Dhaka Sub-area-100 TK </li>
                                    <li><i class="fa-solid fa-location-dot"></i>
                                        Sub-areas: <br>
                                        <span class="pt-2"
                                            style="position: relative;left: 32px;width: 94%;display: inline-block;">Keraniganj,
                                            Tangi, Savar, Gazipur, Narayanganj, Asulia (2-4 Days)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ps-product__content">
                        <ul class="nav nav-tabs ps-tab-list bg-white p-3" id="productContentTabs" role="tablist">
                            <li class="nav-item ml-3 pr-info-tabs" role="presentation">
                                <a class="nav-link show active" id="information-tab" data-toggle="tab"
                                    href="#information-content" role="tab" aria-controls="information-content"
                                    aria-selected="false">
                                    Description
                                </a>
                            </li>
                            <li class="nav-item ml-3 pr-info-tabs" role="presentation">
                                <a class="nav-link" id="description-tab" data-toggle="tab"
                                    href="#description-content" role="tab" aria-controls="description-content"
                                    aria-selected="true">
                                    Key Features
                                </a>
                            </li>
                            <li class="nav-item ml-3 pr-inf-tabs" role="presentation">
                                <a class="nav-link" id="specification-tab" data-toggle="tab"
                                    href="#specification-content" role="tab"
                                    aria-controls="specification-content" aria-selected="false">
                                    Specification
                                </a>
                            </li>
                            <li class="nav-item ml-3" role="presentation">
                                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews-content"
                                    role="tab" aria-controls="reviews-content" aria-selected="false">
                                    Reviews ({{ count($product->reviews) }})
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content bg-white p-5" id="productContent">
                            <div class="tab-pane fade show active" id="information-content" role="tabpanel"
                                aria-labelledby="information-tab">
                                <div class="ps-document">
                                    <div class="row row-reverse">
                                        <div class="col-12">
                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="description-content" role="tabpanel"
                                aria-labelledby="description-tab">
                                <div class="ps-document">
                                    <div class="row row-reverse">
                                        <div class="col-12">
                                            {!! $product->overview !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="specification-content" role="tabpanel"
                                aria-labelledby="specification-tab">
                                <div class="ps-document">
                                    <div class="row row-reverse">
                                        <div class="col-12">
                                            {!! $product->specification !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="reviews-content" role="tabpanel"
                                aria-labelledby="reviews-tab">
                                <div class="ps-product__tabreview">
                                    <div class="ps-review--product">
                                        {{-- Check if $reviews is not empty --}}
                                        @if (!empty($product->reviews) && count($product->reviews) > 0)
                                            @foreach ($product->reviews as $review)
                                                <div class="ps-review__row">
                                                    <div class="ps-review__avatar">

                                                        <img src="{{ !empty($review['image']) ? asset('storage/' . $review['image']) : asset('images/testimonial.png') }}"
                                                            alt="{{ $review['name'] }}" />
                                                    </div>
                                                    <div class="ps-review__info">
                                                        <div class="ps-review__name">{{ $review['name'] }}</div>
                                                        <div class="ps-review__date">
                                                            {{ \Carbon\Carbon::parse($review['date'])->format('M d, Y') }}
                                                        </div>
                                                    </div>
                                                    <div class="ps-review__rating">

                                                        @if ($review['rating'] > 0)
                                                            <div class="br-wrapper br-theme-fontawesome-stars">
                                                                <select class="ps-rating" data-read-only="true"
                                                                    style="display: none;">
                                                                    @php
                                                                        $maxRating = min(
                                                                            5,
                                                                            max(1, floor($review['rating'])),
                                                                        ); // Get the highest full rating value
                                                                    @endphp
                                                                    @for ($i = 1; $i <= $maxRating; $i++)
                                                                        <option value="{{ $i }}">
                                                                            {{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="ps-review__desc">
                                                        <p>{{ $review['message'] }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No reviews available.</p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="ps-section--also" data-background="img/related-bg.jpg">
                        <div class="container px-0">
                            <h3 class="ps-section__title">Customer also bought</h3>
                            <div class="owl-carousel">
                                @foreach ($related_products as $related_product)
                                    <div class="ps-section__product">
                                        <div class="ps-product takeway-products ps-product--standard cst-bought-pr">
                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image takeway-slider-img"
                                                    href="{{ route('product.details', $related_product->slug) }}">
                                                    <figure>
                                                        @if (!empty($related_product->thumbnail))
                                                            @php
                                                                $thumbnailPath =
                                                                    'storage/' . $related_product->thumbnail;
                                                                $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                                    ? asset($thumbnailPath)
                                                                    : asset('frontend/img/no-product.jpg');
                                                            @endphp
                                                            <img src="{{ $thumbnailSrc }}"
                                                                alt="{{ $related_product->meta_title }}"
                                                                width="210" height="210" />
                                                        @else
                                                            @foreach ($related_product->multiImages->slice(0, 2) as $image)
                                                                @php
                                                                    $imagePath = 'storage/' . $image->photo;
                                                                    $imageSrc = file_exists(public_path($imagePath))
                                                                        ? asset($imagePath)
                                                                        : // : asset('frontend/img/no-product.jpg');
                                                                        asset('frontend/img/no-product.jpg');
                                                                @endphp
                                                                <img src="{{ $imageSrc }}"
                                                                    alt="{{ $related_product->meta_title }}"
                                                                    width="210" height="210" />
                                                            @endforeach
                                                        @endif
                                                    </figure>
                                                </a>
                                                <div class="ps-product__actions">
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Wishlist">
                                                        <a class="add_to_wishlist"
                                                            href="{{ route('wishlist.store', $related_product->id) }}">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a>
                                                    </div>
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Quick view"><a href="#"
                                                            data-toggle="modal"
                                                            data-target="#popupQuickview{{ $related_product->id }}"><i
                                                                class="fa fa-eye"></i></a></div>

                                                </div>
                                                @if (!empty($related_product->unit_discount_price))
                                                    <div class="ps-product__badge">
                                                        <div class="ps-badge ps-badge--sale">
                                                            -
                                                            {{ !empty($related_product->unit_discount_price) && $related_product->unit_discount_price > 0 ? number_format((($related_product->unit_price - $related_product->unit_discount_price) / $related_product->unit_price) * 100, 1) : 0 }}
                                                            % Off
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ps-product__content">
                                                <div>
                                                    <h4 class="" style="height: 50px !important;">
                                                        <a href="{{ route('product.details', $related_product->slug) }}"
                                                            style="text-transform: capitalize;">
                                                            {{ implode(' ', array_slice(explode(' ', $related_product->name), 0, 5)) }}
                                                        </a>
                                                    </h4>
                                                </div>
                                                @php
                                                    $review =
                                                        count($related_product->reviews) > 0
                                                            ? optional($related_product->reviews)->sum('rating') /
                                                                count($related_product->reviews)
                                                            : 0;
                                                    // dd($related_product->name, $review);
                                                @endphp
                                                <div class="d-flex justify-content-between align-items-center">
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
                                                        @endif
                                                    </div>
                                                    <div>
                                                        @if (count($related_product->reviews) > 0)
                                                            Reviews ({{ count($related_product->reviews) }})
                                                        @else
                                                            <p class="no-found mb-1 pb-0">N/A</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if (!empty($related_product->unit_discount_price))
                                                    <div class="ps-product__meta pb-3">
                                                        <span
                                                            class="ps-product__price sale">৳{{ $related_product->unit_discount_price }}</span>
                                                        <span
                                                            class="ps-product__del">৳{{ $related_product->unit_price }}</span>
                                                    </div>
                                                @else
                                                    <div class="ps-product__meta pb-3">
                                                        <span
                                                            class="ps-product__price sale">৳{{ $related_product->unit_price }}</span>
                                                    </div>
                                                @endif
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('buy.now', $related_product->id) }}"
                                                        class="btn btn-primary mr-1 mr-lg-3">
                                                        Buy Now
                                                    </a>
                                                    <a href="{{ route('cart.store', $related_product->id) }}"
                                                        class="btn btn-outline-primary add_to_cart"
                                                        data-product_id="{{ $related_product->id }}"
                                                        data-product_qty="1">
                                                        Add To Cart
                                                    </a>
                                                </div>
                                                <div class="ps-product__actions ps-product__group-mobile">
                                                    <div class="ps-product__quantity">
                                                        <div class="def-number-input number-input safari_only">
                                                            <button class="minus"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                    class="icon-minus"></i></button>
                                                            <input class="quantity" min="0" name="quantity"
                                                                value="1" type="number" />
                                                            <button class="plus"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                    class="icon-plus"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="ps-product__item cart" data-toggle="tooltip"
                                                        data-placement="left" title="Add to cart"><a
                                                            href="#"><i class="fa fa-shopping-basket"></i></a>
                                                    </div>
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Wishlist">
                                                        <a class="add_to_wishlist"
                                                            href="{{ route('wishlist.store', $related_product->id) }}">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a>
                                                    </div>
                                                    {{-- <div class="ps-product__item rotate" data-toggle="tooltip"
                                                        data-placement="left" title="Add to compare"><a
                                                            href="compare.html"><i class="fa fa-align-left"></i></a>
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
            </div>
            <div class="ps-delivery ps-delivery--info my-5"
                data-background="{{ asset('images/delivery_banner.jpg') }}"
                style="background-image: url({{ asset('images/delivery_banner.jpg') }});">
                <div class="ps-delivery__content">
                    <div class="ps-delivery__text"> <i class="icon-shield-check"></i><span> <strong>100%
                                Secure
                                delivery </strong>without courier communication</span></div><a
                        class="ps-delivery__more" href="{{ route('allproducts') }}">Shop</a>
                </div>
            </div>
        </div>
    </div>

    @foreach ($related_products as $related_product)
        <div class="modal fade" id="popupQuickview{{ $related_product->id }}" data-backdrop="static"
            data-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered ps-quickview">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="wrap-modal-slider container-fluid ps-quickview__body">
                            <button class="close ps-quickview__close" type="button" data-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="ps-product--detail">
                                <div class="row">
                                    <div class="col-12 col-xl-6 pl-0">
                                        <div class="ps-product--gallery">
                                            <div class="ps-product__thumbnail">
                                                @if ($related_product->multiImages->isNotEmpty())
                                                    @foreach ($related_product->multiImages->slice(0, 5) as $image)
                                                        @php
                                                            $imagePath = 'storage/' . $image->photo;
                                                            $imageSrc = file_exists(public_path($imagePath))
                                                                ? asset($imagePath)
                                                                : asset('frontend/img/no-product.jpg');
                                                        @endphp
                                                        <div class="slide">
                                                            <img src="{{ $imageSrc }}"
                                                                alt="{{ $related_product->name }}" />
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @php
                                                        $thumbnailPath = 'storage/' . $related_product->thumbnail;
                                                        $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                            ? asset($thumbnailPath)
                                                            : asset('frontend/img/no-product.jpg');
                                                    @endphp
                                                    <div class="slide">
                                                        <img src="{{ $thumbnailSrc }}"
                                                            alt="{{ $related_product->name }}" />
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ps-gallery--image">
                                                @if ($related_product->multiImages->isNotEmpty())
                                                    @foreach ($related_product->multiImages->slice(0, 5) as $image)
                                                        @php
                                                            $imagePath = 'storage/' . $image->photo;
                                                            $imageSrc = file_exists(public_path($imagePath))
                                                                ? asset($imagePath)
                                                                : asset('frontend/img/no-product.jpg');
                                                        @endphp
                                                        <div class="slide">
                                                            <div class="ps-gallery__item">
                                                                <img src="{{ $imageSrc }}"
                                                                    alt="{{ $related_product->name }}" />
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @php
                                                        $thumbnailPath = 'storage/' . $related_product->thumbnail;
                                                        $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                            ? asset($thumbnailPath)
                                                            : asset('frontend/img/no-product.jpg');
                                                    @endphp
                                                    <div class="slide">
                                                        <div class="ps-gallery__item">
                                                            <img src="{{ $thumbnailSrc }}"
                                                                alt="{{ $related_product->name }}" />
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 pr-0">
                                        <div class="ps-product__info mb-0">
                                            <div class="ps-product__badges">
                                                <span
                                                    class="ps-badge ps-badge--instock">{{ $related_product->box_stock > 0 ? 'IN STOCK' : 'OUT OF STOCK' }}</span>
                                            </div>
                                            <div class="ps-product__branch pt-2">
                                                <a href="#"
                                                    style="text-transform: uppercase;">{{ optional($related_product->brand)->name }}</a>
                                            </div>
                                            <h5 class="ps-product__title">
                                                <a href="{{ route('product.details', $related_product->slug) }}">
                                                    {{ $related_product->name }}
                                                </a>
                                            </h5>
                                            <div class="ps-product__desc">
                                                <p>{!! $related_product->short_description !!}</p>
                                            </div>
                                            {{-- @if (!empty($related_product->unit_discount_price))
                                                <div class="ps-product__meta">
                                                    <span
                                                        class="ps-product__price sale">৳{{ $related_product->unit_discount_price }}</span>
                                                    <span
                                                        class="ps-product__del">৳{{ $related_product->unit_price }}</span>
                                                </div>
                                            @else
                                                <div class="ps-product__meta">
                                                    <span
                                                        class="ps-product__price sale">৳{{ $related_product->unit_price }}</span>
                                                </div>
                                            @endif --}}

                                            <div class="ps-product__feature">
                                                @if (!empty($related_product->unit_discount_price))
                                                    <div class="ps-product__meta py-3 pr-details-price mt-3">
                                                        <span
                                                            class="ps-product__price sale">৳{{ $related_product->unit_discount_price }}</span>
                                                        <span
                                                            class="ps-product__del">৳{{ $related_product->unit_price }}</span>
                                                    </div>
                                                @else
                                                    <div class="ps-product__meta py-3 pr-details-price mt-3">
                                                        <span
                                                            class="ps-product__price sale">৳{{ $related_product->unit_price }}</span>
                                                    </div>
                                                @endif

                                                <div class="ps-product__quantity">
                                                    <h6>Quantity</h6>
                                                    <div class="def-number-input number-input safari_only">
                                                        <button class="minus"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                class="icon-minus"></i></button>
                                                        <input class="quantity" min="1" name="quantity"
                                                            value="1" type="number"
                                                            data-product_id="{{ $related_product->id }}" />
                                                        <button class="plus"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                class="icon-plus"></i></button>
                                                    </div>
                                                </div>

                                                <a class="ps-btn ps-btn--warning add_to_cart_btn_product_single"
                                                    data-product_id="{{ $related_product->id }}" href="#">Add
                                                    to cart</a>

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
    @endforeach

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.js"></script>
        <script>
            //メインスライド
            var slider = new Swiper('.gallery-slider', {
                slidesPerView: 1,
                centeredSlides: true,
                loop: true,
                loopedSlides: 6, //スライドの枚数と同じ値を指定
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });

            //サムネイルスライド
            var thumbs = new Swiper('.gallery-thumbs', {
                slidesPerView: 'auto',
                spaceBetween: 10,
                centeredSlides: true,
                loop: true,
                slideToClickedSlide: true,
            });

            //3系
            //slider.params.control = thumbs;
            //thumbs.params.control = slider;

            //4系～
            slider.controller.control = thumbs;
            thumbs.controller.control = slider;
        </script>
        <script>
            $('.videos-slider-2').slick({
                autoplay: true,
                slidesToScroll: 1,
                slidesToShow: 1,
                arrows: false,
                dots: false,
                asNavFor: '.slider-nav-thumbnails',
            });

            $('.slider-nav-thumbnails').slick({
                autoplay: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.videos-slider-2',
                dots: false,
                arrows: false,
                focusOnSelect: true,
                variableWidth: true
            });

            // Remove active class from all thumbnail slides
            $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');

            // Set active class to first thumbnail slides
            $('.slider-nav-thumbnails .slick-slide').eq(0).addClass('slick-active');

            // On before slide change match active thumbnail to current slide
            $('.videos-slider-2').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
                var mySlideNumber = nextSlide;
                $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');
                $('.slider-nav-thumbnails .slick-slide').eq(mySlideNumber).addClass('slick-active');
            });
        </script>
        <script>
            $(document).ready(function() {
                $(".owl-carousel").owlCarousel({
                    items: 4, // Change this to 4
                    loop: true,
                    nav: true,
                    dots: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 4 // Change this to 4 as well
                        }
                    }
                });
            });
        </script>
        <script>
            // Get all input elements
            const colorInputs = document.querySelectorAll('.color-one .round input[type="checkbox"]');

            // Loop through each input and set the label background color
            colorInputs.forEach(input => {
                const label = document.querySelector(`label[for="${input.id}"]`);
                if (label) {
                    label.style.backgroundColor = input.value; // Set background color from input value
                }

                // Add event listener to allow only one checkbox to be checked at a time
                input.addEventListener('change', () => {
                    if (input.checked) {
                        // Uncheck all other checkboxes
                        colorInputs.forEach(otherInput => {
                            if (otherInput !== input) {
                                otherInput.checked = false;
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
</x-frontend-app-layout>
