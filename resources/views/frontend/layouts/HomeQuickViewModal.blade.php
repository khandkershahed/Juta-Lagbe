@foreach ($latestproducts as $latest_product)
    <div class="modal fade" id="popupQuickview{{ $latest_product->id }}" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered ps-quickview">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap-modal-slider container-fluid ps-quickview__body">
                        <button class="close ps-quickview__close" type="button" data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="ps-product--detail">
                            <div class="row">
                                <div class="col-12 col-xl-6 pl-0">
                                    <div class="ps-product--gallery">
                                        <div class="ps-product__thumbnail p-0">
                                            @if ($latest_product->multiImages->isNotEmpty())
                                                @foreach ($latest_product->multiImages->slice(0, 5) as $image)
                                                    @php
                                                        $imagePath = 'storage/' . $image->photo;
                                                        $imageSrc = file_exists(public_path($imagePath))
                                                            ? asset($imagePath)
                                                            : asset('frontend/img/no-product.jpg');
                                                    @endphp
                                                    <div class="slide">
                                                        <img src="{{ $imageSrc }}"
                                                            alt="{{ $latest_product->name }}" />
                                                    </div>
                                                @endforeach
                                            @else
                                                @php
                                                    $thumbnailPath = 'storage/' . $latest_product->thumbnail;
                                                    $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                        ? asset($thumbnailPath)
                                                        : asset('frontend/img/no-product.jpg');
                                                @endphp
                                                <div class="slide">
                                                    <img src="{{ $thumbnailSrc }}" alt="{{ $latest_product->name }}" />
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ps-gallery--image">
                                            @if ($latest_product->multiImages->isNotEmpty())
                                                @foreach ($latest_product->multiImages->slice(0, 5) as $image)
                                                    @php
                                                        $imagePath = 'storage/' . $image->photo;
                                                        $imageSrc = file_exists(public_path($imagePath))
                                                            ? asset($imagePath)
                                                            : asset('frontend/img/no-product.jpg');
                                                    @endphp
                                                    <div class="slide">
                                                        <div class="ps-gallery__item">
                                                            <img src="{{ $imageSrc }}"
                                                                alt="{{ $latest_product->name }}" />
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                @php
                                                    $thumbnailPath = 'storage/' . $latest_product->thumbnail;
                                                    $thumbnailSrc = file_exists(public_path($thumbnailPath))
                                                        ? asset($thumbnailPath)
                                                        : asset('frontend/img/no-product.jpg');
                                                @endphp
                                                <div class="slide">
                                                    <div class="ps-gallery__item">
                                                        <img src="{{ $thumbnailSrc }}"
                                                            alt="{{ $latest_product->name }}" />
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="pt-3">
                                            <span class="ps-list__title">SKU-Code: </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6 pr-0">
                                    <div class="ps-product__info mb-0">
                                        <div class="">
                                            <span
                                                class="ps-badge ps-badge--instock ps-badge-2">{{ $latest_product->box_stock > 0 ? 'IN STOCK' : 'OUT OF STOCK' }}</span>
                                        </div>
                                        <div class="ps-product__branch pt-2">
                                            <a href="#"
                                                style="text-transform: uppercase;">{{ optional($latest_product->brand)->name }}</a>
                                        </div>
                                        <h4 class="">
                                            <a href="{{ route('product.details', $latest_product->slug) }}">
                                                {{ $latest_product->name }}
                                            </a>
                                        </h4>
                                        <div class="ps-product__desc">
                                            <p>{!! $latest_product->short_description !!}</p>
                                        </div>

                                        <div class="ps-product__feature">
                                            @if (!empty($latest_product->unit_discount_price))
                                                <div class="ps-product__meta">
                                                    <span class="ps-product__price sale fw-bold"
                                                        style="font-weight:600;">দাম
                                                        {{ $latest_product->unit_discount_price }}
                                                        টাকা</span>
                                                    <span
                                                        class="ps-product__del text-danger">{{ $latest_product->unit_price }}
                                                        টাকা</span>
                                                </div>
                                            @else
                                                <div class="ps-product__meta">
                                                    <span class="ps-product__price sale fw-bold"
                                                        style="font-weight:600;">দাম
                                                        {{ $latest_product->unit_price }}
                                                        টাকা</span>
                                                </div>
                                            @endif

                                            {{-- <div class="ps-product__quantity">
                                                <h6>Quantity</h6>
                                                <div class="def-number-input number-input safari_only">
                                                    <button class="minus"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                            class="icon-minus"></i></button>
                                                    <input class="quantity" min="1" name="quantity"
                                                        value="1" type="number"
                                                        data-product_id="{{ $latest_product->id }}" />
                                                    <button class="plus"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                            class="icon-plus"></i></button>
                                                </div>
                                            </div> --}}
                                            <div class="d-flex align-items-center card-cart-btn">
                                                <a href="{{ route('product.details', $latest_product->slug) }}"
                                                    class="btn btn-primary rounded-0 w-100">
                                                    <i class="fa-solid fa-basket-shopping pr-2"></i>
                                                    অর্ডার
                                                    করুন
                                                </a>
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
    </div>
@endforeach
