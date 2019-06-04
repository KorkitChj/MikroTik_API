<?php
require('conn.php');
?>
<?php
if (isset($_GET['location_id'])) {
    $location_id = $_GET['location_id'];
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
        if (isset($_POST['sm'])) {
            $hostname = $_POST['domainname'];
            $action = $_POST['action'];
            $status = $_POST['status'];
            if ($action != "") {
                $ARRAY = $API->comm("/ip/hotspot/walled-garden/ip/add", array(
                    "dst-host" => $hostname,
                    "action"  => $action,
                    "comment"  => $status,
                ));
            }
            echo "<script>alert('ระบบได้ทำการเพิ่ม Bypass Website เรียบร้อยแล้ว.')</script>";
            echo "<meta http-equiv='refresh' content='0;url=wallgardenstatus.php?location_id=$location_id' />";
        }
    } else {
        echo "<script language='javascript'>alert('Disconnect')</script>";
        echo "<meta http-equiv='refresh' content='0;url=../siteadmin/connectstatus.php'/>";
        exit(0);
    }
?>