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
?>