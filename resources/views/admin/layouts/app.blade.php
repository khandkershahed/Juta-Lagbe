<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="{{ asset('storage/' . optional($setting)->site_favicon) }}" rel="apple-touch-icon-precomposed">
    <link href="{{ asset('storage/' . optional($setting)->site_favicon) }}" rel="shortcut icon" type="image/png">
    <meta name="title" content="{{ optional($setting)->site_title ?: config('app.name', 'E-Commerce') }}" />
    <meta name="description" content="{{ optional($setting)->meta_description ?: config('app.name') }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ optional($setting)->site_url ?: config('app.url') }}" />
    <meta property="og:title" content="{{ optional($setting)->site_title ?: config('app.name', 'E-Commerce') }}" />
    <meta property="og:description" content="{{ optional($setting)->meta_description ?: config('app.name') }}" />
    <meta property="og:image"
        content="{{ optional($setting)->site_logo && file_exists(public_path('storage/' . optional($setting)->site_logo)) ? asset('storage/' . optional($setting)->site_logo) : asset('frontend/images/brandPage-logo-no-img(217-55).jpg') }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ optional($setting)->site_url ?: config('app.url') }}" />
    <meta property="twitter:title"
        content="{{ optional($setting)->site_title ?: config('app.name', 'E-Commerce') }}" />
    <meta property="twitter:description" content="{{ optional($setting)->meta_description ?: config('app.name') }}" />
    <meta property="twitter:image"
        content="{{ optional($setting)->site_logo && file_exists(public_path('storage/' . optional($setting)->site_logo)) ? asset('storage/' . optional($setting)->site_logo) : asset('frontend/images/brandPage-logo-no-img(217-55).jpg') }}" />

    <title>{{ optional($setting)->site_title ?: config('app.name', 'E-Commerce') }}</title>


    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap_icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font_awesome_6.css') }}">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <link href="{{ asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />


    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="{{ asset('admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

    {{-- ===== GLOBAL LOADER STYLE (ADDED) ===== --}}
    <style>
        #globalPageLoader {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.75);
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.15s ease-in-out;
        }

        #globalPageLoader.is-active {
            opacity: 1;
            pointer-events: all;
        }

        #globalPageLoader .loader-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            padding: 18px 22px;
            border-radius: 14px;
            background: rgba(0, 0, 0, 0.75);
            color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            min-width: 180px;
        }

        #globalPageLoader .loader-text {
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
    </style>
