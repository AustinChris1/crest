<?php 
    $var_price = $_POST['price'];
    file_put_contents("rate.txt", $var_price);
?>