<?php
include "../databases/db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require '../vendor/autoload.php';


function sendemail($email,$order_id,$date,$value, $product_name,$order_address)
{
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = "server236.web-hosting.com";
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "ssl";
  $mail->Port = 465;

  $mail->Username = "info@spectrawebx.xyz";
  $mail->Password = getenv("MAIL_PASSWORD");

  $mail->setFrom("info@spectrawebx.xyz", "Crest Management");
  $mail->addAddress($email);
  $mail->addAddress($email);

  //Content
  $mail->isHTML(true);                              
  $mail->Subject = "Order Successful";

  $email_template ="
  <h2>Thanks for your order.</h2>
  <img src='https://unsplash.it/801' width='200px' height='200px'>
  <h5>Thanks for your order.<br> We have received $value USDT for the following products: $product_name and your order($order_id) is being processed</h5><br/><br/>
  <h5>Thanks for your order, your package will be shipped to $order_address.<br> Expect delivery in $date</h5><br/><br/>

  ";

  $mail->Body = $email_template;
  $mail->send();
}

function sendemail_admin($name,$phone,$order_id,$date,$value, $product_name,$order_address)
{
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = "server236.web-hosting.com";
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "ssl";
  $mail->Port = 465;

  $mail->Username = "info@spectrawebx.xyz";
  $mail->Password = getenv("MAIL_PASSWORD");

  $mail->setFrom("info@spectrawebx.xyz", "Crest Management");
  $mail->addAddress('info@spectrawebx.xyz');
  $mail->addAddress('info@spectrawebx.xyz');

  //Content
  $mail->isHTML(true);                              
  $mail->Subject = "Order Successful";

  $email_template ="
  <h2>Thanks for your order.</h2>
  <img src='https://unsplash.it/801' width='200px' height='200px'>
  <h5>Thanks for your order.<br>The user by name '$name' with order of $value USDT for the following products: $product_name with order id($order_id) has been paid</h5><br/><br/>
  Delivery address: $order_address <br>Contact the user <a href='tel:$phone'>$phone</a>
  <h5>Delivery should be in $date</h5><br/><br/>
  

  ";

  $mail->Body = $email_template;
  $mail->send();
}

$user_id = $db->real_escape_string($_POST['uid']);
$product_id = $_POST['prod_id'];
$email = $db->real_escape_string($_POST['email']);
$value = $db->real_escape_string($_POST['rate']);
$address = $db->real_escape_string($_POST['wallet_address']);


// $value = 0.54;
// $address = "0x20FA1f325E279DbA2208D3830512EC233E8689D6";
if(!empty($address)){


$ex_prod = explode(",", $product_id);

$address = strtolower($address);
$API_KEY = 'D3XPR53MHTF8YI3W71YHI923V9MC4HW4XM';

$check_address = "0x2b0afddfb1e34888847c52396e6757ffd60f4729";
$contractaddress =  "0x55d398326f99059ff775485246999027b3197955";

// $contractaddress = '0xe9e7cea3dedca5984780bafc599bd69add087d56';
// $check_address = '0xfbC74D86fc320383D1Af240129aa762341AB00AC';

$BASE_CONVERT_RATE = 10 ** 18;

$BASE_URL = 'https://api.bscscan.com/api';

$url = $BASE_URL . "?module=account&action=tokentx&contractaddress=" . $contractaddress . "&address=" . $check_address . "&apikey=" . $API_KEY;

$val = intval($value * $BASE_CONVERT_RATE);
$val = round($val, -15);
$crypto_response = file_get_contents($url);
$crypto_data = json_decode($crypto_response, true);


    $order = $db->query("SELECT * FROM orders WHERE user_id = '$user_id' AND product_id = '$product_id' AND status = '0' ORDER BY id DESC LIMIT 1");
    if($order->num_rows<=0){
        echo "no_order";
    }else{
$order_det = $order->fetch_assoc();
$order_id = $order_det['order_id'];
$order_address = $order_det['address'];
$now = date("Y-m-d H:i:s");
$date = date('Y-m-d', strtotime($now . '+ 7 days'));
$last_transaction = null;
$product_name = null;
//check if wallet address sent usdt to wallet
foreach (array_slice($crypto_data['result'], -5) as $key) {
    if (in_array($address, $key) && in_array($val, $key)) {
        if ($address === $key['from']) {
            $last_transaction = $key;
        }
    }
}
if ($last_transaction !== null) {
    // print the last transaction data
    $tx_hash = $last_transaction['hash'];
    $products = $db->query("SELECT * FROM stock WHERE status = '0'");
    foreach ($products as $p) {
        $pid = $p['id'];
        if (in_array($p['id'], $ex_prod)) {
            $carts = $db->query("SELECT * FROM cart WHERE stock_id = '$pid' AND user_id = '$user_id' AND status = '0'");
            $cart = $carts->fetch_array();
            $product_name .= $p['name'] . "(" . $cart['quantity'] . "), size:(" . $cart['size'] . "), color:(" . $cart['color'] . ") <br>";
        }
    }
    // get user details
    $user = $db->query("SELECT * FROM users WHERE id = '$user_id' LIMIT 1");
    $users = $user->fetch_assoc();
    $name = $users['fname']. " ". $users['lname'];
    $phone = $users['phone'];

    //check if crypto has been sent earlier
    $check_tx_db = $db->query("SELECT * FROM orders WHERE wallet_address = '$address' AND usdt = '$value' AND hash = '$tx_hash' ORDER BY id DESC LIMIT 1");
    if($check_tx_db->num_rows <= 0){

        //updates database
    $query = $db->query("UPDATE orders SET status = '1', hash = '$tx_hash', wallet_address = '$address', usdt = '$value' WHERE user_id = '$user_id' AND product_id = '$product_id' LIMIT 1");
    $db->query("UPDATE cart SET status = '1' WHERE user_id = '$user_id'");
    if($query){
        echo "success";
        sendemail($email,$order_id,$date,$value,$product_name,$order_address);
        sendemail_admin($name,$phone,$order_id,$date,$value, $product_name,$order_address);

    }else{
        echo "Something went wrong";

    }
}else{
    echo "Duplicate Transaction";
}
}
}
}else{
    echo "All input fields are required!";
}
?>
