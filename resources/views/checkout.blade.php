<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Namoverse</title>
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}" />
</head>

<body>
    @include('forntend.nav')

    <div class="container">
        @if (!isset($plan_name))
            <div class="alert alert-warning">
                Please select a plan to proceed to checkout. <a href="{{ url('pricing') }}">Go to Pricing Page</a>
            </div>
        @else
            <div class="notification">
                <span>"{{ $plan_name }}" has been added to your cart.</span>
                <button class="button">View cart</button>
            </div>
        @endif


        <div class="checkout-grid">
            <div class="billing-details">
                <h2>Billing Details</h2>
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Country/Region</label>
                        <select name="country" class="form-control" required>
                            <option value="US">United States (US)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Street Address</label>
                        <input type="text" name="street_address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Town/City</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <select name="state" class="form-control" required>
                            <option value="CA">California</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ZIP Code</label>
                        <input type="text" name="zip" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel" name="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    {{-- <div class="form-group">
                        <label>Account Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div> --}}

                    <div class="checkbox-group">
                        <input type="checkbox" name="terms" id="terms" required>
                        <label for="terms">I have read and agree to the terms and conditions</label>
                    </div>


            </div>

            <div class="order-summary">
                <h2>Your Order</h2>
                @if (isset($plan_duration) && isset($plan_price))
                    <div class="order-row">
                        <span>{{ $plan_duration }} × 1</span>
                        <span>{{ $plan_price }}</span>
                    </div>
                @else
                    <div class="order-row">
                        <span>Default Plan × 1</span>
                        <span>$20</span>
                    </div>
                @endif

                <div class="order-row total">
                    <strong>Total</strong>
                    <strong>{{ $plan_price ?? '$240' }}</strong>
                </div>



                <div class="payment-section">
                    <h3 style="text-align:center;">PayPal</h3>
                    <button class="button" style="width: 100%; margin-top: 1rem;">Pay via PayPal</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add payment processing logic here
            alert('Processing payment...');
        });

        // Add to cart notification
        setTimeout(() => {
            const notification = document.querySelector('.notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 5000);
    </script>
</body>

</html>
