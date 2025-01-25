<x-frontend-app-layout :title="'Your Wishlist'">
    <style>
        .user-dashboard .tab-wrap {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            margin-top: 50px;
            margin-bottom: 65px;
        }
    </style>
    <div class="breadcrumb-wrap">
        <div class="banner b-top bg-size bread-img">
            <img class="bg-img bg-top" src="img/banner-p.jpg" alt="banner" style="display: none;">
            <div class="container-lg">
                <div class="breadcrumb-box">
                    <div class="title-box3 text-center">
                        <h1>
                            <span class="text-info">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                            <br>Welcome To Your Dashboard
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-wishlist">
        <div class="user-dashboard py-0 py-lg-8">
            <div class="container">
                <div class="row g-3 g-xl-4 tab-wrap">
                    <div class="col-lg-4 col-xl-3 sticky">
                        <!-- Sidebar here -->
                        @include('user.layouts.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9 bg-white">
                        <h3 class="ps-wishlist__title pt-3">My wishlist</h3>
                        <div class="ps-wishlist__content">
                            <ul class="ps-wishlist__list">
                                @foreach ($wishlists as $wishlist)
                                    <li>
                                        <div class="ps-product ps-product--wishlist">
                                            <div class="ps-product__remove">
                                                <a href="{{ route('wishlist.destroy', $wishlist->id) }}">
                                                    <i class="icon-cross delete"></i>
                                                </a>
                                            </div>
                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image"
                                                    href="{{ route('product.details', $wishlist->product->slug) }}">
                                                    <div>
                                                        <img src="{{ asset('storage/' . $wishlist->product->thumbnail) }}"
                                                            alt="alt" class="wishlist-img">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="ps-product__content">
                                                <h5 class="ps-product__title">
                                                    <a
                                                        href="{{ route('product.details', optional($wishlist->product)->slug) }}">
                                                        {{ optional($wishlist->product)->name }}
                                                    </a>
                                                </h5>
                                                @if (!empty(optional($wishlist->product)->unit_discount_price))
                                                    <div class="ps-product__row">
                                                        <div class="ps-product__label">Price:</div>
                                                        <div class="ps-product__value">
                                                            <span
                                                                class="ps-product__price sale">৳{{ optional($wishlist->product)->unit_discount_price }}</span>
                                                            <span
                                                                class="ps-product__del">৳{{ optional($wishlist->product)->unit_price }}</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="ps-product__row">
                                                        <div class="ps-product__label">Price:</div>
                                                        <div class="ps-product__value">
                                                            <span class="ps-product__price sale">৳
                                                                {{ optional($wishlist->product)->unit_price }}
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="ps-product__row ps-product__stock">
                                                    <div class="ps-product__label">Stock:</div>
                                                    <div class="ps-product__value">
                                                        <span class="ps-product__out-stock">
                                                            @if ($wishlist->product->box_stock > 0)
                                                                In Stock
                                                            @else
                                                                Out of Stock
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                {{-- <div class="ps-product__cart">
                                                    <a href="{{ route('cart.store', $wishlist->product->id) }}"
                                                        class="btn ps-btn--warning add_to_cart"
                                                        data-product_id="{{ $wishlist->product->id }}"
                                                        data-product_qty="1">Add To Cart</a>
                                                </div> --}}
                                                <div class="d-flex align-items-center card-cart-btn">
                                                    <a href="{{ route('buy.now', $wishlist->id) }}"
                                                        class="btn btn-primary mr-1 mr-lg-3">
                                                        Buy Now
                                                    </a>
                                                    <a href="{{ route('cart.store', $wishlist->id) }}"
                                                        class="btn btn-outline-primary add_to_cart"
                                                        data-product_id="{{ $wishlist->id }}" data-product_qty="1">
                                                        Add To Cart
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="ps-wishlist__table">
                                <div class="table-responsive">
                                    <table class="table table-striped order-history-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="5%">Sl</th>
                                                <th width="10%">Image</th>
                                                <th width="30%">Product Name</th>
                                                <th width="20%">Unit price</th>
                                                <th width="15%">Stock</th>
                                                <th width="20%" class="text-center">Action</th>
                                            </tr>
                                        <tbody>
                                            @foreach ($wishlists as $wishlist)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a class="ps-product__image"
                                                            href="{{ route('product.details', $wishlist->product->slug) }}">
                                                            <img src="{{ asset('storage/' . $wishlist->product->thumbnail) }}"
                                                                alt="alt" class="wishlist-img-td rounded-2">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="{{ route('product.details', $wishlist->product->slug) }}">
                                                            {{ $wishlist->product->name }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if (!empty($wishlist->product->unit_discount_price))
                                                            <div class="ps-product__row">
                                                                <div class="ps-product__value">
                                                                    <span
                                                                        class="ps-product__price sale">৳{{ $wishlist->product->unit_discount_price }}</span>
                                                                    <span
                                                                        class="ps-product__del">৳{{ $wishlist->product->unit_price }}</span>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="ps-product__row">
                                                                <div class="ps-product__value">
                                                                    <span
                                                                        class="ps-product__price sale">৳{{ $wishlist->product->unit_price }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                        {{-- <span
                                                                class="ps-product__price">{{ $wishlist->product->unit_price }}</span> --}}
                                                    </td>
                                                    <td class="ps-product__status">
                                                        <span>
                                                            @if ($wishlist->product->box_stock > 0)
                                                                In Stock
                                                            @else
                                                                Out of Stock
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="ps-product__cart">
                                                        <div class="d-flex">
                                                            <a href="{{ route('cart.store', $wishlist->product->id) }}"
                                                                class="btn btn-sm btn-outline-primary add_to_cart mr-2"
                                                                data-product_id="{{ $wishlist->product->id }}"
                                                                data-product_qty="1">
                                                                <i class="fa-solid fa-cart-shopping"></i>
                                                            </a>
                                                            <a class="delete btn btn-sm btn-outline-primary mr-2"
                                                                href="{{ route('wishlist.destroy', $wishlist->id) }}">
                                                                <i class="icon-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="ps-wishlist__share">
                                <label>Share on:</label>
                                <ul class="ps-social ps-social--color">
                                    <li><a class="ps-social__link facebook" href="#"><i class="fa fa-facebook">
                                            </i><span class="ps-tooltip">Facebook</span></a></li>
                                    <li><a class="ps-social__link twitter" href="#"><i
                                                class="fa fa-twitter"></i><span class="ps-tooltip">Twitter</span></a>
                                    </li>
                                    <li><a class="ps-social__link pinterest" href="#"><i
                                                class="fa fa-pinterest-p"></i><span
                                                class="ps-tooltip">Pinterest</span></a></li>
                                    <li class="ps-social__linkedin"><a class="ps-social__link linkedin"
                                            href="#"><i class="fa fa-linkedin"></i><span
                                                class="ps-tooltip">Linkedin</span></a></li>
                                    <li class="ps-social__reddit"><a class="ps-social__link reddit-alien"
                                            href="#"><i class="fa fa-reddit-alien"></i><span
                                                class="ps-tooltip">Reddit Alien</span></a></li>
                                    <li class="ps-social__email"><a class="ps-social__link envelope"
                                            href="#"><i class="fa fa-envelope-o"></i><span
                                                class="ps-tooltip">Email</span></a></li>
                                    <li class="ps-social__whatsapp"><a class="ps-social__link whatsapp"
                                            href="#"><i class="fa fa-whatsapp"></i><span
                                                class="ps-tooltip">WhatsApp</span></a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-app-layout>
