<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>VireakRoth - Product Detail</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('homes/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('homes/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    @include('home.css')
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
                                <a href="{{ route('orders.index') }}" id="cart-icon">My Orders</a>
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
                        
                        
                       
                        <!-- ***** Menu End ***** -->
                    </nav>
                                         <!-- Cart button, shown when there is at least one item -->
                                         @if (Auth::check())
                                         @php
                                             $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                                         @endphp
                                         @if ($cartCount > 0)
                                             <button class="popup-cart-btn" onclick="window.location.href='{{ route('cart.view') }}'">
                                                 <i class="fa fa-shopping-cart"></i>
                                                 <span class="cart-count">{{ $cartCount }}</span>
                                             </button>
                                         @endif
                                         @else
                                         @php
                                             $guestCartCount = count(session()->get('guest_cart', []));
                                         @endphp
                                         @if ($guestCartCount > 0)
                                             <button class="popup-cart-btn" onclick="window.location.href='{{ route('cart.view') }}'">
                                                 <i class="fa fa-shopping-cart"></i>
                                                 <span class="cart-count">{{ $guestCartCount }}</span>
                                             </button>
                                         @endif
                                         @endif
                </div>
            </div>
        </div>
      </header>
    <!-- ***** Header Area End ***** -->


      <!-- Succuess Message -->
      @if(session('success'))
      <div class="success-message show">
          <p style="color: white;">{{ session('success') }}</p>
          <button class="close-btn" onclick="document.querySelector('.success-message').classList.remove('show')">×</button>
      </div>
      @endif

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>{{ $product->name }}</h3>
                    <span class="breadcrumb"><a href="#">Home</a> > <a href="#">Shop</a> > {{ $product->name }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product section">
        <div class="container">
            <div class="row">
                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="left-image">
                        <img src="{{ $product->image ? asset('products/' . $product->image) : asset('images/default-product.png') }}" alt="{{ $product->name }}">
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-6 align-self-center">
                    <h4>{{ $product->name }}</h4>
                    <!-- Price with Discount -->
                    <span class="price">
                        @if (!is_null($product->discount) && $product->discount > 0)
                            <em style="text-decoration: line-through;">${{ $product->price }}</em>
                            ${{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}
                        @else
                            ${{ $product->price }}
                        @endif
                    </span>

                    <!-- Description -->
                    <p>{{ $product->description }}</p>

                    <!-- Add to Cart Form -->

                    
                    @if ($product->stock <= 0)
                    <p class="text-danger font-weight-bold">Out of Stock</p>
                    @else
                    <form action="{{ route('cart.details') }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" class="form-control" value="1" required>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary mt-2">Add to Cart</button>
                    </form>
                    @endif
                    <!-- Additional Information -->
                    <ul>
                        <li><span>Category:</span> {{ $product->category->name }}</li>
                        <li><span>Status:</span> {{ ucfirst($product->status) }}</li>
                    </ul>
                </div>

                <!-- Separator -->
                <div class="col-lg-12">
                    <div class="sep"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Games Section -->
    <div class="section categories related-games">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>Action</h6>
                        <h2>Related Games</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="{{ route('products.index') }}">View All</a>
                    </div>
                </div>
                @foreach ($relatedItems as $item)
                    <div class="col-md-4 col-sm-6 col-12" style="padding: 10px 0px 10px 0px;">
                        <div class="item">
                            <h4>{{ $item->name }}</h4>
                            <div class="thumb">
                                <a href="{{route('products.show',$item->id)}}">
                                    <img src="{{ asset('products/' . $item->image) }}" alt="{{ $item->name }}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="col-lg-12">
                <p>Copyright © 2048 LUGX Gaming Company. All rights reserved. &nbsp;&nbsp;
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
