<?php

require_once("databases/db.php");

$select_User = $db->query("SELECT * FROM users WHERE usertype = '1'");
if($select_User->num_rows<=0){

}else{
    foreach($select_User as $user){
        $bal = $user['bal'] + 200;
        $uid = $user['id'];
    $update = $db->query("UPDATE users SET bal = '$bal' WHERE id = '$uid'");
    if($update){
        echo "Success";
    }else{
        echo "failed";
    }
    }
}
$db->close();
?>