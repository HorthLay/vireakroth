<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Lugx Gaming - Product Detail</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('homes/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('homes/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('homes/assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <style>
        .left-image img,
        .related-games .thumb img {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            max-width: 100%;
            height: auto;
        }

        .left-image img:hover,
        .related-games .thumb img:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .related-games .thumb {
            overflow: hidden;
            margin: 10px 0;
        }

        .related-games .item {
            text-align: center;
            margin-bottom: 20px;
        }

        .related-games .item h4 {
            font-size: 18px;
            font-weight: 600;
            margin: 10px 0 5px;
        }

        .related-games .thumb img {
            max-width: 200px;
            height: auto;
            margin: 0 auto;
        }

        .related-games .thumb a::after {
            content: "Quick View";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .related-games .thumb a:hover::after {
            opacity: 1;
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
    @include('home.header')
    <!-- ***** Header Area End ***** -->

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
                    <form id="qty" action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" class="form-control" value="1" min="1" placeholder="1" required>
                        <button type="submit"><i class="fa fa-shopping-bag"></i> ADD TO CART</button>
                    </form>

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
