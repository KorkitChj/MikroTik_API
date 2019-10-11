<?php
include('../../includes/db_connect.php');
$output = array('success' => false, 'messages' => array());
if (isset($_POST['order_id'])) {
    $id = $_POST['order_id'];
    $sql = "UPDATE payment SET paid = 1 WHERE order_id = :id";
    $result =  $conn->prepare($sql);
    $result->bindparam(':id', $id);
    $result->execute();
    if(!empty($result)) {
        $output['success'] = true;
		$output['messages'] = 'ยืนยันข้อมูลแล้ว';
    }else{
        $output['success'] = false;
		$output['messages'] = 'ไม่สามารถยืนยันข้อมูลได้';
    }
}
echo json_encode($output);