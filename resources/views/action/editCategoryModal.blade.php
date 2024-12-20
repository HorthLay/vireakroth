<div id="editCategoryModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeEditCategoryModal()">&times;</span>
        <h2>Edit Category</h2>

        <!-- Category Edit Form -->
        <form id="editCategoryForm" action="{{ route('categories.update', ':id') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="category_id" name="id">
            <div>
                <label for="name">Category Name:</label>
                <input type="text" id="edit_name" name="name" required>
            </div>

            <div>
                <label for="image">Category Image:</label>
                <input type="file" id="edit_image" name="image" accept="image/*">
            </div>

            <div>
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
        </form>
    </div>
</div>