<?php
include "../databases/db.php";
$uid = $_POST['uid'];
$cart = $db->query("SELECT * FROM cart WHERE user_id = '$uid' AND status = '0'");
$cart_count = $cart->num_rows;

echo $cart_count;
?>
