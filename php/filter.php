<?php

include "../databases/db.php";
// $connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");

if(isset($_POST["action"]))
{
	$query = $db->query("SELECT * FROM stock WHERE status = '0'");
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= $db->query("AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'");
	}
	if(isset($_POST["brand"]))
	{
		$brand_filter = implode("','", $_POST["brand"]);
		$query .= $db->query("AND category_id IN('".$brand_filter."')");
	}
	// if(isset($_POST["color"]))
	// {
	// 	$color_filter = implode("','", $_POST["color"]);
	// 	$query .= $db->query("AND color IN('".$color_filter."')");
	// }
	if(isset($_POST["size"]))
	{
		$size_filter = implode("','", $_POST["size"]);
		$query .= $db->query("AND size IN('".$size_filter."')");
	}

	$total_row = $query->num_rows;
	$output = "";
	if($total_row > 0)
	{
		foreach($query as $row)
		{
			$output .= "
            <div class='col-lg-4 col-md-6 col-sm-6 pb-1'>
            <div class='product-item bg-light mb-4'>
                <a class='product-img position-relative overflow-hidden'href='/crest/detail/". $row['url'] ."'>
                    <img class='img-fluid w-100' src='/crest/uploads/items/". $row['image'] ."' alt='". $row['name'] ."'>
                </a>
                <div class='text-center py-4'>
                    <a class='h6 text-decoration-none text-truncate' href=''>". $row['name'] ."</a>
                    <div class='d-flex align-items-center justify-content-center mt-2'>
                        <h5>&#8358;". $row['price'] ."</h5>
                        <h6 class='text-muted ml-2'><del>&#8358;". $row['price'] ."</del></h6>
                    </div>
                    <div class='d-flex align-items-center justify-content-center mb-1'>
                        <small class='fa fa-star text-primary mr-1'></small>
                        <small class='fa fa-star text-primary mr-1'></small>
                        <small class='fa fa-star text-primary mr-1'></small>
                        <small class='fa fa-star text-primary mr-1'></small>
                        <small class='fa fa-star text-primary mr-1'></small>
                        <small>". $row['amount'] ."</small>
                    </div>
                </div>
            </div>
        </div>

			";
		}
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}


?>