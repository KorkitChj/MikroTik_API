<?php
session_start();
?>
<?php
error_reporting(0);
include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

$address = $_POST['address_id'];
$type = $_POST['type'];

$output = array('success' => false, 'messages' => array());
list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
	$ARRAY = $API->comm("/ip/address/print");
	$num = count($ARRAY);
	if ($num == '0') {
		$output['success'] = false;
		$output['messages'] = "Default profile can not be removed.";
	} else {
		if ($type != "many") {
			$ADDRESS = $API->comm("/ip/address/remove", array(".id" => $address));
			$output['success'] = true;
			$output['messages'] = "ทำการลบ Address-List เรียบร้อยแล้ว";
		} else {
			$addressa = implode(", ",$address);
			$ADDRESS = $API->comm("/ip/address/remove", array(".id" => $addressa));
			$output['success'] = true;
			$output['messages'] = "ทำการลบ Address-List เรียบร้อยที่เลือกแล้ว.";
		}
	}
}
echo json_encode($output);
?>