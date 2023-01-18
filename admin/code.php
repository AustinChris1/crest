<?php
include '../databases/db.php';
include "includes/message.php";

if (isset($_POST["stock_delete"])) {
    $stock_id = $_POST["stock_delete"];
    $check_img_query = $db->query(
        "SELECT * FROM stock WHERE id ='$stock_id' LIMIT 1"
    );
    $imgresdata = $check_img_query->fetch_array();
    $image = $imgresdata["image"];

    $postdelete = $db->query("DELETE FROM stock WHERE id = '$stock_id' LIMIT 1");

    if ($postdelete) {
        if (file_exists("../uploads/items/" . $image)) {
            unlink("../uploads/items/" . $image);
        }
        $_SESSION["message"] = "Category Deleted successfully";
        header("Location: stock");
        exit();
    } else {
        $_SESSION["error"] = "Something Went Wrong!";
        header("Location: stock");
        exit();
    }
}

if (isset($_POST["stock_update"])) {
    $stock_id = $_POST["id"];
    $category_id = $_POST["category_id"];
    $name = $db->real_escape_string($_POST["name"]);

    $string = strtolower($_POST["url"]);
    $string = preg_replace("/[^A-Za-z0-9\-]/", "-", $string); //remove all special chars
    $final_string = preg_replace("/-+/", "-", $string);
    $url = $final_string;

    $description = $_POST["description"];
    $size = $_POST["size"];
    $gender = $_POST["gender"];
    $price = $_POST["price"];
    $amount = $_POST["amount"];

    $old_filename = $_POST["old_image"];
    $image = $_FILES["image"]["name"];
    $update_filename = "";

    if ($image != null) {
        //rename the image
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . "." . $image_extension;

        $update_filename = $filename;
    } else {
        $update_filename = $old_filename;
    }

    $old_filename2 = $_POST["old_image2"];
    $image2 = $_FILES["image2"]["name"];
    $update_filename2 = "";

    if ($image2 != null) {
        //rename the image
        $image_extension2 = pathinfo($image2, PATHINFO_EXTENSION);
        $filename2 = time() . "." . $image_extension2;

        $update_filename2 = $filename2;
    } else {
        $update_filename2 = $old_filename2;
    }

    $old_filename3 = $_POST["old_image3"];
    $image3 = $_FILES["image3"]["name"];
    $update_filename3 = "";

    if ($image3 != null) {
        //rename the image
        $image_extension3 = pathinfo($image3, PATHINFO_EXTENSION);
        $filename3 = time() . "." . $image_extension3;

        $update_filename3 = $filename3;
    } else {
        $update_filename3 = $old_filename3;
    }

    $status = $_POST["status"] == true ? "1" : "0";

    $postupdate = $db->query(
        "UPDATE stock SET category_id = '$category_id', name = '$name', url = '$url', description = '$description', size = '$size', gender = '$gender', price = '$price', amount = '$amount', image = '$update_filename', image2 = '$update_filename2', image3 = '$update_filename3', status = '$status' WHERE id = '$stock_id'"
    );

    if ($postupdate) {
        if ($image != null) {
            if (file_exists("../uploads/items/" . $old_filename)) {
                unlink("../uploads/items/" . $old_filename);
            }
            move_uploaded_file(
                $_FILES["image"]["tmp_name"],
                "../uploads/items/" . $update_filename
            );
        }
        if ($image2 != null) {
            if (file_exists("../uploads/items2/" . $old_filename2)) {
                unlink("../uploads/items2/" . $old_filename2);
            }
            move_uploaded_file(
                $_FILES["image2"]["tmp_name"],
                "../uploads/items2/" . $update_filename2
            );
        }
        if ($image3 != null) {
            if (file_exists("../uploads/items3/" . $old_filename3)) {
                unlink("../uploads/items3/" . $old_filename3);
            }
            move_uploaded_file(
                $_FILES["image3"]["tmp_name"],
                "../uploads/items3/" . $update_filename3
            );
        }
        $_SESSION["message"] = "Item Updated Successfully";
        header("Location:stock");
        exit();
    } else {
        $_SESSION["error"] = "Something Went Wrong!";
        header("Location:stock_edit?id=" . $stock_id);
        exit();
    }
}

