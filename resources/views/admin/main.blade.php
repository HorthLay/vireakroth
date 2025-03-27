<main>
    <h1>Analytics</h1>
    <!-- Analyses -->
    <div class="analyse">
        <div class="sales">
            <div class="status">
                <div class="info">
                    <h3>Total OrderSale</h3>
                    <h1>${{$totalOrderSales}}</h1>
                </div>
                <div class="progresss">
                    
                    <lord-icon
                    src="https://cdn.lordicon.com/ljgptdru.json"
                    trigger="in"
                    delay="400"
                    state="in-reveal"
                    style="width:80px;height:80px">
                </lord-icon>
                </div>
            </div>
        </div>
        <div class="visits">
            <div class="status">
                <div class="info">
                    <h3>Site Visit</h3>
                    <h1>{{ number_format($currentVisits) }}</h1>
                </div>
                <div class="progresss">
                    
                    <lord-icon
                    src="https://cdn.lordicon.com/dznelzdk.json"
                    trigger="in"
                    delay="400"
                    state="in-reveal"
                    style="width:80px;height:80px">
                </lord-icon>
                    
                </div>
            </div>
        </div>
        <div class="searches">
            <div class="status">
                <div class="info">
                    <h3>Total Order</h3>
                    <h1>{{$totalOrders}}</h1>
                </div>
                <div class="progresss">
                    <lord-icon
                    src="https://cdn.lordicon.com/hnqamtrw.json"
                    trigger="in"
                    delay="400"
                    state="in-reveal"
                    style="width:80px;height:80px">
                </lord-icon>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Analyses -->

<!-- New Users Section -->
<div class="new-users">
    <h2>New Users</h2>
    <div class="user-list">
        @foreach ($users as $user)
            <div class="user">
                <img src="{{ $user->google_id ? $user->profile_photo : asset('pic/default.png') }}" 
                     alt="{{ $user->name }}">
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->created_at->diffForHumans() }}</p>
            </div>
        @endforeach
        <div class="user">
            <a href="{{url('/user')}}">
            <img src="{{ asset('admin/images/plus.png') }}" alt="More Users">
            </a>
            <h2>More</h2>
            <p>New User</p>
        </div>
    </div>
</div>
<!-- End of New Users Section -->


    <!-- Recent Orders Table -->
    <div class="recent-orders">
        <h2>Recent Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Name</th>
                    <th>Order Date</th>
                    <th>Delivery</th>
                    <th>Address</th>
                    <th>Telegram</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Group orders by order number and sort by creation date
                    $recentOrders = $orders->sortByDesc('created_at')->groupBy('order_number')->take(4);
                @endphp
    
                @foreach ($recentOrders as $order_number => $group)
                    <tr style="background-color: {{ $group->first()->viewed ? 'transparent' : '#ffeb3b' }};">
                        <td>{{ $order_number }}</td>
                        <td>{{ $group->first()->name }}</td>
                        <td>{{ $group->first()->created_at }}</td>
                        <td>{{ $group->first()->delivery }}</td>
                        <td>{{ $group->first()->address }}</td>
                        <td>{{ $group->first()->telegram_number }}</td>
                        <td>{{ $group->sum('quantity') }}</td>
                        <td>${{ number_format($group->sum('total_price'), 2) }}</td>
                        <td style="color:
                            {{ $group->first()->status == 'success' ? 'green' :
                               ($group->first()->status == 'pending' ? 'yellow' :
                               ($group->first()->status == 'canceled' ? 'red' : 'black')) }};">
                            {{ ucfirst($group->first()->status) }}
                        </td>
                        <td>
                            <a href="{{ url('/order_details', $order_number) }}">Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <!-- Pagination Links -->
        <a href="{{ url('/orderadmin') }}">Show All</a>
    </div>
    
    
    <!-- End of Recent Orders -->

</main>