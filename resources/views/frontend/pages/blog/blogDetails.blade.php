<x-frontend-app-layout :title="'Blog Details'">
    <div class="ps-post ps-post--sidebar">
        <div class="container">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Home</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page">{{ $blog->title }}</li>
            </ul>
            <div class="ps-post__content">
                <div class="row">
                    <div class="col-12 col-md-9">
                        {{-- <div class="ps-blog__badge">
                            @foreach ($blog as $slug)
                                <span class="ps-badge__item">{{ $slug }}</span>
                            @endforeach
                        </div> --}}
                        <h1 class="ps-post__title">{{ $blog->title }}</h1>
                        <div class="ps-blog__meta"> <span
                                class="ps-blog__date">{{ $blog->created_at->format('M d Y') }}</span>
                            <a class="ps-blog__author" href="#">{{ $blog->author }}</a>
                        </div>
                        <div class="ps-blog__banner">
                            <img src="{{ asset('storage/' . $blog->banner_image) }}" alt="{{ $blog->title }}">
                        </div>
                        <p class="ps-blog__text-large">{!! $blog->header !!}</p>
                        <p class="ps-blog__text">{!! $blog->short_description !!}</p>
                        <p class="ps-blog__text">{!! $blog->long_description !!}</p>

                        <p class="ps-blog__text">{!! $blog->footer !!}</p>
                        {{-- <div class="ps-comment--post">
                            <h2 class="ps-comment__title">Comments (0)</h2>
                            <ul class="ps-comment__list">
                                <li>
                                    <div class="ps-review--product">
                                        <div class="ps-review__row">
                                            <div class="ps-review__avatar"><img src="img/avatar/avatar-review3.html" alt="alt" /></div>
                                            <div class="ps-review__info">
                                                <div class="ps-review__name">Jenna S.</div>
                                                <div class="ps-review__date">Aug 12, 2021</div>
                                            </div>
                                            <div class="ps-review__desc">
                                                <p>Everything is perfect. I would recommend!</p><a class="ps-review__reply" href="#">Reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="ps-form--review">
                            <div class="ps-form__title">Write a comment</div>
                            <div class="ps-form__desc">Your email address will not be published. All fields are required
                            </div>
                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-6 col-md-6">
                                        <label class="ps-form__label">Your name</label>
                                        <input class="form-control ps-form__input" placeholder="Your name">
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <label class="ps-form__label">Your e-mail</label>
                                        <input class="form-control ps-form__input" placeholder="Your e-mail">
                                    </div>
                                    <div class="col-12">
                                        <div class="ps-form__block">
                                            <label class="ps-form__label">Your comment</label>
                                            <textarea class="form-control ps-form__textarea"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn ps-btn ps-btn--warning">Add Review</button>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="ps-widget ps-widget--blog">
                            <div class="ps-product--extension">
                                <div class="ps-product__delivery">
                                    <div class="ps-delivery__item"><i class="icon-wallet"></i>100% Money back Guaranteed</div>
                                    <div class="ps-delivery__item"><i class="icon-bag2"></i>Non-contact shipping</div>
                                    <div class="ps-delivery__item"><i class="icon-refresh"></i>Minimum Order Quantity
                                        Over ৳500</div>
                                    <div class="ps-delivery__item"><i class="icon-truck"></i>Free Delivery All Over UK Mainland (2-3 Days)</div>
                                </div>
                                <div class="ps-product__payment"> <img src="{{ asset('frontend/img/payment-product.png') }}" alt></div>
                                <div class="ps-product__gif">
                                    <div class="ps-gif__text"><i class="icon-shield-check"></i><strong>100% Secure
                                            delivery </strong>without contacting the courier</div><img
                                        class="ps-gif__thumbnail" src="{{ asset('frontend/img/blue-white-ribbon-on-pink-box.jpg') }}" alt>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="ps-section--blog" data-background="img/related-bg.jpg">
            <div class="container">
                <h3 class="ps-section__title">Related Posts</h3>
                <div class="ps-section__carousel">
                    <div class="owl-carousel" data-owl-auto="false" data-owl-loop="true" data-owl-speed="13000"
                        data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="3" data-owl-item-xs="1"
                        data-owl-item-sm="1" data-owl-item-md="2" data-owl-item-lg="3" data-owl-item-xl="3"
                        data-owl-duration="1000" data-owl-mousedrag="on">
                        @foreach ($blog_posts as $blog_post)
                            <div class="ps-section__item">
                                <div class="ps-blog--latset">
                                    <div class="ps-blog__thumbnail">
                                        <a href="{{ route('blog.details', $blog_post->slug) }}">
                                            <img src="{{ asset('storage/' . $blog_post->image) }}" alt="alt" />
                                        </a>
                                        <div class="ps-blog__badge">
                                            <span class="ps-badge__item">{{ $blog_post->badge }}</span>
                                            {{-- @foreach ($blog_post->blogTag as $tag)
                                                <span class="ps-badge__item">{{ $tag->name }}</span>
                                            @endforeach --}}

                                        </div>
                                    </div>
                                    <div class="ps-blog__content">
                                        <div class="ps-blog__meta"> <span
                                                class="ps-blog__date">{{ $blog_post->created_at->format('M d Y') }}</span>
                                            <a class="ps-blog__author" href="#">{{ $blog_post->author }}</a>
                                        </div>
                                        <a class="ps-blog__title"
                                            href="{{ route('blog.details', $blog_post->slug) }}">{{ $blog_post->title }}</a>
                                        <p class="ps-blog__desc">{{ $blog_post->header }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-frontend-app-layout>
