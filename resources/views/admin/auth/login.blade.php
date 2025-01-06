<x-admin-guest-layout>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">

            <div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-10">
                <div class="d-flex justify-content-between flex-column-fluid ali flex-column w-100 mw-450px">
                    <div class="py-20">
                        <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework"
                            action="{{ route('admin.login') }}" method="POST" id="kt_sign_in_form">
                            @csrf
                            <div class="card-body">
                                <div class="py-20">
                                    <img width="200px" class="img-fluid" src="{{ optional($setting)->site_logo_black && file_exists(public_path('storage/' . optional($setting)->site_logo_black)) ? asset('storage/' . optional($setting)->site_logo_black) : asset('frontend/img/logo.png') }}"
                                        alt="">
                                    {{-- <img width="200px" class="img-fluid" src="{{ !empty($site->site_logo_white) && file_exists(public_path('storage/settings/' . $site->site_logo_white)) ? asset('storage/settings/' . $site->site_logo_white) : asset('frontend/img/logo.png') }}"
                                        alt=""> --}}
                                </div>
                                <div class="text-start mb-10">
                                    <h1 class="text-gray-900 mb-3 fs-3x" data-kt-translate="sign-in-title">
                                        Sign In
                                    </h1>
                                    <div class="text-gray-500 fw-semibold fs-6" data-kt-translate="general-desc">
                                        Get access &amp; to your dashboard
                                    </div>
                                </div>
                                <div class="fv-row mb-8 fv-plugins-icon-container">
                                    <x-metronic.label
                                        class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</x-metronic.label>
                                    <x-metronic.input type="email" name="email"
                                        class="form-control form-control-solid" placeholder="Enter your email address"
                                        value="{{ old('email') }}" autocomplete="off"></x-metronic.input>
                                </div>
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <div class="d-flex flex-stack mb-2">
                                        <x-metronic.label
                                            class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</x-metronic.label>
                                    </div>
                                    <div class="position-relative mb-3">
                                        <x-metronic.input type="password" name="password" id="passwordField"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Enter your password" autocomplete="off">
                                        </x-metronic.input>
                                        <span
                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-2"
                                            style="@error('password')top: 34% !important; @enderror"
                                            data-kt-password-meter-control="visibility"
                                            onclick="togglePasswordVisibility()">
                                            <i id="eyeIcon" class="bi bi-eye-slash fs-2"></i>
                                            <i class="bi bi-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-10">
                                    @if (Route::has('admin.password.request'))
                                        <a href="{{ route('admin.password.request') }}" class="link-primary"
                                            data-kt-translate="sign-in-forgot-password">
                                            {{ __('Forgot password ?') }}</a>
                                    @endif
                                    <div class="fv-row mb-0">
                                        <input id="remember_me" type="checkbox" class="form-check-input me-3" name="remember">
                                        <x-metronic.label for="remember_me"
                                            class="form-check-label">{{ __('Remember me') }}</x-metronic.label>
                                    </div>
                                </div>
                                <div class="d-flex flex-stack">
                                    <x-metronic.button type="submit" class="btn btn-primary me-2 flex-shrink-0 w-100">
                                        <span class="indicator-label"> {{ __('Sign In Now') }}</span>
                                    </x-metronic.button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-flex flex-lg-row-fluid w-100 bgi-size-cover bgi-position-y-center bgi-position-x-start bgi-no-repeat"
                style="background-image: url({{ asset('admin/assets/images/adminImage.jpg') }})">
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function togglePasswordVisibility() {
                const passwordField = document.getElementById('passwordField');
                const eyeIcon = document.getElementById('eyeIcon');
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eyeIcon.classList.remove('bi-eye');
                    eyeIcon.classList.add('bi-eye-slash');
                } else {
                    passwordField.type = 'password';
                    eyeIcon.classList.remove('bi-eye-slash');
                    eyeIcon.classList.add('bi-eye');
                }
            }
        </script>
    @endpush
</x-admin-guest-layout>
