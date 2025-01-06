<x-frontend-app-layout :title="'Category Details'">
    <style>
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: #ffffff;
            background-color: #500066;
            border-color: 0px;
        }
    </style>

    <div class="ps-categogy ps-categogy--dark">
        <div class="container pt-0 pt-lg-5">
            <div class="row">
                <div class="col-lg-3 px-0 px-lg-3">
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
                <div class="col-lg-9 px-0 px-lg-3">
                    <div class="category-banner">
                        {{-- <img class="img-fluid" style="object-fit: cover;height: 125px;width: 100%;"
                            src="{{ asset('storage/' . $category->banner_image) }}" alt=""> --}}
                        <img class="img-fluid ps-categogy__banner"
                            style="object-fit: cover; height: 200px; width: 100%;"
                            src="{{ asset('storage/' . $category->banner_image) }}"
                            onerror="this.onerror=null; this.src='{{ asset('images/no-preview2.png') }}';"
                            alt="">
                        <!-- Fallback for missing image -->
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="ps-categogy__content pt-2">
                <div class="row row-reverse">
                    <!-- Products Section -->
                    <div class="col-md-9 col-12 order-1 order-lg-1">
                        <div class="tab-content" id="myTabContent">
                            @foreach ($categories as $allcategory)
                                @php
                                    $catProducts = $allcategory->products()->get(); // Fetch all products
                                @endphp
                                <div class="tab-pane fade {{ $allcategory->id == $category->id ? 'show active' : '' }}"
                                    id="home{{ $allcategory->id }}" role="tabpanel"
                                    aria-labelledby="home-tab{{ $allcategory->id }}"
                                    data-category-id="{{ $allcategory->id }}"
                                    data-category-name="{{ $allcategory->name }}"
                                    data-product-count="{{ $allcategory->products()->count() }}"
                                    data-banner-image="{{ asset('storage/' . $allcategory->banner_image) }}">
                                    <!-- Products Grid -->
                                    <div class="ps-categogy--grid">
                                        <div class="row m-0">
                                            @forelse ($catProducts as $key => $category_product)
                                                <div
                                                    class="col-12 col-lg-4 p-0 product-item {{ $key >= 4 ? 'd-none' : '' }}">
                                                    <div class="ps-product ps-product--standard category-imges">
                                                        <div class="ps-product__thumbnail">
                                                            <a class="ps-product__image"
                                                                href="{{ route('product.details', $category_product->slug) }}">
                                                                <div>
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
                                                                            class="img-fluid category_product_img" />
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
                                                                                class="category_product_img"
                                                                                alt="{{ $category_product->meta_title }}"
                                                                                width="210" height="210" />
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </a>
                                                            <div class="ps-product__actions">
                                                                <div class="ps-product__item" data-toggle="tooltip"
                                                                    data-placement="left" title="Wishlist">
                                                                    <a class="add_to_wishlist"
                                                                        href="{{ route('wishlist.store', $category_product->id) }}">
                                                                        <i class="fa fa-heart-o"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            @if (!empty($category_product->unit_discount_price))
                                                                <div class="ps-product__badge">
                                                                    <div class="ps-badge ps-badge--sale">
                                                                        -
                                                                        {{ $category_product->unit_price > 0 ? number_format((($category_product->unit_price - $category_product->unit_discount_price) / $category_product->unit_price) * 100, 1) : 0 }}
                                                                        %
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
                                                            @if (!empty($category_product->unit_discount_price))
                                                                <div class="ps-product__meta">
                                                                    <span
                                                                        class="ps-product__price sale">৳{{ $category_product->unit_discount_price }}</span>
                                                                    <span
                                                                        class="ps-product__del">৳{{ $category_product->unit_price }}
                                                                    </span>
                                                                </div>
                                                            @else
                                                                <div class="ps-product__meta">
                                                                    <span
                                                                        class="ps-product__price sale">৳{{ $category_product->unit_price }}</span>
                                                                </div>
                                                            @endif
                                                            <div class="d-flex align-items-center card-cart-btn mt-3">
                                                                <a href="{{ route('buy.now', $category_product->id) }}"
                                                                    class="btn btn-primary mr-1 mr-lg-3 ">
                                                                    Buy Now
                                                                </a>
                                                                <a href="{{ route('cart.store', $category_product->id) }}"
                                                                    class="btn btn-outline-primary add_to_cart"
                                                                    data-product_id="{{ $category_product->id }}"
                                                                    data-product_qty="1">
                                                                    Add To Cart
                                                                </a>
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
                                    <div class="ps-delivery ps-delivery--info mt-4"
                                        data-background="{{ asset('frontend/img/promotion/banner-delivery-2.jpg') }}">
                                        <div class="ps-delivery__content">
                                            <div class="ps-delivery__text text-center">
                                                <i class="icon-shield-check"></i><span><strong>100% Secure
                                                        delivery</strong> without contacting the courier</span>
                                            </div>
                                            {{-- <a class="ps-delivery__more" href="#">More</a> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <!-- Sidebar Widgets -->
                    <div class="col-md-3 col-12 order-12 order-lg-12">
                        <div class="category-title-text">
                            <h4 class="mb-0">Category</h4>
                        </div>
                        <div class="ps-widget ps-widget--product px-0 category-mobile">
                            <div class="ps-widget__block pb-0 px-0">
                                <a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i></a>
                                <div class="ps-widget__content ps-widget__category">
                                    <ul class="menu--mobile nav nav-tabs border-0" id="myTab" role="tablist">
                                        @foreach ($categories as $allcategory)
                                            <li class="nav-item col-12 py-0 mb-0">
                                                <a class="nav-link p-3 category-menus pl-4 {{ $allcategory->id == $category->id ? 'active' : '' }}"
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

    {{-- @foreach ($catProducts as $category_product)
            <div class="modal fade" id="popupQuickview{{ $category_product->id }}" data-backdrop="static"
                data-keyboard="false" tabindex="-1" aria-hidden="true">
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
                                                    @if ($category_product->multiImages->isNotEmpty())
                                                        @foreach ($category_product->multiImages->slice(0, 5) as $image)
                                                            @php
                                                                $imagePath = 'storage/' . $image->photo;
                                                                $imageSrc = file_exists(public_path($imagePath))
                                                                    ? asset($imagePath)
                                                                    : asset('frontend/img/no-product.jpg');
                                                            @endphp
                                                            <div class="slide">
                                                                <img src="{{ $imageSrc }}"
                                                                    alt="{{ $category_product->name }}" />
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        @php
                                                            $thumbnailPath = 'storage/' . $category_product->thumbnail;
                                                            $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                                ? asset($thumbnailPath)
                                                                : asset('frontend/img/no-product.jpg');
                                                        @endphp
                                                        <div class="slide">
                                                            <img src="{{ $thumbnailSrc }}"
                                                                alt="{{ $category_product->name }}" />
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ps-gallery--image">
                                                    @if ($category_product->multiImages->isNotEmpty())
                                                        @foreach ($category_product->multiImages->slice(0, 5) as $image)
                                                            @php
                                                                $imagePath = 'storage/' . $image->photo;
                                                                $imageSrc = file_exists(public_path($imagePath))
                                                                    ? asset($imagePath)
                                                                    : asset('frontend/img/no-product.jpg');
                                                            @endphp
                                                            <div class="slide">
                                                                <div class="ps-gallery__item">
                                                                    <img src="{{ $imageSrc }}"
                                                                        alt="{{ $category_product->name }}" />
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        @php
                                                            $thumbnailPath = 'storage/' . $category_product->thumbnail;
                                                            $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                                ? asset($thumbnailPath)
                                                                : asset('frontend/img/no-product.jpg');
                                                        @endphp
                                                        <div class="slide">
                                                            <div class="ps-gallery__item">
                                                                <img src="{{ $thumbnailSrc }}"
                                                                    alt="{{ $category_product->name }}" />
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
                                                        class="ps-badge ps-badge--instock">{{ $category_product->box_stock > 0 ? 'IN STOCK' : 'OUT OF STOCK' }}</span>
                                                </div>
                                                <div class="ps-product__branch">
                                                    <a
                                                        href="#">{{ optional($category_product->brand)->name }}</a>
                                                </div>
                                                <h5 class="ps-product__title">
                                                    <a href="{{ route('product.details', $category_product->slug) }}">
                                                        {{ $category_product->name }}
                                                    </a>
                                                </h5>
                                                <div class="ps-product__desc">
                                                    <p>{!! $category_product->short_description !!}</p>
                                                </div>
                                                @if (Auth::check() && Auth::user()->status == 'active')
                                                    @if (!empty($category_product->box_discount_price))
                                                        <div class="ps-product__meta">
                                                            <span
                                                                class="ps-product__price sale">৳{{ $category_product->box_discount_price }}</span>
                                                            <span
                                                                class="ps-product__del">৳{{ $category_product->unit_price }} Per Unit</span>
                                                        </div>
                                                    @else
                                                        <div class="ps-product__meta">
                                                            <span
                                                                class="ps-product__price sale">৳{{ $category_product->unit_price }} Per Unit</span>
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
                                                                data-product_id="{{ $category_product->id }}" />
                                                            <button class="plus"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                    class="icon-plus"></i></button>
                                                        </div>
                                                    </div>

                                                    <a class="ps-btn ps-btn--warning add_to_cart_btn_product_single"
                                                        data-product_id="{{ $category_product->id }}"
                                                        href="#">Add
                                                        to
                                                        cart</a>
                                                @else
                                                    <div class="ps-product__meta">
                                                        <a href="{{ route('login') }}"
                                                            class="btn btn-info btn-block">Login to
                                                            view
                                                            price</a>
                                                    </div>
                                                @endif
                                                <div class="ps-product__type">
                                                    <ul class="ps-product__list">

                                                        <li><span class="ps-list__title">SKU-Code: </span><a
                                                                class="ps-list__text"
                                                                href="#">{{ $category_product->sku_code }}</a>
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
        @endforeach --}}
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
