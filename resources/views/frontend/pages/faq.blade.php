<x-frontend-app-layout :title="'Contact Us'">
    <style>
        .accordion .card-header:after {
            font-family: 'FontAwesome';
            content: "\f068";
            float: right;
            color: white;
            border: 1px solid white;
            border-radius: 100%;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 1.9;
            cursor: pointer;
        }

        .accordion .card-header.collapsed:after {
            content: "\f067";
            color: white;
            border: 1px solid white;
            border-radius: 100%;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 1.9;
            cursor: pointer;
        }
    </style>
    <div class="breadcrumb-wrap">
        <div class="banner b-top bg-size bread-img">
            <img class="bg-img bg-top" src="img/banner-p.jpg" alt="banner" style="display: none;">
            <div class="container-lg">
                <div class="breadcrumb-box">
                    <div class="title-box3 text-center">
                        <h1>
                            Faq
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <ul class="ps-breadcrumb faq-breadcumb">
            <li class="ps-breadcrumb__item"><a href="/">Home</a></li>
            <li class="ps-breadcrumb__item active" aria-current="page">Faq</li>
        </ul>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div>
                    <h1 class="text-start mb-5 display-4">
                        <span class="display-3 faq-title fw-bold">{{ optional($setting)->website_name }}</span> <br>
                        Frequently
                        Asked Questions (FAQ)
                    </h1>
                    <p>Find answers to all your questions about shopping at {{ optional($setting)->website_name }}. Our
                        FAQ section covers everything
                        from ordering and shipping to returns and refunds, ensuring a smooth and satisfying shopping
                        experience.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <img class="img-fluid" src="{{ asset('frontend/img/faq.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div id="accordion" class="accordion pb-5">
            <!-- FAQ Item -->
            @foreach ($faqs as $faq)
                <div class="card mb-0 border-0">
                    <div class="card-header collapsed faq-title-bg p-4" data-toggle="collapse"
                        data-target="#collapse{{ $faq->id }}">
                        <a class="card-title text-white faq-title">
                            Q: {{ $faq->question }}
                        </a>
                    </div>
                    <div id="collapse{{ $faq->id }}" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-frontend-app-layout>
