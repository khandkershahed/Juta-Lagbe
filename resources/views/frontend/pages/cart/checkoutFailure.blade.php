<x-frontend-app-layout :title="'Checkout Failure'">
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-lg-8">
                <div class="card border-danger shadow-sm">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">Payment Failed</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-danger">
                            We're sorry, but your payment could not be processed. Please try again or contact support if
                            the problem persists.
                        </p>
                        <p>
                            <strong>Reason:</strong> {{ session('error_message', 'An unknown error occurred.') }}
                        </p>
                        <a href="{{ route('checkout') }}" class="btn btn-primary">
                            Return to Checkout
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            Go to Homepage
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-app-layout>
