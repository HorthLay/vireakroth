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
    <title>VireakRoth PhoneShop - Home📱</title>

    <!-- Bootstrap core CSS -->
    <link href="homes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="homes/assets/css/fontawesome.css">
    <link rel="stylesheet" href="homes/assets/css/templatemo-lugx-gaming.css">
    <link rel="stylesheet" href="homes/assets/css/owl.css">
    <link rel="stylesheet" href="homes/assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />


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
            bottom: 20px;
            /* Distance from the bottom of the screen */
            right: 20px;
            /* Distance from the right side of the screen */
            background-color: #007bff;
            /* Button background color */
            color: white;
            /* Text color */
            padding: 15px 20px;
            border-radius: 50%;
            /* Round button */
            font-size: 24px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1000;
            /* Ensure it stays on top */
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
            line-height: 18px;
            /* Centers the number vertically */
            font-weight: bold;
        }


        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent black */
            display: none;
            /* Hidden by default */
            z-index: 999;
        }

        /* Popup Ad */
        #adPopup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            max-width: 400px;
            width: 90%;
            display: none;
        }

        /* Close Button */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #000;
        }

        /* Link Style */
        #adLink {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
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

        .view-all-link {
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;

            border-radius: 5px;
            color: #007bff;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .view-all-link:hover {
            background-color: #007bff;
            color: #fff;
        }

        /* Make the button bigger on hover */
        .view-all-link:hover {
            transform: scale(1.1);
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

        .footer p,
        .footer li {
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
        @media (max-width: 768px) {
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
            font-size: 14px;
            /* Default font size */
        }

        /* Media Query for Small Screens */
        @media (max-width: 576px) {
            .trending-box .down-content .price {
                font-size: 10px;
                /* Smaller font size for mobile screens */
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
                flex: 1 1 calc(50% - 10px);
                /* Adjust for 2 columns with spacing */
                max-width: calc(50% - 10px);
                /* Ensure columns take up 50% of the row */
                margin: 5px;
                /* Add some spacing between items */
            }


        }
    </style>

    <style>
        /* Popup Ad Styles */
        .popup-ad {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            max-width: 600px;
            width: 90%;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .close-popup {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #666;
            transition: color 0.3s;
        }

        .close-popup:hover {
            color: #000;
        }

        .popup-content {
            text-align: center;
        }

        .popup-ad-item {
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 8px;
            background-color: #f8f9fa;
        }

        .popup-ad-item img {
            max-width: 100%;
            height: 300px;
            object-fit: contain;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #f8f9fa;
            padding: 10px;
        }

        .popup-ad-item h4 {
            margin: 10px 0;
            color: #333;
        }

        .popup-ad-item p {
            color: #666;
            margin-bottom: 10px;
        }

        .popup-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .popup-button:hover {
            background-color: #0b5ed7;
            color: white;
        }

        .swiper-popup {
            width: 100%;
            padding: 20px 0;
        }

        .swiper-popup .swiper-pagination {
            bottom: 0;
        }
    </style>

    <!--

  

TemplateMo 589 lugx gaming

https://templatemo.com/tm-589-lugx-gaming

-->

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

    @include('home.slider')



    <div class="section trending">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>New</h6>
                        <h2>New Phone</h2>
                    </div>
                </div>
            </div>

            <!-- Dynamic Product Items -->
            <div class="container px-1">
                <div class="row g-3">
                    @foreach ($newProducts->take(4) as $product)
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <div class="card h-90 d-flex flex-column px-2 py-3">
                                <div class="card-img-container"
                                    style="aspect-ratio: 4/4; overflow: hidden;border-radius: 10%;border: 5px solid #2768ff;">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <img class="card-img-top img-fluid"
                                            style="object-fit: contain; width: 100%; max-height: 100%;"
                                            src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}">
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
                                                        class="text-primary">${{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}</span>
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
                                                        class="text-muted text-decoration-line-through">{{ number_format($product->price, 2) }}</span>
                                                    <span
                                                        class="text-primary">${{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                                    </span>
                                                @else
                                                    <span>$ {{ number_format($product->price, 2) }}</span>
                                                @endif
                                            </p>
                                        @endif
                                        <span class="category text-muted">{{ $product->category->name }}</span>
                                        <h5 class="card-title mt-2" style="font-size: 15px">{{ $product->name }}</h5>
                                    </div>
                                    @if ($product->stock > 0)
                                        <form action="{{ route('cart.add') }}" method="POST" class="mt-3 text-center">
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


            <!-- View All Button centered below items -->
            <div class="row">
                <div class="col-12 text-center mt-4">
                    <div class="main-button">
                        <a href="{{ route('products.index') }}" class="view-all-link">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="section trending">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>Second Hand</h6>
                        <h2>Second Phone</h2>
                    </div>
                </div>
            </div>

            <!-- Dynamic Product Items -->
            <div class="container px-1">
                <div class="row g-3">
                    @foreach ($secondHandProducts->take(4) as $product)
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
                                                    <span class="text-muted text-decoration-line-through">$
                                                        {{ number_format($product->price, 2) }}$</span>
                                                    <span
                                                        class="text-primary">${{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                                    </span>
                                                @else
                                                    <span>$ {{ number_format($product->price, 2) }}</span>
                                                @endif
                                            </p>
                                        @else
                                            <p class="text-success font-weight-bold">In Stock</p>
                                            <p class="price"
                                                style="font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 20px;">
                                                @if ($product->discount > 0)
                                                    <span
                                                        class="text-muted text-decoration-line-through">${{ $product->price }}</span>
                                                    <span
                                                        class="text-primary">${{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                                    </span>
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

            <!-- View All Button centered below items -->
            <div class="row">
                <div class="col-12 text-center mt-4">
                    <div class="main-button">
                        <a href="{{ route('products.index') }}" class="view-all-link">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <div class="section-heading">
                        <h6>Categories</h6>
                        <h2>Top Categories</h2>
                    </div>
                </div>
            </div>
            <!-- Swiper -->
            <div class="swiper categorySwiper">
                <div class="swiper-wrapper">
                    @foreach ($categories as $category)
                        <div class="swiper-slide">
                            <div class="item text-center">
                                <h4 class="mb-3">{{ $category->name }}</h4>
                                <div class="thumb mb-3" style="height: 120px; overflow: hidden;">
                                    <a href="{{ route('category.show', $category->name) }}">
                                        <img src="{{ asset('categories/' . $category->image) }}"
                                            alt="{{ $category->name }}" class="img-fluid"
                                            style="width: 80%; height: 80%; object-fit: contain;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <style>
        .categorySwiper {
            padding: 20px 40px;
            position: relative;
        }

        .categorySwiper .swiper-slide {
            background: #fff;
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .categorySwiper .swiper-slide:hover {
            transform: translateY(-5px);
        }

        .categorySwiper .swiper-button-next,
        .categorySwiper .swiper-button-prev {
            color: #0056b3;
            background: #fff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .categorySwiper .swiper-button-next:after,
        .categorySwiper .swiper-button-prev:after {
            font-size: 18px;
        }

        .categorySwiper .swiper-pagination-bullet-active {
            background: #0056b3;
        }
    </style>

    {{--  --}}


    <div class="container my-5">
        <!-- Ads Section -->
        <div class="ads-section">
            <div class="text-center mb-5">
                <h2 class="fw-bold display-5 mb-2">Featured Ads</h2>
                <p class="text-muted">Discover amazing opportunities and offers</p>
            </div>

            <div class="row g-4">
                @if ($ads->isNotEmpty())
                    @foreach ($ads as $ad)
                        <div class="col-lg-4 col-md-6">
                            <div class="card border-0 shadow-lg h-100 overflow-hidden hover-card">
                                <!-- Ad Image with Overlay -->
                                <div class="position-relative overflow-hidden"
                                    style="height: 280px; background: #f8f9fa;">
                                    <img src="{{ asset('ads/' . $ad->image) }}" class="w-100 h-100"
                                        alt="{{ $ad->title }}"
                                        style="object-fit: contain; transition: transform 0.4s ease; object-position: center;">
                                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-10">
                                    </div>
                                </div>

                                <!-- Ad Content -->
                                <div class="card-body d-flex flex-column p-4">
                                    <h5 class="card-title fw-bold mb-3" style="color: #2c3e50;">
                                        {{ $ad->title }}
                                    </h5>
                                    <p class="card-text text-muted flex-grow-1 mb-4" style="line-height: 1.6;">
                                        {{ Str::limit($ad->description, 100) }}
                                    </p>
                                    <a href="{{ $ad->cta_url }}" target="_blank"
                                        class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm"
                                        style="transition: all 0.3s ease;">
                                        <span class="me-2">Learn More</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-bullhorn fa-4x text-muted opacity-50"></i>
                            </div>
                            <h4 class="text-muted mb-2">No Ads Available</h4>
                            <p class="text-muted">Check back later for exciting offers and opportunities!</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 16px;
        }

        .hover-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
        }

        .hover-card:hover img {
            transform: scale(1.08);
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #c6d4ff 100%);
            border: none;
            font-weight: 600;
            padding: 12px 24px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #c6d4ff 0%, #007bff 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.4);
        }

        .card-title {
            font-size: 1.25rem;
            letter-spacing: -0.5px;
        }

        .ads-section {
            padding: 20px 0;
        }

        @media (max-width: 768px) {
            .display-5 {
                font-size: 2rem;
            }

            .hover-card:hover {
                transform: translateY(-4px);
            }
        }
    </style>


    @include('home.footer')

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="homes/vendor/jquery/jquery.min.js"></script>
    <script src="homes/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="homes/assets/js/isotope.min.js"></script>
    <script src="homes/assets/js/owl-carousel.js"></script>
    <script src="homes/assets/js/counter.js"></script>
    <script src="homes/assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <script>
        var categorySwiper = new Swiper(".categorySwiper", {
            slidesPerView: 'auto',
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
                480: {
                    slidesPerView: 2,
                    spaceBetween: 15
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 20
                }
            }
        });
    </script>

    @if (count($ads) > 0)
        <div class="popup-overlay" id="popupOverlay" style="display:none;"></div>
        <div class="popup-ad" id="popupAd" style="display:none;">
            <span class="close-popup" onclick="closePopup()">&times;</span>
            <div class="popup-content">
                <h3 class="mb-4">Featured Advertisements</h3>
                <div class="countdown-timer" id="popupTimer">Closing in: 5s</div>
                <div class="swiper swiper-popup">
                    <div class="swiper-wrapper">
                        @foreach ($ads as $ad)
                            <div class="swiper-slide">
                                <div class="popup-ad-item">
                                    <img src="{{ asset('ads/' . $ad->image) }}" alt="{{ $ad->title }}">
                                    <h4>{{ $ad->title }}</h4>
                                    <p>{{ Str::limit($ad->description, 100) }}</p>
                                    <a href="{{ $ad->cta_url }}" target="_blank" class="popup-button">Learn
                                        More</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Swiper init
                new Swiper('.swiper-popup', {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            });

            window.addEventListener('load', function() {
                // Only show if not shown before
                if (!localStorage.getItem('popupShown')) {
                    setTimeout(function() {
                        document.getElementById('popupOverlay').style.display = 'block';
                        document.getElementById('popupAd').style.display = 'block';
                        startCountdown();
                        // mark as shown
                        localStorage.setItem('popupShown', 'true');
                    }, 2000);
                }
            });

            function startCountdown() {
                let timeLeft = 5;
                const timerElement = document.getElementById('popupTimer');

                const countdownInterval = setInterval(function() {
                    timeLeft--;
                    timerElement.textContent = `Closing in: ${timeLeft}s`;

                    if (timeLeft <= 0) {
                        clearInterval(countdownInterval);
                        closePopup();
                    }
                }, 1000);
            }

            function closePopup() {
                document.getElementById('popupOverlay').style.display = 'none';
                document.getElementById('popupAd').style.display = 'none';
            }

            document.getElementById('popupOverlay').addEventListener('click', closePopup);
        </script>
    @endif

</body>

</html>
