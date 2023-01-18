<?php
	        include_once "databases/db.php";
	        $uid = $_SESSION['auth_user']['id'];
setcookie("login", $uid, time()-60*60*24*30, "/");
	unset($_SESSION['auth']);
	unset($_SESSION['auth_role']);
	unset($_SESSION['auth_user']);
	$_SESSION['message'] = "You have logged out successfully";
	header('Location: /crest/login');
	exit();

?>