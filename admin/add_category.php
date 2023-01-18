<?php
include "includes/nav.php";
include "includes/message.php";
include "includes/admin_auth.php";

?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Stock Category</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Stock Category</h6>
    </div>
    <div class="card-body">

        <form action="code.php" method="POST" enctype="multipart/form-data">
            <div class="col-md-6 mb-3">
                <label for="">Name</label>
                <input type="text" name="name" required class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">URL</label>
                <input type="text" name="url" required class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Description</label>
                <textarea name="description" class="form-control" id="summernote" rows="4"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Status</label><br>
                <input type="checkbox" name="status" width="70px" height="70px" />
            </div>
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary" name="add_category">Save category</button>
            </div>
        </form>
    </div>

</div>
<?php
include "includes/footer.php";
?>