<?php
session_start();
?>
<?php
if ($_POST) {
    include('../include/connect_db.php');
    $cus_id = $_SESSION['cus_id'];
    $output = array('success' => false, 'messages' => array());

    $ipaddress = $_POST["ipaddress"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $portapi  = $_POST["portapi"];
    $namesite = $_POST["namesite"];

    $sql3 = "SELECT * FROM location WHERE ip_address = :ipaddress";
    $query3 = $conn->prepare($sql3);
    $query3->bindparam(':ipaddress', $ipaddress);
    $query3->execute();
    if ($query3->rowCount() != 0) {
        $output['success'] = false;
        $output['messages'] = "ไม่สามารถเพิ่มข้อมูลได้กรุณาเปลี่ยน IP Address";
    } else {
        try {
            $sql4 = "INSERT INTO  location VALUES
                    ('',:username,:password,:namesite,:portapi,:ipaddress,:cus_id)";
            $query4 = $conn->prepare($sql4);
            $query4->bindparam(':username', $username);
            $query4->bindparam(':password', $password);
            $query4->bindparam(':namesite', $namesite);
            $query4->bindparam(':portapi', $portapi);
            $query4->bindparam(':ipaddress', $ipaddress);
            $query4->bindparam(':cus_id', $cus_id);
            $query4->execute();
        } catch (PDOException $e) {
            $output['success'] = false;
            $output['messages'] = "ผิดพลาด";
        }
        if (empty($e)) {
            $output['success'] = true;
		    $output['messages'] = "เพิ่มข้อมูลแล้ว";	
        }
    }
}
echo json_encode($output);
?>
