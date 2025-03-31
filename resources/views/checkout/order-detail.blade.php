<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lugx Gaming - Order Details</title>
    <link href="{{ asset('homes/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/animate.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
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

    <!-- Header -->
    @include('home.header')

    <!-- Page Heading -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Order Details</h3>
                    <span class="breadcrumb">
                        <a href="{{ route('home') }}">Home</a> > 
                        <a href="{{ route('orders.index') }}">Orders</a> > Order Details
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Details Section -->
    <div class="container mt-5">
        <div class="row">
            <!-- Order Summary -->
            <div class="col-lg-8">
                <h4>Order Summary</h4>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Order Number: <strong>{{ $orders[0]->order_number }}</strong></h5>
                        <strong>Name</strong><p style="font-family:'Khmer OS Battambang', Courier, monospace"> {{ $orders[0]->name }}</p>
                        <p><strong>Telegram Number:</strong> {{ $orders[0]->telegram_number }}</p>
                        <p><strong>Address:</strong> {{ $orders[0]->address }}</p>
                        <p><strong>Province:</strong> {{ $orders[0]->province }}</p>
                        <p><strong>Delivery:</strong> {{ $orders[0]->delivery }}</p>
                        <p><strong>Total Price:</strong> ${{ number_format($orders->sum('total_price'), 2) }}</p>
                    </div>
                </div>

                <!-- Items in the Order -->
                <h4>Items in Your Order</h4>
<div class="row">
    @foreach($orders as $order)
    @php
    $product = $order->product;
    $priceAfterDiscount = $product->price;
    $discountAmount = 0;
    if ($product->discount > 0) {
        $discountAmount = $product->price * ($product->discount / 100);
        $priceAfterDiscount = $product->price - $discountAmount;
    }
@endphp
    <div class="col-md-6 mb-4">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('products/' . $order->product->image) }}" alt="{{ $order->product->name }}" class="img-thumbnail me-3" style="width: 100px; height: auto;">
                    <div>
                        <h5 class="card-title mb-1">{{ $order->product->name }}</h5>
                        <p class="mb-1"><strong>Quantity:</strong> {{ $order->quantity }}</p>
                        <p class="mb-1"><strong>Price:</strong> ${{ number_format($order->product->price, 2) }}</p>
                        <p class="mb-1"><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
                        @if($discountAmount > 0)
                        <p class="mb-0 text-danger"><strong>Discount:</strong> - ${{ number_format($discountAmount, 2) }}</p>
                        @else
                        <p class="mb-0 text-muted">No Discount</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<hr class="my-4">

                
            </div>

            <!-- Customer and Delivery Information -->
            <div class="col-lg-4">
                <h4>Customer Information</h4>
                <div class="card mb-4">
                    <div class="card-body">
                        <strong>Name</strong><p style="font-family: 'khmer os battambang';">{{ $order->name }}</p>
                        <p><strong>Telegram:</strong> {{ $order->telegram_number }}</p>
                        <p><strong>Province:</strong> {{ $order->province }}</p>
                    </div>
                </div>

                <h4>Delivery Information</h4>
                <div class="card">
                    <div class="card-body">
                        <p><strong>Delivery Address:</strong></p>
                        <p>{{ $order->address }}</p>
                        <p><strong>Delivery Method:</strong> {{ ucfirst($order->delivery) }}</p>
                    </div>
                </div>

                @if($order->status == 'pending')
                <div class="text-center mt-4">
                    <p style="color: red;"><strong>Scan QR Code</strong>:{{ $order->status }}</p>
                    <form action="{{ route('order.checkoutpage', ['order_number' => $order->order_number])}}" method="GET">
                        @csrf
                        <p>checkout</p>
                        <button type="submit" style="border: none; background: none; padding: 0;">
                            <img src="{{ asset('pic/khqr.png') }}" alt="Checkout" style="max-width: 200px;">
                        </button>
                    </form>

                </div>
                @else
                <h4>Payment Information</h4>
                <div class="card">
                    <div class="card-body">
                        <strong>Payment Status:</strong> <p class="text-success">{{ $order->status}}</p>
                        <div style="padding: 10px;color: rgb(36, 25, 245);background-color: #2181ff;border-radius: 5px" >
                            <p style="color: rgb(255, 255, 255);">Thank For Everything for Your Order and Have a Nice Day :)🥰🙏</p>
                        </div>
                    </div>
                </div>
                @endif

                
                
                
            </div>
        </div>
    </div>



    @if(session('success'))
    <!-- Hidden checkbox to trigger modal -->
    <input type="checkbox" id="successModalToggle" checked />
    
    <div class="modal">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Success</h5>
                <label for="successModalToggle" class="btn-close" aria-label="Close">&times;</label>
            </div>
            <div class="modal-body">
                {{ session('success') }}
                <p style="color: green;">Please Contect us on Telegram To <strong class="text-success">Checkout</strong> Your Order</p>
                <a href="https://t.me/Horth_lay"><img src="{{asset('pic/telegram.png')}}" alt="" style="max-width: 50px;">Telegram</a>
            </div>
            <div class="modal-footer">
                <label for="successModalToggle" class="btn btn-success">Close</label>
            </div>
        </div>
    </div>
    @endif

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
