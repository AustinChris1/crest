<?php

//submit_rating.php
include "../databases/db.php";

if(isset($_POST["rating_data"]))
{

    $name	=$db->real_escape_string($_POST["name"]);
    $email	=$db->real_escape_string($_POST["email"]);
    $user_id	=$db->real_escape_string($_POST["user_id"]);
    $product_id	=$db->real_escape_string($_POST["product_id"]);
$rating = $db->real_escape_string($_POST["rating_data"]);
$review = $db->real_escape_string($_POST["review"]);

	$db->query("INSERT INTO review_table (user_id, product_id, name, email, rating, review, date) VALUES ('$user_id', '$product_id', '$name', '$email', '$rating', '$review', NOW())");

	echo "success";

}

if(isset($_POST["action"]))
{
    $user_id	=$_POST["user_id"];
    $product_id	=$_POST["product_id"];
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_rating = 0;
	$review_content = array();

	$connect = $db->query("SELECT * FROM review_table WHERE product_id = '$product_id' ORDER BY id DESC");

	// $result = $connect->fetch_assoc();

	foreach($connect as $row)
	{
		$review_content[] = array(
			'name'		=>	$row["name"],
			'review'	=>	$row["review"],
			'rating'		=>	$row["rating"],
			'datetime'		=>	$row["date"]
		);

		if($row["rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_rating = $total_rating + $row["rating"];

	}

	$average_rating = $total_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}
