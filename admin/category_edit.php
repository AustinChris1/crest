<?php
include "includes/nav.php";
include "includes/message.php";
include "includes/admin_auth.php";

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $postquery = $db->query("SELECT * FROM category WHERE id= '$post_id' LIMIT 1");
    if ($postquery->num_rows > 0) {
        $postrow = $postquery->fetch_array();
?>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Category</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
            </div>
            <div class="card-body">

                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6 mb-3">
                        <input type="hidden" name="id" value="<?= $postrow['id'] ?>">
                        <label for="">Category name</label>
                        <input type="text" name="name" value="<?= $postrow['name'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">URL</label>
                        <input type="text" name="url" value="<?= $postrow['url'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Image</label>
                        <input type="hidden" name="old_image" value="<?= $postrow["image"] ?>" class="form-control"></textarea>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Description</label>
                        <input type="text" name="description" value="<?= $postrow['description'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label><br>
                        <input type="checkbox" name="status" <?= $postrow['status'] == '1' ? 'checked' : ''; ?> width="70px" height="70px" />
                        Checked = Active, UnChecked = Unactive
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary" name="category_update">Update Category</button>
                    </div>
                </form>

            <?php
        } else {
            ?>
                <h4>No Record Found</h4>

        <?php
        }
    }
    include "includes/footer.php";
        ?>