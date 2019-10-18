<?php
//delete.php
include('../../includes/db_connect.php');
$output = array('success' => false, 'messages' => array());
if (isset($_POST["pu_id"])) {
    foreach ($_POST["pu_id"] as $pu_id) {
        $statement = $conn->prepare(
            "SELECT slip_name FROM packet_update WHERE puid = :pu_id"
        );
        $statement->execute(array(':pu_id'	=>	$pu_id));
        $image = $statement->fetch(PDO::FETCH_ASSOC);
        $image = $image['slip_name'];
        unlink('../../slips/'.$image);
        $query = "DELETE FROM packet_update WHERE puid = :pu_id";
        $result = $conn->prepare($query);
        $result->bindparam(':pu_id', $pu_id);
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
