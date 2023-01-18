<?php
require_once "databases/db.php";
require_once "databases/captcha.php";


// if (isset($_POST['login'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $email = htmlspecialchars($email);
    $email = strip_tags($email);
    $email = $db->real_escape_string($email);

    $password = htmlspecialchars($password);
    $password = strip_tags($password);
    $password = $db->real_escape_string($password);
    $user_ip_address = $_SERVER['REMOTE_ADDR'];
    $unique_id = uniqid();


    // $recaptchaResponse = $_POST['g-recaptcha-response'];
    // $request = "https://www.google.com/recaptcha/api/siteverify?secret={$secretkey}&response={$recaptchaResponse}&{$user_ip_address}";
    // $content = file_get_contents($request);
    // $json = json_decode($content);
    // if($json -> success == "true"){

    if(!empty($email) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

    $query = $db->query(
        "SELECT * from users WHERE email='$email' LIMIT 1"
    );
    if ($query->num_rows > 0) {
        $loginrow = $query->fetch_array();
        $hash = $loginrow['password'];
    $pass = password_verify($password, $hash);
if ($pass){
        if ($loginrow["verify_status"] !== "0") {

            $blocked = $loginrow['status'];
            if ($blocked != '1') {

                foreach ($query as $data) {
                    $user_id = $data["id"];
                    $email = $data["email"];
                    $fname = $data["fname"];
                    $lname = $data["lname"];
                    $usertype = $data["usertype"];
                }

                $_SESSION["auth"] = true;
                $_SESSION["auth_role"] = "$usertype";
                $_SESSION["auth_user"] = [
                    "id" => $user_id,
                    "email" => $email,
                    "fname" => $fname,
                    "lname" => $lname,
                    // 'user_image' => $user_image,
                ];
                $db->query("UPDATE users SET unique_id = '$unique_id' WHERE id = '{$_SESSION["auth_user"]["id"]}'");

                    setcookie("login", $unique_id, time()+60*60*24*15, "/");

                if ($_SESSION["auth_role"] == "1") {
                    echo "admin";
                    // header("Location: admin/");
                    // exit(0);
                } elseif ($_SESSION["auth_role"] == "0") {
                    echo "success";
                    // header("Location: index");
                    // exit(0);
                } elseif ($_SESSION["auth_role"] == "2") {
                    echo "admin";
                    // header("Location: admin/");
                    // exit(0);
                }
            } else {
                echo "You have been blocked";
                // header("Location: login");
            }
        } else {
            // $_SESSION['login_attempts'] += 1;
            echo
                "Please verify your email address to login";
            // header("Location: login");
            // exit();
        }
    }
    else{
        echo "Incorrect Password";
        // header("Location: login");
        // exit();
 
    }
    } else {
        echo "Incorrect Email";
        // header("Location: login");
        // exit();
    }
}else{
    echo "Invalid Email";
} 
}else{
    echo "All input fields are required!";
}
    // }else{
    //     echo "Are you really a robot?";
    // }
?>