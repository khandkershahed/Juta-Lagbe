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
        .magnifier-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            /* Adjust width as needed */
            height: 100%;
            /* Adjust height as needed */
            cursor: crosshair;
        }

        .magnifier-container img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
            /* Smooth zoom */
        }

        .magnifier-container:hover img {
            transform: scale(1.5);
            /* Adjust zoom level */
            transition: transform 0.3s ease;
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
        .mySwiperDesktop .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .mySwiper .swiper-slide-thumb-active,
        .mySwiperDesktop .swiper-slide-thumb-active {
            opacity: 1;
        }

        .mySwiperDesktop {
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

            .kovi-product-slider-wrapper {
                display: flex;
                flex-direction: row;
            }

            .mySwiper2 {
                height: 100%;
            }

            .swiper {
                width: 100%;
                height: 700px;
            }

            .mySwiperDesktop .swiper-slide {
                width: 100%;
            }

            .mySwiperDesktop {
                width: calc(22% - 20px);
            }

            .mySwiper2 {
                width: 78%;
            }
        }

        @media (max-width: 767px) {
            .kovi-product-slider-wrapper {
                display: flex;
                flex-direction: column;
            }

            .mySwiperDesktop {
                display: none;
            }

            .kovi-product-slider-wrapper {
                width: 100%;
                height: 70%;
            }

            .mySwiperDesktop {
                height: 250px;
            }
            .releted-order{
                font-size: 14px !important;
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

            .product-details-juta .title {
                height: 100%;
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

        .select2-search--dropdown .select2-search__field {
            padding: 4px;
            width: 100%;
            box-sizing: border-box;
            height: 32px;
        }

        .overlay-iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
            cursor: not-allowed;
        }

        .product-details-juta .title {
            height: 65px;
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
                    <div class="kovi-product-slider-wrapper">
                        <div thumbsSlider="" class="swiper mySwiperDesktop">
                            <div class="bg-white swiper-wrapper">
                                @foreach ($product->multiImages as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $image->photo) }}" />
                                    </div>
                                @endforeach
                                {{-- Add Video at the End --}}
                                @if (!empty($product->video_link))
                                    <div class="swiper-slide">
                                        <div style="position: relative; width: 100%; height: 100%;">
                                            {{-- <iframe width="100%" height="100%"
                                                src="{{ $product->video_link }}&autoplay=0&controls=0&mute=1&modestbranding=0&rel=0&showinfo=0"
                                                title="YouTube video player" frameborder="0"
                                                referrerpolicy="strict-origin-when-cross-origin"></iframe> --}}
                                                <div class="player" data-plyr-provider="youtube"
                                                data-plyr-embed-id="{{ $product->video_link }}">
                                            </div>
                                            <div class="overlay-iframe"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Swiper -->
                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                            class="swiper mySwiper2">
                            <div class="swiper-wrapper">
                                {{-- Loop through images --}}
                                @foreach ($product->multiImages as $image)
                                    <div class="swiper-slide magnifier-container">
                                        <img src="{{ asset('storage/' . $image->photo) }}" />
                                    </div>
                                @endforeach

                                {{-- Add Video at the End --}}
                                @if (!empty($product->video_link))
                                    <div class="swiper-slide">
                                        <iframe width="100%" height="100%"
                                            src="{{ $product->video_link }}&autoplay=1&controls=0&mute=1&modestbranding=0&rel=0&showinfo=0"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </div>
                                @endif
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <div thumbsSlider="" class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach ($product->multiImages as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $image->photo) }}" />
                                    </div>
                                @endforeach
                                {{-- Add Video at the End --}}
                                @if (!empty($product->video_link))
                                    <div class="swiper-slide">
                                        <div style="position: relative; width: 100%; height: 100%;">
                                            <iframe width="100%" height="100%"
                                                src="{{ $product->video_link }}&autoplay=0&controls=0&mute=1&modestbranding=0&rel=0&showinfo=0"
                                                title="YouTube video player" frameborder="0"
                                                referrerpolicy="strict-origin-when-cross-origin"></iframe>
                                            <div class="overlay-iframe"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="pl-0 col-lg-5">
                    <div class="product-details-juta">
                        <h3 class="title">{{ $product->name }}</h3>
                        <div>
                            @if (!empty($product->stock) && $product->stock > 0)
                                <div class="mb-0">
                                    <span class="ps-badge bg-success rounded-0">Available</span>
                                </div>
                            @else
                                <div class="mb-0">
                                    <span class="ps-badge ps-badge--outstock rounded-0">Not Available</span>
                                </div>
                            @endif
                        </div>
                        <div class="pt-3 w-100">
                            @if (!empty($product->unit_discount_price))
                                <div class="d-flex justify-content-start align-items-center">
                                    <h3 class="mb-0">দামঃ</h3>
                                    <h3 class="pl-2 mb-0 text-success">{{ $product->unit_discount_price }} টাকা</h3>
                                    <h4 class="pl-4 mb-0 ps-product__del text-danger">{{ $product->unit_price }} টাকা
                                    </h4>
                                </div>
                            @else
                                <div class="d-flex align-items-center">
                                    <h3>দামঃ {{ $product->unit_price }} টাকা</h3>
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="pt-2 mb-0">প্রোডাক্ট কোডঃ <span
                                    class="text-danger">{{ $product->sku_code }}</span></p>
                        </div>
                        {{-- Size Variation End --}}
                        <div class="py-2 pt-4 ps-page__content row align-items-center">
                            <div class="ps-product--detail col-12 col-lg-3">
                                <div class="p-0 bg-transparent ps-product__feature">
                                    <div class="pb-0 ps-product__quantity rounded-0">
                                        <div class="def-number-input number-input safari_only w-100 rounded-0">
                                            <button class="minus"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                    class="text-white icon-minus"></i></button>
                                            <input class="quantity" min="1" name="quantity" value="1"
                                                type="number" data-product_id="{{ $product->id }}" />
                                            <button class="plus"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                    class="text-white icon-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-9">
                                <div class="d-flex size-box">
                                    @php
                                        $sizes = isset($product->size) ? json_decode($product->size, true) : [];
                                    @endphp

                                    @if (!empty($sizes))
                                        @foreach ($sizes as $size)
                                            <div class="mr-1 radio-wrapper-46 mr-lg-3">
                                                <input class="inp-radio" id="radio-{{ $size }}" name="size"
                                                    type="radio" value="{{ $size }}" />
                                                <label class="radio" for="radio-{{ $size }}">
                                                    <span>
                                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                            <circle cx="6" cy="6" r="4"></circle>
                                                        </svg>
                                                    </span>
                                                    <span>{{ $size }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="mb-0 no-sizes-text">No sizes available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 d-flex align-items-center card-cart-btn">
                            <!-- Order Modal  -->
                            @if (count($sizes) > 0)
                                <a href="#" data-product_id="{{ $product->id }}"
                                    class="py-3 btn btn-primary rounded-0 fa-bounce w-100 add_to_cart_btn_product_single">
                                    <i class="pr-2 fa-solid fa-basket-shopping"></i>
                                    অর্ডার করুন
                                </a>
                            @else
                                <button href="#" class="py-3 btn btn-secondary rounded-0 w-100" disabled>
                                    <i class="pr-2 fa-solid fa-basket-shopping"></i>
                                    অর্ডার করুন
                                </button>
                            @endif


                        </div>
                        {{-- <a href="#" class="py-3 btn btn-primary rounded-0 fa-bounce w-100" data-toggle="modal"
                            data-target="#order-product{{ $product->id }}">
                            <i class="pr-2 fa-solid fa-basket-shopping"></i>
                            অর্ডার করুন
                        </a> --}}
                        <!-- Order Modal End-->
                        <div class="mt-3">
                            @php
                                $phoneNumber = '+8801832828385' . $product->phone; // prepend country code dynamically
                            @endphp

                            <a href="https://wa.me/{{ $phoneNumber }}" target="_blank"
                                class="py-3 mb-2 btn btn-primary rounded-0 w-100"
                                style="background-color: #25D366; border-color: #25D366; color: white;">
                                <i class="fab fa-whatsapp"></i>
                                হোয়াটসঅ্যাপ এ যোগ করুন।
                            </a>
                            <a href="tel:+8801832828385" target="_blank"
                                class="py-3 mb-2 btn btn-primary rounded-0 w-100">
                                <i class="fa-solid fa-phone fa-bounce"></i>
                                কল করুন।
                            </a>
                            <a href="https://www.facebook.com/messages/t/109206945276633" target="_blank"
                                class="py-3 mb-2 btn btn-primary rounded-0 w-100"
                                style="background: linear-gradient(90deg, #00B2FF, #006AFF, #FF5F7E);
           border: none; color: #fff; font-weight: bold;
           text-shadow: 0 1px 3px rgba(0,0,0,0.2);">
                                <i class="fab fa-facebook-messenger"></i>
                                ফেসবুক এ মেসেজ দিন।
                            </a>
                        </div>
                        <div class="pt-3 pl-1">
                            <div class="table-responsive">
                                <table class="table bg-white border">
                                    <tbody>
                                        @foreach ($shippingmethods as $shippingmethod)
                                            <tr class="">
                                                <td><small>{{ $shippingmethod->title }} :</small></td>
                                                <td>{{ $shippingmethod->price }} টাকা</td>
                                            </tr>
                                        @endforeach
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
                        <ul class="p-3 bg-white nav nav-tabs ps-tab-list" id="productContentTabs" role="tablist">

                            <li class="ml-3 nav-item pr-info-tabs" role="presentation">
                                <a class="nav-link show active" id="information-tab" data-toggle="tab"
                                    href="#information-content" role="tab" aria-controls="information-content"
                                    aria-selected="false">
                                    প্রোডাক্ট বিস্তারিত
                                </a>
                            </li>

                            <li class="mt-3 ml-3 nav-item mt-lg-0 pr-info-tabs" role="presentation">
                                <a class="nav-link" id="delivery-tab" data-toggle="tab" href="#delivery-process"
                                    role="tab" aria-controls="delivery-process" aria-selected="false">
                                    ডেলিভারি প্রসেস এবং রিটার্ন পলিসি।
                                </a>
                            </li>
                        </ul>
                        <div class="p-5 bg-white tab-content" id="productContent">
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
                <section class="mb-0 ps-section--also mb-lg-3" data-background="img/related-bg.jpg">
                    <div class="container px-0">
                        <h3 class="ps-section__title">গ্রাহক আরও কিনেছেন</h3>
                        <div class="row g-0">
                            @foreach ($related_products->take(4) as $related_product)
                                <div class="pr-3 mb-4 col-md-3 col-sm-6 pr-lg-0">
                                    <div class="border ps-section__product">
                                        <div class="ps-product ps-product--standard">
                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image"
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
                                                                        : asset('frontend/img/no-product.jpg');
                                                                @endphp
                                                                <img src="{{ $imageSrc }}"
                                                                    alt="{{ $related_product->meta_title }}"
                                                                    width="210" height="210" />
                                                            @endforeach
                                                        @endif
                                                    </figure>
                                                </a>
                                                @if (!empty($related_product->unit_discount_price))
                                                    <div class="ps-product__badge">
                                                        <div class="ps-badge ps-badge--sale">
                                                            -{{ number_format((($related_product->unit_price - $related_product->unit_discount_price) / $related_product->unit_price) * 100, 1) }}%
                                                            অফ
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
                                                            <span class="ps-product__price sale fw-bold"
                                                                style="font-weight:600;">দাম
                                                                {{ $related_product->unit_discount_price }} টাকা</span>
                                                            <span
                                                                class="ps-product__del text-danger">{{ $related_product->unit_price }}
                                                                টাকা</span>
                                                        </div>
                                                    @else
                                                        <div class="ps-product__meta">
                                                            <span class="ps-product__price sale fw-bold"
                                                                style="font-weight:600;">দাম
                                                                {{ $related_product->unit_price }} টাকা</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center card-cart-btn">
                                                    <a href="{{ route('buy.now', $related_product->id) }}"
                                                        class="py-2 btn btn-primary rounded-0 w-100 releted-order py-lg-2">
                                                        <i class="pr-2 fa-solid fa-basket-shopping"></i> অর্ডার করুন
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
            </div>
        </div>
    </div>
    <div class="container-fluid" style="background-image: linear-gradient(to right, #020024,#090979,#009DBD);">
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
                        <img class="img-fluid" src="{{ asset('images/delivery-icons.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.pages.product.partial.productOrder')
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
                                    <div class="pl-0 col-12 col-xl-6">
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
                                    <div class="pr-0 col-12 col-xl-6">
                                        <div class="mb-0 ps-product__info">
                                            <div class="ps-product__badges">
                                                <span
                                                    class="ps-badge ps-badge--instock">{{ $related_product->box_stock > 0 ? 'IN STOCK' : 'OUT OF STOCK' }}</span>
                                            </div>
                                            <div class="pt-2 ps-product__branch">
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
                                                            <div class="ps-product__meta">
                                                                <span class="ps-product__price sale fw-bold"
                                                                    style="font-weight:600;">দাম
                                                                    {{ $related_product->unit_discount_price }}
                                                                    টাকা</span>
                                                                <span
                                                                    class="ps-product__del text-danger">{{ $related_product->unit_price }}
                                                                    টাকা</span>
                                                            </div>
                                                        @else
                                                            <div class="ps-product__meta">
                                                                <span class="ps-product__price sale fw-bold"
                                                                    style="font-weight:600;">দাম
                                                                    {{ $related_product->unit_price }}
                                                                    টাকা</span>
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
            document.querySelectorAll('.magnifier-container').forEach(container => {
                const img = container.querySelector('img');

                container.addEventListener('mousemove', (e) => {
                    const rect = container.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    const xPercent = (x / rect.width) * 100;
                    const yPercent = (y / rect.height) * 100;

                    img.style.transformOrigin = `${xPercent}% ${yPercent}%`;
                    img.style.transform = "scale(2)"; // Zoom level
                });

                container.addEventListener('mouseleave', () => {
                    img.style.transform = "scale(1)";
                    img.style.transformOrigin = "center center";
                });
            });
        </script>
        <!-- Initialize Select2 -->
        <script>
            $(document).ready(function() {
                // Apply Select2 to the 'thana' dropdown
                $('#thana').select2({
                    placeholder: "থানা সিলেক্ট করুন", // Placeholder text
                    allowClear: true, // Allow clearing the selection
                    matcher: function(params, data) {
                        // If there is no search term, return all options
                        if ($.trim(params.term) === '') {
                            return data;
                        }

                        // Perform case-insensitive matching on both the text and the data-name attribute
                        if (data.text.toLowerCase().includes(params.term.toLowerCase()) ||
                            $(data.element).data('name').toLowerCase().includes(params.term.toLowerCase())
                        ) {
                            return data;
                        }

                        // If no match, return null
                        return null;
                    },
                    width: '100%' // Set the width to 100%
                });

                // Apply Select2 to the 'district' dropdown
                $('#district').select2({
                    placeholder: "জেলা সিলেক্ট করুন",
                    allowClear: true,
                    matcher: function(params, data) {
                        // If there is no search term, return all options
                        if ($.trim(params.term) === '') {
                            return data;
                        }

                        // Perform case-insensitive matching on both the text and the data-name attribute
                        if (data.text.toLowerCase().includes(params.term.toLowerCase()) ||
                            $(data.element).data('name').toLowerCase().includes(params.term.toLowerCase())
                        ) {
                            return data;
                        }

                        // If no match, return null
                        return null;
                    }
                });
            });
        </script>
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
                        galleryTop = new Swiper(".mySwiperDesktop", {
                            spaceBetween: 10,
                            slidesPerView: 4,
                            direction: "vertical",
                            freeMode: false,
                            watchSlidesProgress: true,
                            loop: true,
                            autoplay: {
                                delay: 3000,
                                disableOnInteraction: false,
                                pauseOnMouseEnter: true, // Pause autoplay on hover
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
                            loop: true,
                            autoplay: {
                                delay: 3000,
                                disableOnInteraction: false,
                                pauseOnMouseEnter: true, // Pause autoplay on hover
                            },
                        });
                    } else {
                        // Initialize Swiper for mobile
                        galleryTop = new Swiper(".mySwiper", {
                            spaceBetween: 10,
                            slidesPerView: 4,
                            freeMode: false,
                            watchSlidesProgress: true,
                            loop: true,
                            autoplay: {
                                delay: 3000,
                                disableOnInteraction: false,
                                pauseOnMouseEnter: true, // Pause autoplay on hover
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
                            loop: true,
                            autoplay: {
                                delay: 3000,
                                disableOnInteraction: false,
                                pauseOnMouseEnter: true, // Pause autoplay on hover
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
        {{-- <script>
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
                            loop: true,
                            autoplay: {
                                delay: 3000,
                                disableOnInteraction: false,
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
                            loop: true,
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
                            loop: true,
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
                            loop: true,
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

                    // Add hover pause functionality
                    $(".product-details-slide, .mySwiper2").on("mouseenter", function() {
                        galleryTop.autoplay.stop();
                        galleryThumbs.autoplay.stop();
                    });

                    $(".product-details-slide, .mySwiper2").on("mouseleave", function() {
                        galleryTop.autoplay.start();
                        galleryThumbs.autoplay.start();
                    });
                }

                initSwiper();

                // Reinitialize Swiper on window resize
                $(window).resize(function() {
                    initSwiper();
                });
            });
        </script> --}}

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
