<?php
if($_POST){
    include('../include/connect_db.php');
    $output = array('messages' => array());
    $data = $_POST["data"];
    $emp_id = $_POST["emp_id"];

    $query = $conn->prepare("INSERT INTO packet_update VALUES ('',:emp_id,:comment)");
    $query->execute(array(
        ":emp_id" =>$emp_id,
        ":comment" =>$data
    ));
    $output['messages'] = "เพิ่มข้อมูลแล้ว";
}
echo json_encode($output);
?>