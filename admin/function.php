<?php

/*function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './upload/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}*/

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

function get_total_all_records($data)
{
	include('../include/connect_db.php');
	if($data == "admin"){
		$statement = $conn->prepare("SELECT * FROM siteadmin");
		$statement->execute();
		return $statement->rowCount();
	}elseif($data == "payment"){
		$statement = $conn->prepare("SELECT a.cus_id,username,b.order_id,total_cash,
		slip_name,transfer_date,appointment
		FROM siteadmin AS a INNER JOIN orderpd AS b ON
		a.cus_id = b.cus_id INNER JOIN payment AS c ON
		b.order_id = c.order_id WHERE c.paid = 0 ");
		$statement->execute();
		return $statement->rowCount();
	}else{
		$statement = $conn->prepare("SELECT a.cus_id,username,site_name,total_cash,paid,
		slip_name,transfer_date,appointment
		FROM siteadmin AS a INNER JOIN orderpd AS b ON
		a.cus_id = b.cus_id INNER JOIN payment AS c ON
		b.order_id = c.order_id WHERE c.paid = 1");
		$statement->execute();
		return $statement->rowCount();
	}
}

function admin_image_profile($admin_image){  
	require('../include/connect_db.php');

    $query = $conn->prepare("SELECT image FROM admin  WHERE admin_id = :admin_id");
    $query->bindparam(':admin_id', $admin_image);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $image = '';
    if ($row["image"] != '') {
        $image = '<img src="image/' . $row["image"] . '"  style="height:70px;width:60px"/>';
    } else {
        $image = '<img src="image/iconuser.jpg" alt="user" style="height:70px;width:60px">';
    }
    return $image;
}
function upload_imageadmin()
{
	if(isset($_FILES["image"]))
	{
		$extension = explode('.', $_FILES['image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = 'image/' . $new_name;
		move_uploaded_file($_FILES['image']['tmp_name'], $destination);
		return $new_name;
	}
}
function fetchsiteimage($cus_id)
{
    require('../include/connect_db.php');

    $query = $conn->prepare("SELECT image FROM siteadmin  WHERE cus_id = :cus_id");
    $query->bindparam(':cus_id', $cus_id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $image = '';
    if ($row["image"] != '') {
        $image = '<img src="../siteadmin/image/' . $row["image"] . '"  style="height:70px;width:60px"/>';
    } else {
        $image = '<img src="../siteadmin/image/iconuser.jpg" alt="user" style="height:70px;width:60px">';
    }
    return $image;
}
?>