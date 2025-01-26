<x-frontend-app-layout :title="'Your Accounts Details'">
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

    <div class="ps-account">
        <section class="user-dashboard py-0 py-lg-8">
            <div class="container mb-5">
                <div class="row g-3 g-xl-4 tab-wrap">
                    <div class="col-lg-4 col-xl-3 sticky">
                        <!-- Sidebar here -->
                        @include('user.layouts.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="dashboard-tab bg-white p-5">
                            <div class="title-box3">
                                <h3>Your Accounts Details</h3>
                                <p class="mb-0">
                                    Manage and review your personal account information. Here, you can view and update
                                    essential details related to your profile, including your contact information,
                                    account settings, and security preferences
                                </p>
                            </div>
                            <div class="row g-0 option-wrap">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="ps-checkout__content">
                                        <form action="{{ route('profile.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row pt-5">
                                                <div class="col-12 col-lg-12">
                                                    <div class="ps-checkout__form">
                                                        <div class="row">
                                                            <!-- Account Information Section -->
                                                            <div class="col-12">
                                                                <h4>Account Information</h4>
                                                                <hr>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group mb-0">
                                                                    <label class="ps-checkout__label">আপনার নাম
                                                                        <span class="text-danger">*</span> </label>
                                                                    <input class="form-control" name="name"
                                                                        value="{{ old('name', Auth::user()->name) }}"
                                                                        type="text" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group mb-0">
                                                                    <label class="ps-checkout__label">Phone <span
                                                                            class="text-danger">*</span> </label>
                                                                    <input class="form-control" name="phone"
                                                                        value="{{ old('phone', Auth::user()->phone) }}"
                                                                        type="text" required>
                                                                </div>
                                                            </div>
                                                            <!-- Billing Information Section -->
                                                            <div class="col-12 mt-4">
                                                                <h4>Information</h4>
                                                                <hr>
                                                            </div>

                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label class="ps-checkout__label">Country</label>
                                                                    <select name="country" class="form-control select"
                                                                        id="country">
                                                                        <option value="Bangladesh"
                                                                            @selected(Auth::user()->country == 'Bangladesh')>Bangladesh
                                                                        </option>
                                                                        <option value="India"
                                                                            @selected(Auth::user()->country == 'India')>India</option>
                                                                        <option value="Pakistan"
                                                                            @selected(Auth::user()->country == 'Pakistan')>Pakistan
                                                                        </option>
                                                                        <option value="Nepal"
                                                                            @selected(Auth::user()->country == 'Nepal')>Nepal</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                <div class="form-group">
                                                                    <label class="ps-checkout__label">Thana</label>
                                                                    <input class="form-control" name="thana"
                                                                        value="{{ old('thana', Auth::user()->thana) }}"
                                                                        type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                <div class="form-group">
                                                                    <label class="ps-checkout__label">District</label>
                                                                    <input class="form-control" name="district"
                                                                        value="{{ old('district', Auth::user()->district) }}"
                                                                        type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="ps-checkout__group">
                                                                    <label class="ps-checkout__label">Full
                                                                        Address</label>
                                                                    <textarea class="form-control form-control-solid-bg ps-textarea mt-2 p-2" name="address_one" rows="1"
                                                                        placeholder="House number and street name">{{ old('address_one', Auth::user()->address_one) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div>
                                                                    <label
                                                                        class="ps-checkout__label pb-2">Password</label>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <input id="password-field" type="password"
                                                                        class="form-control" name="password"
                                                                        value="{{ old('zipcode', Auth::user()->password) }}">
                                                                    <div class="input-group-append">
                                                                        <button id="toggle-password"
                                                                            class="bg-warning border-0 text-white" type="button">
                                                                            <i id="password-icon"
                                                                                class="fa fa-eye"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <input type="submit" value="Save Changes"
                                                                    class="updatebutton btn btn-info w-100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script>
            document.getElementById('toggle-password').addEventListener('click', function() {
                var passwordField = document.getElementById('password-field');
                var passwordIcon = document.getElementById('password-icon');

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    passwordIcon.classList.remove('fa-eye');
                    passwordIcon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    passwordIcon.classList.remove('fa-eye-slash');
                    passwordIcon.classList.add('fa-eye');
                }
            });
        </script>
    @endpush
</x-frontend-app-layout>
