<x-frontend-app-layout :title="'Terms and Conditions'">
    <div class="breadcrumb-wrap">
        <div class="banner b-top bg-size bread-img">
            <img class="bg-img bg-top" src="img/banner-p.jpg" alt="banner" style="display: none;">
            <div class="container-lg">
                <div class="breadcrumb-box">
                    <div class="title-box3 text-center">
                        <h1>
                            Terms & Conditions
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5 mx-3">
        <div class="row">
            <div class="col-lg-12">
                <ul class="ps-breadcrumb faq-breadcumb">
                    <li class="ps-breadcrumb__item"><a href="/">Home</a></li>
                    <li class="ps-breadcrumb__item active" aria-current="page">Terms</li>
                </ul>
                <p>{!! optional($terms)->content !!}</p>
            </div>
        </div>
    </div>
</x-frontend-app-layout>
