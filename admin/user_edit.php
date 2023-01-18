<?php
include "includes/nav.php";
include "includes/message.php";
include "includes/admin_auth.php";

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $postquery = $db->query("SELECT * FROM users WHERE id= '$post_id' LIMIT 1");
    if ($postquery->num_rows > 0) {
        $postrow = $postquery->fetch_array();
?>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">User</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
            </div>
            <div class="card-body">

                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6 mb-3">
                        <input type="hidden" name="id" value="<?= $postrow['id'] ?>">
                        <label for="">First name</label>
                        <input type="text" name="fname" value="<?= $postrow['fname'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Last name</label>
                        <input type="text" name="lname" value="<?= $postrow['lname'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email</label>
                        <input type="text" name="email" value="<?= $postrow["email"] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Role</label>
                        <select name="usertype" required class="form-control">
                            <option value="">--Select Role--</option>
                            <option value="1" <?= $postrow["usertype"] == "1"
                                                        ? "selected"
                                                        : "" ?>>Admin</option>
                            <option value="0" <?= $postrow["usertype"] == "0"
                                                    ? "selected"
                                                    : "" ?>>User</option>

                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" value="<?= $postrow["phone"] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label><br>
                        <input type="checkbox" name="status" <?= $postrow['status'] == '1' ? 'checked' : ''; ?> width="70px" height="70px" />
                        Checked = Unblocked, UnChecked = Blocked
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary" name="user_update">Update User</button>
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