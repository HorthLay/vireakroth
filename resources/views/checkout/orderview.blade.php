<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lugx Gaming - Order</title>
    <link href="{{ asset('homes/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/animate.css') }}">
    <style>
        table th{
            text-align: center;
            
        }
        table td {
    text-align: center;
    vertical-align: middle; /* Optional */
}
  /* Floating cart button */
  .popup-cart-btn {
position: fixed;
bottom: 20px; /* Distance from the bottom of the screen */
right: 20px; /* Distance from the right side of the screen */
background-color: #007bff; /* Button background color */
color: white; /* Text color */
padding: 15px 20px;
border-radius: 50%; /* Round button */
font-size: 24px;
border: none;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
cursor: pointer;
z-index: 1000; /* Ensure it stays on top */
transition: all 0.3s ease-in-out;
}

/* Hover effect */
.popup-cart-btn:hover {
background-color: #0056b3;
}

/* Cart count styling (small red circle) */
.cart-count {
position: absolute;
top: 10px;
right: 5px;
background-color: red;
color: white;
font-size: 12px;
width: 18px;
height: 18px;
border-radius: 50%;
text-align: center;
line-height: 18px; /* Centers the number vertically */
font-weight: bold;
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
            background: #312aff;
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

    <!-- Header Area -->
    @include('home.header')

    <!-- Page Heading -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Order View</h3>
                    <span class="breadcrumb"><a href="#">Home</a> > <a href="#">Shop</a> > Order</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Page Content -->
    <div class="container mt-5">
        <h3>Your Orders</h3>
        @if($orders->isEmpty())
        <div class="alert alert-info text-center mt-5">
            <p style="font-size: 20px;font-weight: bold;font-family: 'Poppins', sans-serif;">You have no orders.</p>
        </div>
        @else
        <div class="row">
            @php
                $displayedOrderNumbers = [];
            @endphp
            @foreach($orders as $order)
                @if(!in_array($order->order_number, $displayedOrderNumbers))
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">🧾{{ $order->order_number }}</h5>
                            <p class="card-text">
                                <strong>📋Quantity: </strong>
                                <span>{{ $order->quantity }}</span>
                                <strong>💰Total Price: </strong>
                                <span>${{ number_format($order->total_price, 2) }}</span><br>
                                <strong>📊Status: </strong>
                                @if($order->status == 'pending')
                                    <span style="color: rgb(255, 145, 0);">⏳{{ $order->status }}</span>
                                @elseif($order->status == 'success')
                                    <span style="color: green;">✅{{ $order->status }}</span>
                                @elseif($order->status == 'canceled')
                                    <span style="color: red;">❌{{ $order->status }}</span>
                                @else
                                    <span>{{ $order->status }}</span>
                                @endif
                            </p>
                            <a href="{{ route('order.number', $order->order_number) }}" class="btn btn-primary">View Order</a>
                        </div>
                    </div>
                </div>
                @php
                    $displayedOrderNumbers[] = $order->order_number;
                @endphp
                @endif
            @endforeach
        </div>
        @endif
    </div>
    
    

    @include('home.footer')
    <!-- Scripts -->
    <script src="{{ asset('homes/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('homes/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('homes/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('homes/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('homes/assets/js/counter.js') }}"></script>
    <script src="{{ asset('homes/assets/js/custom.js') }}"></script>
</body>

</html>
