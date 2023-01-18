<?php
include "includes/nav.php";
include "includes/message.php";
include "includes/admin_auth.php";

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $postquery = $db->query("SELECT * FROM stock WHERE id= '$post_id' LIMIT 1");
    if ($postquery->num_rows > 0) {
        $postrow = $postquery->fetch_array();
?>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Stock</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Stock</h6>
            </div>
            <div class="card-body">

                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="col-md-12 mb-3">
                        <?php
                        $category = $db->query(
                            "SELECT * FROM category WHERE status ='0'"
                        );
                        if ($category->num_rows > 0) { ?>
                            <label for="">Stock Category List</label>
                            <select name="category_id" required class="form-control">
                                <option value="">--Select Stock Category--</option>
                                <?php foreach ($category
                                    as $category_item) { ?>
                                    <option value="<?= $category_item["id"] ?>" <?= $category_item["id"] == $postrow["category_id"] ? "selected" : "" ?>>
                                        <?= $category_item["name"] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        <?php } else { ?>
                            <h6>No Stock Category Available</h6>
                        <?php }
                        ?>

                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="hidden" name="id" value="<?= $postrow['id'] ?>">
                        <label for="">Stock name</label>
                        <input type="text" name="name" value="<?= $postrow['name'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">URL</label>
                        <input type="text" name="url" value="<?= $postrow['url'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Price</label>
                        <input type="number" name="price" value="<?= $postrow['price'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Amount in stock</label>
                        <input type="text" name="amount" value="<?= $postrow['amount'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Size</label>
                        <select name="size" required class="form-control">
                            <option value="">--Select Size--</option>
                            <option value="<?=$postrow["size"]?>"<?=$postrow["size"] ? "selected" : "" ?>><?=$postrow["size"]?></option>
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
                            <option value="">--Select Gender--</option>
                            <option value="<?=$postrow["gender"]?>"<?=$postrow["gender"] ? "selected" : "" ?>><?=$postrow["gender"]?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Uni-sex">Uni-sex</option>
                            
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Image</label>
                        <input type="hidden" name="old_image" value="<?= $postrow["image"] ?>" class="form-control"></textarea>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Image 2</label>
                        <input type="hidden" name="old_image2" value="<?= $postrow["image2"] ?>" class="form-control"></textarea>
                        <input type="file" name="image2" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Image 3</label>
                        <input type="hidden" name="old_image3" value="<?= $postrow["image3"] ?>" class="form-control"></textarea>
                        <input type="file" name="image3" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Status</label><br>
                        <input type="checkbox" name="status" <?= $postrow['status'] == '1' ? 'checked' : ''; ?> width="70px" height="70px" />
                        Checked = Out of stock, UnChecked = Available
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary" name="stock_update">Update Stock</button>
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