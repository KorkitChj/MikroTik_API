<?php
session_start();
?>
<?php
error_reporting(0);
include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

$output = array('success' => false,'messages' => array());

list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

$address = $_POST['address'];
$network = $_POST['network'];
$interface = $_POST['interface'];
$comment = $_POST['comment'];


if ($API->connect($ip . ":" . $port, $user, $pass)) {
	if ($address != "") {
		$ARRAY = $API->comm("/ip/address/add", array(
			"address"  => $address,
			"network" => $network,
			"interface"  => $interface,
			"comment"  => $comment
		));
		$output['success'] = true;
		$output['messages'] = "ระบบได้ทำการเพิ่ม Address-List เรียบร้อยแล้ว";
	}
}
echo json_encode($output);
?>