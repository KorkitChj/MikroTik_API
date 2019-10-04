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
    require('../includes/connect_db.php');

    $query = $conn->prepare("SELECT image FROM siteadmin  WHERE cus_id = :cus_id");
    $query->bindparam(':cus_id', $cus_id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $image = '';
    if ($row["image"] != '') {
        $image = '<img src="image/' . $row["image"] . '"  style="border-radius:50%"/>';
    } else {
        $image = '<img src="image/iconuser.jpg" alt="user" style="border-radius:50%">';
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
	include('../includes/connect_db.php');
	$query = $conn->prepare("SELECT product_id FROM orderpd AS a INNER JOIN siteadmin AS b
        on a.cus_id = b.cus_id WHERE a.cus_id = :cus_id ");
        $query->execute(array(":cus_id" => $_SESSION["cus_id"]));
		$result = $query->fetch(PDO::FETCH_ASSOC);
		if($result['product_id'] == 1){
			return "ราคา 500 บาท ID 1";
		}else if($result['product_id'] == 2){
			return "ราคา 1000 บาท ID 2";
		}else if($result['product_id'] == 3){
			return "ราคา 200 บาท ID 3";
		}else if($result['product_id'] == 4){
			return "ราคา 300 บาท ID 4";
		}else if($result['product_id'] == 5){
			return "ราคา 400 บาท ID 5";
		}else if($result['product_id'] == 6){
			return "ราคา 600 บาท ID 6";
		}else if($result['product_id'] == 7){
			return "ราคา 700 บาท ID 7";
		}else if($result['product_id'] == 8){
			return "ราคา 800 บาท ID 8";
		}else if($result['product_id'] == 9){
			return "ราคา 900 บาท ID 9";
		}else if($result['product_id'] == 10){
			return "ราคา 1500 บาท ID 10";
		}else if($result['product_id'] == 11){
			return "ราคา 2000 บาท ID 11";
		}
}
?>