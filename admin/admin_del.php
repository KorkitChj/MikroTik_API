<?php
require('../include/connect_db.php');
require('function.php');

if (isset($_POST['cus_id'])) {

	$cusid = $_POST['cus_id'];

	require('../site/function.php');

	$query = $conn->prepare("SELECT * FROM siteadmin AS a INNER JOIN location AS b ON a.cus_id = b.cus_id WHERE a.cus_id = :cus_id");

	$query->execute(array(':cus_id' => $cusid));

	$result1 = $query->fetch(PDO::FETCH_ASSOC);

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

	if ($query->rowCount() == 0) {
		$output = delete($conn, $image);
	} else {
		$location_id = $result1['location_id'];

		$query = $conn->prepare("SELECT * FROM employee WHERE location_id = :location_id");

		$query->execute(array(':location_id' => $location_id));

		$result2 = $query->fetchAll();

		list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cusid, $location_id);

		try {
			if ($API->connect($ip . ":" . $port, $user, $pass)) { } else {
				$disconnect = "disconnect";
				throw new customException($disconnect);
			}

			foreach ($result2 as $pass_router) {
				$ARRAY = $API->comm("/user/remove", array(
					"numbers" => $pass_router['pass_router'],
				));
			}
		} catch (customException $e) {
			$output = delete($conn, $image);
		}
		if (empty($e)) {
			$output = delete($conn, $image);
		}
	}
}
echo json_encode($output);
