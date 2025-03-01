<div id="productContainer">
    <div class="ps-categogy--list">
        @if ($products->count() > 0)
            @foreach ($products as $product)
                <div class="ps-product ps-product--list align-items-center all-product-box">
                    <div class="ps-product__content all-product-box">
                        <div class="ps-product__thumbnail all-product-box-img">
                            <a class="ps-product__image" href="#">
                                <figure>
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                                        onerror="this.onerror=null; this.src='{{ asset('frontend/img/no-product.jpg') }}';">
                                </figure>
                            </a>
                            @if (!empty($product->unit_discount_price))
                                <div class="ps-product__badge">
                                    <div class="ps-badge ps-badge--sale">
                                        -
                                        {{ !empty($product->unit_discount_price) && $product->unit_discount_price > 0 ? number_format((($product->unit_price - $product->unit_discount_price) / $product->unit_price) * 100, 1) : 0 }}
                                        % Off
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if (!empty($product->description))
                            <div class="ps-product__info shop-pr-price">
                                <h5 class="ps-product__title shop_product-title">
                                    <a href="{{ route('product.details', $product->slug) }}">
                                        {{ implode(' ', array_slice(explode(' ', $product->name), 0, 6)) }}
                                    </a>
                                </h5>
                                <div class="ps-product__desc shop-pr-price">
                                    @php
                                        $description = strip_tags($product->description);
                                        $words = explode(' ', $description);
                                        $limitedWords = implode(' ', array_slice($words, 0, 30));
                                    @endphp
                                    {!! $limitedWords !!}...
                                </div>

                            </div>
                        @endif
                    </div>
                    <div class="ps-product__footer shop-pr-price">
                        @if (!empty($product->unit_discount_price))
                            <div class="ps-product__meta">
                                <span class="ps-product__price sale">
                                    দামঃ {{ $product->unit_discount_price }}
                                    টাকা
                                </span> <br>
                                <small>
                                    <span class="ps-product__del text-danger">
                                        {{ $product->unit_price }} টাকা
                                    </span>
                                </small>
                            </div>
                        @else
                            <div class="ps-product__meta">
                                <small>
                                    <span class="ps-product__price sale">
                                        দামঃ {{ $product->unit_price }}
                                        টাকা
                                    </span>
                                </small>
                            </div>
                        @endif
                        <div class="shop-action-all">
                            <div class="ps-product__quantity shop-qty">
                                <h6>Quantity</h6>
                                <div class="def-number-input number-input safari_only">
                                    <button class="minus"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                        <i class="icon-minus"></i>
                                    </button>
                                    <input class="quantity" min="1" name="quantity" value="1"
                                        type="number" />
                                    <button class="plus"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <i class="icon-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a class="px-5 py-2 btn btn-primary add_to_cart w-100" style="font-size: 13px !important;"
                                    href="{{ route('product.details', $product->slug) }}">অর্ডার করুন</a>
                                </a>
                                {{-- <a class="btn btn-outline-primary " href="#"
                                    onclick="addToCartShop(event, {{ $product->id }})">Add to cart</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="p-4 ps-product ps-product--list align-items-center all-product-box justify-content-center">
                <h5 class="p-4 m-0 text-center text-warning">No Product Found.</h5>
            </div>
        @endif
    </div>
    <div class="ps-pagination">
        {{ $products->appends(request()->except('page'))->links() }}
    </div>
</div>
