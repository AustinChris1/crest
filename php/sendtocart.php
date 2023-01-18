<?php

include "../databases/db.php";

$user_id = $db->real_escape_string($_POST['user_id']);
$product_id = $db->real_escape_string($_POST['product_id']);
$check = $db->query("SELECT * FROM cart WHERE status = '0' AND  stock_id = '$product_id' AND user_id = '$user_id'");
if($check->num_rows>0){
    $result_fetch = $check->fetch_assoc();
    $qty = $result_fetch["quantity"] + 1;

    $db->query("UPDATE cart SET quantity = '$qty' WHERE status = '0' AND  stock_id = '$product_id' AND user_id = '$user_id'");
}else{
$db->query("INSERT INTO cart (user_id, stock_id, date) VALUES ('$user_id', '$product_id', NOW())");
}
?>