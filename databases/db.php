<?php 
	$db = new mysqli('localhost','root','','crest') or die('error with connection');
	session_start();
    if(isset($_COOKIE['login'])){
        $cookie_id = $_COOKIE['login'];
        $cookie_query = $db->query("SELECT * FROM users WHERE unique_id = '$cookie_id'");
        $d = $cookie_query->fetch_array();
        $check = json_encode($d);

        if($check == 'null'){
            setcookie("login", $cookie_id, time() - 60 * 60 * 24 * 15, "/");
            session_destroy();
            unset($_SESSION["auth"]);
            unset($_SESSION["auth_role"]);
            unset($_SESSION["auth_user"]);
            echo "Invalid cookie, <a href='/crest/login'>Login again</a>";
            exit();

        }else{
        $_SESSION['auth'] = true;
        foreach ($cookie_query as $cookie_data) {
            $user_id = $cookie_data["id"];
            $fname = $cookie_data["fname"];
            $lname = $cookie_data["lname"];
            $email = $cookie_data["email"];
            $usertype = $cookie_data["usertype"];
        }
        $_SESSION["auth_role"] = "$usertype";
        $_SESSION["auth_user"] = [
            "id" => $user_id,
            "fname" => $fname,
            "lname" => $lname,
            "email" => $email,
        ];
    }
    }

    ?>