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
                        <h3>Total Product</h3>
                        <h1 align="center">{{ $products->count() }}</h1>
                    </div>
                    <div class="progresss">
                        <img src="{{ asset('pic/product.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="sales">
                <div class="status">
                    <div class="info">
                        <a id="createCategoryBtn" class="btn btn-primary" style="text-decoration: none;background-color: #007bff;padding: 10px 20px;border-radius: 5px;color: #fff;">Add Product</a>
                    </div>
                    <div class="progresss">
                        <img src="{{ asset('pic/add.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="success-message show">
            <p>{{ session('success') }}</p>
            <button class="close-btn" onclick="document.querySelector('.success-message').classList.remove('show')">×</button>
        </div>
        @endif

        <!-- Recent Products Table -->
        <div class="recent-orders">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Quantity Sold</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Images</th>
                        <th>Action</th>
                        <th>Edit</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ Str::limit($product->description, 20) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            @if ($product->discount > 0)
        <strong>{{ number_format($product->getDiscountedPrice(), 2) }}$</strong>
    @else
        {{ number_format($product->price, 2) }}$
    @endif
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->quantity_sold }}</td>
                        <td>{{ $product->discount }}%</td>
                        <td>{{ $product->status }}</td>

                        <td>
                            <div class="image-wrapper">
                                <img src="{{ asset('products/'.$product->image) }}" alt="" style="width: 100px; height: 100px;">
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-danger" onClick="confirmation(event)" href="{{ url('/product_delete', $product->id) }}">Delete</a>
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="openEditProductModal({{ $product->id }}, '{{ $product->name }}', '{{ $product->description }}', {{ $product->stock }}, {{ $product->price }}, {{ $product->category->id }})">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

             <!-- Pagination Section -->
             <div class="pagination">
                @if ($products->onFirstPage())
                    <button class="pagination-btn disabled">Previous</button>
                @else
                    <button class="pagination-btn" onclick="window.location='{{ $products->previousPageUrl() }}'">Previous</button>
                @endif

                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    <button class="pagination-btn {{ $page == $products->currentPage() ? 'active' : '' }}"
                            onclick="window.location='{{ $url }}'">
                        {{ $page }}
                    </button>
                @endforeach

                @if ($products->hasMorePages())
                    <button class="pagination-btn" onclick="window.location='{{ $products->nextPageUrl() }}'">Next</button>
                @else
                    <button class="pagination-btn disabled">Next</button>
                @endif
            </div>
        </div>

       @include('action.productmodal')

        <!-- Edit Product Modal -->
        @include('action.editproductmodal') 
        
    </main>

    <div class="right-section">
        @include('admin.nav')
        <!-- End of Nav -->

        <div class="user-profile">
            <div class="logo">
                <img style="margin-left:20%;" src="admin/images/logo.png">
                <h2>VireakRoth <br> PhoneShop</h2>
                <p>address: Phum 2 Songkat 3 SihanoukVille Province</p>
            </div>
        </div>

       @include('admin.reminder')
    </div>
</div>

@include('action.javaproduct')

</body>
</html>
