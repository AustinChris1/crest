<?php

$image = "https://lh3.googleusercontent.com/a/AEdFTp5PwqnM7o6TdiwKxunRTr1DYpokArU-6wndKCVk=s96-c";

$img = file_get_contents($image);
$file_path = "uploads/user_images/".time().".jpg";

file_put_contents($file_path, $img, FILE_APPEND);


?>