<?php
session_start();
?>
<?php
error_reporting(0);
if($_POST){
    $profile = $_POST["editprofile_name"];
    $profilename = $_POST['editprofilename'];
    $idle = $_POST['editidle'];
    $session = $_POST['editsession'];
    $shared = $_POST['editshared'];
    $mac = $_POST['editmac'];
    $limit = $_POST['editlimit'];
    $refresh = $_POST['editautorefresh'];
    $pool = $_POST['editadpool'];
    include ('function.php');

    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];

    list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

    $output = array('success' => false, 'messages' => array());

    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        $ARRAY = $API->comm("/ip/hotspot/user/profile/set",array(
            "name" => $profilename,
            "session-timeout" => $session,
            "idle-timeout" => $idle,
            "shared-users" => $shared,
            "mac-cookie-timeout" => $mac,
            "rate-limit" => $limit,
            "status-autorefresh" => $refresh,
            "numbers" => $profile,
            "address-pool" => $pool
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