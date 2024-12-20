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
                        <p><strong>Name:</strong> {{ $orders[0]->name }}</p>
                        <p><strong>Telegram Number:</strong> {{ $orders[0]->telegram_number }}</p>
                        <p><strong>Address:</strong> {{ $orders[0]->address }}</p>
                        <p><strong>Province:</strong> {{ $orders[0]->province }}</p>
                        <p><strong>Delivery:</strong> {{ $orders[0]->delivery }}</p>
                        <p><strong>Total Price:</strong> ${{ number_format($orders->sum('total_price'), 2) }}</p>
                    </div>
                </div>

                <!-- Items in the Order -->
                <h4>Items in Your Order</h4>
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
                                <td>
                                   ${{$order->total_price,2}}
                                </td>
                                
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Customer and Delivery Information -->
            <div class="col-lg-4">
                <h4>Customer Information</h4>
                <div class="card mb-4">
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $order->name }}</p>
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
                <a href="https://t.me/Horth_lay"><img src="{{asset('pic/telegram.png')}}" alt="" width="50" height="auto">Telegram</a>
            </div>
            <div class="modal-footer">
                <label for="successModalToggle" class="btn btn-success">Close</label>
            </div>
        </div>
    </div>
    @endif

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container text-center">
            <p>Copyright © {{ date('Y') }} LUGX Gaming Company. All rights reserved.
                <a rel="nofollow" href="https://templatemo.com" target="_blank">Design: TemplateMo</a>
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('homes/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('homes/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('homes/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('homes/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('homes/assets/js/counter.js') }}"></script>
    <script src="{{ asset('homes/assets/js/custom.js') }}"></script>

</body>

</html>
