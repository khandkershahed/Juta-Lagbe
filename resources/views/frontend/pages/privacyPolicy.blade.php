<x-frontend-app-layout :title="'Privacy Policy'">
    <div class="breadcrumb-wrap">
        <div class="banner b-top bg-size bread-img">
            <img class="bg-img bg-top" src="img/banner-p.jpg" alt="banner" style="display: none;">
            <div class="container-lg">
                <div class="breadcrumb-box">
                    <div class="title-box3 text-center">
                        <h1>
                            Privacy Policy
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="p-3">
            <ul class="ps-breadcrumb faq-breadcumb">
                <li class="ps-breadcrumb__item"><a href="/">Home</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page">Privacy</li>
            </ul>
            <p class="p-3">{!! optional($privacy)->content !!}</p>
        </div>

    </div>
</x-frontend-app-layout>
