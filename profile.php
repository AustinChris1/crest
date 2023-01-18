<?php

include "includes/nav.php";
include "includes/auth.php";
?>
<div class="container-fluid px-4">
    <?php include "includes/message.php"; ?>
    </ol>
    <div class="row mt-4">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4>User Profile
                    </h4>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION["auth_user"]["id"])) {
                        $user_id = $_SESSION["auth_user"]["id"];

                        $profilequery = $db->query(
                            "SELECT * FROM users WHERE id='$user_id'"
                        );
                        if ($profilequery->num_rows > 0) {
                            foreach ($profilequery as $user) {
                                $image = $user["user_image"];

                                if ($image != null) { ?>

                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                        <input type="hidden" value="<?= $user[
                                            "id"
                                        ] ?>" name="id">

                                            <div class="col-md-12 mb-3">
                                                <div class="userimage">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="">First name</label>
                                                <input type="text" name="fname" readonly value="<?= $user[
                                                    "fname"
                                                ] ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="">Last name</label>
                                                <input type="text" name="lname" readonly value="<?= $user[
                                                    "lname"
                                                ] ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="">Email</label>
                                                <input type="text" name="email" readonly value="<?= $user[
                                                    "email"
                                                ] ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="">Phone</label>
                                                <input type="text" name="phone" readonly value="<?= $user[
                                                    "phone"
                                                ] ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="">Registration Date</label>
                                                <input type="text" name="" readonly value="<?= date(
                                                    "d-M-Y",
                                                    strtotime($user["date"])
                                                ) ?>" class="form-control">
                                            </div>

                                        </div>
                                            <div class="col-md-6 mb-3">
                                                <a href='edit_profile' class="btn btn-primary" name="edit_profile">Edit
                                                    Profile</a>
                                            </div>

                                        </div>
                                    </form>


                                <?php } else { ?>
                                    <form action="usercode.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                        <input type="hidden" value="<?= $user[
                                            "id"
                                        ] ?>" name="id">

                                            <div class="col-md-12 mb-3">

                                                <div class="imageu">
                                                    <input type="file" name="user_image" class="my_file" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>First name</label>
                                                <input type="text" name="fname" readonly value="<?= $user[
                                                    "fname"
                                                ] ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Last name</label>
                                                <input type="text" name="lname" readonly value="<?= $user[
                                                    "lname"
                                                ] ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Email</label>
                                                <input type="text" name="email" readonly value="<?= $user[
                                                    "email"
                                                ] ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Phone</label>
                                                <input type="text" name="phone" readonly value="<?= $user[
                                                    "phone"
                                                ] ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Address</label>
                                                <input type="text" name="address" readonly value="<?= $user[
                                                    "address"
                                                ] ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="">Registration Date</label>
                                                <input type="text" name="date" readonly value="<?= date(
                                                    "d-M-Y",
                                                    strtotime($user["date"])
                                                ) ?>" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <button type="submit" class="btn btn-primary" name="upload_image">Upload Image</button>
                                            </div>
                                        </div>
                                    </form>
                            <?php }
                            }
                        } else {
                             ?>
                            <h4>User Record Not Found</h4>
                        <?php
                        }
                    }
                    ?>
                                        <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="edit">
                            <label class="custom-control-label" for="edit" data-toggle="collapse" data-target="#editdiv">Edit Profile</label>
                            <div class="collapse mb-5" id="editdiv">
                                <h5 class="section-title position-relative text-uppercase mt-3 mb-3"><span class="bg-secondary pr-3">edit</span></h5>
                                <div class="bg-light p-30">
                                <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="row">

                                                <input type="hidden" value="<?= $user[
                                                    "id"
                                                ] ?>" name="id">
                                        <script>
                                            function previewImage(){
                                                var file = document.getElementById("file").files;
                                                if (file.length > 0){
                                                    var fileReader = new FileReader();
                                                    fileReader.onload = function(event){
                                                        document.getElementById("preview").setAttribute("src", event.target.result);
                                                    };
                                                    fileReader.readAsDataURL(file[0]);
                                                }
                                            }
                                        </script>
                                                <div class="col-md-12 mb-3">
                                                <div class="imageuser">
                                                <input type="hidden" name="old_image" value="<?= $user[
                                                    "user_image"
                                                ] ?>" class="form-control" id="preview">
                                                        <input type="file" name="user_image" class="my_file" accept="image/*" id="file" onchange="previewImage();">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="">First name</label>
                                                    <input type="text" name="fname"  value="<?= $user[
                                                        "fname"
                                                    ] ?>" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Last name</label>
                                                    <input type="text" name="lname" value="<?= $user[
                                                        "lname"
                                                    ] ?>" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Phone</label>
                                                    <input type="text" name="phone" value="<?= $user[
                                                        "phone"
                                                    ] ?>" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Address</label>
                                                    <input type="text" name="address" value="<?= $user[
                                                        "address"
                                                    ] ?>" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <button type="submit" class="btn btn-primary" name="update_user_profile">Update
                                                        Profile</button>
                                                </div>

                                            </div>
                                        </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .userimage {
        border-radius: 50%;
        position: relative;
        background-position: center;
        background-repeat: no-repeat;
        border: 3px solid orange;
        background-size: 100% 100%;
        margin-left: 35vw;
        overflow: hidden;
        height: 200px;
        width: 200px;
    }
