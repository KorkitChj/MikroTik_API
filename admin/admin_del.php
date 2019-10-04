<?php
include('../includes/connect_db.php');
include('function.php');
if (isset($_POST['cus_id'])) {
	$cusid = $_POST['cus_id'];
	include('../site/function.php');
	$image = get_image_name($_POST["cus_id"]);
	function delete($conn, $image)
	{
		$output = array('success' => false, 'messages' => array());
		$statement = $conn->prepare(
			"DELETE FROM siteadmin WHERE cus_id = :cus_id"
		);
		if ($image != '') {
			$path = "../slips/" . $image;
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
			return $output;
		} else {
			$output['success'] = false;
			$output['messages'] = 'ไม่สามารถลบข้อมูลได้';
			return $output;
		}
	}
	$output = delete($conn, $image);
}
echo json_encode($output);
