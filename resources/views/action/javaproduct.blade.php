<script type="text/javascript">
    // Open the Add Product Modal
    document.getElementById("createCategoryBtn").onclick = function () {
        document.getElementById("addProductModal").style.display = "block";
    };

    // Close the Add Product Modal
    function closeAddProductModal() {
        document.getElementById("addProductModal").style.display = "none";
    }

   // Open the Edit Product Modal and set the values dynamically
function openEditProductModal(id, name, description, stock, price, categoryId, status, discount) {
    document.getElementById('editProductId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editDescription').value = description;
    document.getElementById('editStock').value = stock;
    document.getElementById('editPrice').value = price;
    document.getElementById('editCategory').value = categoryId;
    document.getElementById('editStatus').value = status; // Set the status value
    document.getElementById('editDiscount').value = discount; // Set the discount value

    // Correctly replace the placeholder ':id' in the action URL
    document.getElementById('editProductForm').action = "{{ route('products.update', ':id') }}".replace(':id', id);

    document.getElementById("editProductModal").style.display = "block";
}


    // Close the Edit Product Modal
    function closeEditProductModal() {
        document.getElementById("editProductModal").style.display = "none";
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