<script type="text/javascript">
    // Open the Add Category Modal
    document.getElementById("createCategoryBtn").onclick = function() {
        document.getElementById("addCategoryModal").style.display = "block";
    };

    // Close the Add Category Modal
    function closeAddCategoryModal() {
        document.getElementById("addCategoryModal").style.display = "none";
    }

    // Open the Edit Category Modal
    function openEditModal(id, name, image) {
        // Set the ID in the hidden input field
        document.getElementById('category_id').value = id;

        // Set the name field with the category name
        document.getElementById('edit_name').value = name;

        // Set the action URL dynamically to include the category ID
        document.getElementById('editCategoryForm').action = "{{ route('categories.update', ':id') }}".replace(':id', id);

        // Open the modal
        document.getElementById('editCategoryModal').style.display = "block";
    }

    // Close the Edit Category Modal
    function closeEditCategoryModal() {
        document.getElementById("editCategoryModal").style.display = "none";
    }

    // Close the modal if clicked outside of it
    window.onclick = function(event) {
        if (event.target == document.getElementById("addCategoryModal")) {
            document.getElementById("addCategoryModal").style.display = "none";
        } else if (event.target == document.getElementById("editCategoryModal")) {
            document.getElementById("editCategoryModal").style.display = "none";
        }
    };

    // Confirmation before deletion
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');

        Swal.fire({
            title: "Are you sure?",
            text: "This delete will be permanent!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            dangerMode: true,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleting...',
                    text: 'Please wait while we delete this category.',
                    icon: 'info',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                setTimeout(() => {
                    window.location.href = urlToRedirect;
                }, 1000);
            }
        });
    }
</script>