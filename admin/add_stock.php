<?php
include "includes/nav.php";
include "includes/message.php";
include "includes/admin_auth.php";

?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Stocks</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Stock</h6>
    </div>
    <div class="card-body">

        <form action="code.php" method="POST" enctype="multipart/form-data">
            <?php
            $category = $db->query(
                "SELECT * FROM category WHERE status ='0'"
            );
            if ($category->num_rows > 0) { ?>
                <label for="">Stock Category</label>
                <select name="category_id" required class="form-control">
                    <option value="">--Select Stock Category--</option>
                    <?php foreach ($category
                        as $category_item) { ?>
                        <option value="<?= $category_item["id"] ?>"><?= $category_item["name"] ?></option>
                    <?php } ?>
                </select>
            <?php } else { ?>
                <h6>No Stock Category Available</h6>
            <?php }
            ?>

            <div class="col-md-6 mb-3">
                <label for="">Name</label>
                <input type="text" name="name" required class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">URL</label>
                <input type="text" name="url" required class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Price</label>
                <input type="number" name="price" required class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Amount in stock</label>
                <input type="number" name="amount" required class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Size</label>
                <select name="size" required class="form-control">
                    <option value="">--Select Size--</option>
                    <option value="S">S</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                    <option value="XXXL">XXXL</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Gender</label>
                <select name="gender" required class="form-control">
                    <option value="">--Select Size--</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Uni-sex">Uni-sex</option>
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Product Info</label>
                <textarea name="description" class="form-control" id="summernote" rows="4"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Image</label>
                <input type="file" name="image" class="form-control"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Image 2</label>
                <input type="file" name="image2" class="form-control"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Image 3</label>
                <input type="file" name="image3" class="form-control"></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label for="">Status</label><br>
                <input type="checkbox" name="status" width="70px" height="70px" />
            </div>
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary" name="stock_add">Save stock</button>
            </div>
        </form>
    </div>

</div>
<?php
include "includes/footer.php";
?>