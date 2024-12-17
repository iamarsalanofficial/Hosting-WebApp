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
            @if (session('success'))
                <div style="color: green; font-weight: bold;">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="pricing-plan">
                    <div class="card" onclick="selectPlan('1 YEAR', '$240')">
                        <div class="duration">1 YEAR</div>
                        <div class="price">$20</div>
                        <div class="per-month">per month</div>
                        <button type="submit" name="plan" class="submit-button" value="1 Year">Select</button>
                    </div>
                    <div class="card" onclick="selectPlan('2 YEARS', '$456')">
                        <div class="save-badge">Save $48</div>
                        <div class="duration">2 YEARS</div>
                        <div class="price">$19</div>
                        <div class="per-month">per month</div>
                        <button type="submit" class="submit-button" name="plan" value="2 Years">Select</button>
                    </div>
                    <div class="card" onclick="selectPlan('3 YEARS', '$648')">
                        <div class="save-badge">Save $72</div>
                        <div class="duration">3 YEARS</div>
                        <div class="price">$18</div>
                        <div class="per-month">per month</div>
                        <button type="submit" class="submit-button" name="plan" value="3 Years">Select</button>
                    </div>
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
