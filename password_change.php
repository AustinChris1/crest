<?php
include 'databases/db.php';


if(isset($_POST['change_password'])){
    $email = $db->real_escape_string($email);
    $email = $_POST['email'];

    $new_password = $db->real_escape_string($new_password);
    $new_password = $_POST['new_password'];

    $confirm_password = $db->real_escape_string($confirm_password);
    $confirm_password = $_POST['confirm_password'];


    $token = $db->real_escape_string($token);
    $token = $_POST['password_token'];

    if(!empty($token))
    {
        if(!empty($email) && !empty($new_password) && !empty($confirm_password))
        {
            //check if token is valid or not
            $check_token = $db->query("SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1");
            
            if($check_token->num_rows>0)
            {
                if($new_password == $confirm_password)
                {
                    $new_password = password_hash($new_password, PASSWORD_DEFAULT);

                    $update_password = $db->query("UPDATE users SET password = '$new_password' WHERE verify_token = '$token' LIMIT 1");
                    

                    if($update_password)
                    {
                        $new_token = md5(rand())."spectrawebx";
                        $update_to_new_token = $db->query("UPDATE users SET verify_token = '$new_token' WHERE verify_token = '$token' LIMIT 1");

                        $_SESSION['message'] = "New password updated successfully";
                        header("location: login");
                        exit();
    
                    }
                    else{
                        $_SESSION['message'] = "Something went wrong! Password did not update";
                        header("location: password_change?token=$token&email=$email");
                        exit();
    
                    }
                }
                else
                {
                    $_SESSION['message'] = "Password does not match";
                    header("location: password_change?token=$token&email=$email");
                    exit();
    
                }
            }
            else
            {
                $_SESSION['message'] = "Invalid token";
                header("location: password_change?token=$token&email=$email");
                exit();
            
            }
        }
        else
        {
            $_SESSION['message'] = "All fields are required";
            header("location: password_change?token=$token&email=$email");
            exit();
    
        }
    }
    else
    {
        $_SESSION['message'] = "No token available";
        header("location: password_reset");
        exit();

    }
}
include 'includes/nav.php';
?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <?php
                    include 'includes/message.php';
                    ?>
                    <div class="card-header">
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="password_change.php" method="post">
                            <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){ echo $_GET['token'];}?>">
                        <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="text" readonly value="<?php if(isset($_GET['email'])){ echo $_GET['email'];}?>" name="email" class="form-control" required placeholder="Enter Email Address">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">New Password</label>
                                <input type="text" name="new_password" class="form-control" required placeholder="Enter New Password">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Confirm Password</label>
                                <input type="text" name="confirm_password" class="form-control" required placeholder="Enter Confirm Password">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="change_password" class="btn btn-primary w-100">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<?php
include 'includes/footer.php';
?>
