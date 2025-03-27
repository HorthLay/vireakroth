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
  @media (max-width: 768px) {
    .features .row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }
  
    .features .col-lg-3, 
    .features .col-md-6 {
      flex: 1 1 calc(50% - 10px); /* Adjust for 2 columns with spacing */
      max-width: calc(50% - 10px); /* Ensure columns take up 50% of the row */
      margin: 5px; /* Add some spacing between items */
    }
  
  
  }
  
  
  
  
      
  
  
  
  </style>
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
   <!-- Header -->
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


  {{-- <h1>home</h1>

@if (auth()->check())
    <p>Welcome, {{ auth()->user()->name }}!</p>
@else
    <p>You are not logged in.</p>
@endif


@auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endauth --}}
    <!-- ***** Header Area End ***** -->
  

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if($selectedCategory)
                        <h3>
                            <img src="{{ asset('categories/' . $selectedCategory->image) }}" 
                                 alt="{{ $selectedCategory->name }}" 
                                 style="max-width: 20%;">
                        </h3>
                        <span class="breadcrumb"><a href="#">Home</a> > {{$name}}</span>
                    @else
                        <h3>No category found</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- success message --}}
    @if(session('success'))
      <div class="success-message show">
          <p style="color: white;">{{ session('success') }}</p>
          <button class="close-btn" onclick="document.querySelector('.success-message').classList.remove('show')">×</button>
      </div>
      @endif
    {{-- <div class="section trending">
        <ul class="trending-filter">
            <li>
                <a href="{{ route('products.index') }}">Show</a>
            </li>
            @if($categories && $categories->count())
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('category.show', $category->name) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            @else
                <li>No categories available.</li>
            @endif
        </ul>
    </div> --}}
    

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
        <div class="container px-1">
            <div class="row g-3">
                @if ($products->isEmpty())
                <div class="col-12 d-flex justify-content-center">
                    <div class="card p-4 text-center shadow-sm" style="max-width: 400px; border-radius: 10px; background-color: #f8f9fa;">
                        <i class="fa fa-box-open text-primary mb-3" style="font-size: 40px;"></i>
                        <p class="text-muted font-weight-bold">No products available</p>
                    </div>
                </div>
                
                @else
                    @foreach ($products as $product)
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <div class="card h-90 d-flex flex-column px-2 py-3">
                                <div class="card-img-container" style="aspect-ratio: 4/4; overflow: hidden;border-radius: 10%;border: 5px solid #2768ff;">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <img class="card-img-top img-fluid"
                                             style="object-fit: contain; width: 100%; max-height: 100%;" 
                                             src="{{ asset('products/' . $product->image) }}" 
                                             alt="{{ $product->name }}">
                                    </a>
                                </div>
                                <div class="card-body text-center d-align flex-column justify-content-between p-4">
                                    <div class="text-center">
                                        @if ($product->stock <= 0)
                                            <p class="text-danger font-weight-bold">Out of Stock</p>
                                        @else
                                            <p class="text-success font-weight-bold">In Stock</p>
                                        @endif
                                        <p class="price" style="font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 20px;">
                                            @if ($product->discount > 0)
                                                <span class="text-muted text-decoration-line-through">${{ $product->price }}</span>
                                                <span class="text-primary">${{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}</span>
                                            @else
                                                <span>${{ number_format($product->price, 2) }}</span>
                                            @endif
                                        </p>
                                        <span class="category text-muted">
                                            {{ $product->category ? $product->category->name : 'Uncategorized' }}
                                        </span>
                                        <h5 class="card-title mt-2" style="font-size: 15px">{{ $product->name }}</h5>
                                    </div>
                                    @if ($product->stock > 0)
                                        <form action="{{ route('cart.add') }}" method="POST" class="mt-3 text-center">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm mt-auto"><i class="fa fa-shopping-bag"></i> Cart</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm mt-auto" disabled>
                                            <i class="fa fa-times"></i> Unavailable
                                        </button>
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
