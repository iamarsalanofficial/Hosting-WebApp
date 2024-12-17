<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Namoverse</title>        
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}" />    
</head>
<body>
<!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <a href="{{ url('pricing')}}">
                <img src="{{ asset('img/logo-new.png') }}" alt="Logo" width="200px" />
            </a>
        </div>
        <div class="nav-tabs">
            <ul class="inline-tabs">
                <li><a href="#">Support</a></li>
                <li><a href="#">Package</a></li>
                <li><a href="#">Why Choose Us</a></li>
                <li><a href="#">Help</a></li>
            </ul>
        </div>
        <div class="nav-buttons">
            <a href="{{ url('checkout' )}}">
            <button class="nav-cart">
                <img src="{{ asset('img/shopping_cart.svg') }}" alt="Cart" />
            </button>
            </a>
            <button class="nav-account">
                <img src="{{ asset('img/person.svg') }}" alt="Account" />
            </button>
        </div>
    </nav>
<hr>
    <!-- End Main Navbar -->