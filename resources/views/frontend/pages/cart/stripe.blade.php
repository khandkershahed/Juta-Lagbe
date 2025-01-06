<x-frontend-app-layout :title="'Make Payment'">
    <div class="container">
        <div class="row py-5 my-5">
            <div class="col-lg-8 col-12 offset-lg-2">
                <div class="d-flex align-items-center payment-mobile">
                    <div class="card my-5 p-5 border-0 shadow-sm pay-half bg-light" style="height: 300px">
                        <div class="card-body">
                            <h3 class="mb-5">Payment Info</h3>
                            <div class="d-flex justify-content-between align-items-center ">
                                <h5>Product</h5>
                                <h5>{{ $order->quantity }}</h5>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pb-4">
                                <h5>Total Ammount</h5>
                                <h5>৳ <span class="text-info">{{ $order->total_amount }}</span></h5>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center pt-4">
                                <h5>Order Id</h5>
                                <h5>#{{ $order->order_number }}</h5>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Payment Methods</h5>
                                <h5>{{ ucfirst($order->payment_method) }}</h5>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Order Date</h5>
                                <h5>{{ $order->created_at->format('d M, Y') }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card my-5 border-0 shadow-lg pay-half">
                        <div class="card-body p-5">
                            <h3>Payment Methods (Stripe)</h3>
                            <div class="row pt-5">
                                <form id='payment-form' method='post' action="{{ route('stripe.pay') }}"
                                    style="width: 100%;">
                                    @csrf
                                    <input type='hidden' name='amount' value='{{ $order->total_amount }}'>
                                    <input type='hidden' name='order_number' value='{{ $order->order_number }}'>
                                    <br>
                                    <div class="col-12">
                                        <div id="card-element" class="border p-4 w-100"></div>
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                    <div class="mt-5 col-12">
                                        <button id='pay-btn' class="btn btn-warning w-100 p-4 text-white"
                                            onclick="createToken()">Pay ৳ {{ $order->total_amount }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        {{-- <script type="text/javascript">
            var stripe = Stripe('{{ env('STRIPE_KEY') }}')
            var elements = stripe.elements();
            var cardElement = elements.create('card');
            cardElement.mount('#card-element');

            function createToken(event) {
                event.preventDefault(); // Prevent default form submission
                document.getElementById("pay-btn").disabled = true;

                stripe.createToken(cardElement).then(function(result) {
                    if (result.error) {
                        document.getElementById("pay-btn").disabled = false;
                        alert(result.error.message);
                    } else {
                        var form = document.getElementById('checkout-form');
                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', result.token.id);
                        form.appendChild(hiddenInput);
                        form.submit();
                    }
                });
            }
        </script> --}}
        {{-- <script type="text/javascript">
            var stripe = Stripe('{{ env('STRIPE_KEY') }}')
            var elements = stripe.elements();
            var cardElement = elements.create('card');
            cardElement.mount('#card-element');

            /*------------------------------------------
            --------------------------------------------
            Create Token Code
            --------------------------------------------
            --------------------------------------------*/
            function createToken() {
                document.getElementById("pay-btn").disabled = true;
                stripe.createToken(cardElement).then(function(result) {

                    if (typeof result.error != 'undefined') {
                        document.getElementById("pay-btn").disabled = false;
                        alert(result.error.message);
                    }

                    /* creating token success */
                    if (typeof result.token != 'undefined') {
                        document.getElementById("stripe-token-id").value = result.token.id;
                        document.getElementById('checkout-form').submit();
                    }
                    form.submit();
                });
            }
        </script> --}}
        <script type="text/javascript">
            // Create a Stripe client.
            var stripe = Stripe('{{ env('STRIPE_KEY') }}')
            // var stripe = Stripe(
            //     'pk_test_51MIhpNKWkQXfo4eQKRqV6aaB2nDyFN7TCYXzPZ9vdCOsybE637QvJRzadjCLCtMP5vQa1Zx4dfCSDierUo3L2mwG00J3XdT7A5'
            // );
            // Create an instance of Elements.
            var elements = stripe.elements();
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };
            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style
            });
            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });
            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
            }
        </script>
    @endpush
</x-frontend-app-layout>
