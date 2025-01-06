<x-frontend-app-layout :title="'About Us'">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Parisienne&display=swap');

        .about-down-img {
            position: relative;
            display: inline-block;
        }

        .about-bg-shape {
            display: block;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            animation: rotateZoom 5s infinite linear;
        }

        .about-upper-img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            max-width: 70%;
        }

        .extra-font {
            font-family: "Parisienne", cursive !important;
        }

        /* Keyframes for rotation and zoom */
        @keyframes rotateZoom {
            0% {
                transform: scale(1) rotate(0deg);
            }

            25% {
                transform: scale(1.1) rotate(90deg);
            }

            50% {
                transform: scale(1) rotate(180deg);
            }

            75% {
                transform: scale(0.9) rotate(270deg);
            }

            100% {
                transform: scale(1) rotate(360deg);
            }
        }
    </style>
    <div class="ps-about bg-white">
        <div class="container">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Home</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page">About us</li>
            </ul>
        </div>
        <div class="container-fluid px-0" style="background-color: #FCF2FF;">
            <div class="container">
                <div class="row align-items-center py-5">
                    <div class="col-lg-6">
                        <div class="ps-banner__content">
                            <h1 class="about-main-title">Welcome to Ardhanggini. Your trusted destination for stylish,
                                high-quality women's bags.</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-center align-items-center">
                        <div class="about-down-img position-relative">
                            <img class="about-bg-shape" src="{{ asset('frontend/img/about/Circles.png') }}" alt>
                            <img class="about-upper-img ps-banner__image"
                                src="{{ asset('frontend/img/about/about-bg.png') }}" alt>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <section class="ps-about--info about-infos">
                <div class="ps-about__extent container">
                    <div class="row my-2 my-lg-5">
                        <div class="col-12 col-md-4 p-0">
                            <div class="ps-block--about">
                                <div class="ps-block__icon"><img src="{{ asset('frontend/img/about/icons1.png') }}"
                                        alt=""></div>
                                <h4 class="ps-block__title">Effortless Ordering</h4>
                                <div class="ps-block__subtitle">Streamline your purchases with our easy-to-use
                                    online platform, making ordering a breeze for
                                    your convenience.
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 p-0">
                            <div class="ps-block--about">
                                <div class="ps-block__icon"><img src="{{ asset('frontend/img/about/icons2.png') }}"
                                        alt="">
                                </div>
                                <h4 class="ps-block__title">Flexible Shipping Options</h4>
                                <div class="ps-block__subtitle">Choose from a variety of shipping methods
                                    tailored to your needs, ensuring your orders arrive promptly and efficiently.</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 p-0">
                            <div class="ps-block--about">
                                <div class="ps-block__icon"><img src="{{ asset('frontend/img/about/icons3.png') }}"
                                        alt="">
                                </div>
                                <h4 class="ps-block__title">Dedicated Customer Support</h4>
                                <div class="ps-block__subtitle">Our knowledgeable team is always here to
                                    assist you, providing personalized assistance and expert guidance whenever you need
                                    it.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section style="background-color: var(--site-green);">
                <div class="container py-5">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="about-content">
                                <h2 class="text-white about-main-title">Are you searching for a practical everyday tote, an elegant
                                    handbag, or a trendy
                                    backpack?</h2>
                                <p class="text-white py-3">we are here to meet your needs with exceptional products and
                                    personalized service.
                                </p>
                                <a class="btn btn-light rounded-pill-btn" href="{{ route('allproducts') }}">Shop now</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-middle-img-box">
                                <img class="img-fluid about-middle-img"
                                    src="{{ asset('frontend/img/about/Ardhanggini Image.png') }}" alt="">
                            </div>
                        </div>
                    </div>
            </section>
        </div>
        <section class="ps-about__project pb-0">
            <div class="">
                <h4 class="ps-about__title pt-3">Why Choose Ardhanggini?
                </h4>
                <div>
                    <div class="container box-padding pt-4">
                        <section class="ps-section--block-grid align-items-center mb-0">
                            <div class="ps-section__thumbnail mb-0"> <a class="ps-section__image" href="#"><img
                                        src="{{ asset('frontend/img/about/about-first-1.jpg') }}" alt=""
                                        style="border-radius: 5px;"></a>
                            </div>
                            <div>
                                <div class="ps-section__content">
                                    <h3 class="ps-section__title site-text mb-2 about-title">Premium Quality:</h3>
                                    <div class="ps-section__desc mb-1 about-description">We partner with trusted suppliers to ensure that every
                                        product meets the highest standards of quality and durability.</div>
                                </div>
                                <div class="ps-section__content">
                                    <h3 class="ps-section__title site-text mb-2 about-title">Affordable Luxury:</h3>
                                    <div class="ps-section__desc mb-1 about-description">Enjoy the perfect balance of style and affordability.
                                        At Ardhanggini, we believe that everyone deserves access to high-quality,
                                        fashionable bags without breaking the bank.</div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div style="background-color: #FCF2FF;">
                    <div class="container box-padding">
                        <section class="ps-section--block-grid row-reverse align-items-center mb-0">
                            <div class="ps-section__thumbnail mb-0"> <a class="ps-section__image" href="#"><img
                                        src="{{ asset('frontend/img/about/about-first-2.jpg') }}" alt=""
                                        style="border-radius: 5px;"></a>
                            </div>
                            <div>
                                <div class="ps-section__content">
                                    <h3 class="ps-section__title mb-2 about-title">Effortless Shopping:</h3>
                                    <div class="ps-section__desc mb-1 about-description">
                                        Our user-friendly online platform makes finding and ordering your favorite bags
                                        a breeze.
                                    </div>
                                </div>
                                <div class="ps-section__content">
                                    <h3 class="ps-section__title mb-2 about-title">Flexible Delivery Options: </h3>
                                    <div class="ps-section__desc mb-1 about-description">With reliable shipping services across Bangladesh,
                                        your orders are delivered promptly and efficiently.</div>
                                </div>
                                <div class="ps-section__content">
                                    <h3 class="ps-section__title mb-2 about-title">Dedicated Customer Support: </h3>
                                    <div class="ps-section__desc mb-1 about-description">Our friendly and knowledgeable team is always ready
                                        to
                                        assist you, ensuring a smooth and enjoyable shopping experience.</div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="container box-padding">
                    <section class="ps-section--block-grid mb-0 align-items-center">
                        <div class="ps-section__thumbnail mb-0"> <a class="ps-section__image" href="#"><img
                                    src="{{ asset('frontend/img/about/about-us-3-mission.jpg') }}" alt=""
                                    style="border-radius: 5px;"></a></div>
                        <div class="ps-section__content mb-3  mb-lg-0">
                            <h3 class="ps-section__title mb-2 about-title">Our Mission:</h3>
                            <div class="ps-section__desc pb-3 mb-0 about-description">
                                At Ardhanggini, we are passionate about empowering women with bags that reflect their
                                style and confidence. We are committed to providing products that combine beauty,
                                practicality, and affordability to elevate your everyday look.
                            </div>
                            <div class="ps-section__desc mb-1 about-description">
                                Browse our collections today and experience the perfect blend of fashion and function
                                with Ardhanggini.
                            </div>
                        </div>
                    </section>
                </div>
                <div style="background-color: #FCF2FF">
                    <section class="ps-about--video">
                        <div class="ps-banner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="ps-banner__content">
                                            <h2 class="ps-banner__title extra-font">Thank you</h2>
                                            <p class="ps-banner__desc">For choosing Ardhanggini.
                                                Where fashion meets function. Happy shopping!</p>
                                            <a class="ps-banner__shop bg-warning"
                                                href="{{ route('allproducts') }}">Shop Now
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            <iframe width="560" height="315"
                                                src="https://www.youtube.com/embed/Un-taQ8cntc?si=9zyCq_gdxhCefKqc"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                referrerpolicy="strict-origin-when-cross-origin"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script>
            $(function() {
                // Owl Carousel
                var owl = $(".owl-carousel");
                owl.owlCarousel({
                    items: 1,
                    margin: 10,
                    loop: true,
                    nav: true,
                    dots: false, // Ensures that dot indicators are not shown
                    autoplay: true, // Enables autoplay
                    autoplayTimeout: 3000, // Time in milliseconds (3000ms = 3 seconds)
                    autoplayHoverPause: true, // Pause on mouse hover
                    responsive: {
                        480: {
                            items: 1
                        },
                        768: {
                            items: 1
                        },
                        992: {
                            items: 1
                        },
                        1200: {
                            items: 4
                        },
                        1680: {
                            items: 4
                        }
                    }
                });
            });
        </script>
    @endpush
</x-frontend-app-layout>
