<?php
include '../databases/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require '../vendor/autoload.php';


function sendemail($email)
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
    $mail->Subject = "Order Notification";
    //https://unsplash.it/801
    $email_template = "
    <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
    <html xmlns='http://www.w3.org/1999/xhtml'>
        <head>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
            <title>Email Template for Order Confirmation Email</title>
            
            <!-- Start Common CSS -->
            <style type='text/css'>
                #outlook a {padding:0;}
                body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0; font-family: Helvetica, arial, sans-serif;}
                .ExternalClass {width:100%;}
                .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
                .backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
                .main-temp table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; font-family: Helvetica, arial, sans-serif;}
                .main-temp table td {border-collapse: collapse;}
            </style>
            <!-- End Common CSS -->
        </head>
        <body>
            <table width='100%' cellpadding='0' cellspacing='0' border='0' class='backgroundTable main-temp' style='background-color: #d5d5d5;'>
                <tbody>
                    <tr>
                        <td>
                            <table width='600' align='center' cellpadding='15' cellspacing='0' border='0' class='devicewidth' style='background-color: #ffffff;'>
                                <tbody>
                                    <!-- Start header Section -->
                                    <tr>
                                        <td style='padding-top: 30px;'>
                                            <table width='560' align='center' cellpadding='0' cellspacing='0' border='0' class='devicewidthinner' style='border-bottom: 1px solid #eeeeee; text-align: center;'>
                                                <tbody>
                                                    <tr>
                                                        <td style='padding-bottom: 10px;'>
                                                            <a href='https://htmlcodex.com'><img src='images/logo.png' alt='PapaChina' /></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #666666;'>
                                                            3828 Mall Road
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #666666;'>
                                                            Los Angeles, California, 90017
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #666666;'>
                                                            Phone: 310-807-6672 | Email: info@example.com
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 25px;'>
                                                            <strong>Order Number:</strong> 001 | <strong>Order Date:</strong> 21-Nov-19
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- End header Section -->
                                    
                                    <!-- Start address Section -->
                                    <tr>
                                        <td style='padding-top: 0;'>
                                            <table width='560' align='center' cellpadding='0' cellspacing='0' border='0' class='devicewidthinner' style='border-bottom: 1px solid #bbbbbb;'>
                                                <tbody>
                                                    <tr>
                                                        <td style='width: 55%; font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;'>
                                                            Delivery Adderss
                                                        </td>
                                                        <td style='width: 45%; font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;'>
                                                            Billing Address
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width: 55%; font-size: 14px; line-height: 18px; color: #666666;'>
                                                            James C Painter
                                                        </td>
                                                        <td style='width: 45%; font-size: 14px; line-height: 18px; color: #666666;'>
                                                            James C Painter
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width: 55%; font-size: 14px; line-height: 18px; color: #666666;'>
                                                            3939  Charles Street, Farmington Hills
                                                        </td>
                                                        <td style='width: 45%; font-size: 14px; line-height: 18px; color: #666666;'>
                                                            3939  Charles Street, Farmington Hills
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;'>
                                                            Michigan, 48335
                                                        </td>
                                                        <td style='width: 45%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;'>
                                                            Michigan, 48335
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- End address Section -->
                                    
                                    <!-- Start product Section -->
                                    <tr>
                                        <td style='padding-top: 0;'>
                                            <table width='560' align='center' cellpadding='0' cellspacing='0' border='0' class='devicewidthinner' style='border-bottom: 1px solid #eeeeee;'>
                                                <tbody>
                                                    <tr>
                                                        <td rowspan='4' style='padding-right: 10px; padding-bottom: 10px;'>
                                                            <img style='height: 80px;' src='images/product-1.jpg' alt='Product Image' />
                                                        </td>
                                                        <td colspan='2' style='font-size: 14px; font-weight: bold; color: #666666; padding-bottom: 5px;'>
                                                            Lorem ipsum dolor sit amet
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575; width: 440px;'>
                                                            Quantity: 100
                                                        </td>
                                                        <td style='width: 130px;'></td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575;'>
                                                            Color: White & Blue
                                                        </td>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575; text-align: right;'>
                                                            $1.23 Per Unit
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575; padding-bottom: 10px;'>
                                                            Size: XL
                                                        </td>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575; text-align: right; padding-bottom: 10px;'>
                                                            <b style='color: #666666;'>$1,234.50</b> Total
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding-top: 0;'>
                                            <table width='560' align='center' cellpadding='0' cellspacing='0' border='0' class='devicewidthinner' style='border-bottom: 1px solid #eeeeee;'>
                                                <tbody>
                                                    <tr>
                                                        <td rowspan='4' style='padding-right: 10px; padding-bottom: 10px;'>
                                                            <img style='height: 80px;' src='images/product-2.jpg' alt='Product Image' />
                                                        </td>
                                                        <td colspan='2' style='font-size: 14px; font-weight: bold; color: #666666; padding-bottom: 5px;'>
                                                            Aliquam posuere ultrices mi ut rutrum
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575; width: 440px;'>
                                                            Quantity: 100
                                                        </td>
                                                        <td style='width: 130px;'></td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575;'>
                                                            Color: White & Blue
                                                        </td>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575; text-align: right;'>
                                                            $1.23 Per Unit
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575; padding-bottom: 10px;'>
                                                            Size: XL
                                                        </td>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575; text-align: right; padding-bottom: 10px;'>
                                                            <b style='color: #666666;'>$1,234.50</b> Total
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding-top: 0;'>
                                            <table width='560' align='center' cellpadding='0' cellspacing='0' border='0' class='devicewidthinner' style='border-bottom: 1px solid #eeeeee;'>
                                                <tbody>
                                                    <tr>
                                                        <td rowspan='4' style='padding-right: 10px; padding-bottom: 10px;'>
                                                            <img style='height: 80px;' src='images/product-3.jpg' alt='Product Image' />
                                                        </td>
                                                        <td colspan='2' style='font-size: 14px; font-weight: bold; color: #666666; padding-bottom: 5px;'>
                                                            Phasellus vitae pharetra arcu
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575; width: 440px;'>
                                                            Quantity: 100
                                                        </td>
                                                        <td style='width: 130px;'></td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575;'>
                                                            Color: White & Blue
                                                        </td>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575; text-align: right;'>
                                                            $1.23 Per Unit
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575; padding-bottom: 10px;'>
                                                            Size: XL
                                                        </td>
                                                        <td style='font-size: 14px; line-height: 18px; color: #757575; text-align: right; padding-bottom: 10px;'>
                                                            <b style='color: #666666;'>$1,234.50</b> Total
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- End product Section -->
                                    
                                    <!-- Start calculation Section -->
                                    <tr>
                                        <td style='padding-top: 0;'>
                                            <table width='560' align='center' cellpadding='0' cellspacing='0' border='0' class='devicewidthinner' style='border-bottom: 1px solid #bbbbbb; margin-top: -5px;'>
                                                <tbody>
                                                    <tr>
                                                        <td rowspan='5' style='width: 55%;'></td>
                                                        <td style='font-size: 14px; line-height: 18px; color: #666666;'>
                                                            Sub-Total:
                                                        </td>
                                                        <td style='font-size: 14px; line-height: 18px; color: #666666; width: 130px; text-align: right;'>
                                                            $1,234.50
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px; border-bottom: 1px solid #eeeeee;'>
                                                            Shipping Fee:
                                                        </td>
                                                        <td style='font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px; border-bottom: 1px solid #eeeeee; text-align: right;'>
                                                            $10.20
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px;'>
                                                            Order Total
                                                        </td>
                                                        <td style='font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px; text-align: right;'>
                                                            $1,234.50
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; font-weight: bold; line-height: 18px; color: #666666;'>
                                                            Payment Term:
                                                        </td>
                                                        <td style='font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; text-align: right;'>
                                                            100%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-bottom: 10px;'>
                                                            Deposit Amount
                                                        </td>
                                                        <td style='font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; text-align: right; padding-bottom: 10px;'>
                                                            $1,234.50
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- End calculation Section -->
                                    
                                    <!-- Start payment method Section -->
                                    <tr>
                                        <td style='padding: 0 10px;'>
                                            <table width='560' align='center' cellpadding='0' cellspacing='0' border='0' class='devicewidthinner'>
                                                <tbody>
                                                    <tr>
                                                        <td colspan='2' style='font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;'>
                                                            Payment Method (Bank Transfer)
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width: 55%; font-size: 14px; line-height: 18px; color: #666666;'>
                                                            Bank Name:
                                                        </td>
                                                        <td style='width: 45%; font-size: 14px; line-height: 18px; color: #666666;'>
                                                            Account Name: 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width: 55%; font-size: 14px; line-height: 18px; color: #666666;'>
                                                            Bank Address:
                                                        </td>
                                                        <td style='width: 45%; font-size: 14px; line-height: 18px; color: #666666;'>
                                                            Account Number: 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;'>
                                                            Bank Code:
                                                        </td>
                                                        <td style='width: 45%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;'>
                                                            SWIFT Code: 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='2' style='width: 100%; text-align: center; font-style: italic; font-size: 13px; font-weight: 600; color: #666666; padding: 15px 0; border-top: 1px solid #eeeeee;'>
                                                            <b style='font-size: 14px;'>Note:</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- End payment method Section -->
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>
    </html>";

    $mail->Body = $email_template;
    $mail->send();
}

