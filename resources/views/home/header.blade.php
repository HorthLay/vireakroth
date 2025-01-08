<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        <img src="homes/assets/images/logo.png" alt="" style="width: 158px;">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ url('/') }}" class="active">Home</a></li>
                        <li><a href="{{ route('products.index') }}">Our Shop</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                        <li>
                            <a href="{{ route('cart.view') }}" id="cart-icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span id="cart-count" class="cart-count" style="color: rgb(0, 255, 60); font-weight: 100%;">
                                    @if (Auth::check())
                                    {{ \App\Models\Cart::where('user_id', Auth::id())->count() }}
                                @else
                                    {{ count(session()->get('guest_cart', [])) }}
                                @endif
                                
                                </span>
                            </a>
                        </li>



                        


                      
                        
                        
                    
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
                    
                    
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
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