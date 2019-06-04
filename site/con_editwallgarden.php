<?php
require('conn.php');
?>
<?php
if (isset($_POST['sm'])) {
    echo "<meta charset='utf-8'>";
    $domainname = $_POST['domainname'];
    $action = $_POST['action'];
    $commenta = $_POST['comment'];
    if (isset($_GET['location_id'])) {
        $id = $_GET['cus_id'];
        $location_id = $_GET['location_id'];
        $commentb = $_GET['comment'];
    }
    $sql = "SELECT * FROM location WHERE cus_id='" . $id . "' AND location_id ='" . $location_id . "'";
    $result = mysqli_query($link, $sql) or die("Could not connect");
    $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $ip = $rows['ip_address'];
    $port = $rows['api_port'];
    $user = $rows['username'];
    $pass = $rows['password'];
    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        if ($commentb != "") {
            $ARRAY = $API->comm("/ip/hotspot/walled-garden/ip/set", array(
                "dst-host" => $domainname,
                "action" => $action,
                "comment" => $commenta,
                "numbers" => $commentb,
            ));
            echo "<script>alert('ทำการอัพเดทข้อมูลแล้ว.')</script>";
            echo "<meta http-equiv='refresh' content='0;url=wallgardenstatus.php?location_id=$location_id' />";
        }
    } else {
        echo "<script language='javascript'>alert('Disconnect')</script>";
        echo "<meta http-equiv='refresh' content='0;url=../siteadmin/connectstatus.php'/>";
    }
}
?>