// if(isset($_POST['register'])){


$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$address = $_POST['address'];
$user_id = $_POST['user_id'];
$cart_id = $_POST['cart_id'];
$product_id = $_POST['product_id'];
$amount = $_POST['amount'];
$state = $_POST['state'];
$city = $_POST['city'];


$fname = htmlentities($fname);
$fname = strip_tags($fname);
$fname = $db->real_escape_string($fname);

$email = htmlentities($email);
$email = strip_tags($email);
$email = $db->real_escape_string($email);

$lname = htmlentities($lname);
$lname = strip_tags($lname);
$lname = $db->real_escape_string($lname);

$address = htmlentities($address);
$address = strip_tags($address);
$address = $db->real_escape_string($address);

// $product_id = htmlentities($product_id);
// $product_id = strip_tags($product_id);
$product_id = $db->real_escape_string($product_id);
$product_id = json_encode($product_id);
$product_id = str_replace('"', "", $product_id);

$cart_id = $db->real_escape_string($cart_id);
$cart_id = json_encode($cart_id);
$cart_id = str_replace('"', "", $cart_id);

$amount = htmlentities($amount);
$amount = strip_tags($amount);
$amount = $db->real_escape_string($amount);

$state = htmlentities($state);
$state = strip_tags($state);
$state = $db->real_escape_string($state);

