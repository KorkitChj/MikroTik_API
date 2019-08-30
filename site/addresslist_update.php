<?php
session_start();
?>
<?php
error_reporting(0);
if($_POST){
    $address = $_POST["editaddress"];
    $network= $_POST['editnetwork'];
    $interface = $_POST['editinterface'];
    $comment = $_POST['editcomment'];
    $id = $_POST['editip_address'];

    include ('function.php');

    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];

    list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

    $output = array('success' => false, 'messages' => array());

    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        $ARRAY = $API->comm("/ip/address/set",array(
            ".id" => $id,
            "address" => $address,
            "network" => $network,
            "interface" => $interface,
            "comment" => $comment
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