</style>
< <style>
    .imageu{
    border-radius: 50%;
    background: url('avatar1.png');
    position: relative;
    background-position: center;
    background-repeat: no-repeat;
    border: 3px solid orange;
    background-size: 100% 100%;
    margin: auto;
    overflow: hidden;
    height: 200px;
    width: 200px;
    }
    .imageuser{
    border-radius: 50%;
    background: url("uploads/user_images/<?= $user["user_image"] ?>");
    position: relative;
    background-position: center;
    background-repeat: no-repeat;
    border: 3px solid orange;
    background-size: 100% 100%;
    margin: auto;
    overflow: hidden;
    height: 200px;
    width: 200px;
    }
    .my_file {
    border-radius: 50%;
    position: absolute !important;
    bottom: 0;
    outline: none;
    width: 100%;
    box-sizing: border-box;
    color: transparent;
    padding: 15px 80px;
    cursor: pointer;
    transition: 0.5s;
    background: rgba(0,0,0,0.5);
    opacity: 0;
    }
    .my_file::-webkit-file-upload-button{
    visibility: hidden;
    }
    .my_file::before{
    content: '\f030';
    font-family: fontAwesome;
    font-size: 30px;
    color: #fff;
    display: inline-block;
    -webkit-user-select:none;
    padding-top: -10px;
    }
    .my_file:hover{
    opacity: 1;
    }

    </style>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<?php include "includes/footer.php"; ?>
<style>

    .userimage {
        border-radius: 50%;
    background: url("<?= $user["user_image"] ?>");
    position: relative;
    background-position: center;
    background-repeat: no-repeat;
    border: 3px solid #343a40;
    background-size: 100% 100%;
    margin: auto;
    overflow: hidden;
    height: 200px;
    width: 200px;
    }
</style>
< <style>
    .imageu{
    border-radius: 50%;
    background: url('avatar1.png');
    position: relative;
    background-position: center;
    background-repeat: no-repeat;
    border: 3px solid orange;
    background-size: 100% 100%;
    margin: auto;
    overflow: hidden;
    height: 200px;
    width: 200px;
    }
    .my_file {
    border-radius: 50%;
    position: absolute !important;
    bottom: 0;
    outline: none;
    width: 100%;
    box-sizing: border-box;
    color: transparent;
    padding: 15px 80px;
    cursor: pointer;
    transition: 0.5s;
    background: rgba(0,0,0,0.5);
    opacity: 0;
    }
    .my_file::-webkit-file-upload-button{
    visibility: hidden;
    }
    .my_file::before{
    content: '\f030';
    font-family: fontAwesome;
    font-size: 30px;
    color: #fff;
    display: inline-block;
    -webkit-user-select:none;
    padding-top: -10px;
    }
    .my_file:hover{
    opacity: 1;
    }

    </style>


<?php
if (isset($_POST["update_user_profile"])) {
    $user_id = $_POST["id"];
    $fname = $_POST["fname"];
    $phone = $_POST["phone"];
    $lname = $_POST["lname"];
    $address = $_POST["address"];

    $phone = $db->real_escape_string($phone);
    $fname = $db->real_escape_string($fname);
    $lname = $db->real_escape_string($lname);
    $address = $db->real_escape_string($address);

    $old_filename = $_POST["old_image"];
    $image = $_FILES["user_image"]["name"];
    $update_filename = "";

    if ($image != null) {
        //rename the image
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . "." . $image_extension;

        $update_filename = $filename;
    } else {
        $update_filename = $old_filename;
    }
    $checkquery = $db->query(
        "SELECT * FROM users WHERE phone='$phone'"
    );
    //check if query is greater than 0
    if ($checkquery->num_rows > 1) {
        $_SESSION["error"] = "Phone number already exists";
        echo "<script>location.href='profile'</script>";
        exit();
    } else {
        $update_profile = $db->query(
            "UPDATE users SET user_image = '$update_filename', fname = '$fname', phone = '$phone', lname = '$lname' , address = '$address' WHERE id = '$user_id' "
        );

        if ($update_profile) {
            if ($image != null) {
                if (file_exists("uploads/user_images/" . $old_filename)) {
                    unlink("uploads/user_images/" . $old_filename);
                }
                move_uploaded_file(
                    $_FILES["user_image"]["tmp_name"],
                    "uploads/user_images/" . $update_filename
                );
            }

            $_SESSION["message"] = "Profile Updated Successfully";
            echo "<script>location.href='profile'</script>";
            exit();
        } else {
            $_SESSION["error"] = "Something Went Wrong!";
            echo "<script>location.href='profile'</script>";
            exit();
        }
    }
}

?>