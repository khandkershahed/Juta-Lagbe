<x-frontend-app-layout :title="'Category Details'">
    <style>
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active-cat {
            color: #ffffff !important;
            background-color: #004d7a91;
            border-color: 0px;
            border-radius: 0;
        }
    </style>

    <div class="ps-categogy ps-categogy--dark bg-white">
        <div class="container py-lg-5">
            <div class="row">
                <div class="col-lg-3 px-0 border">
                    <div class="bg-white bread-crumb-title ctg-products">
                        <!-- Breadcrumbs -->
                        <ul class="ps-breadcrumb pl-3">
                            <li class="ps-breadcrumb__item pl-4"><a href="{{ url('/') }}">Home</a></li>
                            <li class="ps-breadcrumb__item active" aria-current="page">{{ $category->name }}</li>
                        </ul>
                        <!-- Category Title -->
                        <h1 class="ps-categogy__name pl-4" style="font-size: 25px">
                            {{ $category->name }}<sup>({{ $category->products()->count() }})</sup>
                        </h1>
                    </div>
                </div>
                <div class="col-lg-9 px-0 px-lg-3 ">
                    <div class="category-banner">
                        <img class="img-fluid" style="object-fit: fill; height: 200px; width: 100%;"
                            src="{{ asset('storage/' . $category->banner_image) }}" alt="">
                        <!-- Fallback for missing image -->
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="ps-categogy__content pt-2">
                <div class="row row-reverse pb-0 pb-lg-5">
                    <!-- Products Section -->
                    <div class="col-md-9 col-12 order-1 order-lg-1">
                        <div class="tab-content" id="myTabContent">
                            @foreach ($categories as $allcategory)
                                @php
                                    $catProducts = $allcategory->products()->get(); // Fetch all products
                                @endphp
                                <div class="tab-pane fade mb-0 {{ $allcategory->id == $category->id ? 'show active' : '' }}"
                                    id="home{{ $allcategory->id }}" role="tabpanel"
                                    aria-labelledby="home-tab{{ $allcategory->id }}"
                                    data-category-id="{{ $allcategory->id }}"
                                    data-category-name="{{ $allcategory->name }}"
                                    data-product-count="{{ $allcategory->products()->count() }}"
                                    data-banner-image="{{ asset('storage/' . $allcategory->banner_image) }}">
                                    <!-- Products Grid -->
                                    <div class="ps-categogy--grid mt-0">
                                        <div class="row m-0">
                                            @forelse ($catProducts as $key => $category_product)
                                                <div
                                                    class="col-12 col-lg-4 p-0 product-item {{ $key >= 4 ? 'd-none' : '' }}">
                                                    <div class="ps-section__product pr-2">
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
                                                                                    : asset(
                                                                                        'frontend/img/no-product.jpg',
                                                                                    );
                                                                            @endphp
                                                                            <img src="{{ $thumbnailSrc }}"
                                                                                alt="{{ $category_product->meta_title }}"
                                                                                width="210" height="210" />
                                                                        @else
                                                                            @foreach ($category_product->multiImages->slice(0, 2) as $image)
                                                                                @php
                                                                                    $imagePath =
                                                                                        'storage/' . $image->photo;
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
                                                                                        count(
                                                                                            $category_product->reviews,
                                                                                        )
                                                                                    : 0;
                                                                        @endphp
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center my-2 rating-area px-3">
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
                                                                                                    max(
                                                                                                        1,
                                                                                                        floor($review),
                                                                                                    ),
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
                                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                                        data-placement="left" title="Add To Cart">
                                                                        <a class="add_to_cart"
                                                                            href="{{ route('cart.store', $category_product->id) }}"
                                                                            data-product_id="{{ $category_product->id }}"
                                                                            data-product_qty="1">
                                                                            <i class="fa fa-shopping-cart"></i>
                                                                        </a>
                                                                    </div>

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
                                                                    <a href="{{ route('buy.now', $category_product->id) }}"
                                                                        class="btn btn-primary rounded-0 w-100">
                                                                        <i class="fa-solid fa-basket-shopping pr-2"></i>
                                                                        অর্ডার
                                                                        করুন
                                                                    </a>
                                                                </div>
                                                                <div
                                                                    class="ps-product__actions ps-product__group-mobile">
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
                                                                    <div class="ps-product__item"
                                                                        data-toggle="tooltip" data-placement="left"
                                                                        title="Wishlist"><a class="add_to_wishlist"
                                                                            href="{{ route('wishlist.store', $category_product->id) }}"><i
                                                                                class="fa-solid fa-heart"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center bg-white if-show-img">
                                                    <img class="" style="width: 320px;"
                                                        src="{{ asset('frontend/img/no-products-category.jpg') }}"
                                                        alt="">
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                    <!-- "Show All" Button for this tab -->
                                    @if ($catProducts->count() > 4)
                                        <!-- "Show All" Button for this tab -->
                                        <div class="text-center my-4 if-show-none">
                                            <button id="showAllBtn{{ $allcategory->id }}"
                                                class="btn ps-btn--warning my-3 py-3 show-all-btn"
                                                data-category-id="{{ $allcategory->id }}">Show All Product</button>

                                            <button id="showLessBtn{{ $allcategory->id }}"
                                                class="btn ps-btn--warning my-3 py-3 show-less-btn d-none"
                                                data-category-id="{{ $allcategory->id }}">Show Less Product</button>
                                        </div>
                                    @endif
                                    <!-- Delivery Info -->
                                    <div class="container-fluid"
                                        style="background-image: linear-gradient(to right, #020024,#090979,#009DBD);">
                                        <div class="container juta-delivery">
                                            <div class="row align-items-center">
                                                <div class="col-lg-8">
                                                    <div class="ps-delivery ps-delivery--info mb-0">
                                                        <div class="ps-delivery__content">
                                                            <div class="ps-delivery__text text-white">
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
                                                        <img class="img-fluid"
                                                            src="{{ asset('images/delivery-icons.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <!-- Sidebar Widgets -->
                    <div class="col-md-3 col-12 order-12 order-lg-12 bg-white border px-0">
                        <div class="category-title-text py-3" style="background-color: var(--site-primary)">
                            <h4 class="mb-0 text-white">ALL CATEGORY <i class="fa-solid fa-arrow-right-long pl-2"></i></h4>
                        </div>
                        <div class="ps-widget ps-widget--product px-0 category-mobile">
                            <div class="ps-widget__block">
                                <a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i></a>
                                <div class="ps-widget__content ps-widget__category border-0">
                                    <ul class="menu--mobile nav nav-tabs border-0" id="myTab"
                                        role="tablist">
                                        @foreach ($categories as $allcategory)
                                            <li class="nav-item col-12 py-0 mb-0">
                                                <a class="nav-link p-3 category-menus pl-4 {{ $allcategory->id == $category->id ? 'active-cat' : '' }}"
                                                    id="home-tab{{ $allcategory->id }}" data-toggle="tab"
                                                    href="#home{{ $allcategory->id }}" role="tab"
                                                    aria-controls="home{{ $allcategory->id }}"
                                                    aria-selected="{{ $allcategory->id == $category->id ? 'true' : 'false' }}">
                                                    {{ $allcategory->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <!-- JavaScript Code -->
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
            document.querySelectorAll('.show-all-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const categoryId = this.dataset.categoryId;
                    const hiddenItems = document.querySelectorAll('#home' + categoryId +
                        ' .product-item.d-none');

                    hiddenItems.forEach(function(item) {
                        item.classList.remove('d-none'); // Show hidden items
                    });

                    // Hide the "Show All" button and show the "Show Less" button
                    this.classList.add('d-none');
                    document.querySelector('#showLessBtn' + categoryId).classList.remove('d-none');
                });
            });

            // Add functionality for "Show Less" button
            document.querySelectorAll('.show-less-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const categoryId = this.dataset.categoryId;
                    const items = document.querySelectorAll('#home' + categoryId + ' .product-item');

                    items.forEach(function(item, index) {
                        if (index >= 4) {
                            item.classList.add('d-none'); // Hide items after the first 4
                        }
                    });

                    // Show the "Show All" button and hide the "Show Less" button
                    document.querySelector('#showAllBtn' + categoryId).classList.remove('d-none');
                    this.classList.add('d-none');
                });
            });
        </script>
    @endpush
</x-frontend-app-layout>
