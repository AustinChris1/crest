<?php
include "../databases/db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require '../vendor/autoload.php';


function sendemail($email, $order_id, $date, $amount, $product_name,$order_address)
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "server236.web-hosting.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;

    $mail->Username = "info@spectrawebx.xyz";
    $mail->Password = getenv("MAIL_PASSWORD");

    $mail->setFrom("info@spectrawebx.xyz", "Spectra Web-X");
    $mail->addAddress($email);
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);
    $mail->Subject = "Order Successful";

    $email_template = "
  <h2>Thanks for your order.</h2>
  <img src='https://unsplash.it/801' width='200px' height='200px'>
  <h5>Thanks for your order.<br> We have received $amount NGN for the following products: $product_name and your order($order_id) is being processed</h5><br/><br/>
  <h5>Thanks for your order, your package will be shipped to $order_address.<br> Expect delivery in $date</h5><br/><br/>

  ";

    $mail->Body = $email_template;
    $mail->send();
}
function sendemail_admin($name,$phone,$order_id,$date,$amount, $product_name,$order_address)
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
  <h5>Thanks for your order.<br>The user by name '$name' with order of $amount NGN for the following products: $product_name with order id($order_id) has been paid</h5><br/><br/>
  Delivery address: $order_address <br>Contact the user <a href='tel:$phone'>$phone</a>
  <h5>Delivery should be in $date</h5><br/><br/>
  

  ";

  $mail->Body = $email_template;
  $mail->send();
}

$user_id = $db->real_escape_string($_POST['uid']);
$product_id = $_POST['prod_id'];
$email = $db->real_escape_string($_POST['email']);
$amount = $db->real_escape_string($_POST['amount']);
$reference = $db->real_escape_string($_POST['reference']);
$phone = $db->real_escape_string($_POST['phone']);

// $prod = str_replace('"', "", $product_id);


$order = $db->query("SELECT * FROM orders WHERE user_id = '$user_id' AND product_id = '$product_id' AND status = '0' ORDER BY id DESC LIMIT 1");
if ($order->num_rows <= 0) {
    echo "No pending order";
} else {
    $ex_prod = explode(",", $product_id);
    $product_name = '';
    $order_det = $order->fetch_assoc();
    $order_id = $order_det['order_id'];
    $order_address = $order_det['address'];
    $now = date("Y-m-d H:i:s");
    $date = date('Y-m-d', strtotime($now . '+ 7 days'));

    $products = $db->query("SELECT * FROM stock WHERE status = '0'");
    foreach ($products as $p) {
        $pid = $p['id'];
        if (in_array($p['id'], $ex_prod)) {
            $carts = $db->query("SELECT * FROM cart WHERE stock_id = '$pid' AND user_id = '$user_id' AND status = '0'");
            $cart = $carts->fetch_array();
            $product_name .= $p['name'] . "(" . $cart['quantity'] . "), size:(" . $cart['size'] . "), color:(" . $cart['color'] . ") <br>";
        }
    }
    $user = $db->query("SELECT * FROM users WHERE id = '$user_id' LIMIT 1");
    $users = $user->fetch_assoc();
    $name = $users['fname']. " ". $users['lname'];
    $phone = $users['phone'];

    $query = $db->query("UPDATE orders SET status = '1', tx_no = '$reference' WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1");
    $db->query("UPDATE cart SET status = '1' WHERE user_id = '$user_id'");
    if ($query) {
        echo "success";
        sendemail($email, $order_id, $date, $amount, $product_name,$order_address);
        sendemail_admin($name,$phone,$order_id,$date,$amount, $product_name,$order_address);
    } else {
        echo "Something went wrong";
    }
}
