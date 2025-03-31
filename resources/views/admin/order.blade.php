<!DOCTYPE html>
<html lang="en">
<head>
    <base href="public">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('admin/style.css') }}">
    <title>Responsive Dashboard Design #1 | AsmrProg</title>

    @include('action.cssproduct')
</head>
<body>

<div class="container">
    <!-- Sidebar Section -->
    @include('admin.sidebar')
    <!-- End of Sidebar Section -->

    <!-- Main Content -->
    <main>
        <h1>Product</h1>
        <div class="analyse">
            <div class="sales">
                <div class="status">
                    <div class="info">
                        <h3>Total Order</h3>
                        <h1 align="center">{{$uniqueOrderCount}}</h1>

                    </div>
                    <lord-icon
                    src="https://cdn.lordicon.com/pmawqxvu.json"
                    trigger="in"
                    delay="400"
                    state="in-reveal"
                    colors="primary:#1663c7,secondary:#646e78,tertiary:#3a3347"
                    style="width:80px;height:80px">
                </lord-icon>
                </div>
            </div>


            <div class="search-box mt-4">
                <form action="{{ route('orders.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="searchKeyword" class="form-control" placeholder="Search Orders..." required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">🔍 Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="success-message show">
            <p style="color: white;">{{ session('success') }}</p>
            <button class="close-btn" onclick="document.querySelector('.success-message').classList.remove('show')">×</button>
        </div>
        @endif

        <!-- Recent Products Table -->
        <div class="recent-orders">
            <table>
                <thead>
                    <tr>
                        <th align="left">Order Number</th>
                        <th align="left">Name</th>
                        <th>Order Date</th>
                        <th>Delivery</th>
                        <th>Address</th>
                        <th>Sale Type</th>
                        <th>Telegram</th>
                        <th>Quantity</th>
                        <th align="right" style="padding-right: 10px;">Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $groupedOrders = $orders->groupBy('order_number'); 
                    @endphp
                
                @foreach ($groupedOrders as $order_number => $group)
                <tr style="background-color: {{ $group->first()->viewed ? 'transparent' : '#ffeb3b' }};"> 
                    <td align="left">{{ $order_number }}</td>
                    <td align="left">{{ $group->first()->name }}</td>
                    <td>{{  \Carbon\Carbon::parse($group->first()->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $group->first()->delivery }}</td>
                    
                    <td>{{ $group->first()->address }}</td>
                    <td style="color: {{ $group->first()->sale_type == 'online' ? 'green' : 'orange' }};">
                        {{ ucfirst($group->first()->sale_type) }}
                    </td>
                    <td>{{ $group->first()->telegram_number }}</td>
                    <td>{{ $group->sum('quantity') }}</td>
                    
                    <td align="right" style="padding-right: 10px;">${{ number_format($group->sum('total_price'), 2) }}</td> 
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

            <!-- Pagination Section -->
<div class="pagination">
    @if ($orders->onFirstPage())
        <button class="pagination-btn disabled">Previous</button>
    @else
        <button class="pagination-btn" onclick="window.location='{{ $orders->previousPageUrl() }}'">Previous</button>
    @endif

    @php
        $totalPages = $orders->lastPage();
        $currentPage = $orders->currentPage();

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

    @foreach ($orders->getUrlRange($startPage, $endPage) as $page => $url)
        <button class="pagination-btn {{ $page == $currentPage ? 'active' : '' }}"
                onclick="window.location='{{ $url }}'">
            {{ $page }}
        </button>
    @endforeach

    @if ($orders->hasMorePages())
        <button class="pagination-btn" onclick="window.location='{{ $orders->nextPageUrl() }}'">Next</button>
    @else
        <button class="pagination-btn disabled">Next</button>
    @endif
</div>

        </div>

        
    </main>

    <div class="right-section">
        @include('admin.nav')
        <!-- End of Nav -->

        <div class="user-profile">
            <div class="logo">
                <img style="margin-left:20%;" src="{{ asset('pic/vireakroth.png') }}">
                <h2>VireakRoth <br> PhoneShop</h2>
                <p>address: Phum 2 Songkat 3 SihanoukVille Province</p>
            </div>
        </div>

       @include('admin.reminder')
    </div>
</div>

@include('action.javaproduct')
<script src="https://cdn.lordicon.com/lordicon.js"></script>
</body>
</html>
