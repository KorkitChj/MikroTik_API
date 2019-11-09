<?php
function get_image_name($cus_id)
{
	include('../../includes/db_connect.php');
	$statement = $conn->prepare("SELECT slip_name FROM payment AS a INNER JOIN orderpd AS b 
	ON a.order_id = b.order_id INNER JOIN siteadmin AS c ON b.cus_id = c.cus_id WHERE c.cus_id = :cus_id");
	$statement->bindparam(':cus_id', $cus_id);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		return $row["slip_name"];
	}
}

function get_total_all_records($data)
{
	include('../../includes/db_connect.php');
	if ($data == "admin") {
		$statement = $conn->prepare("SELECT * FROM siteadmin");
		$statement->execute();
		return $statement->rowCount();
	} elseif ($data == "payment") {
		$statement = $conn->prepare("SELECT a.cus_id,username,b.order_id,total_cash,
		slip_name,transfer_date,appointment
		FROM siteadmin AS a INNER JOIN orderpd AS b ON
		a.cus_id = b.cus_id INNER JOIN payment AS c ON
		b.order_id = c.order_id WHERE c.paid = 0 ");
		$statement->execute();
		return $statement->rowCount();
	} elseif ($data == "upgrade") {
		$statement = $conn->prepare("SELECT a.cus_id,a.username,b.payment_at,b.transfer_date,b.amount,b.slip_name,b.time_required
		FROM siteadmin AS a INNER JOIN packet_update AS b ON a.cus_id = b.cus_id");
		$statement->execute();
		return $statement->rowCount();
	} elseif ($data == "product") {
		$statement = $conn->prepare("SELECT * FROM product");
		$statement->execute();
		return $statement->rowCount();
	} else {
		$statement = $conn->prepare("SELECT a.cus_id,username,site_name,total_cash,paid,
		slip_name,transfer_date,appointment
		FROM siteadmin AS a INNER JOIN orderpd AS b ON
		a.cus_id = b.cus_id INNER JOIN payment AS c ON
		b.order_id = c.order_id WHERE c.paid = 1");
		$statement->execute();
		return $statement->rowCount();
	}
}

function admin_image_profile($admin_image)
{
	include('../includes/db_connect.php');

	$query = $conn->prepare("SELECT image FROM admin  WHERE admin_id = :admin_id");
	$query->bindparam(':admin_id', $admin_image);
	$query->execute();
	$row = $query->fetch(PDO::FETCH_ASSOC);
	$image = '';
	if ($row["image"] != '') {
		$image = '<img src="../img/img_admin/' . $row["image"] . '"  style="border-radius:50%"/>';
	} else {
		$image = '<img src="../img/img_admin/iconuser.jpg" alt="user" style="border-radius:50%"/>';
	}
	return $image;
}
function upload_imageadmin()
{
	if (isset($_FILES["image"])) {
		$extension = explode('.', $_FILES['image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../../img/img_admin/' . $new_name;
		move_uploaded_file($_FILES['image']['tmp_name'], $destination);
		return $new_name;
	}
}
function upload_image_product()
{
	if (isset($_FILES["product_image"])) {
		$extension = explode('.', $_FILES['product_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../../img/products/' . $new_name;
		move_uploaded_file($_FILES['product_image']['tmp_name'], $destination);
		return $new_name;
	} elseif (isset($_FILES["editproduct_image"])) {
		$extension = explode('.', $_FILES['editproduct_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../../img/products/' . $new_name;
		move_uploaded_file($_FILES['editproduct_image']['tmp_name'], $destination);
		return $new_name;
	}
}
function fetchsiteimage($cus_id)
{
	include('../../includes/db_connect.php');

	$query = $conn->prepare("SELECT image FROM siteadmin  WHERE cus_id = :cus_id");
	$query->bindparam(':cus_id', $cus_id);
	$query->execute();
	$row = $query->fetch(PDO::FETCH_ASSOC);
	$image = '';
	if ($row["image"] != '') {
		$image = '<img src="../img/site_admin/' . $row["image"] . '" width="50px" style="border-radius:50%" />';
	} else {
		$image = '<img src="../img/site_admin/iconuser.jpg" alt="user" width="50px" style="border-radius:50%"/>';
	}
	return $image;
}
function get_total_all_order_records()
{
	include('../../includes/db_connect.php');
	$statement = $conn->prepare("SELECT b.order_id,c.product_name,c.price,b.appointment,a.username 
		FROM siteadmin a 
		INNER JOIN orderpd b on a.cus_id = b.cus_id 
		INNER JOIN product c on c.product_id = b.product_id");
	$statement->execute();
	return $statement->rowCount();
}
function delNoOrder($cus_id)
{
	include('../../includes/db_connect.php');
	$image = get_image_name($cus_id);
	$query = "DELETE FROM siteadmin WHERE cus_id = :cus_id";
	$result = $conn->prepare($query);
	$result->bindparam(':cus_id', $cus_id);
	if ($image != '') {
		$path = "../../slips/" . $image;
		if (file_exists($path)) {
			unlink("../../slips/" . $image);
			$result->execute();
		} else {
			$result->execute();
		}
	} else {
		$result->execute();
	}
}
function userSuccess()
{
	include('../../includes/db_connect.php');
	$statement2 = $conn->prepare("SELECT * FROM siteadmin A 
INNER JOIN orderpd B on A.cus_id = B.cus_id 
INNER JOIN payment C on B.order_id = C.order_id WHERE C.paid = 1");
	$statement2->execute();
	$result2 = $statement2->fetchAll();
	$ool = array();
	foreach ($result2 as $val3) {
		$ool[] = $val3['cus_id'];
	}
	return $ool;
}
