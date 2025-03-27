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
                    <lord-icon
                    src="https://cdn.lordicon.com/ljgptdru.json"
                    trigger="in"
                    delay="400"
                    state="in-reveal"
                    style="width:80px;height:80px">
                </lord-icon>
                </div>
            </div>
            <div class="sales">
                <div class="status">
                    <div class="info">
                        <a id="createCategoryBtn" class="btn btn-primary" style="text-decoration: none;background-color: #007bff;padding: 10px 20px;border-radius: 5px;color: #fff;">Add Product</a>
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


            <div class="search-box mt-4">
                <form action="{{ route('products.search') }}" method="GET">
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
                        <th align="left">Name</th>
                        <th align="left">Description</th>
                        <th align="left">Category</th>
                        <th>Stock</th>
                        <th>Discount</th>
                        <th style="padding-left: 10px;">Status</th>
                        <th style="padding-right: 10px;padding-left:10px;">Sold</th>
                        <th align="right" style="padding-left: 10px;padding-right:10px;">Price</th>
                        <th>Images</th>
                        <th>Action</th>
                        <th style="padding-left: 10px;">Edit</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td align="left">{{ Str::limit($product->name, 10) }}</td>
                        <td align="left">{{ Str::limit($product->description, 20) }}</td>
                        <td align="left">{{ $product->category->name }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ number_format($product->discount,0) }}%</td>
                        <td style="padding-left: 10px;">{{ $product->status }}</td>
                        <td>{{ $product->quantity_sold }}</td>
                        <td align="right" style="padding-left: 10px;padding-right:10px;">
                            @if ($product->discount > 0)
        <strong>{{ number_format($product->getDiscountedPrice(), 2) }}$</strong>
    @else
        {{ number_format($product->price, 2) }}$
    @endif
                        </td>
                        

                        <td>
                            <div class="image-wrapper">
                                <img src="{{ asset('products/'.$product->image) }}" alt="" style="width: 100px; height: 100px;">
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-danger" onClick="confirmation(event)" href="{{ url('/product_delete', $product->id) }}">Delete</a>
                        </td>
                        <td style="padding-left: 10px;">
                            <a class="btn btn-primary" href="{{ url('/product_edit', $product->id) }}">Edit</a>
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
