<?php

include "../databases/db.php";

$user_id = $db->real_escape_string($_POST['user_id']);
$cart_id = $db->real_escape_string($_POST['cart_id']);
$product_id = $db->real_escape_string($_POST['product_id']);
$check = $db->query("SELECT * FROM cart WHERE id = '$cart_id' AND user_id = '$user_id'");
if($check->num_rows>0){

    $query = $db->query("SELECT * FROM orders WHERE user_id = '$user_id' AND status = '0'");
    $arr = '';
    foreach($query as $fetch){
    $pid = explode(",", $fetch['cart_id']);
    echo $cart_id;
    echo $pid;
    if(in_array($cart_id, $pid)){
        $arr = $fetch['cart_id'];
    $db->query("UPDATE orders SET status = '2' WHERE user_id = '$user_id' AND cart_id = '$arr' ORDER BY id DESC LIMIT 1");
    }
    }
    $db->query("DELETE FROM cart WHERE id = '$cart_id' LIMIT 1");
    
}