</head>

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed">

    {{-- ===== GLOBAL LOADER HTML (ADDED) ===== --}}
    <div id="globalPageLoader" class="is-active">
        <div class="loader-box">
            <div class="spinner-border" role="status" aria-hidden="true"></div>
            <div class="loader-text">Loading...</div>
        </div>
    </div>


    <div class="d-flex flex-column flex-root">

        <div class="page d-flex flex-row flex-column-fluid">

            @include('admin.layouts.sidebar')


            <div class="wrapper d-flex flex-column flex-row-fluid pt-lg-17" id="kt_wrapper">

                @include('admin.layouts.header')


                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    {{-- @include('admin.layouts.toolbar') --}}


                    <div class="post d-flex flex-column-fluid" id="kt_post">

                        <div id="kt_content_container" class="container-fluid">
                            @if (session('error'))
                                @foreach ($messages as $item)
                                    <div class="alert alert-danger">
                                        {{ $item }}
                                    </div>
                                @endforeach
                            @endif
                            {{ $slot }}

                        </div>

                    </div>

                </div>


                @include('admin.layouts.footer')

            </div>

        </div>

    </div>


    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">

        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                    transform="rotate(90 13 6)" fill="currentColor" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="currentColor" />
            </svg>
        </span>

    </div>



    <script src="{{ asset('admin/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scripts.bundle.js') }}"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> --}}
    <script src="{{ asset('admin/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

    <script src="{{ asset('admin/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/apps/chat/chat.js') }}"></script>
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script> --}}
    <script src="{{ asset('admin/assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @include('toastr')
    @stack('scripts')

    {{-- ===== GLOBAL LOADER SCRIPT (ADDED) ===== --}}
    <script>
        (function() {
            const loaderEl = document.getElementById('globalPageLoader');
            let activeRequests = 0;

            function showLoader() {
                if (!loaderEl) return;
                loaderEl.classList.add('is-active');
            }

            function hideLoader() {
                if (!loaderEl) return;
                loaderEl.classList.remove('is-active');
            }

            function startRequest() {
                activeRequests++;
                showLoader();
            }

            function endRequest() {
                activeRequests = Math.max(0, activeRequests - 1);
                if (activeRequests === 0) {
                    hideLoader();
                }
            }

            // Hide loader after initial page load
            window.addEventListener('load', function() {
                activeRequests = 0;
                hideLoader();
            });

            // Show loader on normal link navigation (not ajax buttons)
            document.addEventListener('click', function(e) {
                const a = e.target.closest('a');
                if (!a) return;

                // ignore anchors
                const href = a.getAttribute('href');
                if (!href || href === '#' || href.startsWith('javascript:')) return;

                // ignore new tab
                if (a.getAttribute('target') === '_blank') return;

                // ignore download links
                if (a.hasAttribute('download')) return;

                // ignore bootstrap modal toggles
                if (a.getAttribute('data-bs-toggle') === 'modal') return;

                startRequest();
            }, true);

            // Show loader on form submit
            document.addEventListener('submit', function() {
                startRequest();
            }, true);

            // Hook jQuery AJAX if available
            if (window.jQuery) {
                $(document).ajaxStart(function() {
                    startRequest();
                });
                $(document).ajaxStop(function() {
                    // ajaxStop fires when all complete
                    activeRequests = 0;
                    hideLoader();
                });
            }

            // Hook fetch()
            if (window.fetch) {
                const originalFetch = window.fetch;
                window.fetch = function() {
                    startRequest();
                    return originalFetch.apply(this, arguments)
                        .then(function(response) {
                            endRequest();
                            return response;
                        })
                        .catch(function(error) {
                            endRequest();
                            throw error;
                        });
                };
            }

            // Expose manual control if you need it
            window.GlobalLoader = {
                show: function() {
                    startRequest();
                },
                hide: function() {
                    activeRequests = 0;
                    hideLoader();
                }
            };
        })();
    </script>

    <script>
        document.querySelectorAll('.ckeditor').forEach(element => {
            if (!element.classList.contains('ck-editor__editable_inline')) {
                ClassicEditor
                    .create(element)
                    .then(editor => {
                        console.log('CKEditor initialized:', editor);
                    })
                    .catch(error => {
                        console.error('CKEditor initialization error:', error);
                    });
            }
        });
    </script>
    <script>
        //  DropZone Image
        $(document).ready(function() {
            var selectedFiles = [];

            $(".dropzone-field").on("change", "#files", function(e) {
                var files = e.target.files,
                    filesLength = files.length;

                $(".custom-file-upload").toggle(filesLength === 0 && selectedFiles.length === 0);

                for (var i = 0; i < filesLength; i++) {
                    var f = files[i];
                    selectedFiles.push(f);
                    var fileReader = new FileReader();
                    fileReader.onload = (function(file) {
                        return function(e) {
                            $("<div class=\"img-thumb-wrapper card shadow\">" +
                                "<img class=\"img-thumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\">Remove</span>" +
                                "</div>").insertAfter("#files");
                        };
                    })(f);
                    fileReader.readAsDataURL(f);
                }
                // console.log(selectedFiles);
                $(".existing-images").show();
            });

            // Use event delegation for the click event
            $(".dropzone-field").on("click", ".remove", function() {
                var wrapper = $(this).parent(".img-thumb-wrapper");
                wrapper.remove();
                var removedFile = wrapper.find('img').prop('title');
                selectedFiles = selectedFiles.filter(function(file) {
                    return file.name !== removedFile;
                });
                updateInputFiles();
                $(".custom-file-upload").toggle(selectedFiles.length === 0);
                // alert(selectedFiles.length);
            });

            function updateInputFiles() {
                // Create a new set of files excluding the removed one
                var newInputFiles = new DataTransfer();
                selectedFiles.forEach(function(file) {
                    newInputFiles.items.add(file);
                });

                // Clear the input
                $("#files").val("");

                // Assign the new set of files to the input
                $("#files")[0].files = newInputFiles.files;
            }
        });
        // checkbox And Select
        document.addEventListener('DOMContentLoaded', function() {

            const $selectAllCheckbox = $('.metronic_select_all');
            const $categoryCheckboxes = $('.bulkDelete-checkbox');
            const $deleteButton = $('#bulkDelete');

            function updateDeleteButtonVisibility() {
                // Check if any checkbox is checked
                const anyChecked = $categoryCheckboxes.is(':checked');
                $deleteButton.toggle(anyChecked);
            }

            // Handle 'Select All' checkbox change
            $selectAllCheckbox.on('change', function() {
                $categoryCheckboxes.prop('checked', $(this).prop('checked'));
                updateDeleteButtonVisibility();
            });

            // Handle individual checkbox changes
            $categoryCheckboxes.on('change', function() {
                updateDeleteButtonVisibility();
            });

            // Initial check to set the button visibility correctly
            updateDeleteButtonVisibility();
        });
        // Data table
        class DataTableInitializer {
            constructor(selector) {
                this.selector = selector;
                this.init();
            }

            init() {
                $(this.selector).DataTable({
                    "fixedHeader": {
                        "header": true,
                        "headerOffset": 5
                    },
                    "language": {
                        "lengthMenu": "Show _MENU_",
                    },
                    "dom": "<'row mb-2'" +
                        "<'col-sm-6 d-flex align-items-center justify-content-start dt-toolbar'l>" +
                        "<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
                        ">" +
                        "<'table-responsive'tr>" +
                        "<'row'" +
                        "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                        "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                        ">"
                });
            }
        }

        // Initialize DataTables for elements with class 'my-datatable'
        $(document).ready(function() {
            new DataTableInitializer('.my-datatable');
        });
    </script>


    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 10000;
                    toastr.info("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
                case 'success':

                    toastr.options.timeOut = 10000;
                    toastr.success("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'warning':

                    toastr.options.timeOut = 10000;
                    toastr.warning("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'error':

                    toastr.options.timeOut = 10000;
                    toastr.error("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
            }
        @endif
    </script>

</body>

</html>
