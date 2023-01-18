<?php
include "includes/nav.php";
require_once "includes/message.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require "vendor/autoload.php";

function resend_email_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "server236.web-hosting.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;

    $mail->Username = "info@spectrawebx.xyz";
    $mail->Password = "Blabla789?";

    $mail->setFrom("info@spectrawebx.xyz", "Crest Management");
    $mail->addAddress($email);
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);
    $mail->Subject = "Crest Management Email Verification";

    $email_template = "
    <h2>Hello $name, You have registered with Crest Management</h2>
    <h5>Verify your email address with the link given below</h5><br/><br/>
    <a href='http://localhost/crest/verify-email.php?token=$verify_token'>Click Me</a>
    ";

    $mail->Body = $email_template;
    $mail->send();
}

if (isset($_POST["resend_email_verify_btn"])) {
    $email = $_SESSION["email"];
    $email = $db->real_escape_string($email);

    $email_query = $db->query(
        "SELECT * FROM users WHERE email = '$email' LIMIT 1"
    );

    if ($email_query->num_rows > 0) {
        $row = $email_query->fetch_array();
        if ($row["verify_status"] == "0") {
            $name = $row["fname"].' '.$row["lname"];
            $email = $row["email"];
            $verify_token = $row["verify_token"];
            resend_email_verify("$name", "$email", "$verify_token");
            $_SESSION["message"] =
                "Email link verification link has been sent to your email address";
            echo "<script>location.href='login'</script>";
            exit();
        } else {
            $_SESSION["error"] = "Email is already verified. Please login.";
            echo "<script>location.href='login'</script>";
            exit();
        }
    } else {
        $_SESSION["error"] = "Email is not registered. Please register now!";
        echo "<script>location.href='register'</script>";
        exit();
    }
}

?>
<div class="container-fluid">

    <div class="row px-xl-5">
        <img src="email-v1.gif" alt="" class="emailimg img-fluid w-50">
        <p class="verify">Registration Successful!<br>
    Please verify your email to login</p>
<br>
<form action="" method="post">
<p class="resend">Did not receive your verification email? <button type="submit" name='resend_email_verify_btn'>Resend</button></p>
</form>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <?php include "includes/footer.php"; ?>      
<style>
    .page{
        margin-top: 7rem;
        width: 100%;
        height: 100%;
        background-color: #fff;
    }
    .emailimg{
        display: flex;
        align-content: center;
        align-self: center;
        margin: auto;
        justify-self: center;
    }
    .verify{
        text-align: center;
        display: block;
        align-content: center;
        align-self: center;
        margin-top: 5rem;
        justify-self: center;
        color: orange;
        font-size: 15px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }
    .resend{
        text-align: center;
        display: block;
        align-content: center;
        align-self: center;
        justify-self: center;
        color: black;
        font-size: 15px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }
    .resend button{
        color: blue;
        outline: none;
        border: none;
        -webkit-appearance: none;
    -moz-appearance: none;
    }
</style>