@php
    $cartItems = Cart::instance('cart')->content();
    $subTotal = Cart::instance('cart')->subtotal();
@endphp
    <ul class="ps-cart__items">
        @foreach ($cartItems as $item)
            <li class="ps-cart__item">
                <div class="ps-product--mini-cart">
                    <a class="ps-product__thumbnail" href="{{ route('product.details', $item->model->slug) }}">
                        <img src="{{ asset('storage/' . $item->model->thumbnail) }}" alt="alt" />
                    </a>
                    <div class="ps-product__content p-0">
                        <a class="ps-product__name" href="{{ route('product.details', $item->model->slug) }}">
                            {{ $item->model->name }}</a>
                        <p class="ps-product__meta">
                            <span class="ps-product__price">{{ $item->qty }}  X  </span>
                            <span class="ps-product__price">৳{{ $item->price }}</span>
                        </p>
                    </div>
                    <a class="ps-product__remove delete" href="{{ route('cart.destroy',$item->rowId ) }}">
                        <i class="icon-cross"></i>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="ps-cart__total">
        <span>Subtotal </span>
        <span>৳{{ $subTotal }}</span>
    </div>
    <div class="ps-cart__footer d-flex">
        <a class="btn btn-outline-primary mr-2" href="{{ route('cart') }}">View Cart
        </a>
        <a class="btn btn-primary" href="{{ route('checkout') }}">Checkout</a>
    </div>

