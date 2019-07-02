<?php
require_once('../include/connect_db.php');
require('function.php');
$output = array('success' => false, 'messages' => array());
if (isset($_POST['cus_id'])) {
	$cusid = $_POST['cus_id'];
	$image = get_image_name($_POST["cus_id"]);
	$statement = $conn->prepare(
		"DELETE FROM siteadmin WHERE cus_id = :cus_id"
	);
	if ($image != '') {
		$path = "../slips/".$image;
		if (file_exists($path)) {
			unlink("../slips/" . $image);
			$result = $statement->execute(array(':cus_id'	=>	$_POST["cus_id"]));
		} else {
			$result = $statement->execute(array(':cus_id'	=>	$_POST["cus_id"]));
		}
	} else {
		$result = $statement->execute(array(':cus_id'	=>	$_POST["cus_id"]));
	}
	if (!empty($result)) {
		$output['success'] = true;
		$output['messages'] = 'ลบข้อมูลแล้ว';
	} else {
		$output['success'] = false;
		$output['messages'] = 'ไม่สามารถลบข้อมูลได้';
	}
}
echo json_encode($output);
