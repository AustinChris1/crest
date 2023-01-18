<?php

if (!isset($_SESSION["auth"]) || $_SESSION["auth_role"] == "0") {
    $_SESSION["message"] = "You are not Authorized As Admin";
    echo "<script>window.location='/crest/'</script>";

    exit();
}
?>
