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
    @include('action.csscategory')
</head>
<body>

<div class="container">
    <!-- Sidebar Section -->
    @include('admin.sidebar')
    <!-- End of Sidebar Section -->

    <!-- Main Content -->
    <main>
        <h1>Category</h1>
        <div class="analyse">
            <div class="sales">
                <div class="status">
                    <div class="info">
                        @php
                        $groupedOrders = $orders->groupBy('order_number'); 
                    @endphp  
                        <h3>Order Number</h3>
                        @foreach ($groupedOrders as $orderNumber => $group)
                        <h1 align="center">{{ $orderNumber }}</h1>
                    @endforeach
                    </div>
                    <div class="progresss">
                        <img src="{{ asset('pic/category.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="sales" onclick="showPopup('{{ $group->first()->status }}')">
                <div class="status">
                    <div class="info">
                        <h3>Order Status</h3>
                        <h1 align="center">{{ $group->first()->status }}</h1>
                        <p>{{ $group->first()->created_at->format('Y-m-d H:i:s') }}</p>

                    </div>
                    <div class="progresss">
                        @if($group->first()->status == 'pending')
                        <img src="{{ asset('pic/pending.png') }}" alt="">
                        @elseif($group->first()->status == 'canceled')
                        <img src="{{ asset('pic/canncel.png') }}" alt="">
                        @elseif($group->first()->status == 'success')
                        <img src="{{ asset('pic/ok.png') }}" alt="">
                        @endif
                    </div>
                </div>
            </div>

            <div class="sales">
                <div class="status">
                    <div class="info">
                        <h3>Customer</h3>
                        <h1 align="center">{{ $group->first()->name }}</h1>
                        <p align="center">{{ $group->first()->payment_method }}</p>
                    </div>
                    <div class="progresss">
                        <img src="{{ asset('pic/default.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="success-message show">
            <p style="color: white;">{{ session('success') }}</p>
            <button class="close-btn" onclick="document.querySelector('.success-message').classList.remove('show')">×</button>
        </div>
        @endif

        <!-- Error Message --->
        @if(session('error'))
        <div class="error-message show">
            <p style="color: white;">{{ session('error') }}</p>
            <button class="close-btn" onclick="document.querySelector('.error-message').classList.remove('show')">×</button>
        </div>
    @endif
    


        <!-- Recent Categories Table -->
        <div class="recent-orders">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total Price</th>
                        <th>Images</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->product->category->name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->product->description }}</td>
                        <td>${{ number_format($order->product->price, 2) }}</td>
                        <td>%{{ number_format($order->product->discount, 2) }}</td>
                        <td>${{ number_format($order->total_price, 2) }}</td>
                        <td>
                            <div class="image-wrapper">
                                <img  src="{{ asset('products/'.$order->product->image) }}" alt="" style="width: 100px; height: 100px;">
                            </div>
                        </td>
                        {{-- Cancel Success --}}
                        <td>
                            <form action="{{ url('/update_order_status', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control" style="font-weight: bold;">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }} style="color: orange;">🕒 Pending</option>
                                    <option value="success" {{ $order->status == 'success' ? 'selected' : '' }} style="color: green;">✅ Success</option>
                                    <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }} style="color: red;">❌ Canceled</option>
                                </select>
                                <button type="submit" style="border-radius: 10%; background-color: green; color: white; padding: 5px; cursor: pointer;" class="btn btn-primary btn-sm">
                                    Update
                                </button>
                            </form>
                            
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

                @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                    <button class="pagination-btn {{ $page == $orders->currentPage() ? 'active' : '' }}"
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

  <!-- Modal Structure -->
<!-- Modal Structure -->
<div id="statusPopup" class="modal">
    <div class="modal-content">
        <span class="close-btn" style="color: white; cursor: pointer;" onclick="closePopup()">&times;</span>
        <h2>Order Status Details</h2>
        <p id="popupText"></p>
        <form action="{{ route('update-statusadmin', $order_number) }}" method="POST">
            @csrf  <!-- CSRF protection -->
            <div class="button-container">
                <button type="submit" name="status" value="success" 
                    style="background-color: green; color: white; margin-right: 10px; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">
                    ✅ Success
                </button>
                <button type="submit" name="status" value="pending" 
                    style="background-color: orange; color: white; margin-right: 10px; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">
                    🕒 Pending
                </button>
                <button type="submit" name="status" value="canceled" 
                    style="background-color: red; color: white; margin-right: 10px; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">
                    ❌ Canceled
                </button>
            </div>
        </form>
    </div>
</div>





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

<script>
 // Function to open the popup with the status message
 function showPopup(orderNumber, currentStatus) {
    document.getElementById("popupText").textContent = `The order status is: ${currentStatus}`;
    document.getElementById("statusPopup").style.display = "block";

    // Store the order number in the form action
    const form = document.querySelector('form');
    form.action = `/update-status/${orderNumber}`;
}

// Function to close the popup
function closePopup() {
    document.getElementById("statusPopup").style.display = "none";
}

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('admin/orders.js') }}"></script>
<script src="{{ asset('admin/index.js') }}"></script>

</body>
</html>
