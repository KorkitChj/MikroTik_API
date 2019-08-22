<?php
session_start();
?>
<?php
include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

$serverid = $_POST['server_id'];
$type = $_POST['type'];

$output = array('success' => false, 'messages' => array());

list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
	$ARRAY = $API->comm("/ip/hotspot/print");
	$num = count($ARRAY);
	if ($num == '0') {
		$output['success'] = false;
		$output['messages'] = "Default Server can not be removed.";
	} else {
		if ($type != "many") {
			$SERVER = $API->comm("/ip/hotspot/remove", array(".id" => $serverid));
			$output['success'] = true;
			$output['messages'] = "ทำการลบ Server เรียบร้อยแล้ว.";
		} else {
			$serveri = implode(", ",$serverid);
			$SERVER = $API->comm("/ip/hotspot/remove", array(".id" => $serveri));
			$output['success'] = true;
			$output['messages'] = "ทำการลบ Server เรียบร้อยที่เลือกแล้ว.";
		}
	}
}
echo json_encode($output);
?>