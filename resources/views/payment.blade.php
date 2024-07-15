<form action="{{ url('charge') }}" method="post">
    @csrf
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ env('STRIPE_KEY') }}"
        data-amount="1000"
        data-name="Stripe Demo"
        data-description="Test Payment"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto">
    </script>
</form>
