<x-frontend-app-layout :title="'Category Details'">
    <style>
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active-cat {
            color: var(--site-primary) !important;
            background-color: transparent;
            border-color: 0px;
            border-radius: 0;
            font-weight: bold;
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

    <div class="bg-white ps-categogy ps-categogy--dark">
        <div class="container-fluid">
            <div class="row">
                <div class="px-0 col-lg-12">
                    <div class="category-banner">
                        {{-- <img class="img-fluid" src="{{ asset('storage/' . $category->banner_image) }}" alt=""> --}}
                        <img class="img-fluid" style="object-fit: cover;height: 200px;width: 100%;"
                            src="{{ asset('storage/' . $category->banner_image) }}"
                            onerror="this.onerror=null; this.src='{{ asset('images/no-preview2.png') }}';" alt="">
                        <!-- Fallback for missing image -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="pt-2 ps-categogy__content mt-0 pt-0 pt-lg-3 mt-lg-3 ">
                <div class="pb-0 row row-reverse pb-lg-5 pt-0 pt-lg-3">
                    <!-- Products Section -->
                    <div class="order-12 col-md-9 col-12 order-lg-1">
                        <!-- Display individual product data -->
                        <div class="products">

                            @if ($catProducts->isEmpty())
                                <div class="text-center bg-white col-12 if-show-img">
                                    <img class="" style="width: 320px;"
                                        src="{{ asset('frontend/img/no-products-category.jpg') }}" alt="">
                                </div>
                            @else
                                <div class="mt-0 ps-categogy--grid border-0">
                                    <div class="m-0 row">
                                        @foreach ($catProducts as $key => $category_product)
                                            <div
                                                class="col-6 col-lg-4 p-0 product-item">
                                                <div class="pr-2 ps-section__product">
                                                    <div class="ps-product ps-product--standard">
                                                        <div class="ps-product__thumbnail">
                                                            <a class="ps-product__image"
                                                                href="{{ route('product.details', $category_product->slug) }}">
                                                                <figure>
                                                                    @if (!empty($category_product->thumbnail))
                                                                        @php
                                                                            $thumbnailPath =
                                                                                'storage/' .
                                                                                $category_product->thumbnail;
                                                                            $thumbnailSrc = file_exists(
                                                                                public_path($thumbnailPath),
                                                                            )
                                                                                ? asset($thumbnailPath)
                                                                                : asset('frontend/img/no-product.jpg');
                                                                        @endphp
                                                                        <img src="{{ $thumbnailSrc }}"
                                                                            alt="{{ $category_product->meta_title }}"
                                                                            width="210" height="210" />
                                                                    @else
                                                                        @foreach ($category_product->multiImages->slice(0, 2) as $image)
                                                                            @php
                                                                                $imagePath = 'storage/' . $image->photo;
                                                                                $imageSrc = file_exists(
                                                                                    public_path($imagePath),
                                                                                )
                                                                                    ? asset($imagePath)
                                                                                    : asset(
                                                                                        'frontend/img/no-product.jpg',
                                                                                    );
                                                                            @endphp
                                                                            <img src="{{ $imageSrc }}"
                                                                                alt="{{ $category_product->meta_title }}"
                                                                                width="210" height="210" />
                                                                        @endforeach
                                                                    @endif
                                                                </figure>
                                                            </a>
                                                            {{-- Review --}}
                                                            @if (count($category_product->reviews) > 0)
                                                                <div>
                                                                    @php
                                                                        $review =
                                                                            count($category_product->reviews) > 0
                                                                                ? optional(
                                                                                        $category_product->reviews,
                                                                                    )->sum('rating') /
                                                                                    count($category_product->reviews)
                                                                                : 0;
                                                                    @endphp
                                                                    <div
                                                                        class="px-3 my-2 d-flex justify-content-between align-items-center rating-area">
                                                                        <div style="color: var(--site-primary)">
                                                                            Reviews
                                                                            ({{ count($category_product->reviews) }})
                                                                        </div>
                                                                        <div class="ps-product__rating">
                                                                            @if ($review > 0)
                                                                                <div
                                                                                    class="br-wrapper br-theme-fontawesome-stars">
                                                                                    <select class="ps-rating"
                                                                                        data-read-only="true"
                                                                                        style="display: none;">
                                                                                        @php
                                                                                            $maxRating = min(
                                                                                                5,
                                                                                                max(1, floor($review)),
                                                                                            ); // Get the highest full rating value
                                                                                        @endphp
                                                                                        @for ($i = 1; $i <= $maxRating; $i++)
                                                                                            <option
                                                                                                value="{{ $i }}">
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
                                                                        href="{{ route('wishlist.store', $category_product->id) }}"><i
                                                                            class="fa-solid fa-heart"></i></a>
                                                                </div>
                                                                <div class="ps-product__item" data-toggle="tooltip"
                                                                    data-placement="left" title="Quick view">
                                                                    <a href="#" data-toggle="modal"
                                                                        data-target="#popupQuickview{{ $category_product->id }}">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                </div>
                                                                {{-- <div class="ps-product__item"
                                                                            data-toggle="tooltip" data-placement="left"
                                                                            title="Add To Cart">
                                                                            <a class="add_to_cart"
                                                                                href="{{ route('cart.store', $category_product->id) }}"
                                                                                data-product_id="{{ $category_product->id }}"
                                                                                data-product_qty="1">
                                                                                <i class="fa fa-shopping-cart"></i>
                                                                            </a>
                                                                        </div> --}}

                                                            </div>
                                                            @if (!empty($category_product->unit_discount_price))
                                                                <div class="ps-product__badge">
                                                                    <div class="ps-badge ps-badge--sale">
                                                                        -
                                                                        {{ !empty($category_product->unit_discount_price) && $category_product->unit_discount_price > 0 ? number_format((($category_product->unit_price - $category_product->unit_discount_price) / $category_product->unit_price) * 100, 1) : 0 }}
                                                                        % অফ
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ps-product__content">
                                                            <h5 class="ps-product__title">
                                                                <a
                                                                    href="{{ route('product.details', $category_product->slug) }}">
                                                                    {{ implode(' ', array_slice(explode(' ', $category_product->name), 0, 5)) }}
                                                                </a>
                                                            </h5>
                                                            <div class="pb-3">
                                                                @if (!empty($category_product->unit_discount_price))
                                                                    <div class="ps-product__meta">
                                                                        <span
                                                                            class="ps-product__price sale">{{ $category_product->unit_discount_price }}
                                                                            টাকা</span>
                                                                        <span
                                                                            class="ps-product__del text-danger">{{ $category_product->unit_price }}
                                                                            টাকা</span>
                                                                    </div>
                                                                @else
                                                                    <div class="ps-product__meta">
                                                                        <span
                                                                            class="ps-product__price sale">{{ $category_product->unit_price }}
                                                                            টাকা</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="d-flex align-items-center card-cart-btn">
                                                                <a href="{{ route('product.details', $category_product->slug) }}"
                                                                    class="btn btn-primary rounded-0 w-100">
                                                                    <i class="pr-2 fa-solid fa-basket-shopping"></i>
                                                                    অর্ডার
                                                                    করুন
                                                                </a>
                                                            </div>
                                                            <div class="ps-product__actions ps-product__group-mobile">
                                                                <div class="ps-product__quantity">
                                                                    <div
                                                                        class="def-number-input number-input safari_only">
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
                                                                <div class="ps-product__item" data-toggle="tooltip"
                                                                    data-placement="left" title="Wishlist"><a
                                                                        class="add_to_wishlist"
                                                                        href="{{ route('wishlist.store', $category_product->id) }}"><i
                                                                            class="fa-solid fa-heart"></i></a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar Widgets -->
                    <div class="order-1 px-0 col-md-3 col-12 order-lg-12 ps-widget ps-widget--product">
                        <div class="mb-4 shadow-sm shadow-none-sm mb-lg-0">
                            <!-- Categories Filter -->
                            <div class="p-0 mt-0 bg-white ps-widget__block ps-widget__block-shop">
                                <h4 class="p-3 shadow-sm ps-widget__title">
                                    <div class="d-flex align-items-center">
                                        <div>Categories</div>
                                        <div class="title-line"></div>
                                    </div>
                                </h4>
                                <a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i></a>
                                <div class="border-0 ps-widget__content ps-widget__category">
                                    <ul class="border-0 menu--mobile nav nav-tabs" id="myTab" role="tablist">
                                        @foreach ($categories as $allcategory)
                                            <li class="py-0 mb-0 nav-item col-12">
                                                <a class="nav-link cat-tabs-triger pl-3 py-3 category-menus {{ $allcategory->id == $category->id ? 'active-cat' : '' }}"
                                                    href="{{ route('category.products', $allcategory->slug) }}"
                                                    aria-selected="{{ $allcategory->id == $category->id ? 'true' : 'false' }}">
                                                    {{ $allcategory->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <!-- Price Filter -->
                            {{-- <div class="mt-3">
                                <div class="p-0 mt-0 bg-white ps-widget__block ps-widget__block-shop">
                                    <h4 class="p-3 shadow-sm ps-widget__title bg-light">
                                        <div class="d-flex align-items-center">
                                            <div>By Price</div>
                                            <div class="title-line"></div>
                                        </div>
                                    </h4>
                                    <a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i></a>
                                    <div class="px-4 py-4 ps-widget__content priceing-filter">
                                        <div class="ps-widget__price">
                                            <div id="slide-price" class="noUi-target noUi-ltr noUi-horizontal"></div>
                                        </div>
                                        <div class="ps-widget__input">
                                            <span class="ps-price" id="slide-price-min">{{ $price_min }}</span>
                                            <span class="bridge">-</span>
                                            <span class="ps-price" id="slide-price-max">{{ $price_max }}</span>
                                            <input type="hidden" id="price-min" name="price_min"
                                                value="{{ $price_min }}" />
                                            <input type="hidden" id="price-max" name="price_max"
                                                value="{{ $price_max }}" />
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <!-- Size Filter -->
                            <div class="mt-3">
                                <div class="p-0 mt-0 bg-white ps-widget__block ps-widget__block-shop">
                                    <h4 class="p-3 shadow-sm ps-widget__title bg-light">
                                        <div class="d-flex align-items-center">
                                            <div>By Size</div>
                                            <div class="title-line"></div>
                                        </div>
                                    </h4>
                                    <a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i></a>
                                    <div class="px-4 py-4 ps-widget__content priceing-filter">
                                        @foreach ($sizes as $size)
                                            <div class="btn-group" role="group" aria-label="Size filter">
                                                <input type="radio" class="btn-check" name="size"
                                                    id="size-{{ $size }}" value="{{ $size }}"
                                                    autocomplete="off" onchange="updateFilters()"
                                                    {{ $size == $selected_size ? 'checked' : '' }}>
                                                <label class="w-auto my-2 mb-0 mr-2 btn btn-outline-primary rounded-0"
                                                    for="size-{{ $size }}">
                                                    {{ $size }}
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
        <div class="container-fluid" style="background-image: linear-gradient(to right, #020024,#090979,#009DBD);">
            <div class="container juta-delivery">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="mb-0 ps-delivery ps-delivery--info">
                            <div class="ps-delivery__content">
                                <div class="text-white ps-delivery__text">
                                    <i class="icon-shield-check"></i>
                                    <span>
                                        <strong>100% Secure Delivery</strong> Without
                                        Courier Communication
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
    <!-- Delivery Info -->
    @push('scripts')
        <!-- JavaScript Code -->
        <script>
            $(document).ready(function() {
                var priceSlider = document.getElementById('slide-price');
                // noUiSlider.create(priceSlider, {
                //     start: [1, 10000], // Default values
                //     connect: true,
                //     range: {
                //         'min': [0],
                //         'max': [10000]
                //     },
                //     step: 1,
                //     format: {
                //         to: function(value) {
                //             return '৳' + value.toFixed(2);
                //         },
                //         from: function(value) {
                //             return Number(value.replace('৳', ''));
                //         }
                //     }
                // });

                // // Update hidden inputs and displayed values, and trigger filtering
                // priceSlider.noUiSlider.on('update', function(values, handle) {
                //     $('#slide-price-min').text(values[0]);
                //     $('#slide-price-max').text(values[1]);
                //     $('#price-min').val(values[0].replace('৳', ''));
                //     $('#price-max').val(values[1].replace('৳', ''));

                //     // Trigger filtering when slider values change
                //     fetchProducts();
                // });

                function fetchProducts(page = 1) {
                    // Collect filter data
                    let categories = [];
                    let subcategories = [];
                    let brands = [];
                    // let priceMin = $('#price-min').val();
                    // let priceMax = $('#price-max').val();
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var currentCategoryId = @json($category->id);

                function activateTab() {
                    var tabs = document.querySelectorAll('#myTab a');
                    tabs.forEach(function(tab) {
                        var tabId = tab.getAttribute('href').substring(1);
                        if (tabId === 'home' + currentCategoryId) {
                            tab.classList.add('active');
                            document.querySelector('#' + tabId).classList.add('show', 'active');
                        } else {
                            tab.classList.remove('active');
                            document.querySelector('#' + tabId).classList.remove('show', 'active');
                        }
                    });
                    updateCategoryContent(currentCategoryId);
                }

                function updateCategoryContent(categoryId) {
                    var selectedCategory = document.querySelector('#home' + categoryId);
                    var categoryNameElement = document.querySelector('.ps-categogy__name');
                    var bannerImageElement = document.querySelector('.ps-categogy__banner');

                    if (selectedCategory) {
                        var newName = selectedCategory.getAttribute('data-category-name');
                        var productCount = selectedCategory.getAttribute('data-product-count');
                        var newBannerImage = selectedCategory.getAttribute('data-banner-image');

                        if (newName && categoryNameElement) {
                            categoryNameElement.innerHTML = `${newName}<sup>(${productCount})</sup>`;
                        }

                        if (newBannerImage && bannerImageElement) {
                            bannerImageElement.src = newBannerImage;
                        }
                    }
                }

                activateTab();

                document.querySelectorAll('#myTab a').forEach(function(tab) {
                    tab.addEventListener('click', function(e) {
                        e.preventDefault();
                        var targetId = this.getAttribute('href').substring(1);

                        document.querySelectorAll('#myTab a').forEach(function(tab) {
                            tab.classList.remove('active');
                        });
                        document.querySelectorAll('.tab-pane').forEach(function(pane) {
                            pane.classList.remove('show', 'active');
                        });

                        this.classList.add('active');
                        var targetPane = document.getElementById(targetId);
                        targetPane.classList.add('show', 'active');

                        var categoryId = targetPane.getAttribute('data-category-id');
                        updateCategoryContent(categoryId);
                    });
                });
            });
            // Listen for clicks on all "Show All" buttons
            // Listen for clicks on all "Show All" / "Show Less" buttons
            // document.querySelectorAll('.show-all-btn').forEach(function(button) {
            //     button.addEventListener('click', function() {
            //         const categoryId = this.dataset.categoryId;
            //         const hiddenItems = document.querySelectorAll('#home' + categoryId +
            //             ' .product-item.d-none');

            //         hiddenItems.forEach(function(item) {
            //             item.classList.remove('d-none'); // Show hidden items
            //         });

            //         // Hide the "Show All" button and show the "Show Less" button
            //         this.classList.add('d-none');
            //         document.querySelector('#showLessBtn' + categoryId).classList.remove('d-none');
            //     });
            // });

            // // Add functionality for "Show Less" button
            // document.querySelectorAll('.show-less-btn').forEach(function(button) {
            //     button.addEventListener('click', function() {
            //         const categoryId = this.dataset.categoryId;
            //         const items = document.querySelectorAll('#home' + categoryId + ' .product-item');

            //         items.forEach(function(item, index) {
            //             if (index >= 4) {
            //                 item.classList.add('d-none'); // Hide items after the first 4
            //             }
            //         });

            //         // Show the "Show All" button and hide the "Show Less" button
            //         document.querySelector('#showAllBtn' + categoryId).classList.remove('d-none');
            //         this.classList.add('d-none');
            //     });
            // });
        </script>
        <script>
            function updateFilters() {
                // Collect the selected size
                var selectedSize = $('input[name="size"]:checked').val();
                var selectedSizes = selectedSize ? [selectedSize] : []; // Make sure it's an array

                // Get price range values
                var priceMin = $('#price-min').val();
                var priceMax = $('#price-max').val();
                var url = new URL(window.location.href);

                // Clear existing size filter in URL
                url.searchParams.delete('size'); // Only one size, no []

                // Add price filters
                // url.searchParams.set('price_min', priceMin);
                // url.searchParams.set('price_max', priceMax);

                // Add selected size as query parameter
                if (selectedSizes.length) {
                    url.searchParams.set('size', selectedSizes[0]); // Only one size selected
                }

                // Redirect with updated filters
                window.location.href = url.href;
            }

            $(document).ready(function() {
                var priceSlider = document.getElementById('slide-price');
                noUiSlider.create(priceSlider, {
                    start: [{{ $price_min }},
                        {{ $price_max }}
                    ], // Set initial values from the controller
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

                // Update hidden inputs and price display when slider values change
                priceSlider.noUiSlider.on('update', function(values) { // Use 'update' instead of 'change'
                    $('#slide-price-min').text(values[0]);
                    $('#slide-price-max').text(values[1]);
                    $('#price-min').val(values[0].replace('৳', ''));
                    $('#price-max').val(values[1].replace('৳', ''));

                    // Trigger form submission when the price slider changes
                    updateFilters(); // Ensure the page reloads with updated values
                });

                // Bind change event to size and price filters
                $('#price-filter, input[name="size"]').on('change', function() {
                    updateFilters();
                });
            });
        </script>
    @endpush
</x-frontend-app-layout>
