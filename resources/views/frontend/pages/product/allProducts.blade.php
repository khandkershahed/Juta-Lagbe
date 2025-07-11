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

        .ps-categogy .ps-categogy__wrapper {
            background-color: #fff;
            border-radius: 5px;
            padding: 0 20px;
            display: flex;
            margin-top: 0px !important;
        }

        .btn-check:checked+.btn {
            /* Optional: Customize the style for the active button */
            background-color: var(--site-primary);
            /* Change background color when active */
            color: white;
        }

        .btn-check {
            display: none;
            /* Hides the default radio button */
        }
    </style>
    <div class="ps-categogy">
        <div>
            <img class="img-fluid w-100" src="{{ asset('images/special-banner.jpg') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="shop-bread">
                        <ul class="ps-breadcrumb shop-breadcrumb">
                            <li class="ps-breadcrumb__item"><a href="/">Home</a></li>
                            <li class="ps-breadcrumb__item">Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="ps-categogy__content">
                <div class="row row-reverse">
                    <div class="order-12 col-md-9 col-12 order-lg-1">
                        <div class="px-1 mt-0 ps-categogy__wrapper d-flex justify-content-center">
                            <div class="py-0 text-left ps-categogy__sort w-100">
                                <form>
                                    <select id="sort-by" class="form-select">
                                        <option value="latest">সর্বশেষ</option>
                                        <option value="oldest">আগের</option>
                                        <option value="name-asc">পণ্যের নাম (A থেকে Z)</option>
                                        <option value="name-desc">পণ্যের নাম (Z থেকে A)</option>
                                        <option value="price-asc">মূল্য: কম থেকে বেশি</option>
                                        <option value="price-desc">মূল্য: বেশি থেকে কম</option>
                                    </select>
                                    {{-- <span>Sort by</span> --}}
                                </form>
                            </div>
                            <div class="py-0 text-right ps-categogy__show w-100">
                                <form>
                                    {{-- <span>Show</span> --}}
                                    <select id="show-per-page" class="w-auto form-select show_per_page">
                                        <option value="10" selected>১০</option>
                                        <option value="20">২০</option>
                                        <option value="30">৩০</option>
                                        <option value="40">৪০</option>
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
                        <div class="mb-5 ps-delivery ps-delivery--info"
                            data-background="{{ asset('images/delivery_banner.jpg') }}"
                            style="background-image: url({{ asset('images/delivery_banner.jpg') }});">
                            <div class="ps-delivery__content">
                                <div class="ps-delivery__text"> <i class="icon-shield-check"></i><span> <strong>১০০% সহজে ডেলিভারি নিন</strong> কুরিয়ারের সঙ্গে যোগাযোগ ছাড়াই।</span></div><a
                                    class="ps-delivery__more" href="{{ route('allproducts') }}">Shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 col-md-3 col-12 order-lg-12">
                        <div class="px-0 ps-widget ps-widget--product">
                            <div class="p-0 ps-widget__block">
                                <a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i>
                                </a>
                                <h4 class="p-3 shadow-sm ps-widget__title bg-light">
                                    <div class="d-flex align-items-center">
                                        <div>ক্যাটাগরি অনুযায়ী</div>
                                        <div class="title-line"></div>
                                    </div>
                                </h4>
                                <div class="pt-3 ps-widget__content ps-widget__category shop-filter">
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
                            <div class="bg-white ps-widget__block ps-widget__block-shop">
                                <a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i>
                                </a>
                                <h4 class="p-3 shadow-sm ps-widget__title bg-light">
                                    <div class="d-flex align-items-center">
                                        <div>দাম অনুযায়ী</div>
                                        <div class="title-line"></div>
                                    </div>
                                </h4>
                                <div class="px-0 ps-widget__content priceing-filter px-lg-4">
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
                            <div class="pt-2 bg-white ps-widget__block ps-widget__block-shop">
                                <a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i>
                                </a>
                                <h4 class="p-3 shadow-sm ps-widget__title bg-light">
                                    <div class="d-flex align-items-center">
                                        <div>ব্র্যান্ড অনুযায়ী </div>
                                        <div class="title-line"></div>
                                    </div>
                                </h4>
                                <div class="ps-widget__content">
                                    @foreach ($brands as $brand)
                                        <div class="p-0 ps-widget__item">
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
                            <div class="p-0 mt-0 bg-white ps-widget__block ps-widget__block-shop">
                                <h4 class="p-3 shadow-sm ps-widget__title bg-light">
                                    <div class="d-flex align-items-center">
                                        <div>সাইজ অনুযায়ী </div>
                                        <div class="title-line"></div>
                                    </div>
                                </h4>
                                <a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i></a>
                                <div class="px-4 py-4 ps-widget__content priceing-filter">
                                    <!-- Bootstrap Button Radios -->
                                    @php
                                        function convertToBengaliNumber($number)
                                        {
                                            $bnDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                                            return str_replace(range(0, 9), $bnDigits, $number);
                                        }
                                    @endphp

                                    @foreach ($sizes as $size)
                                        <div class="btn-group" role="group" aria-label="Size filter">
                                            <input type="radio" class="btn-check" name="size"
                                                id="size-{{ $size }}" value="{{ $size }}"
                                                autocomplete="off">
                                            <label class="w-auto my-2 mb-0 mr-2 btn btn-outline-primary rounded-0"
                                                for="size-{{ $size }}">
                                                {{ convertToBengaliNumber($size) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



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
                            button.text('✔'); // Change button text
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
                    // let sizes = []; // Collect selected sizes
                    let size = $('input[name="size"]:checked').val();
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
                    // $('input[name="size"]:checked').each(function() {
                    //     sizes.push($(this).val());
                    // });
                    // Send AJAX request
                    $.ajax({
                        url: '{{ route('products.filter') }}',
                        method: 'GET',
                        data: {
                            categories: categories,
                            subcategories: subcategories,
                            brands: brands,
                            sizes: size,
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
                $('.category-filter, .subcategory-filter, .brand-filter, #sort-by, #price-filter, #show-per-page, input[name="size"]')
                    .on(
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
