<?php

function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './upload/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($cus_id)
{
	include('../include/connect_db.php');
	$statement = $conn->prepare("SELECT slip_name FROM payment AS a INNER JOIN orderpd AS b 
	ON a.order_id = b.order_id INNER JOIN siteadmin AS c ON b.cus_id = c.cus_id WHERE c.cus_id = :cus_id");
	$statement->bindparam(':cus_id',$cus_id);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["slip_name"];
	}
}

function get_total_all_records()
{
	include('../include/connect_db.php');
	$statement = $conn->prepare("SELECT * FROM siteadmin");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function admin_image_profile($admin_image){  
	if($admin_image == "kao"){
		return'<img src="../img/korkit.jpg" style="width:60px;height:70px">';
	}elseif($admin_image == "noon"){
		return'<img src="../img/nnnn.jpg">';
	}else{
		return '<img src="../img/bbbb.jpg">';
	}
}
?>