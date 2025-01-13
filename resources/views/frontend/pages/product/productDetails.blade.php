<x-frontend-app-layout :title="'Product Details'" :product="$product">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    @push('heads')
        @php
            $isProductPage = true; // Flag to indicate this is a product details page
            $metaTitle = $product->meta_title ?? $product->name;
            $metaDescription = $product->meta_description ?? substr($product->description, 0, 150);
            $metaImage = $product->thumbnail ?? ''; // Default image
        @endphp
    @endpush
    <style>
        .product-slider-wrapper {
            /* width: 600px;
            height: 800px; */
            width: 100%;
            height: 100%;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper {
            width: 100%;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .mySwiper2 {
            height: 80%;
            width: 100%;
        }

        .mySwiper {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .mySwiper .swiper-slide,
        .product-details-slide .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .mySwiper .swiper-slide-thumb-active,
        .product-details-slide .swiper-slide-thumb-active {
            opacity: 1;
        }

        .product-details-slide {
            margin-bottom: 10px;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #fff !important;
        }



        @media (min-width: 768px) {
            .mySwiper {
                display: none;
            }

            .product-slider-wrapper {
                display: flex;
                flex-direction: row;
            }

            .mySwiper2 {
                height: 100%;
            }

            .swiper {
                width: 100%;
                height: 850px;
            }

            .product-details-slide .swiper-slide {
                width: 100%;
            }

            .product-details-slide {
                width: calc(22% - 20px);
            }

            .mySwiper2 {
                width: 78%;
            }
        }

        @media (max-width: 767px) {
            .product-slider-wrapper {
                display: flex;
                flex-direction: column;
            }

            .product-details-slide {
                display: none;
            }

            .product-slider-wrapper {
                width: 100%;
                height: 70%;
            }

            .product-details-slide {
                height: 250px;
            }
        }

        .form-select option {
            background-color: var(--site-primary);
            color: #fff;
            border-radius: 0;
        }

        option {
            background: #fff;
            border: 0px solid #626262;
            padding-left: 10px;
            font-size: 14px;
        }

        option:hover {
            background: #fff;
            border: 0px solid #626262;
            padding-left: 10px;
            font-size: 14px;
            color: var(--site-primary);
        }
    </style>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="ps-breadcrumb">
                        <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="ps-breadcrumb__item"><a href="{{ route('allproducts') }}">All Products</a></li>
                        <li class="ps-breadcrumb__item active" aria-current="page">{{ $product->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container product-details">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-slider-wrapper">
                        <div thumbsSlider="" class="swiper product-details-slide">
                            <div class="swiper-wrapper">
                                @foreach ($product->multiImages as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $image->photo) }}" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Swiper -->
                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                            class="swiper mySwiper2">
                            <div class="swiper-wrapper">
                                @foreach ($product->multiImages as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $image->photo) }}" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div>
                        <h3 class="title">{{ $product->name }}</h3>
                        <div>
                            @if (!empty($product->stock) && $product->stock > 0)
                                <div class="mb-0">
                                    <span class="ps-badge bg-success rounded-0">{{ $product->stock }} In Stock</span>
                                </div>
                            @else
                                <div class="mb-0">
                                    <span class="ps-badge ps-badge--outstock rounded-0">Out Of Stock</span>
                                </div>
                            @endif
                        </div>
                        <div class="w-100 pt-3">
                            @if (!empty($product->unit_discount_price))
                                <div class="d-flex justify-content-start align-items-center">
                                    <h4 class="mb-0">দামঃ</h4>
                                    <h4 class="text-success pl-2 mb-0"> {{ $product->unit_discount_price }} টাকা</h4>
                                    <h4 class="ps-product__del text-danger pl-4 mb-0">{{ $product->unit_price }} টাকা
                                    </h4>
                                </div>
                            @else
                                <div class="">
                                    {{ $product->unit_price }} টাকা
                                </div>
                            @endif
                        </div>
                        <div class="pt-3">
                            <div class="pl-3">
                                {!! $product->specification ??
                                    ' <div>
                                                                                                                                                                        <ul class="pl-2">
                                                                                                                                                                            <li><strong>Brand:</strong> Juta Lagbe</li>
                                                                                                                                                                            <li><strong>Model:</strong> Footwear</li>
                                                                                                                                                                            <li><strong>Weight:</strong> Light Weight</li>
                                                                                                                                                                            <li><strong>Outsole:</strong> PU Leather/Leather</li>
                                                                                                                                                                        </ul>
                                                                                                                                                                    </div>
                                                                                                                                                                ' !!}
                            </div>
                        </div>
                        <div class="ps-page__content py-2">
                            <div class="ps-product--detail">
                                <div class="ps-product__feature w-50 bg-light">
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
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center card-cart-btn mt-4">
                            <!-- Order Modal  -->
                            <a href="#" class="btn btn-primary rounded-0 w-100 mr-3 py-3" data-toggle="modal"
                                data-target="#order-product{{ $product->id }}">
                                <i class="fa-solid fa-basket-shopping pr-2 fa-fade"></i>
                                অর্ডার করুন
                            </a>
                            <!-- Order Modal End-->
                            <a data-product_id="{{ $product->id }}" href="#"
                                class="btn btn-outline-primary rounded-0 w-100 py-3 add_to_cart_btn_product_single">
                                <i class="fa-solid fa-shopping-cart fa-fade"></i>
                                কার্ট এ যোগ করুন।
                            </a>
                        </div>
                        <div class="mt-3">
                            @php
                                $phoneNumber = '+8801832828385' . $product->phone; // prepend country code dynamically
                            @endphp

                            <a href="https://wa.me/{{ $phoneNumber }}" target="_blank"
                                class="btn btn-primary rounded-0 w-100 py-3 mb-2"
                                style="background-color: #25D366; border-color: #25D366; color: white;">
                                <i class="fab fa-whatsapp fa-bounce"></i>
                                হোয়াটসঅ্যাপ এ যোগ করুন।
                            </a>
                            <a href="tel:+8801832828385" target="_blank"
                                class="btn btn-primary rounded-0 w-100 py-3 mb-2">
                                <i class="fab fa-whatsapp fa-bounce"></i>
                                কল করুন।
                            </a>
                            <a href="https://www.facebook.com/messages/t/109206945276633" target="_blank"
                                class="btn btn-primary rounded-0 w-100 py-3 mb-2"
                                style="background: linear-gradient(90deg, #00B2FF, #006AFF, #00FFEB, #FFC700, #FF7EA5);
          border: none; color: #fff; font-weight: bold; text-shadow: 0 1px 3px rgba(0,0,0,0.2);">
                                <i class="fab fa-facebook-messenger fa-bounce"></i>
                                ফেসবুক এ মেসেজ দিন।
                            </a>
                        </div>
                        <div class="pt-3 pl-1">
                            <div class="table-responsive">
                                <table class="table border bg-white">
                                    <tbody>
                                        <tr class="">
                                            <td><small>ঢাকা মেট্রো সিটি ডেলিভারি খরচ :</small></td>
                                            <td>৬০ টাকা</td>
                                        </tr>
                                        <tr class="">
                                            <td><small>ডেমরা, কামরাঙ্গীরচর ডেলিভারি খরচ :</small></td>
                                            <td>৮০ টাকা</td>
                                        </tr>
                                        <tr class="">
                                            <td><small>সাভার, গাজীপুর, কেরানীগঞ্জ, নারায়ণগঞ্জ ডেলিভারি খরচ : </small>
                                            </td>
                                            <td>১০০ টাকা</td>
                                        </tr>
                                        <tr class="">
                                            <td><small>অন্যান্য জেলা, উপজেলা, বিভাগ ডেলিভারি খরচ : </small></td>
                                            <td>১৩০ টাকা</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="ps-page--product3">
        <div class="container">
            <div class="ps-page__content">
                <div class="ps-product--detail">
                    <div class="ps-product__content">
                        <ul class="nav nav-tabs ps-tab-list bg-white p-3" id="productContentTabs" role="tablist">

                            <li class="nav-item ml-3 pr-info-tabs" role="presentation">
                                <a class="nav-link show active" id="information-tab" data-toggle="tab"
                                    href="#information-content" role="tab" aria-controls="information-content"
                                    aria-selected="false">
                                    প্রোডাক্ট বিস্তারিত
                                </a>
                            </li>
                            <li class="nav-item ml-3 pr-info-tabs" role="presentation">
                                <a class="nav-link" id="description-tab" data-toggle="tab"
                                    href="#description-content" role="tab" aria-controls="description-content"
                                    aria-selected="true">
                                    প্রোডাক্ট ফিচার।
                                </a>
                            </li>
                            <li class="nav-item ml-3 pr-inf-tabs" role="presentation">
                                <a class="nav-link" id="specification-tab" data-toggle="tab"
                                    href="#specification-content" role="tab"
                                    aria-controls="specification-content" aria-selected="false">
                                    প্রোডাক্ট স্পেসিফিকেশন।
                                </a>
                            </li>
                            <li class="nav-item ml-3" role="presentation">
                                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews-content"
                                    role="tab" aria-controls="reviews-content" aria-selected="false">
                                    প্রোডাক্ট রিভিউ ({{ count($product->reviews) }})।
                                </a>
                            </li>
                            <li class="nav-item ml-3 pr-info-tabs" role="presentation">
                                <a class="nav-link" id="delivery-tab" data-toggle="tab" href="#delivery-process"
                                    role="tab" aria-controls="delivery-process" aria-selected="false">
                                    ডেলিভারি প্রসেস এবং রিটার্ন পলিসি।
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
                            <div class="tab-pane fade" id="delivery-process" role="tabpanel"
                                aria-labelledby="delivery-process">
                                <div class="ps-document">
                                    <div class="row row-reverse">
                                        <div class="col-12">
                                            <div>
                                                <p>
                                                    ডেলিভারি ও রিটার্ন পলিসি (বিস্তারিত)
                                                    পন্য অর্ডার করার আগে:
                                                </p>
                                                <h4>
                                                    <strong>বিস্তারিত তথ্য</strong> পণ্যের বিবরণ, ছবি এবং আপনার
                                                    প্রশ্নের উত্তর সঠিকভাবে পড়ুন। কোনো সন্দেহ থাকলে অবশ্যই আমাদের
                                                    সাথে যোগাযোগ করুন।
                                                </h4>

                                                <div class="my-3">
                                                    <h4 class="site-text">পণ্য ডেলিভারি:</h4>
                                                    <ul class="pl-3">
                                                        <li><strong>সময়:</strong> ডেলিভারির সময়কাল অর্ডারের ধরন এবং
                                                            আপনার অবস্থানের উপর নির্ভর করে। সাধারণত [ডেলিভারির গড় সময়]
                                                            দিনের মধ্যে আপনি পণ্যটি পাবেন।</li>
                                                        <li><strong>পদ্ধতি:</strong> আমরা Pathao এবং Steadfast
                                                            কুরিয়ারের মাধ্যমে ডেলিভারি করি।</li>
                                                        <li><strong>খরচ:</strong> ডেলিভারি খরচ পণ্যের মূল্য এবং
                                                            অবস্থানের উপর নির্ভর করে। ডেলিভারি খরচের বিস্তারিত তথ্য
                                                            অর্ডার সম্পন্ন করার সময় দেখতে পাবেন।</li>
                                                        <li><strong>পেমেন্ট:</strong> আপনি অগ্রিম বিকাশ বা নগদ এর
                                                            মাধ্যমে ডেলিভারি চার্জ দিতে পারবেন। বাকী টাকা আপনি পণ্য হাতে
                                                            পেয়ে দিতে পারবেন।</li>
                                                        <li><strong>ট্র্যাকিং:</strong> আপনি আপনার অর্ডারের স্ট্যাটাস
                                                            আমাদের ওয়েবসাইট বা অ্যাপের মাধ্যমে ট্র্যাক করতে পারবেন।
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="my-3">
                                                    <h4 class="site-text">পণ্য রিটার্ন:</h4>
                                                    <ul class="pl-3">
                                                        <li><strong>পণ্যের অবস্থা:</strong> পণ্যটি ছবি এবং বিবরণের সাথে
                                                            মিল থাকলে এবং ব্যবহৃত না হলে সাধারণত রিটার্ন করা যাবে।</li>
                                                        <li><strong>সময়সীমা:</strong> পণ্য গ্রহণের [দিন] দিনের মধ্যে
                                                            আপনি রিটার্ন করার জন্য আবেদন করতে পারবেন।</li>
                                                        <li><strong>বিনিময়:</strong> যদি পণ্যটি আপনার পছন্দ না হয়,
                                                            তাহলে আপনি ডেলিভারি ম্যানকে তাৎক্ষণিকভাবে ফেরত দিতে পারেন
                                                            অথবা আমাদের সাথে যোগাযোগ করে বিনিময়ের জন্য আবেদন করতে
                                                            পারবেন।</li>
                                                        <li><strong>রিফান্ড:</strong> রিফান্ডের ক্ষেত্রে, আমরা আপনার
                                                            প্রদানকৃত পেমেন্ট পদ্ধতির মাধ্যমে ২ দিনের মধ্যে অর্থ ফেরত
                                                            করে দেব।</li>
                                                        <li><strong>খরচ:</strong> রিফান্ডের ক্ষেত্রে পণ্য আনা-নেয়ার
                                                            সমস্ত খরচ আপনাকে বহন করতে হবে। তবে, যদি পণ্যটি ত্রুটিপূর্ণ
                                                            বা ভুল হয়ে থাকে, তাহলে আমরা ডেলিভারি খরচ বহন করব।</li>
                                                    </ul>
                                                </div>

                                                <ul class="pl-3">
                                                    <li><strong>ক্ষতিগ্রস্ত পণ্য:</strong> যদি ডেলিভারির সময় পণ্যটি
                                                        ক্ষতিগ্রস্ত হয়, তাহলে ডেলিভারি ম্যানকে তাৎক্ষণিকভাবে জানান এবং
                                                        আমাদের সাথে যোগাযোগ করুন। আমরা ক্ষতিগ্রস্ত পণ্যটি বিনামূল্যে
                                                        প্রতিস্থাপন করব।</li>
                                                    <li><strong>ভুল পণ্য:</strong> যদি ভুল পণ্য ডেলিভারি হয়, তাহলে আমরা
                                                        নিজ খরচে আপনাকে সঠিক পণ্য পাঠিয়ে দিব।</li>
                                                </ul>

                                                <div class="my-3">
                                                    <h4 class="site-text">অন্যান্য:</h4>
                                                    <ul class="pl-3">
                                                        <li><strong>যোগাযোগ:</strong> কোনো সমস্যা বা প্রশ্ন থাকলে,
                                                            আমাদের কাস্টমার কেয়ারে [ইমেইল, ফোন নম্বর, চ্যাট] এর মাধ্যমে
                                                            যোগাযোগ করুন।</li>
                                                        <li><strong>বাতিল:</strong> অর্ডার দেওয়ার পর ৬ ঘণ্টার মধ্যে
                                                            আপনি অর্ডারটি বাতিল করতে পারবেন।</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="ps-section--also" data-background="img/related-bg.jpg">
                    <div class="container px-0">
                        <h3 class="ps-section__title">গ্রাহক আরও কিনেছেন</h3>
                        <div class="owl-carousel">
                            @foreach ($related_products as $related_product)
                                <div class="ps-section__product border">
                                    <div class="ps-product ps-product--standard">
                                        <div class="ps-product__thumbnail">
                                            <a class="ps-product__image"
                                                href="{{ route('product.details', $related_product->slug) }}">
                                                <figure>
                                                    @if (!empty($related_product->thumbnail))
                                                        @php
                                                            $thumbnailPath = 'storage/' . $related_product->thumbnail;
                                                            $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                                ? asset($thumbnailPath)
                                                                : asset('frontend/img/no-product.jpg');
                                                        @endphp
                                                        <img src="{{ $thumbnailSrc }}"
                                                            alt="{{ $related_product->meta_title }}" width="210"
                                                            height="210" />
                                                    @else
                                                        @foreach ($related_product->multiImages->slice(0, 2) as $image)
                                                            @php
                                                                $imagePath = 'storage/' . $image->photo;
                                                                $imageSrc = file_exists(public_path($imagePath))
                                                                    ? asset($imagePath)
                                                                    : asset('frontend/img/no-product.jpg');
                                                            @endphp
                                                            <img src="{{ $imageSrc }}"
                                                                alt="{{ $related_product->meta_title }}"
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
                                                        href="{{ route('wishlist.store', $related_product->id) }}"><i
                                                            class="fa fa-heart-o"></i></a>
                                                </div>
                                                <div class="ps-product__item" data-toggle="tooltip"
                                                    data-placement="left" title="Quick view">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#popupQuickview{{ $related_product->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div class="ps-product__item" data-toggle="tooltip"
                                                    data-placement="left" title="Add To Cart">
                                                    <a class="add_to_cart"
                                                        href="{{ route('cart.store', $related_product->id) }}"
                                                        data-product_id="{{ $related_product->id }}"
                                                        data-product_qty="1">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </a>
                                                </div>

                                            </div>
                                            @if (!empty($related_product->unit_discount_price))
                                                <div class="ps-product__badge">
                                                    <div class="ps-badge ps-badge--sale">
                                                        -
                                                        {{ !empty($related_product->unit_discount_price) && $related_product->unit_discount_price > 0 ? number_format((($related_product->unit_price - $related_product->unit_discount_price) / $related_product->unit_price) * 100, 1) : 0 }}
                                                        % অফ
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ps-product__content">
                                            <h5 class="ps-product__title">
                                                <a href="{{ route('product.details', $related_product->slug) }}">
                                                    {{ implode(' ', array_slice(explode(' ', $related_product->name), 0, 5)) }}
                                                </a>
                                            </h5>
                                            <div class="pb-3">
                                                @if (!empty($related_product->unit_discount_price))
                                                    <div class="ps-product__meta">
                                                        <span
                                                            class="ps-product__price sale">{{ $related_product->unit_discount_price }}
                                                            টাকা</span>
                                                        <span
                                                            class="ps-product__del text-danger">{{ $related_product->unit_price }}
                                                            টাকা</span>
                                                    </div>
                                                @else
                                                    <div class="ps-product__meta">
                                                        <span
                                                            class="ps-product__price sale">{{ $related_product->unit_price }}
                                                            টাকা</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center card-cart-btn">
                                                <a href="{{ route('buy.now', $related_product->id) }}"
                                                    class="btn btn-primary rounded-0 w-100">
                                                    <i class="fa-solid fa-basket-shopping pr-2"></i>
                                                    অর্ডার করুন
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
                                                    data-placement="left" title="Wishlist"><a class="add_to_wishlist"
                                                        href="{{ route('wishlist.store', $related_product->id) }}"><i
                                                            class="fa fa-heart-o"></i></a>
                                                </div>
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
    {{-- @foreach ($products as $product) --}}
    <div class="modal fade rounded-0" id="order-product{{ $product->id }}" data-backdrop="static"
        data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered ps-quickview">
            <div class="modal-content">
                <div class="modal-header rounded-0" style="background-color: var(--site-primary);">
                    <h5 class="modal-title text-white">{{ $product->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="wrap-modal-slider container-fluid ps-quickview__body p-2">
                        {{-- Product ID: {{ $product->id }}
                        {{ $product->name }} --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <p style="font-size: large;text-align: center">
                                    <span class="text-danger">*</span> অর্ডার করতে,অনুগ্রহ করে আপনার সম্পূর্ণ নাম,
                                    মোবাইল নম্বর, সম্পূর্ণ ঠিকানা লিখুন এবং <span class="text-danger">অর্ডার কনফার্ম
                                        করুন</span> ক্লিক করুন
                                </p>
                            </div>
                            <div class="col-lg-12">
                                <form action="">
                                    <div class="ps-form--review row">
                                        <div class="col-12 col-xl-12">
                                            <div class="ps-form__group pt-2">
                                                <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                    for="first_name">আপনার সম্পূর্ণ নাম<span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input id="first_name" class="form-control ps-form__input"
                                                    type="text" name="first_name" value="Roth" autofocus=""
                                                    required="" autocomplete="first_name"
                                                    placeholder="Enter Your First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6 pr-0">
                                            <div class="ps-form__group pt-2">
                                                <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                    for="first_name">আপনার মোবাইল নম্বার... 01...<span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input id="first_name" class="form-control ps-form__input"
                                                    type="text" name="first_name" value="Roth" autofocus=""
                                                    required="" autocomplete="first_name"
                                                    placeholder="Enter Your First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6">
                                            <div class="ps-form__group pt-2">
                                                <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                    for="first_name">ডেলিভারি লোকেশন সিলেক্ট করুন।
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select name="title" class="form-select ps-form__input" required
                                                    id="title">
                                                    <option value="1" data-id="0" data-price="60.00">ঢাকা
                                                        মেট্রো সিটি
                                                        ( ৬০ Tk)</option>
                                                    <option value="2" data-id="1" data-price="80.00">ডেমরা,
                                                        কামরাঙ্গীরচর ( ৮০ Tk)</option>
                                                    <option value="4" data-id="2" data-price="100.00">সাভার,
                                                        গাজীপুর,
                                                        কেরানীগঞ্জ, নারায়ণগঞ্জ ( ১০০Tk )</option>
                                                    <option value="5" data-id="3" data-price="130.00">
                                                        অন্যান্য জেলা,
                                                        উপজেলা, বিভাগ ( ১৩০ TK )</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-12">
                                            <div class="ps-form__group pt-2">
                                                <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                    for="first_name">আপনার সম্পূর্ণ ঠিকানা যেমন গ্রাম , থানা , বিভাগ
                                                    লিখুন
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <textarea class="ps-form__input w-100" name="" id="" rows="3" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-12">
                                            <div class="ps-form__group pt-2">
                                                <label class="block font-medium text-sm text-gray-700 ps-form__label"
                                                    for="first_name">পেমেন্ট অপশন
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="checkout-checkbox">
                                                    <input class="inp-cbx" id="cbx-005" type="radio"
                                                        name="payment_method" />
                                                    <label class="cbx" for="cbx-005"><span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg></span><span>প্রোডাক্ট হাতে পাওয়ার পরে সম্পূর্ণ টাকা
                                                            পরিশোধ করবো।</span>
                                                    </label>
                                                </div>
                                                <div class="checkout-checkbox">
                                                    <input class="inp-cbx" id="cbx-006" type="radio"
                                                        name="payment_method" />
                                                    <label class="cbx" for="cbx-006"><span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg></span><span>শুধুমাত্র ডেলিভারি চার্জ পরিশোধ
                                                            করবো।</span>
                                                    </label>
                                                </div>
                                                <div class="checkout-checkbox">
                                                    <input class="inp-cbx" id="cbx-007" type="radio"
                                                        name="payment_method" checked />
                                                    <label class="cbx" for="cbx-007"><span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg></span><span>ফুল পেমেন্ট এখনি করবো।</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card p-0 mt-3 rounded-0">
                                                <div class="card-body p-0 rounded-0">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-3">
                                                            @php
                                                                $thumbnailPath = 'storage/' . $product->thumbnail;
                                                                $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                                    ? asset($thumbnailPath)
                                                                    : asset('frontend/img/no-product.jpg');
                                                            @endphp
                                                            <div class="">
                                                                <img src="{{ $thumbnailSrc }}" class="img-fluid"
                                                                    alt="{{ $product->name }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9 px-0">
                                                            <p class="mb-0"><strong>নামঃ
                                                                </strong>{{ $product->name }}</p>
                                                            <p class="mb-0"><strong>দামঃ </strong><span
                                                                    class="text-success">{{ $related_product->unit_price }}
                                                                    টাকা</span></p>
                                                            <p class="mb-0"><strong>সাইজঃ </strong>৪০</p>
                                                            <p class="mb-0"><strong>কত জোড়াঃ </strong>০১</p>
                                                        </div>
                                                    </div>
                                                    <div class="px-3 py-2"
                                                        style="background-color: var(--site-primary)">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-0 text-white">সাব টোটাল</p>
                                                            <p class="mb-0 text-white">৮৯৯.০০ টাকা</p>
                                                        </div>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center pt-1">
                                                            <p class="mb-0 text-white">ডেলিভারি চার্জ</p>
                                                            <p class="mb-0 text-white">৬০.০০ টাকা</p>
                                                        </div>
                                                        <hr class="mb-1 bg-white">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center pt-2">
                                                            <p class="mb-0 text-white">সর্বমোট মূল্য</p>
                                                            <p class="mb-0 text-white fw-bold"><strong>৯৫৯.০০
                                                                    টাকা</strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mt-3">
                                                <button type="submit"
                                                    class="btn btn-danger rounded-0 w-100 mr-3 py-3 fa-bounce"><i
                                                        class="fa-solid fa-shopping-cart pr-2"></i> অর্ডার কনফার্ম
                                                    করুন</button>
                                            </div>
                                            <p class="pt-3 text-center mb-0">উপরের বাটনে ক্লিক করলে আপনার অর্ডারটি সাথে
                                                সাথে কনফার্ম হয়ে যাবে !</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endforeach --}}
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
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('click', function(event) {
                // Check if the clicked element is a modal trigger button
                if (event.target.matches('[data-bs-toggle="modal"]')) {
                    // Get the target modal ID from the data-bs-target attribute
                    const modalId = event.target.getAttribute('data-bs-target');

                    // Initialize the modal dynamically
                    const myModal = new bootstrap.Modal(document.querySelector(modalId));
                    myModal.show();
                }
            });
        </script>
        <script>
            $(function() {
                var galleryTop, galleryThumbs;

                function initSwiper() {
                    // Destroy existing Swiper instances if they exist
                    if (galleryTop) {
                        galleryTop.destroy(true, true);
                    }
                    if (galleryThumbs) {
                        galleryThumbs.destroy(true, true);
                    }

                    if ($(window).width() > 768) {
                        // Initialize Swiper for desktop
                        galleryTop = new Swiper(".product-details-slide", {
                            spaceBetween: 10,
                            slidesPerView: 4,
                            direction: "vertical",
                            freeMode: false,
                            watchSlidesProgress: true,
                            loop: true, // Enable looping
                            autoplay: {
                                delay: 3000, // 3 seconds delay
                                disableOnInteraction: false, // Keep autoplay after user interaction
                            },
                            breakpoints: {
                                768: {
                                    slidesPerView: 4,
                                },
                                530: {
                                    slidesPerView: 3,
                                },
                                300: {
                                    slidesPerView: 2,
                                },
                            },
                        });
                        galleryThumbs = new Swiper(".mySwiper2", {
                            spaceBetween: 10,
                            navigation: {
                                nextEl: ".swiper-button-next",
                                prevEl: ".swiper-button-prev",
                            },
                            a11y: {
                                prevSlideMessage: "Previous slide",
                                nextSlideMessage: "Next slide",
                            },
                            thumbs: {
                                swiper: galleryTop,
                            },
                            loop: true, // Enable looping
                            autoplay: {
                                delay: 3000,
                                disableOnInteraction: false,
                            },
                        });
                    } else {
                        // Initialize Swiper for mobile
                        galleryTop = new Swiper(".mySwiper", {
                            spaceBetween: 10,
                            slidesPerView: 4,
                            freeMode: false,
                            watchSlidesProgress: true,
                            loop: true, // Enable looping
                            autoplay: {
                                delay: 3000,
                                disableOnInteraction: false,
                            },
                        });
                        galleryThumbs = new Swiper(".mySwiper2", {
                            spaceBetween: 10,
                            navigation: {
                                nextEl: ".swiper-button-next",
                                prevEl: ".swiper-button-prev",
                            },
                            a11y: {
                                prevSlideMessage: "Previous slide",
                                nextSlideMessage: "Next slide",
                            },
                            thumbs: {
                                swiper: galleryTop,
                            },
                            loop: true, // Enable looping
                            autoplay: {
                                delay: 3000,
                                disableOnInteraction: false,
                            },
                        });
                    }

                    // Sync the slide change between galleryTop and galleryThumbs
                    galleryTop.on("slideChangeTransitionStart", function() {
                        galleryThumbs.slideTo(galleryTop.activeIndex);
                    });
                    galleryThumbs.on("transitionStart", function() {
                        galleryTop.slideTo(galleryThumbs.activeIndex);
                    });
                }

                initSwiper();

                // Reinitialize Swiper on window resize
                $(window).resize(function() {
                    initSwiper();
                });
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
    @endpush
</x-frontend-app-layout>
