<x-frontend-app-layout :title="'All Products'">
    <style>
        /* Ensure all elements use border-box sizing */
        .checkbox-shop * {
            box-sizing: border-box;
        }

        .ps-categogy .ps-categogy__sort select,
        .ps-categogy .ps-categogy__onsale select {
            max-width: 250px;
        }

        .checkbox-shop .cbx {
            -webkit-user-select: none;
            user-select: none;
            cursor: pointer;
            padding: 15px 20px;
            border-radius: 6px;
            font-size: 17px;
            line-height: 24px;
            font-weight: 500;
            font-style: normal;
            color: #103178;
            overflow: hidden;
            transition: background 0.2s ease, border-color 0.2s ease;
            display: inline-block;
            background: #fff;
            width: 100%;
            position: relative;
        }

        /* Adjust spacing between checkboxes */
        .checkbox-shop .cbx:not(:last-child) {
            margin-right: 6px;
        }

        /* Hover effect */
        .checkbox-shop .cbx:hover {
            background: rgba(0, 119, 255, 0.06);
        }

        /* Styling for checkbox and SVG */
        .checkbox-shop .cbx span {
            float: left;
            vertical-align: middle;
        }

        .checkbox-shop .cbx span:first-child {
            position: relative;
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid #cccfdb;
            transition: border-color 0.2s ease;
            box-shadow: 0 1px 1px rgba(0, 16, 75, 0.05);
        }

        .checkbox-shop .cbx span:first-child svg {
            position: absolute;
            top: 3px;
            left: 2px;
            fill: none;
            stroke: #fff;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 16px;
            stroke-dashoffset: 16px;
            transition: stroke-dashoffset 0.3s ease 0.1s;
        }

        /* Label text styling */
        .checkbox-shop .cbx span:last-child {
            padding-left: 8px;
            line-height: 18px;
        }

        /* Checked state background */
        .checkbox-shop .inp-cbx:checked+.cbx {
            background: rgba(0, 119, 255, 0.06);
        }

        .checkbox-shop .inp-cbx:checked+.cbx span:first-child {
            background: #07f;
            border-color: #07f;
        }

        .checkbox-shop .inp-cbx:checked+.cbx span:first-child svg {
            stroke-dashoffset: 0;
            fill: #0077ff;
            /* Change color of the SVG when checked */
        }

        /* Hide default checkbox appearance */
        .checkbox-shop .inp-cbx {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Style for inline SVG */
        .checkbox-shop .inline-svg {
            display: none;
        }

        /* Responsive design for small screens */
        @media screen and (max-width: 640px) {
            .checkbox-shop .cbx {
                width: 100%;
                display: inline-block;
            }
        }

        /* Keyframes for checked state animation */
        @keyframes wave-4 {
            50% {
                transform: scale(0.9);
            }
        }
    </style>
    <div class="ps-categogy">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="shop-bread">
                        <ul class="ps-breadcrumb shop-breadcrumb">
                            <li class="ps-breadcrumb__item"><a href="/">Home</a></li>
                            <li class="ps-breadcrumb__item">Shop</li>
                        </ul>
                        <h1 class="ps-categogy__name">Shop <sup>(<span class="productCount">{{ $products->count() }}</span>)</sup></h1>
                    </div>
                </div>
                <div class="col-12 col-md-9 d-flex align-items-center">
                    <div>
                        <img class="img-fluid shop-top-banner" src="{{ asset('frontend/img/shop-banner-bg.jpg') }}"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="ps-categogy__content">
                <div class="row row-reverse">
                    <div class="col-md-9 col-12 order-12 order-lg-1">
                        <div class="ps-categogy__wrapper d-flex justify-content-center px-1">
                            <div class="ps-categogy__sort w-100 text-left py-0">
                                <form>
                                    <select id="sort-by" class="form-select">
                                        <option value="latest">Latest</option>
                                        <option value="oldest">Oldest</option>
                                        <option value="name-asc">Product Name Ascending(A to Z)</option>
                                        <option value="name-desc">Product Name Descending(Z to A)</option>
                                        <option value="price-asc">Price: low to high</option>
                                        <option value="price-desc">Price: high to low</option>
                                    </select>
                                    {{-- <span>Sort by</span> --}}
                                </form>
                            </div>
                            <div class="ps-categogy__show w-100 text-right py-0">
                                <form>
                                    {{-- <span>Show</span> --}}
                                    <select id="show-per-page" class="form-select w-auto show_per_page">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div id="productContainer">
                            @include('frontend.pages.product.partial.getProduct')
                        </div>
                        {{-- <div class="ps-pagination">
                            {{ $products->links() }}
                        </div> --}}
                        <div class="ps-delivery ps-delivery--info mb-5"
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
                    <div class="col-md-3 col-12 order-1 order-lg-12">
                        <div class="ps-widget ps-widget--product">
                            <div class="ps-widget__block p-0">
                                <h4 class="ps-widget__title">Categories</h4>
                                <a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i>
                                </a>
                                <div class="ps-widget__content ps-widget__category pt-3 shop-filter">
                                    <ul class="">
                                        @foreach ($categories as $category)
                                            <li>
                                                <div class="checkbox-shop">
                                                    <input type="checkbox" class="category-filter inp-cbx"
                                                        data-id="{{ $category->id }}"
                                                        id="category_{{ $category->name }}" />
                                                    <label class="cbx" for="category_{{ $category->name }}">
                                                        <span>
                                                            <svg width="12px" height="10px">
                                                                <use xlink:href="#check-4"></use>
                                                            </svg>
                                                        </span>
                                                        <span>{{ $category->name }}</span>
                                                    </label>
                                                    <svg class="inline-svg">
                                                        <symbol id="check-4" viewbox="0 0 12 10">
                                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                        </symbol>
                                                    </svg>
                                                </div>

                                                {{-- <input type="checkbox" class="category-filter"
                                                    data-id="{{ $category->id }}" id="category_{{ $category->name }}" />
                                                <label class="label"
                                                    for="category_{{ $category->name }}">{{ $category->name }}</label> --}}



                                                @foreach ($category->children as $subCat)
                                                    <span class="sub-toggle">
                                                        <i class="fa fa-chevron-down"></i>
                                                    </span>
                                                    <ul class="sub-menu">
                                                        <li>
                                                            <div class="checkbox-shop">
                                                                <input type="checkbox"
                                                                    class="subcategory-filter inp-cbx"
                                                                    data-id="{{ $subCat->id }}"
                                                                    id="category_{{ $subCat->name }}" />
                                                                <label class="cbx"
                                                                    for="category_{{ $subCat->name }}">
                                                                    <span>
                                                                        <svg width="12px" height="10px">
                                                                            <use xlink:href="#check-4"></use>
                                                                        </svg>
                                                                    </span>
                                                                    <span>{{ $subCat->name }}</span>
                                                                </label>
                                                                <svg class="inline-svg">
                                                                    <symbol id="check-4" viewbox="0 0 12 10">
                                                                        <polyline points="1.5 6 4.5 9 10.5 1">
                                                                        </polyline>
                                                                    </symbol>
                                                                </svg>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="ps-widget__block ps-widget__block-shop bg-white p-lg-3 p-0 ">
                                <h4 class="ps-widget__title">By price</h4><a class="ps-block-control" href="#"><i
                                        class="fa fa-angle-down"></i></a>
                                <div class="ps-widget__content priceing-filter">
                                    <div class="ps-widget__price">
                                        <div id="slide-price" class="noUi-target noUi-ltr noUi-horizontal"></div>
                                    </div>
                                    <div class="ps-widget__input">
                                        <span class="ps-price" id="slide-price-min">৳10</span><span
                                            class="bridge">-</span><span class="ps-price"
                                            id="slide-price-max">৳10000</span>
                                        <input type="hidden" id="price-min" name="price_min" value="10" />
                                        <input type="hidden" id="price-max" name="price_max" value="10000" />
                                    </div>
                                    {{-- <button id="price-filter" class="ps-widget__filter">Filter</button> --}}
                                </div>
                            </div>
                            <div class="ps-widget__block ps-widget__block-shop bg-white p-3">
                                <h4 class="ps-widget__title">Brands</h4><a class="ps-block-control" href="#"><i
                                        class="fa fa-angle-down"></i></a>
                                <div class="ps-widget__content">
                                    @foreach ($brands as $brand)
                                        <div class="ps-widget__item p-0">
                                            <div class="checkbox-shop">
                                                <input type="checkbox" class="brand-filter inp-cbx"
                                                    data-id="{{ $brand->id }}"
                                                    id="category_{{ $brand->name }}" />
                                                <label class="cbx" for="category_{{ $brand->name }}">
                                                    <span>
                                                        <svg width="12px" height="10px">
                                                            <use xlink:href="#check-4"></use>
                                                        </svg>
                                                    </span>
                                                    <span>{{ $brand->name }}</span>
                                                </label>
                                                <svg class="inline-svg">
                                                    <symbol id="check-4" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </symbol>
                                                </svg>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @if ($deal)
                                <div class="ps-widget__promo">
                                    {{-- <img src="{{ asset('frontend/img/banner-sidebar1.jpg') }}" alt=""> --}}
                                    <div class="ps-promo__item">
                                        @if (optional($deal)->image)
                                            <img class="ps-promo__banner"
                                                src="{{ asset('storage/' . optional($deal)->image) }}"
                                                alt="alt" />
                                        @endif
                                        <div class="ps-promo__content">
                                            <h4 class="text-dark ps-promo__name">
                                                {{ optional($deal)->title }}
                                            </h4>
                                            @if (optional($deal)->offer_price && optional($deal)->price)
                                                <div class="ps-promo__meta">
                                                    <p class="ps-promo__price text-warning">
                                                        ৳ {{ number_format(optional($deal)->offer_price, 2) }}</p>
                                                    <p class="ps-promo__del text-dark">
                                                        ৳ {{ number_format(optional($deal)->price, 2) }}</p>
                                                </div>
                                            @endif
                                            @if (!empty(optional($deal)->button_link))
                                                <a class="btn-green ps-promo__btn"
                                                    href="{{ optional($deal)->button_link }}">{{ optional($deal)->button_name }}</a>
                                            @elseif (!empty(optional($deal)->product_id))
                                                <a class="btn-green ps-promo__btn"
                                                    href="{{ route('product.details', optional($deal)->product->slug) }}">Buy
                                                    now</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($products as $product)
        <div class="modal fade" id="popupQuickview{{ $product->id }}" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered ps-quickview">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="wrap-modal-slider container-fluid ps-quickview__body">
                            <button class="close ps-quickview__close" type="button" data-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="ps-product--detail">
                                <div class="row">
                                    <div class="col-12 col-xl-6">
                                        <div class="ps-product--gallery">
                                            <div class="ps-product__thumbnail">
                                                @if ($product->multiImages->isNotEmpty())
                                                    @foreach ($product->multiImages->slice(0, 5) as $image)
                                                        @php
                                                            $imagePath = 'storage/' . $image->photo;
                                                            $imageSrc = file_exists(public_path($imagePath))
                                                                ? asset($imagePath)
                                                                : asset('frontend/img/no-product.jpg');
                                                        @endphp
                                                        <div class="slide">
                                                            <img src="{{ $imageSrc }}"
                                                                alt="{{ $product->name }}" />
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @php
                                                        $thumbnailPath = 'storage/' . $product->thumbnail;
                                                        $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                            ? asset($thumbnailPath)
                                                            : asset('frontend/img/no-product.jpg');
                                                    @endphp
                                                    <div class="slide">
                                                        <img src="{{ $thumbnailSrc }}" alt="{{ $product->name }}" />
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ps-gallery--image">
                                                @if ($product->multiImages->isNotEmpty())
                                                    @foreach ($product->multiImages->slice(0, 5) as $image)
                                                        @php
                                                            $imagePath = 'storage/' . $image->photo;
                                                            $imageSrc = file_exists(public_path($imagePath))
                                                                ? asset($imagePath)
                                                                : asset('frontend/img/no-product.jpg');
                                                        @endphp
                                                        <div class="slide">
                                                            <div class="ps-gallery__item">
                                                                <img src="{{ $imageSrc }}"
                                                                    alt="{{ $product->name }}" />
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @php
                                                        $thumbnailPath = 'storage/' . $product->thumbnail;
                                                        $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                            ? asset($thumbnailPath)
                                                            : asset('frontend/img/no-product.jpg');
                                                    @endphp
                                                    <div class="slide">
                                                        <div class="ps-gallery__item">
                                                            <img src="{{ $thumbnailSrc }}"
                                                                alt="{{ $product->name }}" />
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="ps-product__info">
                                            <div class="ps-product__badge">
                                                <span
                                                    class="ps-badge ps-badge--instock">{{ $product->box_stock > 0 ? 'IN STOCK' : 'OUT OF STOCK' }}</span>
                                            </div>
                                            <div class="ps-product__branch">
                                                <a href="#">{{ optional($product->brand)->name }}</a>
                                            </div>
                                            <h5 class="ps-product__title">
                                                <a href="{{ route('product.details', $product->slug) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </h5>
                                            <div class="ps-product__desc">
                                                <p>{!! $product->short_description !!}</p>
                                            </div>
                                            @if (!empty($product->unit_discount_price))
                                                <div class="ps-product__meta">
                                                    <span
                                                        class="ps-product__price sale">৳{{ $product->unit_discount_price }}</span>
                                                    <span class="ps-product__del">৳{{ $product->unit_price }}</span>
                                                </div>
                                            @else
                                                <div class="ps-product__meta">
                                                    <span
                                                        class="ps-product__price sale">৳{{ $product->unit_price }}</span>
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
                                                        data-product_id="{{ $product->id }}" />
                                                    <button class="plus"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                            class="icon-plus"></i></button>
                                                </div>
                                            </div>

                                            <a class="ps-btn ps-btn--warning add_to_cart_btn_product_single"
                                                data-product_id="{{ $product->id }}" href="#">Add to
                                                cart</a>
                                            <div class="ps-product__type">
                                                <ul class="ps-product__list">

                                                    <li><span class="ps-list__title">SKU-Code: </span><a
                                                            class="ps-list__text"
                                                            href="#">{{ $product->sku_code }}</a>
                                                    </li>
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
        </div>
    @endforeach

    @push('scripts')
        <script>
            function addToWishlist(event, url) {
                event.preventDefault(); // Prevent the default action of the link
                var button = $(this);
                var product_id = button.data('product_id');
                var user_id = button.data('product_id');
                var wishlistUrl = url;
                // var wishlistUrl = $(this).attr('href');
                var wishlistCount = $('.wishlistCount');
                // Check if quantity is valid

                $.ajax({
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: wishlistUrl,
                    dataType: 'json',
                    success: function(data) {
                        const Toast = Swal.mixin({
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });

                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            });
                            button.prop('disabled', true); // Disable the button
                            button.text('Included'); // Change button text
                            wishlistCount.html(data.wishlistCount);
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Something went wrong!'; // Default message

                        // Check if the response is JSON and contains an error message
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            try {
                                let response = JSON.parse(xhr.responseText);
                                if (response.message) {
                                    errorMessage = response.message;
                                }
                            } catch (e) {
                                // If responseText is not JSON, use default message
                                console.error('Error parsing response text:', e);
                            }
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage
                        });
                    }
                });
            }

            function addToCartShop(event, product_id) {
                event.preventDefault(); // Prevent the default action of the link

                var $quantityInput = $(event.target).closest('.ps-product').find('.quantity');
                var qty = $quantityInput.val();
                var cartHeader = $('.miniCart');
                // Check if quantity is valid
                if (qty <= 0 || isNaN(qty)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Invalid Quantity',
                        text: 'Please select a valid quantity.'
                    });
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: '/cart/store/' + product_id,
                    data: {
                        _token: "{{ csrf_token() }}", // Include CSRF token for security
                        quantity: qty
                    },
                    dataType: 'json',
                    success: function(data) {
                        const Toast = Swal.mixin({
                            showConfirmButton: false,
                            timer: 3000
                        });

                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            });
                            // alert(data.subTotal);
                            if (data.subTotal > 4000) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Congratulations!',
                                    text: "Your shipping is now free. Happy Shopping!",
                                })
                            };
                            // Update mini cart
                            cartHeader.html(data.cartHeader);
                            $(".cartCount").html(data.cartCount);
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'An unexpected error occurred.';

                        // Check if the response is JSON and contains an error message
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        } else if (xhr.responseText) {
                            try {
                                let response = JSON.parse(xhr.responseText);
                                if (response.error) {
                                    errorMessage = response.error;
                                }
                            } catch (e) {
                                console.error('Error parsing response text:', e);
                            }
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage
                        });
                    }
                });
            }
        </script>
        <script>
            // $(document).ready(function() {
            //     // Initialize noUiSlider
            //     var priceSlider = document.getElementById('slide-price');
            //     noUiSlider.create(priceSlider, {
            //         start: [1, 10000], // Default values
            //         connect: true,
            //         range: {
            //             'min': [0],
            //             'max': [10000]
            //         },
            //         step: 1,
            //         format: {
            //             to: function(value) {
            //                 return '৳' + value.toFixed(2);
            //             },
            //             from: function(value) {
            //                 return Number(value.replace('৳', ''));
            //             }
            //         }
            //     });

            //     // Update hidden inputs and displayed values, and trigger filtering
            //     priceSlider.noUiSlider.on('update', function(values, handle) {
            //         $('#slide-price-min').text(values[0]);
            //         $('#slide-price-max').text(values[1]);
            //         $('#price-min').val(values[0].replace('৳', ''));
            //         $('#price-max').val(values[1].replace('৳', ''));

            //         // Trigger filtering when slider values change
            //         filterProducts();
            //     });

            //     function filterProducts() {
            //         let categories = [];
            //         let subcategories = [];
            //         let brands = [];
            //         let priceMin = $('#price-min').val();
            //         let priceMax = $('#price-max').val();
            //         let sortBy = $('#sort-by').val();
            //         let showPage = $('#show-per-page').val();

            //         $('.category-filter:checked').each(function() {
            //             categories.push($(this).data('id'));
            //         });

            //         $('.subcategory-filter:checked').each(function() {
            //             subcategories.push($(this).data('id'));
            //         });

            //         $('.brand-filter:checked').each(function() {
            //             brands.push($(this).data('id'));
            //         });

            //         $.ajax({
            //             url: '{{ route('products.filter') }}',
            //             method: 'GET',
            //             data: {
            //                 categories: categories,
            //                 subcategories: subcategories,
            //                 brands: brands,
            //                 price_min: priceMin,
            //                 price_max: priceMax,
            //                 sort_by: sortBy,
            //                 showPage: showPage,
            //             },
            //             success: function(response) {
            //                 $('#productContainer').html(response);
            //             }
            //         });
            //     }

            //     // Trigger filtering on change
            //     $('.category-filter, .subcategory-filter, .brand-filter, #sort-by, #price-filter, #show-per-page').on(
            //         'change',
            //         function() {
            //             filterProducts();
            //         });

            //     // Initial filtering
            //     filterProducts();
            // });
            $(document).ready(function() {
                var priceSlider = document.getElementById('slide-price');
                noUiSlider.create(priceSlider, {
                    start: [1, 10000], // Default values
                    connect: true,
                    range: {
                        'min': [0],
                        'max': [10000]
                    },
                    step: 1,
                    format: {
                        to: function(value) {
                            return '৳' + value.toFixed(2);
                        },
                        from: function(value) {
                            return Number(value.replace('৳', ''));
                        }
                    }
                });

                // Update hidden inputs and displayed values, and trigger filtering
                priceSlider.noUiSlider.on('update', function(values, handle) {
                    $('#slide-price-min').text(values[0]);
                    $('#slide-price-max').text(values[1]);
                    $('#price-min').val(values[0].replace('৳', ''));
                    $('#price-max').val(values[1].replace('৳', ''));

                    // Trigger filtering when slider values change
                    fetchProducts();
                });

                function fetchProducts(page = 1) {
                    // Collect filter data
                    let categories = [];
                    let subcategories = [];
                    let brands = [];
                    let priceMin = $('#price-min').val();
                    let priceMax = $('#price-max').val();
                    let sortBy = $('#sort-by').val();
                    let showPage = $('#show-per-page').val();

                    $('.category-filter:checked').each(function() {
                        categories.push($(this).data('id'));
                    });

                    $('.subcategory-filter:checked').each(function() {
                        subcategories.push($(this).data('id'));
                    });

                    $('.brand-filter:checked').each(function() {
                        brands.push($(this).data('id'));
                    });

                    // Send AJAX request
                    $.ajax({
                        url: '{{ route('products.filter') }}',
                        method: 'GET',
                        data: {
                            categories: categories,
                            subcategories: subcategories,
                            brands: brands,
                            price_min: priceMin,
                            price_max: priceMax,
                            sort_by: sortBy,
                            showPage: showPage,
                            page: page // Pagination page number
                        },
                        beforeSend: function() {
                            $('#productContainer').html('<div class="loading-spinner">Loading...</div>');
                        },
                        success: function(response) {
                            $('#productContainer').html(response.html);
                            $('.productCount').html(response.productCount);
                            // $('html, body').animate({
                            //     scrollTop: $('#productContainer').offset().top
                            // }, 500);
                        },
                        error: function(xhr) {
                            console.error("Error fetching products:", xhr.responseText);
                        }
                    });
                }

                // Filter form change event
                $('.category-filter, .subcategory-filter, .brand-filter, #sort-by, #price-filter, #show-per-page').on(
                    'change',
                    function() {
                        fetchProducts();
                    });
                // $('#filterForm input, #filterForm select').on('change', function() {
                //     fetchProducts();
                // });

                // Pagination click event
                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    fetchProducts(page);
                });
            });
        </script>
    @endpush
</x-frontend-app-layout>
