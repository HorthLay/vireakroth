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

        <!-- Error Message -->
        @if(session('error'))
        <div class="error-message show">
            <p>{{ session('error') }}</p>
            <button class="close-btn" onclick="document.querySelector('.error-message').classList.remove('show')">×</button>
        </div>
        @endif

    
        <div class="recent-orders p-4" style="background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
            <h3 class="mb-3" style="font-size: 1.5rem; color: #333;">Update Category</h3>
        
            <form method="POST" action="{{ route('update.role',$user->id) }}" enctype="multipart/form-data" style="max-width: 600px; margin-top: 10px;">
                @csrf
        
                <!-- Product Name Input -->
                <div class="form-group mb-3">
                    <label for="categoryName" class="form-label" style="font-weight: 600;">Product Name</label>
                    <input type="text" id="productName" name="name" value="{{ $user->name }}" class="form-control" 
                           placeholder="Enter category name" required 
                           style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; margin-top: 5px;">
                </div>



                {{-- category --}}
                <div class="form-group mb-3">
                    <label for="category" class="form-label fw-semibold">Product Category</label>
                    <select id="category" name="user_type" class="form-control" required>
                        <option value="" disabled selected>{{ $user->user_type }}</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
        
        
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary" 
                        style="background: #007bff; color: #fff; padding: 10px 15px; border: none; border-radius: 8px; margin-top: 15px;">
                    Update Role
                </button>
            </form>
        </div>
        
        
        

        
    </main>

    <div class="right-section">
        @include('admin.nav')
        <!-- End of Nav -->

        <div class="user-profile">
            <div class="logo">
                <img style="margin-left:20%;" src="{{asset ('admin/images/logo.png')}}">
                <h2>VireakRoth <br> PhoneShop</h2>
                <p>address: Phum 2 Songkat 3 SihanoukVille Province</p>
            </div>
        </div>

       @include('admin.reminder')
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('admin/orders.js') }}"></script>
<script src="{{ asset('admin/index.js') }}"></script>

</body>
</html>
