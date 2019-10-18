<?php
include('../../includes/db_connect.php');
if (isset($_POST['pu_id'])) {
	$puid = $_POST['pu_id'];
	$statement = $conn->prepare(
		"SELECT slip_name FROM packet_update WHERE puid = :pu_id"
	);
	$statement->execute(array(':pu_id'	=>	$puid));
	$image = $statement->fetch(PDO::FETCH_ASSOC);
	$image = $image['slip_name'];
	unlink('../../slips/'.$image);
	function delete($conn, $puid)
	{
		$output = array('success' => false, 'messages' => array());
		$statement = $conn->prepare(
			"DELETE FROM packet_update WHERE puid = :pu_id"
		);
		$result = $statement->execute(array(':pu_id'	=>	$puid));
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
	$output = delete($conn, $puid);
}
echo json_encode($output);
