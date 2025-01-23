<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Lugx Gaming - Shop Page</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('homes/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

    <style>
        /* General Styling */
        body {
            font-size: 16px;
            line-height: 1.5;
        }

        h4 {
            font-size: 18px;
        }

        /* Success Message Styling */
        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            position: fixed;
            top: 20px;
            right: 20px;
            width: 300px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            font-size: 16px;
            z-index: 1000;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease-in-out;
        }

        .success-message.show {
            opacity: 1;
            transform: translateX(0);
        }

        .success-message .close-btn {
            color: white;
            font-size: 20px;
            background: transparent;
            border: none;
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
        }

        .success-message .close-btn:hover {
            color: #ffffff;
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
    top: -5px;
    right: -5px;
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



        /* Product Item Styling */
        .trending-box .trending-items .item {
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .trending-box .thumb img {
            width: 100%;
            border-radius: 3px;
        }

        .trending-box .down-content {
            text-align: center;
        }

        .trending-box .down-content h4 {
            margin: 10px 0 5px;
            font-size: 16px;
            font-weight: bold;
        }

        .trending-box .down-content .price {
            font-size: 14px;
            color: #3238e4;
            margin-top: 5px;
        }

        .trending-box .down-content .btn {
            font-size: 14px;
            padding: 5px 10px;
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

        /* Responsive Styling */
        @media (max-width: 768px)  {
            body {
                font-size: 14px;
            }

            h4 {
                font-size: 16px;
            }

            .success-message {
                width: 90%;
            }

            .trending-box .trending-items .item {
                margin: 10px 0;
            }

            .trending-box .thumb img {
                max-width: 100%;
                height: auto;
            }

            .trending-filter {
                flex-wrap: wrap;
                text-align: center;
            }

            .pagination {
                justify-content: center;
            }
        }

        .trending-box .down-content .price {
    font-size: 14px; /* Default font size */
}

/* Media Query for Small Screens */
@media (max-width: 576px) {
    .trending-box .down-content .price {
        font-size: 10px; /* Smaller font size for mobile screens */
    }
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

    <!-- Floating Cart Button -->
<!-- Floating Cart Button with Item Count -->
<button class="popup-cart-btn" onclick="window.location.href='{{ route('cart.view') }}'">
    <i class="fa fa-shopping-cart"></i>
    <span class="cart-count">
        @if (Auth::check())
            {{ \App\Models\Cart::where('user_id', Auth::id())->count() }}
        @else
            {{ count(session()->get('guest_cart', [])) }}
        @endif
    </span>
</button>



    <!-- Header -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{url('/')}}" class="logo">
                            <img src="{{asset ('homes/assets/images/logo.png')}}" alt="" style="width: 158px;">
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
                </div>
            </div>
        </div>
      </header>

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Our Shop</h3>
                    <span class="breadcrumb"><a href="#">Home</a> > Our Shop</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="success-message show">
        <p style="color: white;">{{ session('success') }}</p>
        <button class="close-btn" onclick="document.querySelector('.success-message').classList.remove('show')">×</button>
    </div>
    @endif

    <!-- Trending Section -->
    <div class="section trending">
        <ul class="trending-filter">
            <li><a href="{{ route('products.index') }}">Show</a></li>
            @foreach($categories as $category)
            <li><a href="{{ route('category.show', $category->name) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
        <div class="container">
            <div class="row trending-box">
                @if ($products->isEmpty())
                <div class="col-12 text-center">
                    <p class="alert alert-warning">No products available.</p>
                </div>
                @else
                @foreach ($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="item">
                        <div class="thumb">
                            <a href="{{ route('products.show', $product->id) }}">
                                <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}">
                            </a>
                            
                        </div>
                        <div class="down-content">
                            @if ($product->stock <= 0)
                            <span class="price">Out of Stock</span>
                            @else
                            <p class="price" style="font-family: 'Kantumruy', sans-serif; font-weight: bold; font-size: 20px;">
                                @if ($product->discount > 0)
                                    <em style="text-decoration: line-through; color: #888;">${{ $product->price }}</em>
                                    ${{ $product->price - ($product->price * $product->discount / 100) }}
                                @else
                                    ${{ $product->price }}
                                @endif
                            </p>
                            
                            
                            @endif
                            <span class="category">{{ $product->category->name }}</span>
                            <h4>{{ $product->name }}</h4>
                            @if ($product->stock > 0)
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-bag"></i></button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
        

        <!-- Pagination -->
        <div class="pagination" style="justify-content: center;">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Footer -->
    @include('home.footer')

    <!-- Scripts -->
    <script src="{{asset('homes/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('homes/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('homes/assets/js/isotope.min.js')}}"></script>
    <script src="{{asset('homes/assets/js/owl-carousel.js')}}"></script>
    <script src="{{asset('homes/assets/js/counter.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        
        window.onload = function() {
            // Hide the preloader once the page is loaded
            document.getElementById('js-preloader').style.display = 'none';
            
        };
        
    </script>
    
</body>

</html>
