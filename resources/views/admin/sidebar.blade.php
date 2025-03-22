<aside>
    <div class="toggle">
        <div class="logo">
            <img src="{{ asset('pic/vireakroth.png') }}">
            <h2><span class="danger">PhoneShop</span></h2>
        </div>
        <div class="close" id="close-btn">
            <span class="material-icons-sharp">close</span>
        </div>
    </div>

    <div class="sidebar">
        <a href="{{ url('/user') }}" class="{{ Request::is('user') ? 'active' : '' }}">
            <span class="material-icons-sharp">person_outline</span>
            <h3>Users</h3>
        </a>
        <a href="{{ url('/category') }}" class="{{ Request::is('category') ? 'active' : '' }}">
            <span class="material-icons-sharp">receipt_long</span>
            <h3>Category</h3>
        </a>
        <a href="{{ url('/home') }}" class="{{ Request::is('home') ? 'active' : '' }}">
            <span class="material-icons-sharp">insights</span>
            <h3>Dashboard</h3>
        </a>
        @php
        $newOrdersCount = \App\Models\Order::where('viewed', false)->count();
    @endphp
    
    <a href="{{ url('/orderadmin') }}" class="{{ Request::is('orderadmin') ? 'active' : '' }}">
        <span class="material-icons-sharp">mail_outline</span>
        <h3>Order</h3>
        @if($newOrdersCount > 0)
            <span class="message-count" style="color: white">{{ $newOrdersCount }}</span>
        @endif
    </a>
    
        <a href="{{ url('/product') }}" class="{{ Request::is('product') ? 'active' : '' }}">
            <span class="material-icons-sharp">inventory</span>
            <h3>Product</h3>
        </a>
        <a href="{{url('/report')}}" class="{{ Request::is('report') ? 'active' : '' }}">
            <span class="material-icons-sharp">report_gmailerrorred</span>
            <h3>Reports</h3>
        </a>
        <a href="#" class="{{ Request::is('new-login') ? 'active' : '' }}">
            <span class="material-icons-sharp">add</span>
            <h3>New Login</h3>
        </a>


        <a href="/adsy" class="{{ Request::is('adsy') ? 'active' : '' }}">
            <span class="material-icons-sharp">add</span>
            <h3>Ads</h3>
        </a>
        
        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="material-icons-sharp">logout</span>
            <h3>Logout</h3>
        </a>


        
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        
    </div>
</aside>


