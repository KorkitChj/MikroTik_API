<?php
session_start();
?>
<?php

include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$uptime = $_POST['uptime'];
$reset = $_POST['uptimereset'];
$profile = $_POST['trialprofile'];
$name = $_POST['login'];
$addtrial = $_POST['addtrial'];

if ($API->connect($ip . ":" . $port, $user, $pass)) {
	if ($name != "") {
		$ARRAY = $API->comm("/ip/hotspot/profile/set", array(
			"login-by"  => $name,
			"trial-uptime-limit" => $uptime,
			"trial-uptime-reset"  => $reset,
            "trial-user-profile"  => $profile,
            "numbers" => $addtrial
		));
		echo "<script>alert('ระบบได้ทำการเพิ่ม Server Profile เรียบร้อยแล้ว.')</script>";
		//echo "<meta http-equiv='refresh' content='0;url=addserverprofile.php' />";
		exit();
	}
}
?>