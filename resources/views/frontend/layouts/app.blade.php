<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="{{ asset('storage/' . optional($setting)->site_favicon) }}" rel="apple-touch-icon-precomposed">
    <link href="{{ asset('storage/' . optional($setting)->site_favicon) }}" rel="shortcut icon" type="image/png">

    @stack('heads')
    @props(['product'])

    @if (Route::currentRouteName() === 'product.details')
        @php
            $metaTitle = $product->meta_title ?? $product->name;
            $metaDescription = strip_tags(
                $product->meta_description ?? substr(htmlspecialchars($product->description), 0, 150),
            );
            $metaImage = $product->thumbnail ?? ''; // Default image
        @endphp

        <meta name="title" content="{{ $metaTitle }}" />
        <meta name="description" content="{{ $metaDescription }}" />
        <meta property="og:title" content="{{ $metaTitle }}" />
        <meta property="og:description" content="{{ $metaDescription }}" />
        <meta property="og:image" content="{{ $metaImage ? asset('storage/' . $metaImage) : '' }}" />
        <meta property="og:type" content="product" />

        <meta property="og:url" content="{{ request()->fullUrl() }}" />
        <meta property="og:site_name" content="{{ optional($setting)->site_title ?: config('app.name') }}" />
        <meta property="og:locale" content="en_US" />

        <meta property="twitter:title" content="{{ $metaTitle }}" />
        <meta property="twitter:description" content="{{ $metaDescription }}" />
        <meta property="twitter:image" content="{{ $metaImage ? asset('storage/' . $metaImage) : '' }}" />
    @else
        <meta name="title" content="{{ optional($setting)->site_title ?: config('app.name', 'E-Commerce') }}" />
        <meta name="description" content="{{ optional($setting)->meta_description ?: config('app.name') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ optional($setting)->site_url ?: config('app.url') }}" />
        <meta property="og:title" content="{{ optional($setting)->site_title ?: config('app.name', 'E-Commerce') }}" />
        <meta property="og:description" content="{{ optional($setting)->meta_description ?: config('app.name') }}" />
        <meta property="og:image"
            content="{{ optional($setting)->site_logo_black && file_exists(public_path('storage/' . optional($setting)->site_logo_black)) ? asset('storage/' . optional($setting)->site_logo_black) : asset('frontend/images/brandPage-logo-no-img(217-55).jpg') }}" />

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="{{ optional($setting)->site_url ?: config('app.url') }}" />
        <meta property="twitter:title"
            content="{{ optional($setting)->site_title ?: config('app.name', 'E-Commerce') }}" />
        <meta property="twitter:description"
            content="{{ optional($setting)->meta_description ?: config('app.name') }}" />
        <meta property="twitter:image"
            content="{{ optional($setting)->site_logo_black && file_exists(public_path('storage/' . optional($setting)->site_logo_black)) ? asset('storage/' . optional($setting)->site_logo_black) : asset('frontend/images/brandPage-logo-no-img(217-55).jpg') }}" />
    @endif

    <title>
        {{ isset($metaTitle) && $metaTitle ? $metaTitle : (optional($setting)->site_title ? optional($setting)->site_title : config('app.name', 'E-Commerce')) }}
    </title>
    <!-- Open Graph / Facebook -->


    <link rel="stylesheet" href="{{ asset('frontend/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/Linearicons/Font/demo-files/demo.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/bootstrap4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/owl-carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/slick/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/lightGallery/dist/css/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/lightGallery/dist/css/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/noUiSlider/nouislider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/home-14.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/sidebar.css') }}">
    <link href="{{ asset('frontend/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <!--Start of Tawk.to Script-->
    {{-- <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/66fa6576e5982d6c7bb68965/1i911om0h';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script> --}}
    <!--End of Tawk.to Script-->

    <style>
        /* Preloader styles */
        #preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Main content visibility after preloader */
        #main-content {
            display: block;
        }

        /* Swal2 Popup Styling */
        .swal2-popup {
            font-size: 1.3rem !important;
            padding: 1.5rem;
        }

        /* Swal button alignment */
        .swal2-confirm {
            margin-right: 1rem;
        }

        .swal2-actions {
            margin-bottom: 1.25rem;
        }
    </style>
</head>

<body>
    <!-- Preloader HTML -->
    <div id="preloader" class="flex-column">
        <div class="wave-text">
            <span>অ</span>
            <span>র্ধা</span>
            <span>ঙ্গি</span>
            <span>নী</span>
        </div>
    </div>
    <div id="main-content" style="display: none;">
        <div class="ps-page">
            {{-- Header --}}
            @include('frontend.layouts.header')
            {{-- Header --}}
            {{ $slot }}
            {{-- Footer --}}
            @include('frontend.layouts.footer')
        {{-- Footer --}}
        </div>
        {{-- Sidebar Cart Common Start --}}
        <div>
            <a class="cart-sidebar-btn" href="{{ route('cart') }}">
                <span class="cart-values cartCount">{{ Cart::instance('cart')->count() }}</span>
                <i class="fa fa-shopping-cart"></i>
            </a>
        </div>
        {{-- Sidebar Cart Common End --}}
    </div>

    <!-- Scroll to Top Button -->
    <a href="#" class="scroll-top" style="display: none;">↑</a>
 
    @include('frontend.layouts.extra')
    <script src="{{ asset('frontend/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/bootstrap4/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/lightGallery/dist/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/slick/slick/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/noUiSlider/nouislider.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/69b7156a94.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://kit.fontawesome.com/69b7156a94.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/sidebar.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    @stack('scripts')

    <script>
        function addToCart(e, csrfToken, cartUrl) {
            e.preventDefault(); // Prevent the default action of the link

            var button = e.currentTarget; // Get the button that triggered the event
            var product_id = button.getAttribute('data-product_id');
            var qty = button.getAttribute('data-product_qty'); // Get the quantity value
            var cartHeader = document.querySelector('.miniCart');

            // Check if quantity is valid
            if (qty <= 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Quantity',
                    text: 'Please select a valid quantity.'
                });
                return;
            }

            // AJAX request
            fetch(cartUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken // Include CSRF token for security
                    },
                    body: JSON.stringify({
                        quantity: qty
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const Toast = Swal.mixin({
                        showConfirmButton: false,
                        timer: 1000
                    });

                    if (data.success) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });
                        button.disabled = true; // Disable the button
                        button.innerText = 'Included'; // Change button text
                        document.querySelector(".cartCount").innerHTML = data.cartCount;
                        cartHeader.innerHTML = data.cartHeader;
                        if (data.subTotal > 4000) {
                            Toast.fire({
                                title: 'Congratulations!',
                                text: "Your shipping is now free. Happy Shopping!",
                                icon: 'success',
                                showCancelButton: true,
                                // confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'Close',
                                buttonsStyling: false,
                                customClass: {
                                    // confirmButton: 'btn btn-danger',
                                    cancelButton: 'btn btn-success'
                                }
                            })
                        }
                    } else if (data.error) {
                        Toast.fire({
                            icon: 'error',
                            title: data.error
                        });
                    }
                })
                .catch(xhr => {
                    let errorMessage = 'An unexpected error occurred.';

                    // Check if the response is JSON and contains an error message
                    if (xhr.response && xhr.response.error) {
                        errorMessage = xhr.response.error;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: errorMessage
                    });
                });
        }
    </script>
    {{-- Preloader --}}
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}'
            });
        </script>
    @endif
    @if (session('errors'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @foreach (session('errors') as $error)
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{ $error }}',
                        timer: 1000
                    });
                @endforeach
            });
        </script>
    @endif
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Set a timeout for 2 seconds
            setTimeout(function() {
                // Hide the preloader
                document.getElementById('preloader').style.display = 'none';
                // Show the main content
                document.getElementById('main-content').style.display = 'block';
            }, 700); // 2000 milliseconds = 2 seconds
        });
    </script>
    {{-- Preloader End --}}
    <!-- custom code-->
    <script>
        class Dashboard {
            constructor() {
                this.initDataTables();
            }
            initDataTables() {
                $(document).ready(() => {
                    // Initialize DataTable for elements with class 'order-history-table'
                    $('.order-history-table').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                        "language": {
                            "paginate": {
                                "previous": "<i class='fa fa-chevron-left pagination-icon'></i>",
                                "next": "<i class='fa fa-chevron-right pagination-icon'></i>"
                            }
                        }
                    });
                });
            }
        }
        // Create an instance of the Dashboard class
        $(document).ready(() => {
            new Dashboard();
        });
    </script>
    {{-- add_to_cart_btn_product_single --}}
    <script>
        $(document).ready(function() {
            $('.add_to_cart_btn_product_single').click(function(e) {
                e.preventDefault(); // Prevent the default action of the link

                // Find the quantity input
                var $quantityInput = $(this).closest('.ps-product__feature').find('.quantity');
                var product_id = $(this).data('product_id');
                var cartHeader = $('.miniCart');
                var qty = $quantityInput.val(); // Get the quantity value

                // Check if quantity is valid
                if (qty <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Invalid Quantity',
                        text: 'Please select a valid quantity.'
                    });
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: '/cart/store/' + product_id,
                    data: {
                        _token: "{{ csrf_token() }}", // Include CSRF token for security
                        quantity: qty
                    },
                    dataType: 'json',
                    success: function(data) {
                        const Toast = Swal.mixin({
                            showConfirmButton: false,
                            timer: 1000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });
                        if (data.subTotal > 4000) {
                            Toast.fire({
                                title: 'Congratulations!',
                                text: "Your shipping is now free. Happy Shopping!",
                                icon: 'success',
                                showCancelButton: true,
                                // confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'Close',
                                buttonsStyling: false,
                                customClass: {
                                    // confirmButton: 'btn btn-danger',
                                    cancelButton: 'btn btn-success'
                                }
                            })
                        }
                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            });

                            // Update mini cart
                            cartHeader.html(data.cartHeader);
                            $(".cartCount").html(data.cartCount);
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'An unexpected error occurred.';

                        // Check if the response is JSON and contains an error message
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        } else if (xhr.responseText) {
                            try {
                                let response = JSON.parse(xhr.responseText);
                                if (response.error) {
                                    errorMessage = response.error;
                                }
                            } catch (e) {
                                console.error('Error parsing response text:', e);
                            }
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.add_to_cart').click(function(e) {
                e.preventDefault(); // Prevent the default action of the link
                var button = $(this);
                var product_id = button.data('product_id');
                var qty = button.data('product_qty'); // Get the quantity value
                var cartUrl = $(this).attr('href');
                var cartHeader = $('.miniCart');

                // Check if quantity is valid
                if (qty <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Invalid Quantity',
                        timer: 1000,
                        text: 'Please select a valid quantity.'
                    });
                    return;
                }

                $.ajax({
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // Include CSRF token for security
                        quantity: qty
                    },
                    url: cartUrl,
                    dataType: 'json',
                    success: function(data) {
                        const Toast = Swal.mixin({
                            showConfirmButton: false,
                            timer: 1000
                        });

                        if (data.success) {
                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            });
                            button.prop('disabled', true); // Disable the button
                            button.text('Included'); // Change button text
                            $(".cartCount").html(data.cartCount);
                            if (data.subTotal > 4000) {
                                Toast.fire({
                                    title: 'Congratulations!',
                                    text: "Your shipping is now free. Happy Shopping!",
                                    icon: 'success',
                                    showCancelButton: true,
                                    // confirmButtonText: 'Yes, delete it!',
                                    cancelButtonText: 'Close',
                                    buttonsStyling: false,
                                    customClass: {
                                        // confirmButton: 'btn btn-danger',
                                        cancelButton: 'btn btn-success'
                                    }
                                })
                            }
                            cartHeader.html(data.cartHeader);
                        } else if (data.error) {
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'An unexpected error occurred.';

                        // Check if the response is JSON and contains an error message
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        } else if (xhr.responseText) {
                            try {
                                let response = JSON.parse(xhr.responseText);
                                if (response.error) {
                                    errorMessage = response.error;
                                }
                            } catch (e) {
                                console.error('Error parsing response text:', e);
                            }
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.add_to_cartPage').click(function(e) {
                e.preventDefault(); // Prevent the default action of the link
                var button = $(this);
                var product_id = button.data('product_id');
                var qty = button.data('product_qty'); // Get the quantity value
                var cartUrl = $(this).attr('href');
                var cartHeader = $('.miniCart');

                // Check if quantity is valid
                if (qty <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Invalid Quantity',
                        text: 'Please select a valid quantity.'
                    });
                    return;
                }

                $.ajax({
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // Include CSRF token for security
                        quantity: qty
                    },
                    url: cartUrl,
                    dataType: 'json',
                    success: function(data) {
                        Swal.fire(
                            'Added To Cart!',
                            data.success,
                            'success'
                        ).then(function() {
                            location.reload(); // Reload the page to reflect changes
                        });
                        if (data.subTotal > 4000) {
                            Toast.fire({
                                title: 'Congratulations!',
                                text: "Your shipping is now free. Happy Shopping!",
                                icon: 'success',
                                showCancelButton: true,
                                // confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'Close',
                                buttonsStyling: false,
                                customClass: {
                                    // confirmButton: 'btn btn-danger',
                                    cancelButton: 'btn btn-success'
                                }
                            })
                        }
                    },
                    error: function(xhr) {
                        console.log('AJAX Error Response:', xhr
                            .responseText); // Log full response for debugging
                        let errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr
                            .responseJSON.error : 'An unexpected error occurred.';
                        Swal.fire(
                            'Oops...',
                            errorMessage,
                            'error'
                        );
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.add_to_wishlist').click(function(e) {
                e.preventDefault(); // Prevent the default action of the link
                var button = $(this);
                var product_id = button.data('product_id');
                var user_id = button.data('product_id');
                var wishlistUrl = $(this).attr('href');
                var wishlistCount = $('.wishlistCount');
                // Check if quantity is valid


                $.ajax({
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: wishlistUrl,
                    dataType: 'json',
                    success: function(data) {
                        const Toast = Swal.mixin({
                            showConfirmButton: false,
                            timer: 1000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });

                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            });
                            button.prop('disabled', true); // Disable the button
                            // button.text('Included'); // Change button text
                            wishlistCount.html(data.wishlistCount);
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = xhr.responseJSON.message; // Default message

                        // Check if the response is JSON and contains an error message
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            try {
                                let response = JSON.parse(xhr.responseText);
                                if (response.message) {
                                    errorMessage = response.message;
                                }
                            } catch (e) {
                                // If responseText is not JSON, use default message
                                console.error('Error parsing response text:', e);
                            }
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage
                        });
                    }
                });
            });
        });
    </script>
    {{-- MiNiCart  --}}
    {{-- <script>
        function miniCart() {

            $.ajax({

                type: 'GET',
                dataType: 'json',
                url: '/product/mini/cart',

                success: function(response) {

                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('#cartQty').text(response.cartQty);

                    var miniCart = ""

                    $.each(response.carts, function(key, value) {

                        miniCart += `<ul id="minicartHeader" class="product_list_widget list-unstyled">

                            <li>
                                <div class="media clearfix">

                                    <div class="media-lefta">
                                        <a href="single-product.html">
                                            <img src="/${value.options.image}" style="width:50px;height:50px;" alt="hoodie_5_front" />
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        <a href="javascript:void(0)">${value.name}</a>

                                        <span class="price">
                                            <span class="amount">
                                                Tk ${value.price}
                                            </span>
                                        </span>

                                        <span class="quantity">Qty: ${value.qty} Pcs</span>

                                    </div>

                                </div>
                                <div class="product-remove">

                                    <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)" class="btn-remove" title="Remove this item">
                                        <i class="fa fa-close"></i>
                                    </a>

                                </div>
                            </li>

                            </ul>`

                    });

                    $('#miniCart').html(miniCart);

                }

            })

        }

        miniCart();
    </script> --}}
    {{-- //MiNiCart Remove  --}}
    {{-- Search Script --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var searchContainer = $('.search_container');
            var path = "{{ route('global.search') }}";
            var searchInput = $('.search_text');

            searchInput.autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: path,
                        type: "POST",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            if (data.length > 0) {
                                if (searchContainer.hasClass('d-none')) {
                                    searchContainer.removeClass('d-none');
                                }
                                searchContainer.html(data);
                            } else {
                                searchContainer.addClass('d-none');
                            }
                        }
                    });
                },
                minLength: 1
            });

            searchInput.on('input', function() {
                if (searchInput.val() === '') {
                    searchContainer.addClass('d-none');
                }
            });

            searchInput.on('keydown', function(event) {
                if (event.keyCode === 8 && searchInput.val() === '') {
                    searchContainer.addClass('d-none');
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();

            var deleteUrl = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-success'
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(function() {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error Occurred!',
                                error,
                                'error'
                            );
                        }
                    });
                } else if (result.dismiss === swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    );
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#update-cart').click(function() {
                var cartItems = [];

                // Collect all quantities and row IDs
                $('.quantity').each(function() {
                    var rowId = $(this).data(
                        'row_id'); // Use data-row_id as specified in your Blade file
                    var qty = $(this).val();

                    // Ensure rowId and qty are valid
                    if (rowId && !isNaN(qty) && qty >= 0) {
                        cartItems.push({
                            rowId: rowId,
                            qty: parseInt(qty, 10) // Ensure qty is an integer
                        });
                    }
                });

                // Send the updated quantities to the server
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        items: cartItems
                    },
                    success: function(data) {
                        Swal.fire(
                            'Updated!',
                            data.success,
                            'success'
                        ).then(function() {
                            location.reload(); // Reload the page to reflect changes
                        });
                    },
                    error: function(xhr) {
                        console.log('AJAX Error Response:', xhr
                            .responseText); // Log full response for debugging
                        let errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr
                            .responseJSON.error : 'An unexpected error occurred.';
                        Swal.fire(
                            'Oops...',
                            errorMessage,
                            'error'
                        );
                    }
                });
            });
            $('#update-mobile-cart').click(function() {
                var cartItems = [];

                // Collect all quantities and row IDs
                $('.quantity_mobile').each(function() {
                    var rowId = $(this).data(
                        'row_id'); // Use data-row_id as specified in your Blade file
                    var qty = $(this).val();

                    // Ensure rowId and qty are valid
                    if (rowId && !isNaN(qty) && qty >= 0) {
                        cartItems.push({
                            rowId: rowId,
                            qty: parseInt(qty, 10) // Ensure qty is an integer
                        });
                    }
                });

                // Send the updated quantities to the server
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        items: cartItems
                    },
                    success: function(data) {
                        Swal.fire(
                            'Updated!',
                            data.success,
                            'success'
                        ).then(function() {
                            location.reload(); // Reload the page to reflect changes
                        });
                    },
                    error: function(xhr) {
                        console.log('AJAX Error Response:', xhr
                            .responseText); // Log full response for debugging
                        let errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr
                            .responseJSON.error : 'An unexpected error occurred.';
                        Swal.fire(
                            'Oops...',
                            errorMessage,
                            'error'
                        );
                    }
                });
            });
        });
    </script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 3000;
                    toastr.info("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
                case 'success':

                    toastr.options.timeOut = 3000;
                    toastr.success("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'warning':

                    toastr.options.timeOut = 3000;
                    toastr.warning("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'error':

                    toastr.options.timeOut = 3000;
                    toastr.error("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
            }
        @endif
    </script>
    {!! optional($setting)->google_analytics !!}
    {!! optional($setting)->google_adsense !!}
    {{-- add_to_cart_btn_product_single --}}
</body>

</html>
