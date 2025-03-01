    <x-frontend-app-layout :title="'Quick Order'">
        <div class="breadcrumb-wrap">
            <div class="banner b-top bg-size bread-img">
                <img class="bg-img bg-top" src="{{ asset('frontend/img/banner-p.jpg') }}" alt="banner"
                    style="display: none;">
                <div class="container-lg">
                    <div class="breadcrumb-box">
                        <div class="title-box3 text-center">
                            <h1>
                                <span class="text-info">{{ Auth::user()->first_name }}
                                    {{ Auth::user()->last_name }}</span>
                                <br>Welcome To Your Dashboard
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-shopping">
            <div class="user-dashboard py-0 py-lg-8">
                <div class="container">
                    <div class="row g-3 g-xl-4 tab-wrap">
                        <div class="col-lg-4 col-xl-3 sticky">
                            <!-- Sidebar here -->
                            @include('user.layouts.sidebar')
                        </div>
                        <div class="col-lg-8 col-xl-9">
                            <div class="row bg-white">
                                <h3 class="ps-shopping__title pl-3 pt-2 mb-2">Quick Order<sup>(0)</sup></h3>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped order-history-table">
                                            <thead>
                                                <tr>
                                                    <th width="5%">SL</th>
                                                    <th width="10%">Image</th>
                                                    <th width="25%">Name</th>
                                                    <th width="15%" class="text-center">Status</th>
                                                    <th width="15%" class="text-center">Price</th>
                                                    <th width="15%" class="text-center">Old Price</th>
                                                    <th width="15%" class="text-center">To Cart</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Example Row -->
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <div>
                                                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                                    class="" width="50px" height="50px"
                                                                    alt=""
                                                                    onerror="this.onerror=null; this.src='{{ asset('frontend/img/no-image.png') }}';">
                                                            </div>
                                                        </td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>
                                                            @if (!empty($product->stock) && $product->stock > 0)
                                                                <span class="ps-badge bg-success">
                                                                    {{ $product->stock }} In Stock</span>
                                                            @else
                                                                <span class="ps-badge ps-badge--outstock">Out Of
                                                                    Stock</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="ps-product__meta">
                                                                <span
                                                                    class="ps-product__price sale">৳{{ $product->unit_price }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($product->unit_discount_price))
                                                                <div class="ps-product__meta">
                                                                    <span
                                                                        class="ps-product__del">৳{{ $product->unit_discount_price }}</span>
                                                                </div>
                                                            @else
                                                                <div class="ps-product__meta">
                                                                    <span class="ps-product__del">N/A</span>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a class="add_to_cart"
                                                                href="{{ route('cart.store', $product->id) }}"
                                                                data-product_id="{{ $product->id }}"
                                                                data-product_qty="1">
                                                                <i class="fa fa-shopping-basket"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <!-- Additional rows go here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="ps-section--latest mb-0">
                            <div class="container">
                                <h3 class="ps-section__title mt-50">You may be interested in…</h3>
                                <div class="dealCarousel owl-carousel">
                                    @foreach ($related_products as $related_product)
                                        <div class="ps-section__product">
                                            <div class="ps-product ps-product--standard">
                                                <div class="ps-product__thumbnail">
                                                    <a class="ps-product__image"
                                                        href="{{ route('product.details', $related_product->slug) }}">
                                                        <figure>
                                                            @if (!empty($related_product->thumbnail))
                                                                @php
                                                                    $thumbnailPath =
                                                                        'storage/' . $related_product->thumbnail;
                                                                    $thumbnailSrc = file_exists(
                                                                        public_path($thumbnailPath),
                                                                    )
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
                                                                <i class="fa-solid fa-heart"></i>
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
                                                            <div class="ps-badge ps-badge--sale">Offer</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ps-product__content">
                                                    <h5 class="ps-product__title">
                                                        <a
                                                            href="{{ route('product.details', $related_product->slug) }}">
                                                            {{ $related_product->name }}
                                                        </a>
                                                    </h5>

                                                    @if (!empty($related_product->unit_discount_price))
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
                                                    @endif
                                                    <div class="d-flex align-items-center card-cart-btn">
                                                        <a href="{{ route('product.details', $related_product->slug) }}"
                                                            class="btn btn-primary rounded-0 w-100">
                                                            <i class="pr-2 fa-solid fa-basket-shopping"></i>
                                                            অর্ডার
                                                            করুন
                                                        </a>
                                                    </div>

                                                    <div class="ps-product__actions ps-product__group-mobile">
                                                        <div class="ps-product__quantity">
                                                            <div class="def-number-input number-input safari_only">
                                                                <button class="minus"
                                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                        class="icon-minus"></i></button>
                                                                <input class="quantity" min="0"
                                                                    name="quantity" value="1" type="number" />
                                                                <button class="plus"
                                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                        class="icon-plus"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="ps-product__item cart" data-toggle="tooltip"
                                                            data-placement="left" title="Add to cart"><a
                                                                href="#"><i
                                                                    class="fa fa-shopping-basket"></i></a>
                                                        </div>
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist">
                                                            <a class="add_to_wishlist"
                                                                href="{{ route('wishlist.store', $related_product->id) }}">
                                                                <i class="fa-solid fa-heart"></i>
                                                            </a>
                                                        </div>
                                                        {{-- <div class="ps-product__item rotate" data-toggle="tooltip"
                                                            data-placement="left" title="Add to compare"><a
                                                                href="compare.html"><i
                                                                    class="fa fa-align-left"></i></a>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-frontend-app-layout>
