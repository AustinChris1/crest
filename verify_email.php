<?php
include 'databases/db.php';

if(isset($_GET['token'])){
$token = $_GET['token'];
$verifyquery = $db->query("SELECT verify_token, verify_status FROM users WHERE verify_token='$token' LIMIT 1");
if($verifyquery->num_rows>0){
$tokenrow = $verifyquery->fetch_array();

if($tokenrow['verify_status'] == "0"){
    $clicked_token = $tokenrow['verify_token'];
    $updatetokenquery = $db->query("UPDATE users SET verify_status='1' WHERE verify_token = '$clicked_token' LIMIT 1");
    
    if($updatetokenquery){
        $_SESSION['message'] = "Your account has been verified, You can now login.";
        header('location: login');
        exit();

    }
    else{
        $_SESSION['message'] = "Verification Failed!";
        header('location: login');
        exit();
    
    }
}
else{
    $_SESSION['message'] = "Account is already verified. Please login.";
    header('location: login');
    exit();

}
}
else{
    $_SESSION['message'] = "This token does not exist";
    header('location: register');
    exit();
}
}
else{
    $_SESSION['message'] = "Please verify your email";
    header('location: register');
    exit();
}
?>