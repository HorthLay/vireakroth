<div id="addCategoryModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeAddCategoryModal()">&times;</span>
        <h2>Add Category</h2>

        <!-- Category Add Form -->
        <form id="addCategoryForm" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">Category Name:</label>
                <input type="text" id="add_name" name="name" required>
            </div>

            <div>
                <label for="image">Category Image:</label>
                <input type="file" id="add_image" name="image" accept="image/*" required>
            </div>

            <div>
                <button type="submit" class="btn btn-success">Save Category</button>
            </div>
        </form>
    </div>
</div>
