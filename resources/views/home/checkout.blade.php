<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VireakRoth PhoneShop - Checkout💵</title>
    <link href="{{ asset('homes/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/animate.css') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- Link Bootstrap --}}
   
    {{-- Bakong KHQR --}}
    <script src="https://github.com/davidhuotkeo/bakong-khqr/releases/download/bakong-khqr-1.0.6/khqr-1.0.6.min.js"></script>

    {{-- QR Code Reader --}}
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <style>
        /* Hide the checkbox by default */
        #successModalToggle {
            display: none;
        }

        /* Modal Style */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
        }

        .modal-header {
            background-color: #21ff4a;
            color: white;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }

        .modal-footer {
            padding: 10px;
            text-align: right;
        }

        .modal-body {
            padding: 10px;
        }

        /* Show modal when checkbox is checked */
        #successModalToggle:checked + .modal {
            display: flex;
        }

        .btn-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
        }

        .btn-close:hover {
            cursor: pointer;
        }

        .modal-header {
            background-color: #ff0c0c;
            color: white;
            display: flex;
            justify-content: center;
        }

        .modal-header img {
            max-width: 80px;
            height: auto;
        }

        .modal-body {
            text-align: center;
            padding: 30px;
            background-color: #f9f9f9;
        }

        .modal-body h3 {
            font-size: 2rem;
            color: #28a745;
            font-weight: bold;
        }

        #qrCodeCanvas {
            margin-top: 20px;
            background-color: #fff;
            border: 2px solid #e0e0e0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 300px;
            max-height: 300px;
            width: 100%;
            height: 100%;
        }

        .modal-footer {
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
        }

        .btn-secondary {
            background-color: #757575;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #616161;
        }
  
        /* Footer Styling */
        .footer {
            background-color: #141414;
            color: #f1f1f1;
            padding: 40px 0;
            font-size: 14px;
        }

        .footer h5 {
            color: #000000;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .footer p, .footer li {
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .footer a {
            color: #fff700;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #ff3300;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links li a {
            display: inline-block;
        }

        .footer .social-icons {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .footer .social-icon {
            width: 40px;
            height: 40px;
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 50%;
            background: #2a4aff;
            padding: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .footer .social-icon:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
        }

        .footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .footer .row {
            margin-bottom: 30px;
        }

        .footer .text-center {
            border-top: 1px solid #444;
            padding-top: 15px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <!-- Preloader -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <!-- Header -->
    @include('home.header')

    <!-- Page Heading -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3> Checkout💵</h3>
                    <span class="breadcrumb">
                        <a href="{{ route('home') }}">Home</a> > 
                        <a href="{{ route('orders.index') }}">Orders</a> > Checkout💵
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Details Section -->
    <div class="container mt-5">
        <div class="row">
<!-- QR Code Modal Structure -->
    <!-- QR Code Modal -->
    <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm"> <!-- Centered and small modal for mobile -->
            <div class="modal-content" style="position: relative;">
                <button type="button" class="close-button" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 1.5rem; font-weight: bold; cursor: pointer;">
                    X
                </button>
    
                <div id="countdownTimer" style="font-size: 1.5rem; font-weight: bold; color: black; margin-bottom: 10px; text-align: center;">
                    02:00
                </div>
    
                <!-- Modal Header -->
                <div class="modal-header" style="padding: 10px; position: relative;">
                    <h5 class="modal-title" id="qrCodeModalLabel" style="margin: 0 auto;">
                        <img src="{{ asset('pic/khqr.png') }}" alt="QR Logo" style="max-width: 100px; height: auto;">
                    </h5>
                </div>
    
                <!-- Modal Body -->
                <div class="modal-body text-center" style="padding: 15px;">
                    <h3 style="color: #000000; font-size: 1.5rem; margin-bottom: 10px;">${{ number_format($totalPrice, 2) }}</h3>
    
                    <h4 style="font-size: 1.2rem; margin-bottom: 20px;">SOUNG LAY HORTH</h4>
                    <!-- Canvas for QR Code Rendering -->
                    <p>-----------------------------</p>
                    <canvas id="qrCodeCanvas" style="max-width: 100%; height: auto; border: 1px solid #ccc; padding: 10px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    
    


    <div class="row m-0" style="height: 30vh; display: flex; justify-content: center; align-items: center;">
        @php
    $displayedOrderNumbers = [];
@endphp

@foreach($order as $orders)
    @if(!in_array($orders->order_number, $displayedOrderNumbers))
        <h5 class="text-center"><strong>Order Number:</strong> {{ $orders->order_number }}</h5>
        @php
            $displayedOrderNumbers[] = $orders->order_number;
        @endphp
    @endif
@endforeach

        <div class="col-12 mb-4 p-0 text-center">
            <img src="{{ asset('pic/khqr.png') }}" style="cursor: pointer; max-width: 20%; height: auto;"><br>
            <button class="btn btn-primary" style="margin-top:10px;" alt="Checkout" id="checkout">Check Out</button>
        </div>
    </div>
    
    
        </div>
    </div>

@include('home.footer')
    <!-- Scripts -->
     {{-- Script Bootstrap--}}
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     {{-- Script jquery  --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 
     @include('checkout.khqr')
     <script src="{{ asset('homes/times.js') }}"></script>
    <script src="{{ asset('homes/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('homes/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('homes/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('homes/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('homes/assets/js/counter.js') }}"></script>
    <script src="{{ asset('homes/assets/js/custom.js') }}"></script>

</body>

</html>
