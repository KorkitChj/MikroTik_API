<?php
session_start();
?>
<?php
error_reporting(0);
include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

$poolid = $_POST['pool_id'];
$type = $_POST['type'];

$output = array('success' => false, 'messages' => array());
list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
	$ARRAY = $API->comm("/ip/pool/print");
	$num = count($ARRAY);
	if ($num == '0') {
		$output['success'] = false;
		$output['messages'] = "Default profile can not be removed.";
	} else {
		if ($type != "many") {
			$ADDRESS = $API->comm("/ip/pool/remove", array(".id" => $poolid));
			$output['success'] = true;
			$output['messages'] = "ทำการลบ IP Pool เรียบร้อยแล้ว.";
		} else {
			$pooli = implode(", ",$poolid);
			$ADDRESS = $API->comm("/ip/pool/remove", array(".id" => $pooli));
			$output['success'] = true;
			$output['messages'] = "ทำการลบ IP Pool เรียบร้อยที่เลือกแล้ว.";
		}
	}
}
echo json_encode($output);
?>