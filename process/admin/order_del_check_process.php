<?php
//delete.php
require('../../includes/db_connect.php');
$output = array('success' => false, 'messages' => array());
if (isset($_POST["order_id"])) {
    foreach ($_POST["order_id"] as $order_id) {
        $query = "DELETE FROM orderpd WHERE order_id = :order_id";
        $result = $conn->prepare($query);
        $result->bindparam(':order_id', $order_id);
        $result->execute();
    }
    if (!empty($result)) {
        $output['success'] = true;
        $output['messages'] = 'ลบข้อมูลที่เลือกแล้ว';
    } else {
        $output['success'] = false;
        $output['messages'] = 'ไม่สามารถลบข้อมูลที่เลือกได้';
    }
}
echo json_encode($output);
