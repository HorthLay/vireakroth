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
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{url('/')}}" class="logo">
                            <img src="{{asset ('pic/vireakroth.png')}}" alt="" style="width: 50px;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="{{ url('/') }}" class="active">Home</a></li>
                            <li><a href="{{ route('products.index') }}">Our Shop</a></li>
                            <li><a href="{{url('/contact-us')}}">Contact Us</a></li>
                            
     
    
    
    
    
                            
    
    
                          
                            
                            
                        
                            @auth
                            <li>
                                <a href="{{ route('orders.view') }}" id="cart-icon">My Orders</a>
                            </li>
                                <li>
                                    <span style="color: rgb(0, 0, 0);font-family: 'Kantumruy', sans-serif;">Welcome, {{ auth()->user()->name }}!</span>
                                </li>
                                <li>
                                    <!-- Logout link -->
                                    <a href="#" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                       Log out
                                    </a>
                                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}">Sign In</a></li>
                            @endauth
                        </ul>
                        
                        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                                         <!-- Cart button, shown when there is at least one item -->
                </div>
            </div>
        </div>
      </header>

    <!-- Page Heading -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Order Page</h3>
                    <span class="breadcrumb"><a href="#">Home</a> > <a href="#">Shop</a> > Order</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Page Content -->
    <div class="container mt-5">
        <div class="row">
            <!-- Cart Items Section -->
            <div class="col-lg-8 col-12 mb-4">
                <h3>Review Your Order</h3>
            
                @if($cart && count($cart) > 0)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach($cart as $item)
                                    @php
                                        $product = $item->product;
                                        $priceAfterDiscount = $product->price;
                                        $discountAmount = 0;
                                        if ($product->discount > 0) {
                                            $discountAmount = $product->price * ($product->discount / 100);
                                            $priceAfterDiscount = $product->price - $discountAmount;
                                        }
                                    @endphp
                                    <div class="col-md-6 col-12 mb-3">
                                        <div class="card mb-3">
                                            <div class="card-body"  style="border: solid blue 2px;border-radius: 10px">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('products/'.$product->image) }}" alt="" class="img-fluid">
                                                    </div>
                                                    <div class="col-8">
                                                        <h5>{{ $product->name }}</h5>
                                                        <p>Quantity: {{ $item->quantity }}</p>
                                                        <p>Price: ${{ number_format($priceAfterDiscount, 2) }}</p>
                                                        <p>Total: ${{ number_format($priceAfterDiscount * $item->quantity, 2) }}</p>
                                                        <p>
                                                            @if($discountAmount > 0)
                                                                <span class="text-danger">Discount: -${{ number_format($discountAmount, 2) }}</span>
                                                            @else
                                                                <span>No Discount</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <h4 class="text-right" style="border-top: 2px solid blue; padding-top: 10px;">Grand Total: ${{ $total }}</h4>
                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <h4>Your cart is empty.</h4>
                        <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Shop Now</a>
                    </div>
                @endif
            </div>
        
            <!-- Order Form Section -->
            @if($cart && count($cart) > 0)
            <div class="col-lg-4 col-12">
                <h3>Enter Delivery Information</h3>
                <div class="card">
                    <div class="card-body" style="border: solid blue 2px;border-radius: 10px">
                        <form action="{{ route('order.submit') }}" method="POST">
                            @csrf
        
                            <!-- Loop through cart items and create hidden input for each product -->
                            @foreach($cart as $item)
                                <input type="hidden" name="product_ids[]" value="{{ $item->product_id }}">
                                <input type="hidden" name="quantities[]" value="{{ $item->quantity }}">
                            @endforeach
        
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                            </div>
        
                            <div class="form-group">
                                <label for="address">Delivery Address</label>
                                <textarea class="form-control" id="address" name="address" rows="4" required></textarea>
                            </div>
        
                            <div class="form-group">
                                <label for="telegram_number">Telegram Number</label>
                                <input type="text" class="form-control" id="telegram_number" name="telegram_number" value="{{ auth()->user()->phone }}" required>
                            </div>
        
                            <div class="form-group">
                                <label for="delivery">Delivery Method</label>
                                <select class="form-control" id="delivery" name="delivery" required>
                                    <option value="" disabled selected>Select Delivery Method</option>
                                    <option value="J&T">J&T Express</option>
                                    <option value="vireak_bontham">Vireak BonTham</option> 
                                    <option value="zto">ZTO</option> 
                                </select>
                            </div>
        
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" id="province" name="province" required>
                            </div>
        
                            <button type="submit" class="btn btn-primary mt-3">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    
    

    <!-- Footer -->
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
