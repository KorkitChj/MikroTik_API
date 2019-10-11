<?php
session_start();
?>
<?php
if ($_POST) {
    include('../../includes/db_connect.php');
    $output = array('success' => false, 'messages' => array());
    if (isset($_POST['type'])) {
        if ($_POST['type'] == 'one') {
            $location_id = $_POST['location_id'];
            $sql = "SELECT * FROM location WHERE location_id = :location_id";
            $query = $conn->prepare($sql);
            $query->bindparam(':location_id', $location_id);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            unlink('../../img/sitelogo/'.$row['image_site'].'');
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
            $location_id2 = explode(", ",$location_id);
            foreach($location_id2 as $xx){
                $sql = "SELECT * FROM location WHERE location_id = :xx";
                $query = $conn->prepare($sql);
                $query->bindparam(':xx', $xx);
                $query->execute();
                $row = $query->fetch(PDO::FETCH_ASSOC);
                unlink('../../img/sitelogo/'.$row['image_site'].'');
            }
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