$city = htmlentities($city);
$city = strip_tags($city);
$city = $db->real_escape_string($city);
$name = $fname . ' ' . $lname;
$feed = "Pending";
$date = date('d M Y H:i:s');
function random_num($length_of_string)
{

    // String of all alphanumeric character
    $str_result = '0123456789';

    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(
        str_shuffle($str_result),
        0,
        $length_of_string
    );
}
// $prod_id = json_decode($pro)
$order_id = random_num(8);
if (!empty($fname) && !empty($lname) && !empty($email) && !empty($address) && !empty($state) && !empty($city)) {

    $checkQuery = $db->query("SELECT * FROM orders WHERE user_id = '$user_id' AND product_id = '$product_id' AND status = '0' ORDER BY id DESC LIMIT 1");
    if ($checkQuery->num_rows > 0) {
        echo "You have an existing order";
    } else {
        $check = $db->query("SELECT * FROM cart WHERE user_id = '$user_id' AND status = '0'");
        if ($check->num_rows <= 0) {
            echo "You have no item in cart";
        } else {
            $createquery = $db->query(
                "INSERT INTO orders (user_id, product_id, cart_id, amount_paid, order_id, address, city, state, date) VALUES('$user_id', '$product_id', '$cart_id', '$amount', '$order_id', '$address', '$city', '$state', NOW())"
            );

            if ($createquery) {
                sendemail($email);
                echo "success";
            } else {
                echo "Something went wrong!";
                // header("Location: login");
                // exit(); 
            }
        }
        exit();
        $db->close();
    }
} else {
    echo "All input fields are required!";
}
