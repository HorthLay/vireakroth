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
    <style>
        /* Modal Styles */
        #successModalToggle {
            display: none;
        }

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
        <!-- Check if there are any orders -->
        @if($orders->isNotEmpty())
            <div class="col-lg-8">
                <h4>Order Summary</h4>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">🆔Order Number: <strong>{{ $orders[0]->order_number }}</strong></h5>
                        <p><strong>👤Name:</strong> {{ $orders[0]->name }}</p>
                        <p><strong>📧Telegram Number:</strong> {{ $orders[0]->telegram_number }}</p>
                        <p><strong>🏠Address:</strong> {{ $orders[0]->address }}</p>
                        <p><strong>🌐Province:</strong> {{ $orders[0]->province }}</p>
                        <p><strong>🚚Delivery:</strong> {{ $orders[0]->delivery }}</p>
                        <p><strong>💵Total Price:</strong> ${{ number_format($orders->sum('total_price'), 2) }}</p>
                        <p><strong>📊Status:</strong> 
                            @if($orders[0]->status == 'pending')
                                <span style="color: orange;">{{ $orders[0]->status }}⏳</span>
                            @elseif($orders[0]->status == 'paid')
                                <span style="color: green;">{{ $orders[0]->status }}✅</span>
                            @elseif($orders[0]->status == 'canceled')
                                <span style="color: red;">{{ $orders[0]->status }}❌</span>
                            @else
                                <span>{{ $orders[0]->status }}</span>
                            @endif
                        </p>
                        
                    </div>
                </div>

                <h4>📦Items in Your Order</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->product->name }}</td>
                                    <td>${{ number_format($order->product->price, 2) }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>${{ number_format($order->total_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="col-lg-12">
                <p>No order found with the given order number.</p>
            </div>
        @endif

        @foreach($orders as $order)
        @if($order->status == 'canceled')
            <div class="col-lg-12">
                <p style="color: red;">This order has been cancelled.</p>
            </div>
        @else
            <a class="btn btn-danger" onClick="cancelConfirmation(event)" style="padding: 5px 10px; font-size: 14px;" href="{{ url('/order_cancel', $order->order_number) }}">
                Cancel Order
            </a>
        @endif
    @endforeach
    
    </div>
</div>

@include('home.footer')

    <!-- Scripts -->


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function cancelConfirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');

        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to cancel this order?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, cancel it!',
            cancelButtonText: 'No, keep it',
            dangerMode: true,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait while we cancel your order.',
                    icon: 'info',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                setTimeout(() => {
                    window.location.href = urlToRedirect;
                }, 1000);
            }
        });
    }
</script>


    <script src="{{ asset('homes/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('homes/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('homes/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('homes/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('homes/assets/js/counter.js') }}"></script>
    <script src="{{ asset('homes/assets/js/custom.js') }}"></script>

</body>

</html>
