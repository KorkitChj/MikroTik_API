<?php
session_start();
?>
<?php
error_reporting(0);
if($_POST){
    $name = $_POST["editname"];
    $address= $_POST['edithotadd'];
    $dns = $_POST['editdns'];
    $rate = $_POST['editrate'];
    $id = $_POST['edit_sp'];

    include ('function.php');

    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];

    list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

    $output = array('success' => false, 'messages' => array());

    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        $ARRAY = $API->comm("/ip/hotspot/profile/set",array(
            ".id" => $id,
            "name" => $name,
            "hotspot-address" => $address,
            "dns-name" => $dns,
            "rate-limit" => $rate
        ));
            $output['success'] = true;
            $output['messages'] = "แก้ไขข้อมูลแล้ว";
    }
    else
    {
        $output['success'] = false;
        $output['messages'] = "กรุณารีเฟสหน้าจอ หรือ เชื่อมต่อไซต์ใหม่";
    }
}
echo json_encode($output);
?>