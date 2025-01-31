<x-frontend-app-layout :title="'My Cart'">
    <div class="ps-shopping">
        <div class="container">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="/">Home</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page">
                    Shopping cart
                </li>
            </ul>
            <h3 class="ps-shopping__title mb-2">শপিং কার্ট<sup>(সু)</sup></h3>
            <div class="ps-shopping__content">
                <div class="row cartTable">
                    @include('frontend.pages.cart.partials.cartTable')
                </div>
                @if ($related_products->count() > 0)
                    {{-- @dd($related_products) --}}
                    <section class="ps-section--latest">
                        <div class="container">
                            <h3 class="ps-section__title">আরও দেখতে পারেন…</h3>
                            <div class="ps-section__carousel">
                                <div class="dealCarousel owl-carousel">
                                    @foreach ($related_products as $deal_product)
                                    <div class="ps-section__product border">
                                        <div class="ps-product ps-product--standard">
                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image"
                                                    href="{{ route('product.details', $deal_product->slug) }}">
                                                    <figure>
                                                        @if (!empty($deal_product->thumbnail))
                                                            @php
                                                                $thumbnailPath =
                                                                    'storage/' . $deal_product->thumbnail;
                                                                $thumbnailSrc = file_exists(
                                                                    public_path($thumbnailPath),
                                                                )
                                                                    ? asset($thumbnailPath)
                                                                    : asset('frontend/img/no-product.jpg');
                                                            @endphp
                                                            <img src="{{ $thumbnailSrc }}"
                                                                alt="{{ $deal_product->meta_title }}"
                                                                width="210" height="210" />
                                                        @else
                                                            @foreach ($deal_product->multiImages->slice(0, 2) as $image)
                                                                @php
                                                                    $imagePath = 'storage/' . $image->photo;
                                                                    $imageSrc = file_exists(public_path($imagePath))
                                                                        ? asset($imagePath)
                                                                        : asset('frontend/img/no-product.jpg');
                                                                @endphp
                                                                <img src="{{ $imageSrc }}"
                                                                    alt="{{ $deal_product->meta_title }}"
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
                                                            href="{{ route('wishlist.store', $deal_product->id) }}"><i
                                                                class="fa-solid fa-heart"></i></a>
                                                    </div>
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Quick view">
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#popupQuickview{{ $deal_product->id }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                    {{-- <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Add To Cart">
                                                        <a class="add_to_cart"
                                                            href="{{ route('cart.store', $deal_product->id) }}"
                                                            data-product_id="{{ $deal_product->id }}"
                                                            data-product_qty="1">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </a>
                                                    </div> --}}

                                                </div>
                                                @if (!empty($deal_product->unit_discount_price))
                                                    <div class="ps-product__badge">
                                                        <div class="ps-badge ps-badge--sale">
                                                            -
                                                            {{ !empty($deal_product->unit_discount_price) && $deal_product->unit_discount_price > 0 ? number_format((($deal_product->unit_price - $deal_product->unit_discount_price) / $deal_product->unit_price) * 100, 1) : 0 }}
                                                            % অফ
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ps-product__content">
                                                <h5 class="ps-product__title">
                                                    <a
                                                        href="{{ route('product.details', $deal_product->slug) }}">
                                                        {{ implode(' ', array_slice(explode(' ', $deal_product->name), 0, 5)) }}
                                                    </a>
                                                </h5>
                                                <div class="pb-3">
                                                    @if (!empty($deal_product->unit_discount_price))
                                                        <div class="ps-product__meta">
                                                            <span class="ps-product__price sale fw-bold"
                                                                style="font-weight:600;">দাম
                                                                {{ $deal_product->unit_discount_price }}
                                                                টাকা</span>
                                                            <span
                                                                class="ps-product__del text-danger">{{ $deal_product->unit_price }}
                                                                টাকা</span>
                                                        </div>
                                                    @else
                                                        <div class="ps-product__meta">
                                                            <span class="ps-product__price sale fw-bold"
                                                                style="font-weight:600;">দাম
                                                                {{ $deal_product->unit_price }}
                                                                টাকা</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center card-cart-btn">
                                                    <a href="{{ route('product.details', $deal_product->slug) }}"
                                                        class="btn btn-primary rounded-0 w-100">
                                                        <i class="fa-solid fa-basket-shopping pr-2"></i>
                                                        অর্ডার
                                                        করুন
                                                    </a>
                                                </div>
                                                <div class="ps-product__actions ps-product__group-mobile">
                                                    <div class="ps-product__quantity">
                                                        <div class="def-number-input number-input safari_only">
                                                            <button class="minus"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                    class="icon-minus"></i>
                                                            </button>
                                                            <input class="quantity" min="0"
                                                                name="quantity" value="1" type="number" />
                                                            <button class="plus"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                    class="icon-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Wishlist"><a
                                                            class="add_to_wishlist"
                                                            href="{{ route('wishlist.store', $deal_product->id) }}"><i
                                                                class="fa-solid fa-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.remove-from-cart').click(function(e) {
                    e.preventDefault(); // Prevent default link behavior

                    var button = $(this);
                    var rowId = button.data('cart-item-id'); // Get the cart item ID
                    var cartHeader = $('.miniCart');

                    // Confirm removal
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: '/cart/remove', // The route to handle item removal
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    rowId: rowId
                                },
                                success: function(response) {
                                    // Remove the cart item from the list
                                    $(".cartCount").html(data.cartCount);
                                    cartHeader.html(data.cartHeader);
                                    $(".cartCount").html(data.cartCount);
                                    Swal.fire(
                                        'Deleted!',
                                        'Your item has been removed.',
                                        'success'
                                    );
                                },
                                error: function(xhr) {
                                    console.error(xhr.responseText);
                                    Swal.fire(
                                        'Oops...',
                                        'Something went wrong!',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                });
            });
        </script>
        {{-- <script>
            $(document).ready(function() {
                $('.dealCarousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    dots: true,
                    autoplay: false,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    navText: [
                        '<div class="dealCarousel-prev">←</div>',
                        '<div class="dealCarousel-next">→</div>'
                    ],
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 4
                        }
                    }
                });
            });
        </script> --}}
    @endpush
</x-frontend-app-layout>
