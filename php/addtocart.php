<?php

include "../databases/db.php";

$user_id = $_POST['user_id'];
$product_id = $_POST['product_id'];
$size = $_POST['size'];
$color = $_POST['color'];
$quant = $_POST['quantity'];
if(!empty($size) && !empty($color) && !empty($quant)){

if($user_id == ''){
    echo "Please login!";
}else{
$check = $db->query("SELECT * FROM cart WHERE status = '0' AND  stock_id = '$product_id' AND user_id = '$user_id'");
if($check->num_rows>0){
    // $result_fetch = $check->fetch_assoc();
    // $qty = $result_fetch["quantity"] + 1;

    $db->query("UPDATE cart SET quantity = '$quant', color = '$color', size = '$size' WHERE status = '0' AND  stock_id = '$product_id' AND user_id = '$user_id'");
    echo "success";
}else{
$db->query("INSERT INTO cart (user_id, stock_id, quantity, color, size, date) VALUES ('$user_id', '$product_id', '$quant', '$color', '$size', NOW())");
echo "success";
}
}
}else{
    echo "All input fields are required!";
}

?>