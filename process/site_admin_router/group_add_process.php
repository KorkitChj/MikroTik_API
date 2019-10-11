<?php
session_start();
?>
<?php
error_reporting(0);
include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$name = $_POST['namegroup'];
$write = $_POST['inlineCheckbox1'];
$read = $_POST['inlineCheckbox2'];
$winbox = $_POST['inlineCheckbox3'];
$api = $_POST['inlineCheckbox4'];
$web = $_POST['inlineCheckbox5'];


if ($API->connect($ip . ":" . $port, $user, $pass)) {
	if ($name != "") {
		$ARRAY = $API->comm("/user/group/add", array(
			"name"  => $name,
			"policy" => $write.",".$read.",".$winbox.",".$api.",".$web,
		));
		echo "<script>alert('ระบบได้ทำการเพิ่ม Group เรียบร้อยแล้ว.')</script>";
		echo "<meta http-equiv='refresh' content='0;url=../../site/employeestatus.php' />";
		exit();
	}
}
?>