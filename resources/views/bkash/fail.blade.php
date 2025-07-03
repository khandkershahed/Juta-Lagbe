{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        h1 {
            color: #e74c3c;
        }

        p {
            color: #333;
            margin-bottom: 20px;
        }


    </style>
</head>
<body>
    <div class="container">

    </div>
</body>
</html> --}}

<x-frontend-app-layout :title="'Payment Failed'">
    <style>
        .response {
            color: #e74c3c;
            font-weight: bold;
        }
        .breadcrumb-wrap {
            margin-top: 20px;
        }

        .banner.b-top {
            background-color: #f8f9fa;
            padding: 50px 0;
        }

        .title-box3 h2 {
            font-size: 2.5rem;
            color: #dc3545;
            /* Bootstrap's danger color */
        }

        .bg-img.bg-top {
            display: none;
            /* Hide the background image */
        }
    </style>
    <div class="breadcrumb-wrap">
        <div class="banner b-top bg-size bread-img">
            <div class="container-lg">
                <div class="breadcrumb-box">
                    <div class="title-box3 text-center">
                        <h1>Sorry!! Please try again later.</h1>
                        <p>
                            @if (isset($response))
                                <span class="response">{{ $response }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="d-flex text-center justify-content-center">
                        <a href="{{ route('checkout') }}" class="btn btn-primary w-100"> Go to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-app-layout>
