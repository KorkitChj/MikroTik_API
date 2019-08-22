<?php
session_start();
?>
<?php
error_reporting(0);
include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

$name = $_POST['name'];
$hotadd = $_POST['hotadd'];
$dns = $_POST['dns'];
$rate = $_POST['rate'];
$output = array('success' => false,'messages' => array());
if ($API->connect($ip . ":" . $port, $user, $pass)) {
	if ($name != "") {
		if(empty($hotadd)&& empty($dns) && empty($rate)){
			$ARRAY = $API->comm("/ip/hotspot/profile/add", array(
				"name"  => $name
			));
			$output['success'] = true;
			$output['messages'] = "ระบบได้ทำการเพิ่ม Server Profile เรียบร้อยแล้ว";
		}elseif(!empty($hotadd) && !empty($dns) && !empty($rate)){
			$ARRAY = $API->comm("/ip/hotspot/profile/add", array(
				"name"  => $name,
				"hotspot-address" => $hotadd,
				"dns-name"  => $dns,
				"rate-limit"  => $rate,
			));
			$output['success'] = true;
			$output['messages'] = "ระบบได้ทำการเพิ่ม Server Profile เรียบร้อยแล้ว";
		}elseif(!empty($hotadd)&& empty($dns) && empty($rate)){
			$ARRAY = $API->comm("/ip/hotspot/profile/add", array(
				"name"  => $name,
				"hotspot-address" => $hotadd
			));
			$output['success'] = true;
			$output['messages'] = "ระบบได้ทำการเพิ่ม Server Profile เรียบร้อยแล้ว";
		}elseif(empty($hotadd)&& !empty($dns) && empty($rate)){
			$ARRAY = $API->comm("/ip/hotspot/profile/add", array(
				"name"  => $name,
				"dns-name" => $dns
			));
			$output['success'] = true;
			$output['messages'] = "ระบบได้ทำการเพิ่ม Server Profile เรียบร้อยแล้ว";
		}elseif(empty($hotadd)&& empty($dns) && !empty($rate)){
			$ARRAY = $API->comm("/ip/hotspot/profile/add", array(
				"name"  => $name,
				"rate-limit" => $rate
			));
			$output['success'] = true;
			$output['messages'] = "ระบบได้ทำการเพิ่ม Server Profile เรียบร้อยแล้ว";
		}elseif(!empty($hotadd)&& !empty($dns) && empty($rate)){
			$ARRAY = $API->comm("/ip/hotspot/profile/add", array(
				"name"  => $name,
				"hotspot-address" => $hotadd,
				"dns-name"  => $dns
			));
			$output['success'] = true;
			$output['messages'] = "ระบบได้ทำการเพิ่ม Server Profile เรียบร้อยแล้ว";
		}elseif(empty($hotadd)&& !empty($dns) && !empty($rate)){
			$ARRAY = $API->comm("/ip/hotspot/profile/add", array(
				"name"  => $name,
				"rate-limit" => $rate,
				"dns-name"  => $dns
			));
			$output['success'] = true;
			$output['messages'] = "ระบบได้ทำการเพิ่ม Server Profile เรียบร้อยแล้ว";
		}elseif(!empty($hotadd)&& empty($dns) && !empty($rate)){
			$ARRAY = $API->comm("/ip/hotspot/profile/add", array(
				"name"  => $name,
				"hotspot-address" => $hotadd,
				"rate-limit" => $rate
			));
			$output['success'] = true;
			$output['messages'] = "ระบบได้ทำการเพิ่ม Server Profile เรียบร้อยแล้ว";
		}		
	}
}
echo json_encode($output);
?>