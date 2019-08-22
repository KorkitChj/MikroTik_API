<?php
session_start();
?>
<?php
error_reporting(0);
include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

$id = $_POST['serverp_id'];
$type = $_POST['type'];

$output =array('success' => false,'messages' => array());

list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
	$ARRAY = $API->comm("/ip/hotspot/profile/print");
	$num = count($ARRAY);
	if ($num == '0') {
		$output['success'] = false;
		$output['messages'] = "Default Server Profile can not be removed.";
	} else {
		if($type != "many"){
			$SERVERPROFILE = $API->comm("/ip/hotspot/profile/remove", array(".id" => $id));
			$output['success'] = true;
			$output['messages'] = "ทำการลบ Server Profile เรียบร้อยแล้ว.";
		}else{
			$ida = implode(", ",$id);
			$SERVERPROFILE = $API->comm("/ip/hotspot/profile/remove", array(".id" => $ida));
			$output['success'] = true;
			$output['messages'] = "ทำการลบ Server Profile เรียบร้อยที่เลือกแล้ว.";
		}
		
	}
}
echo json_encode($output);
?>