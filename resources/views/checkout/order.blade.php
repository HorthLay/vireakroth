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
            <div class="col-lg-8">
                <h3>Review Your Order</h3>
            
                @if($cart && count($cart) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Discount</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $item)
                                    @php
                                        $product = $item->product; // Access the product from the cart item
                                        $priceAfterDiscount = $product->price;
                                        $discountAmount = 0;
                                        if ($product->discount > 0) {
                                            // Calculate discount if applicable
                                            $discountAmount = $product->price * ($product->discount / 100);
                                            $priceAfterDiscount = $product->price - $discountAmount;
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ number_format($priceAfterDiscount, 2) }}</td>
                                        <td>${{ number_format($priceAfterDiscount * $item->quantity, 2) }}</td>
                                        <td>
                                            @if($discountAmount > 0)
                                                <span class="text-danger">Discount: -${{ number_format($discountAmount, 2) }}</span>
                                            @else
                                                <span>No Discount</span>
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{ asset('products/'.$product->image) }}" alt="" style="width: 100px; height: 100px;">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        <h4 class="text-right">Grand Total: ${{ $total }}</h4>
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
            <div class="col-lg-4">
                <h3>Enter Delivery Information</h3>
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
        @endif
        
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container">
            <div class="col-lg-12 text-center">
                <p>Copyright © 2048 LUGX Gaming Company. All rights reserved.
                    <a rel="nofollow" href="https://templatemo.com" target="_blank">Design: TemplateMo</a>
                </p>
            </div>
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
