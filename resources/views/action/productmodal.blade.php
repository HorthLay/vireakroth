 <!-- Add Product Modal -->
 <div id="addProductModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeAddProductModal()">&times;</span>
        <h2>Add Product</h2>
        <form id="addProductForm" action="{{ url('/product_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea style="resize: none; height: 100px; width: 100%;outline: 1px solid;border-radius: 5px;" id="description" name="description" rows="4" required></textarea>
            </div>
            <div>
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" required>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <div>
                <label for="category">Category:</label>
                <select id="category" name="category_id" required>
                    <option value="" disabled selected>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>


            <!-- Status Field (Pre-filled with current value) -->
            <div>
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="new">New</option>
                    <option value="second_hand">Second Hand</option>
                </select>
            </div>


            <div class="form-group">
                <label for="discount">Discount (%)</label>
                <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount', $product->discount ?? 0) }}" min="0" max="100" step="0.01">
            </div>
            <div>
                <label for="image">Product Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <div>
                <button type="submit" class="btn btn-success">Create Product</button>
            </div>
        </form>
    </div>
</div>