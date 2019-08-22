<?php
session_start();
?>
<?php
error_reporting(0);
if($_POST){
    $name = $_POST["editname"];
    $ranges= $_POST['editranges'];
    $nextpool = $_POST['editnextpool'];
    $ippool = $_POST['edit_ippool'];

    include ('function.php');

    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];

    list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

    $output = array('success' => false, 'messages' => array());

    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        if(!$nextpool){
            $ARRAY = $API->comm("/ip/pool/set",array(
                ".id" => $ippool,
                "name" => $name,
                "ranges" => $ranges
            ));
                $output['success'] = true;
                $output['messages'] = "แก้ไขข้อมูลแล้ว";
        }
        else{
            $ARRAY = $API->comm("/ip/pool/set",array(
                ".id" => $ippool,
                "name" => $name,
                "ranges" => $ranges,
                "next-pool" => $nextpool
            ));
                $output['success'] = true;
                $output['messages'] = "แก้ไขข้อมูลแล้ว";
        }       
    }
    else
    {
        $output['success'] = false;
        $output['messages'] = "กรุณารีเฟสหน้าจอ หรือ เชื่อมต่อไซต์ใหม่";
    }
}
echo json_encode($output);
?>