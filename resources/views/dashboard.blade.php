<x-frontend-app-layout :title="'User Dashboard'">
    {{-- <div class="breadcrumb-wrap">
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
    </div> --}}
    @if (Auth::user()->status == 'active')
        <div class="ps-account">
            <section class="user-dashboard py-5">
                <div class="container">
                    <div class="row g-3 g-xl-4 tab-wrap">
                        <div class="col-lg-4 col-xl-3 sticky">
                            <button class="d-lg-none d-sm-block setting-menu btn-solid btn-sm " style="display: none">Setting Menu <i
                                    class="arrow"></i>
                                </button>
                            @include('user.layouts.sidebar')
                        </div>
                        <div class="col-lg-8 col-xl-9">
                            <div class="right-content tab-content" id="myTabContent">
                                <!-- User Dashboard Start -->
                                {{-- <div class="tab-pane show active" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab"> --}}
                                    <div class="dashboard-tab p-3" style="border:1px solid c7c5c5">
                                        <div class="title-box3">
                                            <div class="title-box3 text-center">
                                                <h1>
                                                    <span class="text-info">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                                                    <br>Welcome To Your Dashboard
                                                </h1>
                                            </div>
                                            <p>
                                                Welcome to your account page, where you can manage your trade account
                                                effortlessly. Here, you can view your order history, update your
                                                details, and place quick orders. Additionally, you can subscribe to our daily
                                                stock feed, check stock availability.
                                            </p>
                                        </div>
                                        <div class="row">
                                        {{-- <div class="row g-0 option-wrap"> --}}
                                            <div class="col-sm-6 col-xl-4">
                                                <a href="{{ route('user.order.history') }}" data-class="orders"
                                                    class="tab-box">
                                                    <img src="{{ asset('frontend/img/icon/1.svg') }}"
                                                        alt="shopping bag">
                                                    <h5>Order History</h5>
                                                    <p>Search and View Your Online Order History with Ease.</p>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <a href="{{ route('user.account.details') }}" data-class="wishlist"
                                                    class="tab-box">
                                                    <img src="{{ asset('frontend/img/icon/2.svg') }}" alt="wishlist">
                                                    <h5>Account Details</h5>
                                                    <p>Update Your Contact Details and Address</p>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <a href="{{ route('user.quick.order') }}" data-class="savedAddress"
                                                    class="tab-box">
                                                    <img src="{{ asset('frontend/img/icon/3.svg') }}" alt="address">
                                                    <h5>Quick order</h5>
                                                    <p>Search and Add Products to Your Basket for Quick Orders.</p>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <a href="{{ route('user.stock.history') }}" data-class="payment"
                                                    class="tab-box">
                                                    <img src="{{ asset('frontend/img/icon/4.svg') }}" alt="payment">
                                                    <h5>Stock Availability</h5>
                                                    <p>Easily Check Stock Availability with Our User-Friendly Page.</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                {{-- </div> --}}
                                <!-- User Dashboard End -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @else
        <section class="user-dashboard py-0 py-lg-8">
            <div class="container">
                <div>
                    <h6 class="text-warning display-4 text-center">Thank you for registering. <br> Our team is
                        reviewing your information. You'll receive a confirmation email once your account is active.
                    </h6>
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid" style="width: 100px;"
                            src="https://cdni.iconscout.com/illustration/premium/thumb/wait-a-minute-6771645-5639826.png?f=webp"
                            alt="">
                    </div>
                    <div class="w-25 mx-auto">
                        <a href="{{ route('home') }}" class="ps-btn ps-btn--warning">Back To Home</a>
                    </div>
                </div>
            </div>
        </section>
    @endif
</x-frontend-app-layout>
