<?php
session_start();
?>
<?php
if ($_POST) {
    include('../../includes/db_connect.php');
    include('function.php');
    $output = array('success' => false, 'messages' => array());

    if (isset($_POST["editlocation_id"])) {
        $location_id = $_POST["editlocation_id"];
    }
    $image = '';
    if ($_FILES["editsite_image"]["name"] != '') {
        $image = upload_image();
        unlink('../../img/sitelogo/'.$_POST["hidden_site_image"].'');
    } else {
        $image = $_POST["hidden_site_image"];
    }
    $ipaddress = $_POST["editipaddress"];
    $username = $_POST["editusername"];
    $password = $_POST["editpassword"];
    $portapi  = $_POST["editportapi"];
    $namesite = $_POST["editnamesite"];

    $sql = "SELECT * FROM location WHERE ip_address = :ipaddress";
    $query = $conn->prepare($sql);
    $query->bindparam(':ipaddress', $ipaddress);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if ($result['ip_address'] == $ipaddress) {
        try {
            $sql = "UPDATE location SET ip_address = :ipaddress,username= :username
            ,password= :password ,api_port= :portapi,working_site= :namesite,image_site =:image_site WHERE location_id = :location_id";
            $query = $conn->prepare($sql);
            $query->bindparam(':ipaddress', $ipaddress);
            $query->bindparam(':username', $username);
            $query->bindparam(':password', $password);
            $query->bindparam(':namesite', $namesite);
            $query->bindparam(':portapi', $portapi);
            $query->bindparam(':image_site', $image);
            $query->bindparam(':location_id', $location_id);
            $query->execute();
        } catch (PDOException $e) {
            $output['success'] = false;
            $output['messages'] = "ไม่สามารถเพิ่มข้อมูลได้กรุณาเปลี่ยน IP Address";
        }
        if (empty($e)) {
            $output['success'] = true;
            $output['messages'] = "แก้ไขข้อมูลแล้ว";
        }
    } else {
        try {
            $sql = "UPDATE location SET ip_address= :ipaddress,username= :username
            ,password= :password ,api_port= :portapi,working_site= :namesite,image_site =:image_site WHERE location_id = :location_id";
            $query = $conn->prepare($sql);
            $query->bindparam(':username', $username);
            $query->bindparam(':password', $password);
            $query->bindparam(':namesite', $namesite);
            $query->bindparam(':portapi', $portapi);
            $query->bindparam(':ipaddress', $ipaddress);
            $query->bindparam(':image_site', $image);
            $query->bindparam(':location_id', $location_id);
            $query->execute();
        } catch (PDOException $e) {
            $output['success'] = false;
            $output['messages'] = "ผิดพลาด";
        }
        if (empty($e)) {
            $output['success'] = true;
            $output['messages'] = "แก้ไขข้อมูลแล้ว";
        }
    }
}
echo json_encode($output);
?>
