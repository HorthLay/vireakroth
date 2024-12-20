<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Lugx Gaming - Cart</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('homes/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('homes/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
</head>

<body>

    <!-- ***** Preloader Start ***** -->
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
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    @include('home.header')
    <!-- ***** Header Area End ***** -->

    <!-- Page Heading -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Your Cart</h3>
                    <span class="breadcrumb"><a href="#">Home</a> > <a href="#">Shop</a> > Cart</span>
                </div>
            </div>
        </div>
    </div>

   <!-- Cart Section -->
    <div class="container mt-5">
        @if($cart && count($cart) > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                            <tr>
                                <td>
                                    @if(Auth::check())
                                        {{ $item->product->name }}
                                    @else
                                        {{ $item['name'] }}
                                    @endif
                                </td>
                                <td>
                                    @if(Auth::check())
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input 
                                            type="number" 
                                            name="quantity" 
                                            value="{{ $item->quantity }}" 
                                            min="1" 
                                            max="10" 
                                            class="form-control" 
                                            onchange="this.form.submit()" 
                                        />
                                    </form>
                                    @else
                                        {{ $item['quantity'] }}
                                    @endif
                                </td>
                                <td>
                                    @if(Auth::check())
                                        ${{ number_format($item->product->price * $item->quantity, 2) }}
                                    @else
                                        ${{ number_format($item['original_total_price'] * $item['quantity'], 2) }}
                                    @endif
                                </td>
                                
                                
                                <td>
                                    @if(Auth::check())
                                        ${{ $item->product->discount }}
                                    @else
                                        ${{ $item['discount'] }}
                                    @endif
                                </td>
                                <td>
                                    @if(Auth::check())
                                        ${{ $item->total_price }}
                                    @else
                                        ${{ $item['total_price'] }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                <h4 class="text-right">Grand Total: ${{ $total }}</h4>
                <a href="{{ route('order.page') }}" class="btn btn-primary mt-3">Proceed to Order</a>

            </div>
        @else
            <div class="text-center">
                <h4>Your cart is empty.</h4>
                <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Shop Now</a>
            </div>
        @endif
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
