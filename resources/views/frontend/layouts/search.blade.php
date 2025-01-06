@if (
    (is_countable($brands) && count($brands) > 0) ||
        (is_countable($categorys) && count($categorys) > 0) ||
        (is_countable($products) && count($products) > 0))
    <div class="ps-result__content">
        <div class="row m-0">
            <div class="col-12 col-lg-4 pl-0">
                <div class="search-ctg">
                    <div class="row">
                        @if (is_countable($brands) && count($brands) > 0)
                            <div class="col-12">
                                <h4 class="fw-bold mb-4 site_text_color">Brands</h4>
                                @foreach ($brands as $brand)
                                    <h4><a class="search_titles" href="#">{{ $brand->name }}</a></h4>
                                @endforeach
                            </div>
                        @endif
                        @if (is_countable($categorys) && count($categorys) > 0)
                            <div class="col-12">
                                <h4 class="fw-bold mb-4 site_text_color">Categorys</h4>
                                @foreach ($categorys as $category)
                                    <h4>
                                        <a class="search_titles"
                                            href="{{ route('category.products', $category->slug) }}">{{ $category->name }}</a>
                                    </h4>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 pr-0">
                <div class="searching-div">
                    @if (count($products) > 0)
                        @foreach ($products as $search_product)
                            <div class="ps-product ps-product--horizontal top-search-product">
                                <div class="top-search-product-img">
                                    <a class="ps-product__image search-img"
                                        href="{{ route('product.details', $search_product->slug) }}">
                                        <figure>
                                            <img class="img-fluid searched-product"
                                                src="{{ asset('storage/' . $search_product->thumbnail) }}"
                                                alt="alt"
                                                onerror="this.onerror=null;this.src='{{ asset('images/no-preview.png') }}';" />
                                        </figure>
                                    </a>
                                </div>
                                <div class="ps-product__content pt-0">
                                    <h4 class="ps-product__title" style="height: auto; min-height:auto">
                                        <a href="{{ route('product.details', $search_product->slug) }}">
                                            {{ $search_product->name }}
                                        </a>
                                    </h4>
                                    <p class="ps-product__desc text-dark" style="display: block">
                                        {!! implode(' ', array_slice(explode(' ', strip_tags($search_product->short_description)), 0, 10)) !!}...
                                    </p>
                                    {{-- Display product pricing information outside of the <a> tag --}}
                                    @if (!empty($search_product->unit_discount_price))
                                        <div class="ps-product__meta mb-4">
                                            <span class="">৳{{ $search_product->unit_discount_price }}</span>
                                            <span class="ps-product__del">৳{{ $search_product->unit_price }}</span>
                                        </div>
                                    @else
                                        <div class="ps-product__meta mb-4">
                                            <span
                                                class="ps-product__price sale">৳{{ $search_product->unit_price }}</span>
                                        </div>
                                    @endif

                                    {{-- Add to Cart button --}}
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('buy.now', $search_product->id) }}"
                                            class="btn btn-primary mr-1 mr-lg-3">
                                            Buy Now
                                        </a>
                                        <a href="{{ route('cart.store', $search_product->id) }}"
                                            class="btn btn-outline-primary add_to_cart"
                                            data-product_id="{{ $search_product->id }}" data-product_qty="1"
                                            onclick="addToCart(event, '{{ csrf_token() }}', '{{ route('cart.store', $search_product->id) }}')">
                                            Add To Cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="ps-result__viewall"><a href="{{ route('allproducts') }}">View all</a></div>
                    @else
                        <div class="row m-0 p-2 shadow-lg bg-white border rounded d-flex align-items-center">
                            <h4 class="text-danger text-center">No Product Found. Search again.</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@else
    <div class="ps-result__content">
        <div class="row m-0">
            <div class="col-12 col-lg-5">
                <div class="text-center p-4">
                    <h4 style="color: #ae0a46;"> Nothing Found ! Search again.</h4>
                </div>
            </div>
        </div>
    </div>
@endif
