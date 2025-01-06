<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <a href="{{ route('dashboard') }}">
            <img alt="Logo"
                src="{{ !empty(optional($setting)->site_logo_black) && file_exists(public_path('storage/' . optional($setting)->site_logo_white)) ? asset('storage/' . optional($setting)->site_logo_black) : asset('frontend/img/logo.png') }}"
                class="w-100px">
            {{-- <img alt="Logo" src="{{ asset('frontend/img/logo.png') }}" class="w-100px"> --}}
        </a>
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-dark aside-toggle active"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="aside-minimize">
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor"></path>
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor"></path>
                </svg>
            </span>
        </div>
    </div>
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0" style="height: 318px;">
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0"
                                    viewBox="0 0 512 511" style="enable-background:new 0 0 512 512" xml:space="preserve"
                                    class="">
                                    <g>
                                        <path fill="#ed5176"
                                            d="M26.36 106.684v342.218a4.122 4.122 0 0 0 4.12 4.121h451.04a4.122 4.122 0 0 0 4.12-4.12v-342.22zm0 0"
                                            opacity="1" data-original="#ed5176" class=""></path>
                                        <g fill="#ba365f">
                                            <path
                                                d="M26.36 224.047h459.28v23.25H26.36zM26.36 106.684h459.28v23.25H26.36zm0 0"
                                                fill="#ba365f" opacity="1" data-original="#ba365f" class="">
                                            </path>
                                            <path
                                                d="M174.426 106.684v23.414c0 16.496 13.37 29.867 29.867 29.867h126.148c21.293 0 38.555-17.262 38.555-38.555v-14.726zM461.348 106.684v342.218a4.122 4.122 0 0 1-4.121 4.121h24.293a4.122 4.122 0 0 0 4.12-4.12v-342.22zm0 0"
                                                fill="#ba365f" opacity="1" data-original="#ba365f" class="">
                                            </path>
                                        </g>
                                        <path fill="#6a7193"
                                            d="M201.07 299.07v153.953h109.86V299.07c0-5.691-4.614-10.304-10.305-10.304h-89.254c-5.687 0-10.3 4.613-10.3 10.304zm0 0"
                                            opacity="1" data-original="#6a7193"></path>
                                        <path fill="#575b7a"
                                            d="M216.781 314.793c0-5.691 4.614-10.305 10.305-10.305h83.844v-5.418c0-5.691-4.614-10.304-10.301-10.304h-89.254c-5.691 0-10.305 4.613-10.305 10.304v153.953h15.711zm0 0"
                                            opacity="1" data-original="#575b7a" class=""></path>
                                        <path fill="#c8e7f7"
                                            d="M.64 177.871v42.055a4.12 4.12 0 0 0 4.122 4.12h502.476a4.12 4.12 0 0 0 4.121-4.12V177.87a4.12 4.12 0 0 0-4.12-4.121H4.761a4.12 4.12 0 0 0-4.121 4.121zm0 0"
                                            opacity="1" data-original="#c8e7f7" class=""></path>
                                        <path fill="#8cbcd6"
                                            d="M507.238 173.75H483.04a4.12 4.12 0 0 1 4.121 4.121v42.059a4.122 4.122 0 0 1-4.12 4.12h24.198a4.122 4.122 0 0 0 4.121-4.12V177.87a4.12 4.12 0 0 0-4.12-4.121zm0 0"
                                            opacity="1" data-original="#8cbcd6"></path>
                                        <path fill="#c8e7f7"
                                            d="M344.598 314.008v84.312a8.724 8.724 0 0 0 8.722 8.723h95.617a8.721 8.721 0 0 0 8.723-8.723v-84.312a8.719 8.719 0 0 0-8.723-8.723H353.32c-4.82-.004-8.722 3.903-8.722 8.723zM54.34 314.008v84.312a8.721 8.721 0 0 0 8.722 8.723h95.618a8.721 8.721 0 0 0 8.722-8.723v-84.312a8.721 8.721 0 0 0-8.722-8.723H63.062c-4.82-.004-8.722 3.903-8.722 8.723zM512 83.984V65.09H0v18.894c12.535 0 22.7 10.164 22.7 22.7h466.6c0-12.536 10.165-22.7 22.7-22.7zm0 0"
                                            opacity="1" data-original="#c8e7f7" class=""></path>
                                        <path fill="#8cbcd6"
                                            d="M174.426 65.09h194.57v41.594h-194.57zM487.8 65.09v18.894c-12.538 0-22.702 10.164-22.702 22.7H489.3c0-12.536 10.164-22.7 22.699-22.7V65.09zm0 0"
                                            opacity="1" data-original="#8cbcd6"></path>
                                        <path fill="#ffeb96"
                                            d="M158.715 30.367v84.305c0 16.492 13.37 29.867 29.867 29.867h134.836c16.492 0 29.867-13.375 29.867-29.867V30.367C353.285 13.871 339.91.5 323.418.5H188.582c-16.496 0-29.867 13.371-29.867 29.867zm0 0"
                                            opacity="1" data-original="#ffeb96"></path>
                                        <path fill="#252d4c"
                                            d="M226.125 378.395h-6.184c-4.14 0-7.5-3.36-7.5-7.5s3.36-7.5 7.5-7.5h6.184c4.145 0 7.5 3.359 7.5 7.5s-3.355 7.5-7.5 7.5zm0 0"
                                            opacity="1" data-original="#252d4c"></path>
                                        <path fill="#5692d8"
                                            d="M284.84 100.809h-45.883c-9.09 0-17.035-6.457-18.894-15.356l-9.754-46.617h-9.649a7.5 7.5 0 0 1-7.5-7.5 7.5 7.5 0 0 1 7.5-7.5h9.649c7.062 0 13.238 5.02 14.683 11.93l9.75 46.617a4.325 4.325 0 0 0 4.215 3.426h45.883a4.332 4.332 0 0 0 4.027-2.786l13.719-36.316h-60.828a7.5 7.5 0 1 1 0-15h64.887a12.2 12.2 0 0 1 10.03 5.262 12.183 12.183 0 0 1 1.376 11.242l-15.153 40.113c-2.82 7.465-10.078 12.485-18.058 12.485zM240.29 122.742h-2.06a7.497 7.497 0 0 1-7.5-7.5 7.5 7.5 0 0 1 7.5-7.5h2.06a7.5 7.5 0 0 1 7.5 7.5c0 4.145-3.356 7.5-7.5 7.5zM273.77 122.742h-2.06a7.497 7.497 0 0 1-7.5-7.5 7.5 7.5 0 0 1 7.5-7.5h2.06a7.5 7.5 0 0 1 7.5 7.5c0 4.145-3.356 7.5-7.5 7.5zm0 0"
                                            opacity="1" data-original="#5692d8"></path>
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>

                {{-- Site Content  --}}
                @php
                    $menuItems = [
                        [
                            'title' => 'Products',
                            'icon' => 'fa-solid fa-box-open text-danger fs-3',
                            'routes' => [
                                'admin.brands.index',
                                'admin.brands.create',
                                'admin.brands.edit',
                                'admin.categories.index',
                                'admin.categories.create',
                                'admin.categories.edit',
                                'admin.stock-management.index',
                                'admin.shipping-management.index',
                                'admin.product.index',
                                'admin.product.create',
                                'admin.product.edit',
                                'admin.special-offer.index',
                                'admin.special-offer.create',
                                'admin.special-offer.edit',
                                'admin.product-review.index',
                                'admin.product-review.create',
                                'admin.product-review.edit',
                            ],
                            'subMenu' => [
                                [
                                    'title' => 'Products List',
                                    'routes' => ['admin.product.index', 'admin.product.create', 'admin.product.edit'],
                                    'route' => 'admin.product.index',
                                ],
                                [
                                    'title' => 'Brand List',
                                    'routes' => ['admin.brands.index', 'admin.brands.create', 'admin.brands.edit'],
                                    'route' => 'admin.brands.index',
                                ],
                                [
                                    'title' => 'Category List',
                                    'routes' => [
                                        'admin.categories.index',
                                        'admin.categories.create',
                                        'admin.categories.edit',
                                    ],
                                    'route' => 'admin.categories.index',
                                ],
                                [
                                    'title' => 'Stock Info',
                                    'routes' => ['admin.stock-management.index'],
                                    'route' => 'admin.stock-management.index',
                                ],
                                [
                                    'title' => 'Shipping',
                                    'routes' => ['admin.shipping-management.index'],
                                    'route' => 'admin.shipping-management.index',
                                ],
                                [
                                    'title' => 'Review',
                                    'routes' => [
                                        'admin.product-review.index',
                                        'admin.product-review.create',
                                        'admin.product-review.edit',
                                    ],
                                    'route' => 'admin.product-review.index',
                                ],
                                [
                                    'title' => 'Special Offer',
                                    'routes' => [
                                        'admin.special-offer.index',
                                        'admin.special-offer.create',
                                        'admin.special-offer.edit',
                                    ],
                                    'route' => 'admin.special-offer.index',
                                ],
                            ],
                        ],
                        [
                            'title' => 'Orders',
                            'icon' => 'fa-solid fa-cart-shopping text-warning fs-3',
                            'routes' => [
                                'admin.order-management.index',
                                'admin.order-management.create',
                                'admin.order-management.edit',
                                'admin.orderReport',
                                'admin.orderDetails',
                            ],
                            'subMenu' => [
                                [
                                    'title' => 'Order Report',
                                    'routes' => ['admin.orderReport'],
                                    'route' => 'admin.orderReport',
                                ],
                                [
                                    'title' => 'Order List',
                                    'routes' => ['admin.order-management.index'],
                                    'route' => 'admin.order-management.index',
                                ],
                            ],
                        ],
                        [
                            'title' => 'Blogs',
                            'icon' => 'fa-brands fa-blogger-b text-success fs-3',
                            'routes' => [
                                'admin.blog-category.index',
                                'admin.blog-tags.index',
                                'admin.blog-post.index',
                                'admin.blog-post.create',
                                'admin.blog-post.edit',
                                // 'admin.categories.index',
                                // 'admin.categories.create',
                                // 'admin.categories.edit',
                            ],
                            'subMenu' => [
                                [
                                    'title' => 'Blog Category',
                                    'routes' => ['admin.blog-category.index'],
                                    'route' => 'admin.blog-category.index',
                                ],
                                [
                                    'title' => 'Blog Post',
                                    'routes' => ['admin.blog-post.index'],
                                    'route' => 'admin.blog-post.index',
                                ],
                            ],
                        ],
                        [
                            'title' => 'Users',
                            'icon' => 'fa-solid fa-users text-primary fs-3',
                            'subMenu' => [
                                [
                                    'title' => 'User List',
                                    'routes' => ['admin.user.index'],
                                    'route' => 'admin.user.index',
                                ],
                            ],
                        ],
                        [
                            'title' => 'Staffs',
                            'icon' => 'fa-solid fa-lock fs-3 text-primary',
                            'routes' => [
                                'admin.staff.index',
                                'admin.staff.create',
                                'admin.staff.edit',
                                'admin.role.index',
                                'admin.role.create',
                                'admin.role.edit',
                                'admin.permission.index',
                                'admin.permission.create',
                                'admin.permission.edit',
                            ],
                            'subMenu' => [
                                [
                                    'title' => 'Staff List',
                                    'routes' => ['admin.staff.index', 'admin.staff.create', 'admin.staff.edit'],
                                    'route' => 'admin.staff.index',
                                ],
                                [
                                    'title' => 'Role & Permissions',
                                    'routes' => [
                                        'admin.role.index',
                                        'admin.role.create',
                                        'admin.role.edit',
                                        'admin.permission.index',
                                        'admin.permission.create',
                                        'admin.permission.edit',
                                    ],
                                    'subMenu' => [
                                        [
                                            'title' => 'Roles List',
                                            'routes' => ['admin.role.index', 'admin.role.create', 'admin.role.edit'],
                                            'route' => 'admin.role.index',
                                        ],
                                        [
                                            'title' => 'Permissions List',
                                            'routes' => [
                                                'admin.permission.index',
                                                'admin.permission.create',
                                                'admin.permission.edit',
                                            ],
                                            'route' => 'admin.permission.index',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'title' => 'Customer Support',
                            'icon' => 'fa-solid fa-headset text-info fs-3',
                            'routes' => [
                                'admin.contacts.index',
                                'admin.faq.index',
                                'admin.faq.create',
                                'admin.faq.edit',
                                'admin.newsletters.index',
                                'admin.testimonial.index',
                                'admin.testimonial.create',
                                'admin.testimonial.edit',
                            ],
                            'subMenu' => [
                                [
                                    'title' => 'Contact Messages',
                                    'routes' => ['admin.contacts.index'],
                                    'route' => 'admin.contacts.index',
                                ],
                                [
                                    'title' => 'FAQ Lists',
                                    'routes' => ['admin.faq.index', 'admin.faq.create', 'admin.faq.edit'],
                                    'route' => 'admin.faq.index',
                                ],
                                [
                                    'title' => 'Subscribed Emails List',
                                    'routes' => ['admin.newsletters.index'],
                                    'route' => 'admin.newsletters.index',
                                ],
                                [
                                    'title' => 'Testimonials',
                                    'routes' => ['admin.testimonial.index'],
                                    'route' => 'admin.testimonial.index',
                                ],
                            ],
                        ],
                        [
                            'title' => 'Site Contents',
                            'icon' => 'fa-solid fa-file-pen text-info fs-3',
                            'routes' => [
                                'admin.terms-condition.index',
                                'admin.terms-condition.create',
                                'admin.terms-condition.edit',
                                'admin.banner.index',
                                'admin.banner.create',
                                'admin.banner.edit',
                                'admin.deal-banner.index',
                                'admin.deal-banner.create',
                                'admin.deal-banner.edit',
                                'admin.privacy-policy.index',
                                'admin.privacy-policy.create',
                                'admin.privacy-policy.edit',
                            ],
                            'subMenu' => [
                                [
                                    'title' => 'Banners',
                                    'routes' => ['admin.banner.index', 'admin.banner.create', 'admin.banner.edit'],
                                    'route' => 'admin.banner.index',
                                ],
                                [
                                    'title' => 'Deal Banners',
                                    'routes' => [
                                        'admin.deal-banner.index',
                                        'admin.deal-banner.create',
                                        'admin.deal-banner.edit',
                                    ],
                                    'route' => 'admin.deal-banner.index',
                                ],
                                [
                                    'title' => 'Terms & Condition',
                                    'routes' => [
                                        'admin.terms-condition.index',
                                        'admin.terms-condition.create',
                                        'admin.terms-condition.edit',
                                    ],
                                    'route' => 'admin.terms-condition.index',
                                ],
                                [
                                    'title' => 'Privacy Policy',
                                    'routes' => [
                                        'admin.privacy-policy.index',
                                        'admin.privacy-policy.create',
                                        'admin.privacy-policy.edit',
                                    ],
                                    'route' => 'admin.privacy-policy.index',
                                ],
                            ],
                        ],
                        [
                            'title' => 'Settings',
                            'icon' => 'fa-solid fa-gear text-danger fs-3',
                            'routes' => [
                                'admin.settings.index',
                                'admin.email-settings.index',
                                'admin.admin-managemnet.index',
                                'admin.admin-managemnet.create',
                                'admin.admin-managemnet.edit',
                            ],
                            'subMenu' => [
                                [
                                    'title' => 'Website Setting',
                                    'routes' => ['admin.settings.index'],
                                    'route' => 'admin.settings.index',
                                ],
                                [
                                    'title' => 'Admin Management',
                                    'routes' => ['admin.admin-managemnet.index'],
                                    'route' => 'admin.admin-managemnet.index',
                                ],
                                // [
                                //     'title' => 'Email Setting',
                                //     'routes' => ['admin.email-settings.index'],
                                //     'route' => 'admin.email-settings.index',
                                // ],
                            ],
                        ],
                    ];
                @endphp

                @foreach ($menuItems as $item)
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ Route::is(...$item['routes'] ?? []) ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="{{ $item['icon'] }}"></i>
                                </span>
                            </span>
                            <span class="menu-title">{{ $item['title'] }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        @if (!empty($item['subMenu']))
                            <div
                                class="menu-sub menu-sub-accordion {{ Route::is(...$item['routes'] ?? []) ? 'menu-active-bg' : '' }}">
                                @foreach ($item['subMenu'] as $subItem)
                                    @if (isset($subItem['subMenu']))
                                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1">
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">{{ $subItem['title'] }}</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <div
                                                class="menu-sub menu-sub-accordion {{ Route::is(...array_column($subItem['subMenu'], 'route') ?? []) ? 'here show' : '' }}">
                                                @foreach ($subItem['subMenu'] as $subSubItem)
                                                    <div class="menu-item">
                                                        @if (isset($subSubItem['route']))
                                                            <a class="menu-link {{ Route::is($subSubItem['route']) ? 'active' : '' }}"
                                                                href="{{ route($subSubItem['route']) }}">
                                                                <span class="menu-bullet">
                                                                    <span class="bullet bullet-dot"></span>
                                                                </span>
                                                                <span
                                                                    class="menu-title">{{ $subSubItem['title'] }}</span>
                                                            </a>
                                                        @else
                                                            <span class="menu-title">{{ $subSubItem['title'] }}</span>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="menu-item">
                                            @if (isset($subItem['route']))
                                                <a class="menu-link {{ Route::is($subItem['routes']) ? 'active' : '' }}"
                                                    href="{{ route($subItem['route']) }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{ $subItem['title'] }}</span>
                                                </a>
                                            @else
                                                <span class="menu-title">{{ $subItem['title'] }}</span>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
        <form method="POST" action="{{ route('admin.logout') }}">
            <a href="{{ route('admin.logout') }}" class="btn btn-custom btn-primary w-100"
                onclick="event.preventDefault();this.closest('form').submit();">
                <span class="btn-label">
                    @csrf
                    <i class="fa-solid fa-right-from-bracket"></i> Log Out
                </span>
            </a>
        </form>
    </div>
</div>
