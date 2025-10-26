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
                                <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">
                                    Sign In
                                </a>
                            </li>
                        @endauth
                    </ul>


                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
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
