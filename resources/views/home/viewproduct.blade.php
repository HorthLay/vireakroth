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
                    <h3>Our Shop</h3>
                    <span class="breadcrumb"><a href="#">Home</a> > Our Shop</span>
                </div>
            </div>
        </div>
    </div>

    <div class="section trending">
      <ul class="trending-filter">
        <li>
          <a href="{{route('products.index')}}">Show</a>
        </li>
        @foreach($categories as $category)
        <li>
            <a href="{{ route('category.show', $category->name) }}" >
                {{ $category->name }}
            </a>
        </li>
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
                    <div class="col-lg-3 col-md-6 align-self-stretch mb-30 trending-items">
                        <div class="item">
                            <div class="thumb">
                                <a href="{{route('products.show', $product->id)}}">
                                    <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}" >
                                </a>
                                @if ($product->stock <= 0)
                                    <span class="badge bg-danger out-of-stock">Out of Stock</span>
                                @else
                                    <span class="price">
                                        @if ($product->discount > 0)
                                            <em>${{ $product->price }}</em>
                                            ${{ $product->price - ($product->price * $product->discount / 100) }}
                                           
                                        @else
                                            ${{ $product->price }}
                                        @endif
                                    </span>
                                @endif
                            </div>
                            <div class="down-content">
                                <span class="category">{{ $product->category->name }}</span><br>
                                @if ($product->status == 'new')
                                <img src="{{ asset('pic/new.png') }}" alt="" style="max-width: 50px;">
                                @elseif ($product->status == 'second_hand')
                                <img src="{{ asset('pic/second.png') }}" alt="" style="max-width: 50px;">
                                @endif
                                <h4>{{ $product->name }}</h4>
                                @if ($product->stock > 0)
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-primary mt-2">Add to Cart</button>
                                    </form>
                                @else
                                    <span class="text-muted">Unavailable</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                @endif
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="pagination">
                        {{ $products->links() }}
                    </ul>
                </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('homes/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('homes/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('homes/assets/js/counter.js') }}"></script>
    <script src="{{ asset('homes/assets/js/custom.js') }}"></script>
</body>

</html>
