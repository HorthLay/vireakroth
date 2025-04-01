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
    @include('action.cssads')
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        @include('admin.sidebar')
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <h1>Ads</h1>
            <div class="analyse">

                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <a id="createCategoryBtn" class="btn btn-primary"
                                style="text-decoration: none;background-color: #007bff;padding: 10px 20px;border-radius: 5px;color: #fff;">Add
                                Ads</a>
                        </div>
                        <div class="progresss">
                            <img src="{{ asset('pic/add.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="success-message show">
                    <p>{{ session('success') }}</p>
                    <button class="close-btn"
                        onclick="document.querySelector('.success-message').classList.remove('show')">×</button>
                </div>
            @endif

            <!-- Recent Categories Table -->
            <div class="recent-orders">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Cta Url</th>
                            <th>Images</th>
                            <th>Action</th>
                            <th>Edit</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ads as $ad)
                            <tr>
                                <td>{{ $ad->title }}</td>
                                <td>{{ $ad->description }}</td>
                                <td>{{ $ad->cta_url }}</td>
                                <td>
                                    <div class="image-wrapper">
                                        <img src="{{ asset('ads/' . $ad->image) }}" alt=""
                                            style="width: 200px; height: 100px;">
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-danger" onClick="confirmation(event)"
                                        href="{{ url('/category_delete', $ad->id) }}">Delete</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ url('/ads_edit', $ad->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    @if ($ads->onFirstPage())
                        <button class="pagination-btn disabled">Previous</button>
                    @else
                        <button class="pagination-btn"
                            onclick="window.location='{{ $ads->previousPageUrl() }}'">Previous</button>
                    @endif

                    @php
                        $totalPages = $ads->lastPage();
                        $currentPage = $ads->currentPage();

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

                    @foreach ($ads->getUrlRange($startPage, $endPage) as $page => $url)
                        <button class="pagination-btn {{ $page == $currentPage ? 'active' : '' }}"
                            onclick="window.location='{{ $url }}'">
                            {{ $page }}
                        </button>
                    @endforeach

                    @if ($ads->hasMorePages())
                        <button class="pagination-btn"
                            onclick="window.location='{{ $ads->nextPageUrl() }}'">Next</button>
                    @else
                        <button class="pagination-btn disabled">Next</button>
                    @endif
                </div>
            </div>

            <!-- Add Product Modal -->
            <div id="addProductModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeAddProductModal()">&times;</span>
                    <h2>Add Ads</h2>
                    <form id="addProductForm" action="{{ url('/addads') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="name">Tittle:</label>
                            <input type="text" id="name" name="title" required>
                        </div>
                        <div>
                            <label for="description">Description:</label>
                            <textarea style="resize: none; height: 100px; width: 100%;outline: 1px solid;border-radius: 5px;" id="description"
                                name="description" rows="4" required></textarea>
                        </div>

                        <div>
                            <label for="cta_url">Url:</label>
                            <input type="text" id="name" name="cta_url" required>
                        </div>

                        <!-- Status Field (Pre-filled with current value) -->



                        <div>
                            <label for="image">Ads Image:</label>
                            <input type="file" id="image" name="image" accept="image/*" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">Create Ads</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- <!-- Edit Category Modal -->
        @include('action.editCategoryModal') --}}

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
    <script type="text/javascript">
        // Open the Add Product Modal
        document.getElementById("createCategoryBtn").onclick = function() {
            document.getElementById("addProductModal").style.display = "block";
        };

        // Close the Add Product Modal
        function closeAddProductModal() {
            document.getElementById("addProductModal").style.display = "none";
        }


        // Close modals if clicked outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('addProductModal')) {
                closeAddProductModal();
            }
            if (event.target == document.getElementById('editProductModal')) {
                closeEditProductModal();
            }
        };

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('admin/orders.js') }}"></script>
    <script src="{{ asset('admin/index.js') }}"></script>

</body>

</html>
