<?php
include('../includes/connect_db.php');
if (isset($_POST['order_id'])) {
	$orderid = $_POST['order_id'];
	function delete($conn, $orderid)
	{
		$output = array('success' => false, 'messages' => array());
		$statement = $conn->prepare(
			"DELETE FROM orderpd WHERE order_id = :order_id"
		);
		$result = $statement->execute(array(':order_id'	=>	$orderid));
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
	$output = delete($conn, $orderid);
}
echo json_encode($output);
