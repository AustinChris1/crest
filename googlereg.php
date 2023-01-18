<?php
// Google register
require_once 'vendor/autoload.php';
// init configuration
require_once 'databases/db.php';

$clientID = '175487070765-tllbo4nhfjfctpre680j3b0oruc110p0.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/crest/googlereg';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Google register
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
  
    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $userinfo = [
      "email" => $google_account_info['email'],
      "fname" => $google_account_info['givenName'],
      "lname" => $google_account_info['familyName'],
      "picture" => $google_account_info['picture'],
      "verifiedEmail" => $google_account_info['verifiedEmail'],
      "token" => $google_account_info['id']
    ];
   
    $image = $userinfo['picture'];
    $img = file_get_contents($image);
    $image_name = time().".jpg";
$file_path = "uploads/user_images/".$image_name;

file_put_contents($file_path, $img, FILE_APPEND);


    $googleQuery = $db->query("SELECT * FROM users WHERE email='{$userinfo['email']}'");
    if ($googleQuery->num_rows > 0){
      $loginrow = $googleQuery->fetch_array();
      $blocked = $loginrow['status'];
      if ($blocked != 1) {

          foreach ($googleQuery as $data) {
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

          if ($_SESSION["auth_role"] == "1") {
              $_SESSION["message"] =
                  "Hello Admin, Welcome To Dashboard";
              header("Location: admin/");
              exit(0);
          } elseif ($_SESSION["auth_role"] == "0") {
              $_SESSION["message"] = "Login Successful";
              header("Location: index");
              exit(0);
          } elseif ($_SESSION["auth_role"] == "2") {
              $_SESSION["message"] =
                  "Hello Admin, Welcome To Dashboard";
              header("Location: admin/");
              exit(0);
          }
      } else {
          $_SESSION["error"] = "You have been blocked";
          header("Location: login");
          exit();
      }

    }
    else{
      $createGquery = $db->query(
        "INSERT INTO users (fname, lname, email, user_image, verify_token, verify_status) VALUES('{$userinfo['fname']}', '{$userinfo['lname']}', '{$userinfo['email']}','$image_name', '{$userinfo['token']}', '3')"
    );
  
    if($createGquery){
        
        $_SESSION["message"] = "Registration Successful";
header("Location: index");
    exit();
    }
    else{
        $_SESSION["error"] = "Something went wrong!";
  header("Location: login");
        exit(); 
    }
    exit();
  }
  
  $db->close();
  
}


?>