<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('pic/vireakroth.png') }}">
    <title>VireakRoth - Shop Page</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link href="homes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

    @include('home.productcss')
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




    <!-- Header -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('pic/vireakroth.png') }}" alt="" style="width: 50px;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li>
                                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('products.index') }}"
                                    class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
                                    Our Shop
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/contact-us') }}"
                                    class="{{ request()->is('contact-us') ? 'active' : '' }}">
                                    Contact Us
                                </a>
                            </li>

                            @auth
                                <li>
                                    <a href="{{ route('orders.view') }}" id="cart-icon"
                                        class="{{ request()->routeIs('orders.view') ? 'active' : '' }}">
                                        My Orders
                                    </a>
                                </li>
                                <li>
                                    <span style="color: rgb(0, 0, 0);font-family: 'Kantumruy', sans-serif;">
                                        Welcome, {{ auth()->user()->name }}!
                                    </span>
                                </li>
                                <li>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Log out
                                    </a>
                                    <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}"
                                        class="{{ request()->routeIs('login') ? 'active' : '' }}">
                                        Sign In
                                    </a>
                                </li>
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

                    {{-- <!-- Overlay -->
                                     <div id="overlay"></div>

                                     <!-- Ad Popup -->
                                     <div id="adPopup" style="display: none;">
                                         <span class="close-btn" onclick="closeAd()">×</span>
                                         <h3 id="adTitle">Special Offer!</h3>
                                         <img id="adImage" src="https://via.placeholder.com/250" alt="Ad Image" style="width:100%; border-radius:5px;">
                                         <p id="adDescription">Get 20% off on your first purchase.</p>
                                         <a id="adLink" href="https://example.com" target="_blank">Shop Now</a>
                                     </div> --}}

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
    @if (session('success'))
        <div class="success-message show">
            <p style="color: white;">{{ session('success') }}</p>
            <button class="close-btn"
                onclick="document.querySelector('.success-message').classList.remove('show')">×</button>
        </div>
    @endif

    <!-- Trending Section -->
    <div class="section trending">
        <div class="container">


            <ul class="trending-filter">
                <li>
                    <a href="{{ route('products.index') }}" class="category-link">
                        <img src="{{ asset('pic/vireakroth.png') }}" alt="All" class="category-icon">
                        <span>Show All</span>
                    </a>
                </li>
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('category.show', $category->name) }}" class="category-link">
                            <img src="{{ asset('categories/' . $category->image) }}" alt="{{ $category->name }}"
                                class="category-icon" onerror="this.src='{{ asset('pic/vireakroth.png') }}'">
                            <span>{{ $category->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <style>
                .trending-filter {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 25px;
                    padding: 0;
                    list-style: none;
                    margin: 30px 0;
                    justify-content: center;
                }

                .trending-filter li {
                    margin: 0;
                }

                .category-link {
                    display: flex;
                    align-items: center;
                    gap: 15px;
                    padding: 15px 30px;
                    background: #fff;
                    border-radius: 35px;
                    text-decoration: none;
                    color: #333;
                    transition: all 0.3s ease;
                    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
                    font-size: 17px;
                    font-weight: 500;
                }

                .category-link:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                    background: #f8f9fa;
                }

                .category-icon {
                    width: 40px;
                    height: 40px;
                    object-fit: contain;
                    border-radius: 50%;
                    padding: 2px;
                    background: #f8f9fa;
                }

                @media (max-width: 768px) {
                    .trending-filter {
                        gap: 15px;
                    }

                    .category-link {
                        padding: 10px 20px;
                        font-size: 15px;
                    }

                    .category-icon {
                        width: 30px;
                        height: 30px;
                    }
                }
            </style>
            <div class="container px-1">
                <div class="row g-3">
                    @foreach ($products as $product)
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <div class="card h-90 d-flex flex-column px-2 py-3">
                                <div class="card-img-container"
                                    style="aspect-ratio: 4/4; overflow: hidden;border-radius: 10%;border: 5px solid #2768ff;">
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
                                            <p class="price"
                                                style="font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 20px;">
                                                @if ($product->discount > 0)
                                                    <span
                                                        class="text-muted text-decoration-line-through">${{ $product->price }}</span>
                                                    <span
                                                        class="text-primary">${{ $product->price - ($product->price * $product->discount) / 100 }}</span>
                                                @else
                                                    <span>${{ $product->price }}</span>
                                                @endif
                                            </p>
                                        @else
                                            <p class="text-success font-weight-bold">In Stock</p>
                                            <p class="price"
                                                style="font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 20px;">
                                                @if ($product->discount > 0)
                                                    <span
                                                        class="text-muted text-decoration-line-through">${{ number_format($product->price, 2) }}</span>
                                                    <span
                                                        class="text-primary">${{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}</span>
                                                @else
                                                    <span>${{ number_format($product->price, 2) }}</span>
                                                @endif
                                            </p>
                                        @endif
                                        <span class="category text-muted">{{ $product->category->name }}</span>
                                        <h5 class="card-title mt-2" style="font-size: 15px">{{ $product->name }}</h5>
                                    </div>
                                    @if ($product->stock > 0)
                                        <form action="{{ route('cart.add') }}" method="POST"
                                            class="mt-3 text-center">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm mt-auto"><i
                                                    class="fa fa-shopping-bag"></i> Cart</button>
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
                </div>
            </div>


            <!-- Pagination -->
            <div class="row">
                <div class="col-lg-12">
                    <ul class="pagination">
                        @if ($products->onFirstPage())
                            <button class="pagination-btn disabled">Previous</button>
                        @else
                            <button class="pagination-btn"
                                onclick="window.location='{{ $products->previousPageUrl() }}'">Previous</button>
                        @endif

                        @php
                            $totalPages = $products->lastPage();
                            $currentPage = $products->currentPage();

                            // Determine the range of pages to show
                            if ($totalPages <= 5) {
                                // Show all pages if there are 5 or fewer
                                $startPage = 1;
                                $endPage = $totalPages;
                            } else {
                                // Show pages 1 to 5 initially
                                if ($currentPage <= 3) {
                                    $startPage = 1;
                                    $endPage = 5;
                                } elseif ($currentPage >= $totalPages - 2) {
                                    // Show the last 5 pages if near the end
                                    $startPage = $totalPages - 4;
                                    $endPage = $totalPages;
                                } else {
                                    // Show the current page and the two pages before and after
                                    $startPage = $currentPage - 2;
                                    $endPage = $currentPage + 2;
                                }
                            }
                        @endphp

                        @foreach ($products->getUrlRange($startPage, $endPage) as $page => $url)
                            <button class="pagination-btn {{ $page == $currentPage ? 'active' : '' }}"
                                onclick="window.location='{{ $url }}'">
                                {{ $page }}
                            </button>
                        @endforeach

                        @if ($products->hasMorePages())
                            <button class="pagination-btn"
                                onclick="window.location='{{ $products->nextPageUrl() }}'">Next</button>
                        @else
                            <button class="pagination-btn disabled">Next</button>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>




    <!-- Footer -->
    @include('home.footer')

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/counter.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        window.onload = function() {
            // Hide the preloader once the page is loaded
            document.getElementById('js-preloader').style.display = 'none';

        };
    </script>

</body>

</html>
