<?php
function upload_image()
{
	if(isset($_FILES["site_image"]))
	{
		$extension = explode('.', $_FILES['site_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../employee/sitelogo/' . $new_name;
		move_uploaded_file($_FILES['site_image']['tmp_name'], $destination);
		return $new_name;
	}elseif(isset($_FILES["editsite_image"])){
		$extension = explode('.', $_FILES['editsite_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../employee/sitelogo/' . $new_name;
		move_uploaded_file($_FILES['editsite_image']['tmp_name'], $destination);
		return $new_name;
	}
}
function fetchimage($cus_id)
{
    require('../include/connect_db.php');

    $query = $conn->prepare("SELECT image FROM siteadmin  WHERE cus_id = :cus_id");
    $query->bindparam(':cus_id', $cus_id);
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
function upload_imagepacket()
{
	if(isset($_FILES["fileslip"]))
	{
		$extension = explode('.', $_FILES['fileslip']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../slips/' . $new_name;
		move_uploaded_file($_FILES['fileslip']['tmp_name'], $destination);
		return $new_name;
	}
}
function fetch_packet()
{
	include('../include/connect_db.php');
	$query = $conn->prepare("SELECT product_id FROM orderpd AS a INNER JOIN siteadmin AS b
        on a.cus_id = b.cus_id WHERE a.cus_id = :cus_id ");
        $query->execute(array(":cus_id" => $_SESSION["cus_id"]));
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result['product_id'];
}
?>