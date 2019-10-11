<?php
session_start();
?>
<?php
error_reporting(0);
include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$name = $_POST['name'];
$hotadd = $_POST['hotadd'];
$dns = $_POST['dns'];
$rate = $_POST['rate'];
$cookie = $_POST['cookie'];
$maccookie = $_POST['maccookie'];
$output = array('success' => false,'messages' => array());
if ($API->connect($ip . ":" . $port, $user, $pass)) {
	if ($name != "") {
		if(empty($hotadd)&& empty($dns) && empty($rate)){
			$ARRAY = $API->comm("/ip/hotspot/profile/add", array(
				"name"  => $name
			));
			/*if(isset($_POST['cookie']) == ''){
				$ARRAY2 = $API->comm("/ip/hotspot/profile/set", array(
					"login-by"  => "http-pap",
					"numbers"	=> $name
				));
			}elseif($_POST['maccookie'] != ''){
				$ARRAY3 = $API->comm("/ip/hotspot/profile/set", array(
					"login-by"  => "http-pap,mac-cookie,cookie",
					"numbers"	=> $name
				));
			}*/
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
			if($maccookie != '' && $cookie == ''){
				$ARRAY4 = $API->comm("/ip/hotspot/profile/set", array(
					"login-by"  => "http-pap,mac-cookie",
					"numbers"	=> $name
				));
			}elseif($maccookie != '' && $cookie != ''){
				$ARRAY4 = $API->comm("/ip/hotspot/profile/set", array(
					"login-by"  => "http-pap,mac-cookie,cookie",
					"numbers"	=> $name
				));
			}elseif($maccookie == '' && $cookie == ''){
				$ARRAY2 = $API->comm("/ip/hotspot/profile/set", array(
					"login-by"  => "http-pap",
					"numbers"	=> $name
				));
			}elseif($maccookie == '' && $cookie != ''){
				$ARRAY3 = $API->comm("/ip/hotspot/profile/set", array(
					"login-by"  => "cookie",
					"numbers"	=> $name
				));
			}
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