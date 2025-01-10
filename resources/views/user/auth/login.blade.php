<x-frontend-app-layout :title="'Login'">
    <style>
        ::placeholder {
            color: #000 !important;
            opacity: 1;
            font-size: 16px;
        }
        .inner {
            z-index: 2;
            position: relative;
            width: 100%;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(12px, 2vw, 16px);=
            font-weight: 500;
            line-height: 1.5;
            transition: color 0.2s ease-in-out;
            text-align: center;
            word-break: break-word;
        }
    </style>
    <div class="ps-account my-lg-5 py-lg-5 my-0 py-0">
        <div class="container">
            <div class="row row-equal-height login-content my-lg-5 my-0 py-5 py-lg-0 align-items-center gx-5 bg-white">
                <div class="col-12 col-md-6 bg-white column-equal-height">
                    <div class="row">
                        <div class="col-lg-12 pl-5">
                            <div class="p-3">
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <a href="{{ route('home') }}" class="">
                                        <img class="img-fluid" width="200px"
                                            src="{{ !empty(optional($setting)->site_logo_black) ? asset('storage/' . optional($setting)->site_logo_black) : asset('frontend/img/logo.png') }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="text-lg-start text-center">
                                    <h2 class="ps-form__title mb-0">Welcome Back!</h2>
                                    <p>Enter To Get Unlimited Access & Data</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pl-0 pl-lg-5">
                        <div class="col-lg-10  px-lg-0 pl-0 pl-lg-5">
                            <div class="p-3">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="ps-form--review w-100 w-lg-75">
                                        <div class="ps-form__group">
                                            <x-input-label class="form-label form__label" for="email"
                                                :value="__('Email')" />
                                            <x-text-input id="email"
                                                class="form-control form-control-solid ps-form__input" type="email"
                                                name="email" :value="old('email')" required autocomplete="username" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="ps-form__group">
                                            <x-input-label class="ps-form__label form-label" for="password"
                                                :value="__('Password')" />
                                            <div class="input-group">
                                                <x-text-input class="form-control form-control-solid ps-form__input"
                                                    type="password" id="password" name="password" required
                                                    autocomplete="new-password" />
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                <div class="input-group-append">
                                                    <a class="fa fa-eye-slash toogle-password"
                                                        href="javascript:void(0);"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ps-form__submit">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="form-check ml-0">
                                                    <input class="form-check-input" type="checkbox" id="remember_me"
                                                        name="remember">
                                                    <label class="form-check-label" for="remember_me">Remember
                                                        me</label>
                                                </div>
                                                <div>
                                                    @if (Route::has('password.request'))
                                                        <a class="ps-account__link site-text mt-0"
                                                            href="{{ route('password.request') }}">Forgot your password
                                                            ?</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-5">
                                            <button class="btn btn-info w-100 p-3 text-white display-4 rounded-3"
                                                type="submit">
                                                Log in
                                            </button>
                                        </div>
                                        {{-- <div class="login-divider text-center pt-3">
                                            <p class="mb-0 pb-0 divider-text">Or Login With</p>
                                            <p class="devider mb-0 pb-0"></p>
                                        </div> --}}

                                        {{-- <div class="mt-5">
                                            <button class="btn btn-outline-primary w-100 p-3 display-4 rounded-3">
                                              <i class="fa fa-google-plus"></i>  Sign Up With Google
                                            </button>
                                        </div> --}}
                                        @if (Route::has('password.request'))
                                            <p class="text-center"><span class="ps-5 text-center">
                                                    Don't Have Account
                                                    <a class="ps-account__link site-text"
                                                        href="{{ route('register') }}">
                                                        Create New Accounts
                                                    </a>
                                                </span></p>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 column-equal-height px-0">
                    <div>
                        <img class="img-fluid login-imge" src="{{ asset('images/login-side-banner.png') }}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-app-layout>
