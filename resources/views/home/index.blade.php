<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>VireakRoth PhoneShop - Home📱</title>

    <!-- Bootstrap core CSS -->
    <link href="homes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="homes/assets/css/fontawesome.css">
    <link rel="stylesheet" href="homes/assets/css/templatemo-lugx-gaming.css">
    <link rel="stylesheet" href="homes/assets/css/owl.css">
    <link rel="stylesheet" href="homes/assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <style>
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
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
      <div class="col-lg-6">
          <div class="main-button">
              <a href="{{ route('products.index') }}">View All</a>
          </div>
      </div>
      <!-- Succuess Message -->
      @if(session('success'))
      <div class="success-message show">
          <p style="color: white;">{{ session('success') }}</p>
          <button class="close-btn" onclick="document.querySelector('.success-message').classList.remove('show')">×</button>
      </div>
      @endif
      <!-- Dynamic Product Items -->
      @foreach ($newProducts as $product)
      <div class="col-lg-3 col-md-6">
          <div class="item">
              <div class="thumb">
                  <a href="{{ $product->stock > 0 ? route('products.show', $product->id) : '#' }}">
                      <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}" >
                  </a>
                  @if ($product->stock <= 0)
                      <span class="badge badge-danger out-of-stock" style="position: absolute; top: 10px; right: 10px;color: black;">Out of Stock</span>
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
                  <span class="category">{{ $product->category->name }}</span>
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
  </div>
  
  </div>
</div>


<div class="section trending">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
          <div class="section-heading">
              <h6>SecondHand</h6>
              <h2>SecondHand Phone</h2>
          </div>
      </div>
      <div class="col-lg-6">
          <div class="main-button">
              <a href="{{ route('products.index') }}">View All</a>
          </div>
      </div>
      <!-- Succuess Message -->
      <!-- Dynamic Product Items -->
      @foreach ($secondHandProducts as $product)
      <div class="col-lg-3 col-md-6">
          <div class="item">
              <div class="thumb">
                  <a href="{{ $product->stock > 0 ? route('products.show', $product->id) : '#' }}">
                      <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}" >
                  </a>
                  @if ($product->stock <= 0)
                      <span class="badge badge-danger out-of-stock" style="position: absolute; top: 10px; right: 10px;color: black;">Out of Stock</span>
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
                  <span class="category">{{ $product->category->name }}</span>
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
  </div>
  
  </div>
</div>

  <div class="section categories">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading">
            <h6>Categories</h6>
            <h2>Top Categories</h2>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Action</h4>
            <div class="thumb">
              <a href="product-details.html"><img src="homes/assets/images/categories-01.jpg" alt=""></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Action</h4>
            <div class="thumb">
              <a href="product-details.html"><img src="homes/assets/images/categories-05.jpg" alt=""></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Action</h4>
            <div class="thumb">
              <a href="product-details.html"><img src="homes/assets/images/categories-03.jpg" alt=""></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Action</h4>
            <div class="thumb">
              <a href="product-details.html"><img src="homes/assets/images/categories-04.jpg" alt=""></a>
            </div>
          </div>
        </div>
        <div class="col-lg col-sm-6 col-xs-12">
          <div class="item">
            <h4>Action</h4>
            <div class="thumb">
              <a href="product-details.html"><img src="homes/assets/images/categories-05.jpg" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  {{-- <div class="ad-section" style="background-color: #fef7ec; padding: 50px 0; border: 3px solid #3db5ff; border-radius: 10px; margin: 20px; text-align: center;">
    <div class="container">
      <div class="row align-items-center">
        <!-- Ad Content -->
        <div class="col-lg-6">
          <div class="ad-content">
            <h6 style="color: #3daeff; font-size: 16px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
              Limited-Time Offer!
            </h6>
            <h2 style="font-size: 32px; font-weight: bold; margin: 10px 0;">
              Pre-Order Now & Get <em style="color: #3daeff;">Exclusive Discounts</em>
            </h2>
            <p style="font-size: 16px; color: #555; margin: 20px 0;">
              Don't miss out on unbeatable prices for top-quality products. Subscribe to stay updated on our latest deals!
            </p>
            <div class="cta-button" style="margin-top: 20px;">
              <a href="shop.html" style="padding: 10px 25px; background-color: #3daeff; color: #fff; text-decoration: none; font-size: 16px; border-radius: 5px;">
                Shop Now
              </a>
            </div>
          </div>
        </div>
  
        <!-- Ad Image and Subscription -->
        <div class="col-lg-6">
          <div class="ad-image" style="margin-bottom: 20px;">
            <img src="homes/assets/images/trending-04.jpg" alt="Ad Product" style="max-width: 100%; border-radius: 10px;">
          </div>
          <div class="ad-subscription" style="margin-top: 20px;">
            <h6 style="color: #3daeff; font-size: 16px; font-weight: bold; text-transform: uppercase;">Subscribe Now</h6>
            <p style="font-size: 14px; color: #777; margin-bottom: 10px;">Sign up for our newsletter and enjoy up to $100 off on your first purchase!</p>
            <form id="subscribe" action="#" method="POST" style="display: flex; gap: 10px; justify-content: center;">
              <input type="email" class="form-control" placeholder="Your email..." 
                     style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px; max-width: 300px;">
              <button type="submit" 
                      style="padding: 10px 20px; background-color: #3daeff; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                Subscribe
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
  



  <div class="container my-4">
    <!-- Welcome Section -->
    <div class="text-center mb-5">
        <h1>Welcome to Our Platform</h1>
        <p>Discover the best deals and offers curated just for you!</p>
    </div>

    <!-- Ads Section -->
    <div class="ads-section">
        <h2 class="mb-4">Featured Ads</h2>
        <div class="row">
            @forelse($ads as $ad)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <!-- Ad Image -->
                        <img src="{{ asset('ads/' . $ad->image) }}" class="card-img-top" alt="Ad Image" style="height: 200px; object-fit: cover;">

                        <!-- Ad Content -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $ad->title }}</h5>
                            <p class="card-text">{{ Str::limit($ad->description, 100) }}</p>
                            <a href="{{ $ad->cta_url }}" target="_blank" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No ads available at the moment. Check back later!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
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


  </body>
</html>