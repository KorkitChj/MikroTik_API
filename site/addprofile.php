<?php
session_start();
?>
<?php
if ($_POST) {

    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];
    include('function.php');

    list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

    $output = array('success' => false, 'messages' => array());


    $profilename = $_POST['profilename'];
    $idle = $_POST['idle'];
    $session = $_POST['session'];
    $shared = $_POST['shared'];
    $mac = $_POST['mac'];
    $limit = $_POST['limit'];


    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        $ARRAY = $API->comm("/ip/hotspot/user/profile/print");
        $count = count($ARRAY);
        for ($i = 0; $i < $count; $i++) {
            $a = $ARRAY[$i]['name'];
            if ($a == $profilename) {    
                $output['success'] = false;
                $output['messages'] = "กรุณาเปลี่ยนชื่อ Profile";
                echo json_encode($output);
                exit(0);
         
            }
        }
        $ARRAY = $API->comm("/ip/hotspot/user/profile/add", array(
            "name" => $profilename,
            "session-timeout" => $session,
            "idle-timeout" => $idle,
            "shared-users" => $shared,
            "mac-cookie-timeout" => $mac,
            "rate-limit" => $limit,
        ));
        $output['success'] = true;
        $output['messages'] = "ทำการเพิ่มแพคเกจเข้าระบบเรียบร้อยแล้ว";
    }
    else
    {
        $output['success'] = false;
        $output['messages'] = "Disconnect !! กรุณารีเฟซเพจอีกครั้ง";
    }
}
echo json_encode($output);
?>