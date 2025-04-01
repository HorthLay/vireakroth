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
    <title>Order Reports | Admin Panel</title>
    @include('action.cssproduct')
</head>

<body>

    <div class="container">
        @include('admin.sidebar')

        <main>
            <h1>Order Reports</h1>

            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <a id="openFilterBtn" class="btn btn-primary"
                                style="text-decoration: none; background-color: #007bff; padding: 10px 20px; border-radius: 5px; color: #fff; cursor: pointer;">
                                Filter
                            </a>
                        </div>
                        <lord-icon src="https://cdn.lordicon.com/sbnjyzil.json" trigger="in" delay="100"
                            state="in-reveal" stroke="bold" colors="primary:#30c9e8,secondary:#242424"
                            style="width:80px;height:80px">
                        </lord-icon>
                    </div>



                </div>
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <a href="{{ route('order.report.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                                target="_blank" class="btn btn-primary"
                                style="text-decoration: none;background-color: #007bff;padding: 10px 20px;border-radius: 5px;color: #fff;">View
                                Report</a>
                        </div>
                        <lord-icon src="https://cdn.lordicon.com/bdnahcds.json" trigger="in" delay="100"
                            state="in-reveal" stroke="bold" style="width:80px;height:80px">
                        </lord-icon>
                        </lord-icon>
                    </div>



                </div>
            </div>

            <!-- Filter Modal -->
            <div id="filterModal" class="modal"
                style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);">
                <div class="modal-content"
                    style="background: #fff; padding: 20px; width: 50%; margin: 10% auto; border-radius: 10px; text-align: center;">
                    <span class="close-btn" style="float: right; font-size: 25px; cursor: pointer;">&times;</span>
                    <h3>Filter Orders</h3>
                    <form method="GET" action="">
                        <label>Start Date:</label>
                        <input type="date" name="start_date" value="2025-03-01" required>
                        <label>End Date:</label>
                        <input type="date" name="end_date" value="2025-03-15" required>
                        <button type="submit" class="btn btn-success"
                            style="margin-top: 10px; padding: 8px 15px;">Apply Filter</button>
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div class="success-message show">
                    <p style="color: white;">{{ session('success') }}</p>
                    <button class="close-btn"
                        onclick="document.querySelector('.success-message').classList.remove('show')">×</button>
                </div>
            @endif

            <div class="recent-orders">
                <table>
                    <thead>
                        <tr>
                            <th>Order Date</th>
                            <th>Total Orders</th>
                            <th>Total Items</th>
                            <th>Total Sales</th>
                            <th>View</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>

                                <td>{{ $order->total_orders }}</td>
                                <td>{{ $order->total_items }}</td>
                                <td>${{ number_format($order->total_sales, 2) }}</td> <!-- Format total sales -->
                                <td>
                                    <a href="{{ route('order.view.report', ['order_date' => $order->order_date]) }}"
                                        class="btn btn-info">View</a>
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
                        <button class="pagination-btn"
                            onclick="window.location='{{ $orders->previousPageUrl() }}'">Previous</button>
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
                        <button class="pagination-btn"
                            onclick="window.location='{{ $orders->nextPageUrl() }}'">Next</button>
                    @else
                        <button class="pagination-btn disabled">Next</button>
                    @endif
                </div>
            </div>

        </main>

        <div class="right-section">
            @include('admin.nav')
            <div class="user-profile">
                <div class="logo">
                    <img style="margin-left:20%;" src="{{ asset('pic/vireakroth.png') }}">
                    <h2>VireakRoth <br> PhoneShop</h2>
                    <p>Address: Phum 2 Songkat 3 SihanoukVille Province</p>
                </div>
            </div>
            @include('admin.reminder')
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            let modal = document.getElementById("filterModal");
            let openBtn = document.getElementById("openFilterBtn");
            let closeBtn = document.querySelector(".close-btn");

            // Open modal
            openBtn.addEventListener("click", function() {
                modal.style.display = "block";
            });

            // Close modal when clicking the close button
            closeBtn.addEventListener("click", function() {
                modal.style.display = "none";
            });

            // Close modal when clicking outside
            window.addEventListener("click", function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
        });

        // Confirmation for Deleting Product
        function confirmation(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = event.target.href;
                }
            });
        }
    </script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>

</body>

</html>
