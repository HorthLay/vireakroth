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
                        <h3>Total Category</h3>
                        <h1 align="center">{{ $categorycount->count() }}</h1>
                    </div>
                    <div class="progresss">
                        <img src="{{ asset('pic/category.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="sales">
                <div class="status">
                    <div class="info">
                        <a id="createCategoryBtn" class="btn btn-primary" style="text-decoration: none;background-color: #007bff;padding: 10px 20px;border-radius: 5px;color: #fff;">Add Category</a>
                    </div>
                    <lord-icon
                    src="https://cdn.lordicon.com/sbnjyzil.json"
                    trigger="in"
                    delay="100"
                    state="in-reveal"
                    stroke="bold"
                    colors="primary:#30c9e8,secondary:#242424"
                    style="width:80px;height:80px">
                </lord-icon>
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
                        <th>Name</th>
                        <th>Images</th>
                        <th>Action</th>
                        <th>Edit</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div class="image-wrapper">
                                <img src="{{ asset('categories/'.$category->image) }}" alt="" style="width: 200px; height: 100px;">
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-danger" onClick="confirmation(event)" href="{{ url('/category_delete', $category->id) }}">Delete</a>
                        </td>
                        <td>
                            <a class="btn btn-primary text-white" href="{{ route('categories.view', $category->id) }}" style="text-decoration: none;">
                              Edit
                            </a>
                          </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                @if ($categories->onFirstPage())
                    <button class="pagination-btn disabled">Previous</button>
                @else
                    <button class="pagination-btn" onclick="window.location='{{ $categories->previousPageUrl() }}'">Previous</button>
                @endif

                @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                    <button class="pagination-btn {{ $page == $categories->currentPage() ? 'active' : '' }}"
                            onclick="window.location='{{ $url }}'">
                        {{ $page }}
                    </button>
                @endforeach

                @if ($categories->hasMorePages())
                    <button class="pagination-btn" onclick="window.location='{{ $categories->nextPageUrl() }}'">Next</button>
                @else
                    <button class="pagination-btn disabled">Next</button>
                @endif
            </div>
        </div>

        <!-- Add Category Modal -->
      @include('action.categoryModal')
        <!-- Edit Category Modal -->
        
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
@include('action.javacategory')
<script src="https://cdn.lordicon.com/lordicon.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('admin/orders.js') }}"></script>
<script src="{{ asset('admin/index.js') }}"></script>

</body>
</html>
