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
    <style>
        /* Success Message Styling */
        .success-message {
            background-color: #4CAF50;  /* Green background for success */
            color: white;               /* White text color */
            padding: 15px;              /* Some padding */
            border-radius: 5px;         /* Rounded corners */
            position: fixed;            /* Fixed position */
            top: 20px;                  /* Distance from top */
            right: 20px;                /* Distance from right */
            width: 300px;               /* Fixed width */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Subtle shadow */
            font-size: 16px;            /* Font size */
            z-index: 1000;              /* Ensure it’s above other content */
            opacity: 0;                 /* Initially hidden */
            transform: translateX(100%); /* Initially off-screen to the right */
            transition: all 0.3s ease-in-out; /* Smooth transition for showing and hiding */
        }

        /* Show the success message */
        .success-message.show {
            opacity: 1;                /* Show the message */
            transform: translateX(0);  /* Move the message into view */
        }

        /* Optional: Close button styling */
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
        .search-box {
        max-width: 400px;
        margin: 20px auto;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .search-box .input-group {
        display: flex;
        align-items: center;
    }

    .search-box .form-control {
        border-radius: 20px 0 0 20px;
        border: 1px solid #ced4da;
        padding: 17px 15px;
        font-size: 16px;
    }

    .search-box .btn {
        border-radius: 0 20px 20px 0;
        background: #007bff;
        color: white;
        padding: 10px 20px 10px 15px;
        border: none;
        transition: background 0.3s ease-in-out;
    }

    .search-box .btn:hover {
        background: #0056b3;
    }

        /* Pagination Styling */
        .pagination {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .pagination-btn:hover {
            background-color: #0056b3;
        }

        .pagination-btn.active {
            background-color: #0056b3;
        }

        .pagination-btn.disabled {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
        }

    </style>
</head>
<body>

<div class="container">
    <!-- Sidebar Section -->
    @include('admin.sidebar')
    <!-- End of Sidebar Section -->

    <!-- Main Content -->
    <main>
        <h1>Users</h1>
        <div class="analyse">
            <div class="sales">
                <div class="status">
                    <div class="info">
                        <h3>Total User</h3>
                        <h1 align="center">{{ $users->count() }}</h1>
                    </div>
                    <lord-icon
    src="https://cdn.lordicon.com/hroklero.json"
    trigger="in"
    delay="100"
    colors="primary:#30c9e8,secondary:#ffc738"
    style="width:80px;height:80px">
</lord-icon>
                </div>
            </div>
            <div class="search-box mt-4">
                <form action="{{ route('user.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="searchKeyword" class="form-control" placeholder="Search Users..." required>
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
            <p>{{ session('success') }}</p>
            <button class="close-btn" onclick="document.querySelector('.success-message').classList.remove('show')">×</button>
        </div>
        @endif

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <table>
                <thead>
                    <tr>
                        <th style="text-align: left; padding: 10px 20px;">Name</th>
                        <th style="text-align: left; padding: 10px 20px;">Email</th>
                        <th style="padding: 10px 20px;">Phone</th>
                        <th style="padding: 10px 20px;">User Type</th>
                        <th style="padding: 10px 20px;">Action</th>
                        <th style="padding: 10px 20px;">Role</th>
                    </tr>
                </thead>
        
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td style="text-align: left; padding: 10px 20px;">{{ $user->name }}</td>
                        <td style="text-align: left; padding: 10px 20px;">{{ $user->email }}</td>
                        <td style="padding: 10px 20px;">{{ $user->phone }}</td>
                        <td style="padding: 10px 20px;">{{ $user->user_type }}</td>
                        <td style="padding: 10px 20px;">
                            <a class="btn btn-danger" onClick="confirmation(event)" href="{{ url('/user_delete', $user->id) }}">Delete</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="{{ url('/edit-role', $user->id) }}">Edit</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
            <!-- Pagination Section -->
            <div class="pagination">
                @if ($users->onFirstPage())
                    <button class="pagination-btn disabled">Previous</button>
                @else
                    <button class="pagination-btn" onclick="window.location='{{ $users->previousPageUrl() }}'">Previous</button>
                @endif
            
                @php
                    $totalPages = $users->lastPage();
                    $currentPage = $users->currentPage();
            
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
            
                @foreach ($users->getUrlRange($startPage, $endPage) as $page => $url)
                    <button class="pagination-btn {{ $page == $currentPage ? 'active' : '' }}"
                            onclick="window.location='{{ $url }}'">
                        {{ $page }}
                    </button>
                @endforeach
            
                @if ($users->hasMorePages())
                    <button class="pagination-btn" onclick="window.location='{{ $users->nextPageUrl() }}'">Next</button>
                @else
                    <button class="pagination-btn disabled">Next</button>
                @endif
            </div>
        </div>
        
        <!-- End of Recent Orders -->
    </main>
    <!-- End of Main Content -->

    <!-- Right Section -->
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

<!-- SweetAlert and Toastr Script -->
<script type="text/javascript">
    function confirmation(ev) {
        ev.preventDefault();  // Prevent the default behavior (following the link)

        var urlToRedirect = ev.currentTarget.getAttribute('href'); // Get the href URL

        // Show SweetAlert2 confirmation dialog
        Swal.fire({
            title: "Are you sure?",
            text: "This delete will be permanent!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            dangerMode: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // Show a loading state (optional)
                Swal.fire({
                    title: 'Deleting...',
                    text: 'Please wait while we delete this user.',
                    icon: 'info',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Perform the actual redirect after a delay
                setTimeout(() => {
                    window.location.href = urlToRedirect; // Redirect to the delete URL
                }, 1000); // Wait 1 second before redirecting (optional)
            }
        });
    }

    window.onload = function() {
        // Check if there is a success message in the session
        if (document.querySelector('.success-message')) {
            // Add the class to show the success message
            document.querySelector('.success-message').classList.add('show');
            
            // Auto hide the message after 3 seconds
            setTimeout(function() {
                document.querySelector('.success-message').classList.remove('show');
            }, 3000); // Hide after 3 seconds
        }
    };
</script>
<script src="https://cdn.lordicon.com/lordicon.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('admin/orders.js') }}"></script>
<script src="{{ asset('admin/index.js') }}"></script>

</body>
</html>
