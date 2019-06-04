<?php
require('conn.php');
if (isset($_POST['submit'])) {
    echo "<meta charset='utf-8'>";
    $name = $_POST['name'];
    $session = $_POST['session'];
    $idle = $_POST['idle'];
    $use = $_POST['use'];
    $limit = $_POST['limit'];
    $maccookie = $_POST['maccookie'];
    if (isset($_GET['location_id'])) {
        $id = $_GET['cus_id'];
        $location_id = $_GET['location_id'];
        $profile = $_GET['profile'];
    }
    $sql = "SELECT * FROM location WHERE cus_id='" . $id . "' AND location_id ='" . $location_id . "'";
    $result = mysqli_query($link, $sql) or die("Could not connect");
    $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $ip = $rows['ip_address'];
    $port = $rows['api_port'];
    $user = $rows['username'];
    $pass = $rows['password'];
    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        if ($name != "") {
            $ARRAY = $API->comm("/ip/hotspot/user/profile/set", array(
                "name" => $name,
                "session-timeout" => $session,
                "idle-timeout" => $idle,
                "shared-users" => $use,
                "mac-cookie-timeout" => $maccookie,
                "rate-limit" => $limit,
                "numbers" => $profile,
            ));
            echo "<script>alert('ทำการอัพเดทข้อมูลแล้ว.')</script>";
            echo "<meta http-equiv='refresh' content='0;url=profilestatus.php?location_id=$location_id' />";
            exit;
        }
    } else {
        echo "<script language='javascript'>alert('Disconnect')</script>";
        echo "<meta http-equiv='refresh' content='0;url=../siteadmin/connectstatus.php'/>";
        exit(0);
    }
}
