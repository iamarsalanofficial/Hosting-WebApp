<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pricing Plan</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
</head>

<body>
    <!-- Navbar -->
    @include('forntend.nav')
    
    <!-- Main Section -->
    <section>
    <div class="main-container">
        <h1 class="selected-plan-head">Choose Your Plan</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="pricing-plan">
                @foreach ($plans as $plan)
                    <div class="card" onclick="selectPlan('{{ $plan['name'] }}', '{{ $plan['price'] }}')">
                        @if(isset($plan['save_badge']))
                            <div class="save-badge">{{ $plan['save_badge'] }}</div>
                        @endif
                        <div class="duration">{{ $plan['name'] }}</div>
                        <div class="price">${{ $plan['price'] }}</div>
                        <div class="per-month">per month</div>
                        <button type="submit" name="plan" class="submit-button" value="{{ $plan['name'] }}">Select</button>
                    </div>
                @endforeach
            </div>

            <!-- Hidden Fields -->
            <input type="hidden" name="plan_duration" id="plan_duration" value="">
            <input type="hidden" name="plan_price" id="plan_price" value="">
        </form>

        <script>
            function selectPlan(duration, price) {
                document.getElementById('plan_duration').value = duration;
                document.getElementById('plan_price').value = price;
            }
        </script>
    </div>
</section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <img src="{{ asset('img/footer-logo.png') }}" alt="" width="150px" />
                <p>Smart website solutions for small businesses.</p>
            </div>
            <div class="footer-right">
                <h2>Subscribe</h2>
                <form>
                    <input type="email" placeholder="Enter your email" />
                    <button type="submit">➡</button>
                </form>
            </div>
        </div>
        <div class="copyright">
            <p>© 2024 Namoverse. All rights reserved.</p>
        </div>
    </footer>
    <!-- Add this script before closing </body> tag -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Grab all card elements
            const planCards = document.querySelectorAll('.card');

            // Loop through each plan card
            planCards.forEach(function(card) {
                card.addEventListener('click', function() {
                    // Remove selected class from all cards
                    planCards.forEach(function(c) {
                        c.classList.remove('selected-plan');
                    });

                    // Add the selected class to the clicked card
                    this.classList.add('selected-plan');

                    // Optionally, select the hidden input or modify the form value
                    const planInput = this.querySelector('button');
                    if (planInput) {
                        planInput.disabled = false;
                    }
                });
            });
        });
    </script>

</body>

</html>
