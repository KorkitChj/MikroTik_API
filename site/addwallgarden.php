<?php
session_start();
?>
<?php
if ($_POST) {

    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];
    include('function.php');

    list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

    $output = array('success' => false, 'messages' => array());

    $hostname = $_POST['domainname'];
    $action = $_POST['action'];
    $comment = $_POST['comment'];

    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        $ARRAY = $API->comm("/ip/hotspot/walled-garden/ip/print");
        $count = count($ARRAY);
        for ($i = 0; $i < $count; $i++) {
            $a = $ARRAY[$i]['dst-host'];
            if ($a == $hostname) {
                $output['success'] = false;
                $output['messages'] = "กรุณาเปลี่ยนชื่อ Domain Name";
                echo json_encode($output);
                exit(0);
            }
        }
        $ARRAY = $API->comm("/ip/hotspot/walled-garden/ip/add", array(
            "dst-host" => $hostname,
            "action"  => $action,
            "comment"  => $comment,
        ));
        $output['success'] = true;
        $output['messages'] = "ทำการเพิ่ม Bypass เข้าระบบเรียบร้อยแล้ว";
    }
    else
    {
        $output['success'] = false;
        $output['messages'] = "Disconnect !! กรุณารีเฟซเพจอีกครั้ง";
    }
}
echo json_encode($output);
?>