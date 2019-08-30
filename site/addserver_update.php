<?php
session_start();
?>
<?php
error_reporting(0);
if($_POST){
    $name = $_POST["editname"];
    $interface= $_POST['editinterface'];
    $pool = $_POST['editpool'];
    $profile = $_POST['editprofile'];
    $edit_sv = $_POST['edit_sv'];

    include ('function.php');

    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];

    list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

    $output = array('success' => false, 'messages' => array());

    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        $ARRAY = $API->comm("/ip/hotspot/set",array(
            ".id" => $edit_sv,
            "name" => $name,
            "interface" => $interface,
            "address-pool" => $pool,
            "profile" => $profile
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