<?php
session_start();
?>
<?php
include_once('../config/routeros_api.class.php');
require('../include/connect_db_router.php');
$API = new routeros_api();
if (isset($_GET['location_id'])) {
    $location_id = $_GET['location_id'];
    $profile = $_GET['name'];
    $id = $_SESSION['cus_id'];
}
$sql = "SELECT * FROM location WHERE cus_id='" . $id . "' AND location_id ='" . $location_id . "'";
$result = mysqli_query($link, $sql) or die("Could not connect");
$rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
$ip = $rows['ip_address'];
$port = $rows['api_port'];
$user = $rows['username'];
$pass = $rows['password'];

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/ip/hotspot/user/profile/print");
    $num = count($ARRAY);
    echo "<meta charset='utf-8'>";
    if ($num == '0') {
        echo "<script>alert('Default profile can not be removed.')</script>";
        echo "<meta http-equiv='refresh' content='0;url=index.php?opt=profile' />";
        exit;
    } else {
        if ($profile == "default") {
            echo "<script>alert('ไม่สามารถลบ Profile ได้.')</script>";
            echo "<meta http-equiv='refresh' content='0;url=profilestatus.php?location_id=$location_id' />";
            exit(0);
        } else {
            $ARRAY = $API->comm("/ip/hotspot/user/profile/remove", array(
                "numbers" => $profile,
            ));
            echo "<script>alert('ทำการลบแพคเกจที่เลือกเรียบร้อยแล้ว.')</script>";
            echo "<meta http-equiv='refresh' content='0;url=profilestatus.php?location_id=$location_id' />";
            exit(0);
        }
    }
} else {
    echo "<script language='javascript'>alert('Disconnect')</script>";
    echo "<meta http-equiv='refresh' content='0;url=../siteadmin/connectstatus.php'/>";
    exit(0);
}
?>