if (isset($_POST["stock_add"])) {
    $category_id = $_POST["category_id"];
    $name = $_POST["name"];
    $string = strtolower($_POST["url"]);
    $string = preg_replace("/[^A-Za-z0-9\-]/", "-", $string); //remove all special chars
    $final_string = preg_replace("/-+/", "-", $string);
    $url = $final_string;
    $size = $_POST["size"];
    $gender = $_POST["gender"];
    $price = $_POST["price"];
    $amount = $_POST["amount"];

    $description = $_POST["description"];
    $image = $_FILES["image"]["name"];
    //rename the image
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . "." . $image_extension;
    $status = $_POST["status"] == true ? "1" : "0";

    $image2 = $_FILES["image2"]["name"];
    //rename the image
    $image_extension2 = pathinfo($image2, PATHINFO_EXTENSION);
    $filename2 = time() . "." . $image_extension2;

    $image3 = $_FILES["image"]["name"];
    //rename the image
    $image_extension3 = pathinfo($image3, PATHINFO_EXTENSION);
    $filename3 = time() . "." . $image_extension3;

    $addpostquery = $db->query("INSERT INTO stock (category_id, name, url, description, size, gender, price, amount, image, image2, image3, status, date) 
    VALUES('$category_id', '$name', '$url', '$description', '$size', '$gender', '$price', '$amount', '$filename', '$filename2', '$filename3', '$status', NOW())");

    if ($addpostquery) {
        move_uploaded_file(
            $_FILES["image"]["tmp_name"],
            "../uploads/items/" . $filename
        );
        move_uploaded_file(
            $_FILES["image2"]["tmp_name"],
            "../uploads/items2/" . $filename2
        );
        move_uploaded_file(
            $_FILES["image3"]["tmp_name"],
            "../uploads/items3/" . $filename3
        );
        $_SESSION["message"] = "Item Created Successfully";
        header("Location:stock");
        exit();
    } else {
        $_SESSION["error"] = "Something Went Wrong!";
        header("Location:add_stock");
        exit();
    }
}
if (isset($_POST["category_delete"])) {
    $category_id = $_POST["category_delete"];
    $check_img_query = $db->query(
        "SELECT * FROM category WHERE id ='$category_id' LIMIT 1"
    );
    $imgresdata = $check_img_query->fetch_array();
    $image = $imgresdata["image"];

    $postdelete = $db->query("DELETE FROM category WHERE id = '$category_id' LIMIT 1");

    if ($postdelete) {
        $_SESSION["message"] = "Item Deleted successfully";
        header("Location: category");
        exit();
    } else {
        $_SESSION["error"] = "Something Went Wrong!";
        header("Location: category");
        exit();
    }
}


if (isset($_POST["category_update"])) {
    $category_id = $_POST["id"];
    $name = $_POST["name"];

    $string = strtolower($_POST["url"]);
    $string = preg_replace("/[^A-Za-z0-9\-]/", "-", $string); //remove all special chars
    $final_string = preg_replace("/-+/", "-", $string);
    $url = $final_string;

    $description = $_POST["description"];
    $status = $_POST["status"] == true ? "1" : "0";
    $old_filename = $_POST["old_image"];
    $image = $_FILES["image"]["name"];
    $update_filename = "";

    if ($image != null) {
        //rename the image
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . "." . $image_extension;

        $update_filename = $filename;
    } else {
        $update_filename = $old_filename;
    }

    $categoryupdate = $db->query(
        "UPDATE category SET name='$name', url='$url', description='$description', image = '$update_filename', status='$status' WHERE id = '$category_id'"
    );

    if ($categoryupdate) {
        if ($image != null) {
            if (file_exists("../uploads/category/" . $old_filename)) {
                unlink("../uploads/category/" . $old_filename);
            }
            move_uploaded_file(
                $_FILES["image"]["tmp_name"],
                "../uploads/category/" . $update_filename
            );
        }

        $_SESSION["message"] = "Category Updated successfully";
        header("Location:category");
        exit();
    } else {
        $_SESSION["error"] = "Something Went Wrong!";
        header("Location:category_edit?id=" . $category_id);
        exit();
    }
}

if (isset($_POST["add_category"])) {
    $name = $_POST["name"];

    $string = strtolower($_POST["url"]);
    $string = preg_replace("/[^A-Za-z0-9\-]/", "-", $string); //remove all special chars
    $final_string = preg_replace("/-+/", "-", $string);
    $url = $final_string;

    $description = $_POST["description"];
    $status = $_POST["status"] == true ? "1" : "0";
    $image = $_FILES["image"]["name"];
    //rename the image
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . "." . $image_extension;

    $categoryquery = $db->query(
        "INSERT INTO category (name, url, description, status, image, date) VALUES('$name', '$url', '$description', '$status', '$filename', NOW())"
    );

    if ($categoryquery) {
        move_uploaded_file(
            $_FILES["image"]["tmp_name"],
            "../uploads/category/" . $filename
        );

        $_SESSION["message"] = "Category added successfully";
        header("Location:add_category");
        exit();
    } else {
        $_SESSION["error"] = "Something Went Wrong!";
        header("Location:add_category");
        exit();
    }
}
if (isset($_POST["user_update"])) {
    $user_id = $_POST["id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $role = $_POST["usertype"] == true ? "1" : "0";
    // $password = $_POST["password"];
    $phone = $_POST["phone"];
    $status = $_POST["status"] == true ? "1" : "0";

    // $password = $db->real_escape_string($password);
    // $password = md5($password);

    $editquery = $db->query(
        "UPDATE users SET fname='$fname', lname='$lname', email='$email', usertype='$role', phone='$phone', status='$status' WHERE id='$user_id'"
    );

    if ($editquery) {
        $_SESSION["message"] = "Updated Successfully";
        header("Location:users");
        exit();
    } else {
        $_SESSION["error"] = "Something Went Wrong!";
        header("Location:user_edit?id=".$user_id);
        exit();
    }
}


?>