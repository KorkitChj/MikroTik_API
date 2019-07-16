<?php
session_start();
?>
<?php
if ($_POST) {
    include('../include/connect_db.php');


    $output = array('success' => false, 'messages' => array());
    if (isset($_POST['type'])) {
        if ($_POST['type'] == 'one') {
            $location_id = $_POST['location_id'];
            $sql = "DELETE FROM location WHERE location_id = :location_id AND cus_id = :cus_id";
            $result =  $conn->prepare($sql);
            $result->bindparam(':location_id', $location_id);
            $result->bindparam(':cus_id',$_SESSION['cus_id']);
            $statement = $result->execute();
            if (!empty($statement)) {
                $output['success'] = true;
                $output['messages'] = "ลบข้อมูลแล้ว";
            } else {
                $output['success'] = false;
                $output['messages'] = "ผิดพลาด";
            }
        } elseif ($_POST['type'] == 'many') {
            $location_id = $_POST['location_id'];
            $location_id = implode(", ", $location_id);
            $sql = "DELETE FROM location WHERE location_id IN ($location_id) AND cus_id = :cus_id";
            $result = $conn->prepare($sql);
            $result->bindparam(':cus_id',$_SESSION['cus_id']);
            $statement = $result->execute();
            if (!empty($statement)) {
                $output['success'] = true;
                $output['messages'] = "ลบข้อมูลแล้ว";
            } else {
                $output['success'] = false;
                $output['messages'] = "ผิดพลาด";
            }
        }
    }
}
echo json_encode($output);
