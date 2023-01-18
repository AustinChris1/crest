<?php
include 'databases/db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_name,$get_email,$token){

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "server236.web-hosting.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;

    $mail->Username = "info@spectrawebx.xyz";
    $mail->Password = "Blabla789?";

    $mail->setFrom("info@spectrawebx.xyz", "Spectra Web-X");
    $mail->addAddress($get_email);

    //Content
    $mail->isHTML(true);                              
    $mail->Subject = "Reset Password Notification";

    $email_template ="
    <h2>Hello $get_name</h2>
     <h3>You are receiving this email because we received a password reset request for your account</h3>
  <br/><br/>
    <a href='http://localhost/crest/password_change?token=$token&email=$get_email'>Click Me</a>
    ";

    $mail->Body = $email_template;
    $mail->send();

}
if(isset($_POST['reset_password'])){
    $email = $_POST['email'];
    $email = $db->real_escape_string($email);
    $token = md5(rand());
    $check_email = $db->query("SELECT email, fname, lname FROM users WHERE email = '$email' LIMIT 1");
    if($check_email->num_rows>0)
{
    $row = $check_email->fetch_array();
    $get_name = $row['name'].' '.$row['lname'];
    $get_email = $row['email'];

    $update_token = $db->query("UPDATE users SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1");

    if($update_token){
        send_password_reset("$get_name","$get_email","$token");
        $_SESSION['message'] = "A password reset link has been sent to your email";
        header('location: forgot-password');
        exit();
     

    }
    else{
        $_SESSION['error'] = "Something went wrong!";
        header('location: forgot-password');
        exit();
     
    }
}
else{
    $_SESSION['error'] = "No email found";
    header('location: forgot-password');
    exit();
}
}


include "includes/nav.php";
include 'includes/message.php';
?>
<div class="container"></div>
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <button name="reset_password" type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <?php
include "includes/footer.php";
?>
