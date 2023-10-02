<?php
include 'databases/db.php';
include "databases/captcha.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';


function sendemail_verify($name, $email, $verify_token)
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
    $mail->Subject = "Crest Management Email Verification";

    $email_template = "
  <h2>Hello $name, Welcome to Crest Management</h2>
  <img src='https://unsplash.it/801' width='200px' height='200px'>
  <h5>Thanks for your registration.<br> Please verify your email address by clicking the button below</h5><br/><br/>
  <a style='background-color:orange; color:white; padding: 2px 2px 2px 2px ' href='http://localhost/crest/verify_email?token=$verify_token'>Verify my account</a>

  ";

    $mail->Body = $email_template;
    $mail->send();
}

// if(isset($_POST['register'])){


$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$phone = $_POST['phone'];


$fname = htmlentities($fname);
$fname = strip_tags($fname);
$fname = $db->real_escape_string($fname);

$email = htmlentities($email);
$email = strip_tags($email);
$email = $db->real_escape_string($email);

$lname = htmlentities($lname);
$lname = strip_tags($lname);
$lname = $db->real_escape_string($lname);

$password = htmlentities($password);
$password = strip_tags($password);
$password = $db->real_escape_string($password);

$phone = htmlentities($phone);
$phone = strip_tags($phone);
$phone = $db->real_escape_string($phone);
$user_ip_address = $_SERVER['REMOTE_ADDR'];

$_SESSION['email'] = $email;
$verify_token = md5(rand());
$recaptchaResponse = $_POST['g-recaptcha-response'];
$request = "https://www.google.com/recaptcha/api/siteverify?secret={$secretkey}&response={$recaptchaResponse}&{$user_ip_address}";
$content = file_get_contents($request);
$json = json_decode($content);
// if ($json->success == "true") {

    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !empty($phone)) {
        if ($password == $confirm_password) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = $db->query("SELECT * FROM users WHERE email='$email'");
            //check if query equal to one
            if ($query->num_rows > 0) {
                echo "Email already exists";
                // header("Location: index");
                // exit();
            } else {
                $pquery = $db->query("SELECT * FROM users WHERE phone='$phone'");
                //check if query equal to one
                if ($pquery->num_rows > 0) {
                    echo "Phone number already exists";
                    // header("Location: index");
                    // exit();
                } else {

                    //inserting data
                    $createquery = $db->query(
                        "INSERT INTO users (fname, lname, email, phone, password, verify_token, date) VALUES('$fname', '$lname', '$email','$phone', '$hashed_password', '$verify_token', NOW())"
                    );

                    if ($createquery) {
                        sendemail_verify($fname . ' ' . $lname, $email, $verify_token);
                        echo "success";
                        // header("Location: email_verify");
                        // exit();
                    } else {
                        echo "Something went wrong!";
                        // header("Location: login");
                        // exit(); 
                    }
                    exit();
                }
            }
        }else{
            echo "Invalid Email";
        }
        } else {
            echo "Password does not match";
            // header("Location: login");
            // exit();

        }
        $db->close();
    } else {
        echo "All input fields are required!";
    }
// } else {
//     echo "Are you really a robot?";
// }
