<div id="editProductModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeEditProductModal()">&times;</span>
        <h2>Edit Product</h2>
        <form id="editProductForm" action="{{ route('products.update', ':id') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="editProductId" name="id">
            <div>
                <label for="editName">Product Name:</label>
                <input type="text" id="editName" name="name" required>
            </div>
            <div>
                <label for="editDescription">Description:</label>
                <textarea style="resize: none; height: 100px; width: 100%;outline: 1px solid;border-radius: 5px; padding: 5px;" id="editDescription" name="description" required></textarea>
            </div>
            <div>
                <label for="editStock">Stock:</label>
                <input type="number" id="editStock" name="stock" required>
            </div>
            <div>
                <label for="editPrice">Price:</label>
                <input type="number" id="editPrice" name="price" step="0.01" required>
            </div>
            <div>
                <label for="editCategory">Category:</label>
                <select id="editCategory" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status Field (Pre-filled with current value) -->
            <div>
                <label for="editStatus">Status:</label>
                <select id="editStatus" name="status" required>
                    <option value="new">New</option>
                    <option value="second_hand">Second Hand</option>
                </select>
            </div>

            <!-- Discount Field (Pre-filled with current value) -->
            <div>
                <label for="editDiscount">Discount (%):</label>
                <input type="number" id="editDiscount" name="discount" step="0.01" min="0" max="100" required>
            </div>

            <div>
                <label for="editImage">Product Image:</label>
                <input type="file" id="editImage" name="image" accept="image/*">
            </div>
            <div>
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
        </form>
    </div>
</div>