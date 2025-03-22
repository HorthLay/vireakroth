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

    <style>
        /* Success Message Styling */
    .success-message {
        background-color: #f73838;
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


    /* General styling for smaller screens */
@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }

    table.table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    table.table thead {
        display: none; /* Hide table header for mobile */
    }

    table.table tbody tr {
        display: block;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    table.table tbody td {
        display: block;
        text-align: left;
        font-size: 14px;
        padding: 5px 0;
    }

    table.table tbody td img {
        margin-bottom: 10px;
    }

    table.table tbody td:before {
        content: attr(data-label);
        font-weight: bold;
        color: #333;
        display: inline-block;
        margin-right: 10px;
    }

    table.table tfoot tr {
        display: block;
        text-align: center;
    }

    .text-end {
        text-align: center !important;
    }

    .btn-primary {
        width: 100%;
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
                        
                        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
      </header>
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

      <!-- Succuess Message -->
      @if(session('success'))
      <div class="success-message show">
          <p style="color: white;">{{ session('success') }}</p>
          <button class="close-btn" onclick="document.querySelector('.success-message').classList.remove('show')">×</button>
      </div>
      @endif

      <div class="container mt-5">
        @if($cartItems && count($cartItems) > 0)
        <div class="table-responsive">
            <table class="table table-borderless">
                <thead class="text-primary">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    <tr style="border-bottom: 2px solid blue;">
                        <!-- Product Column -->
                        <td data-label="Product" class="d-flex align-items-center">
                            <img src="{{ 'products/' . $item['product']->image }}" alt="{{ $item['product']->name }}" class="img-thumbnail me-3" style="width: 60px; height: 60px; border: 1px solid blue;">
                            <span>{{ $item['product']->name }}</span>
                        </td>
                        <td data-label="Price">${{ number_format($item['product']->price, 2) }}</td>
                        <td data-label="Quantity">
                            <form action="{{ route('cart.update', $item['product_id']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="input-group" style="width: 120px;">
                                    <button type="button" class="btn btn-outline-primary" onclick="changeQuantity(-1, this)">-</button>
                                    <input
                                        type="text"
                                        name="quantity"
                                        value="{{ $item['quantity'] }}"
                                        class="form-control text-center border border-primary"
                                        style="width: 40px; text-align: center;"
                                        readonly>
                                    <button type="button" class="btn btn-outline-primary" onclick="changeQuantity(1, this)">+</button>
                                </div>
                            </form>
                        </td>
                        <td data-label="Discount">{{ number_format($item['product']->discount, 2) }}</td>
                        <td data-label="Subtotal">
                            ${{ number_format($item['product']->price * $item['quantity'] * (1 - ($item['product']->discount / 100)), 2) }}
                        </td>
                        <td data-label="Action">
                            <form action="{{ route('cart.delete', $item['product_id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">×</button>
                            </form>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end">
                            <h5 class="text-primary">Grand Total:</h5>
                        </td>
                        <td colspan="2">
                            <h5 class="text-primary">${{ number_format($total, 2) }}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end">
                            <a href="{{ route('order.page') }}" class="btn btn-primary mt-3">Proceed to Order</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @else
        <div class="text-center">
            <h4>Your cart is empty.</h4>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Shop Now</a>
        </div>
        @endif
    </div>
    


    <!-- Footer -->
@include('home.footer')


    <!-- Scripts -->
    <script>
         function changeQuantity(change, button) {
        const input = button.closest('.input-group').querySelector('input[name="quantity"]');
        let currentValue = parseInt(input.value);
        const min = 1;
        const max = 10;

        currentValue += change;

        if (currentValue < min) {
            currentValue = min;
        } else if (currentValue > max) {
            currentValue = max;
        }

        input.value = currentValue;
        input.form.submit();
    }
    </script>
    <script src="{{ asset('homes/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('homes/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('homes/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('homes/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('homes/assets/js/counter.js') }}"></script>
    <script src="{{ asset('homes/assets/js/custom.js') }}"></script>

</body>
</html>
