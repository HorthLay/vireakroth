<script type="text/javascript">
    // Open the Add Category Modal
    document.getElementById("createCategoryBtn").onclick = function() {
        document.getElementById("addCategoryModal").style.display = "block";
    };

    // Close the Add Category Modal
    function closeAddCategoryModal() {
        document.getElementById("addCategoryModal").style.display = "none";
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