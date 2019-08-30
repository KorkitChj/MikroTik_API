<?php
session_start();
?>
<?php
error_reporting(0);
include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

$output = array('success' => false,'messages' => array());

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$name = $_POST['name'];
$interface = $_POST['interface'];
$pool = $_POST['pool'];
$profile = $_POST['profile'];
$firewall = $_POST['firewall'];




if ($API->connect($ip . ":" . $port, $user, $pass)) {
	$ARRAY = $API->comm("/ip/address/print");
	$ARRAY1 = $API->comm("/ip/address/print", (array('where' => "dynamic")));
	$ARRAY2 = $API->comm("/ip/firewall/nat/print");

	$comment = '';
	$ipaddress = '';
	$network = '';
	if (!$ARRAY) {
		$output['success'] = false;
		$output['messages'] = "คุณยังไม่ได้กำหนด IP Address ที่ Interface";
	} else {
		foreach ($ARRAY1 as $fire) {
			$interfacea = $fire['interface'];
		}


		foreach ($ARRAY as $value) {
			if ($interface == $value['interface']) {
				$comment = $value['comment'];
				$network = $value['network'];
				$ipaddress = $value['address'];
			}
		}
		if ($ipaddress == '') {
			$output['success'] = false;
			$output['messages'] = "คุณยังไม่ได้กำหนด IP Address ที่ Interface";
		}
	}


	if ($network != "") {

		$result = explode("/", $ipaddress);
		//print_r($result);
		$address = $result[0];
		$crud = $result[1];
		$API->comm("/ip/dhcp-server/network/add", array(
			"address" => $network . "/" . $crud,
			"gateway" => $address,
			//"netmask" => "255.255.255.0"
		));
		$API->comm("/ip/hotspot/add", array(
			"name"  => $name,
			"interface" => $interface,
			"address-pool"  => $pool,
			"profile"  => $profile,
			"disabled" => "no"
		));
		if($pool == "none"){
			$pool = "static-only";
		}
		$API->comm("/ip/dhcp-server/add", array(
			"name" => $name,
			"interface" => $interface,
			"address-pool" => $pool,
			"disabled" => "no"
		));
		
		if ($firewall != '') {
			$i = 0;
			$j = 0;
			foreach ($ARRAY2 as $nat) {
				if ($nat['src-address'] != $network . "/" . $crud) {
					$i += 1;
				} else {
					$j += 1;
				}
			}
			if ($i != 0 || $i == 0) {
				if ($j == 0) {
					$API->comm('/ip/firewall/nat/add', array(
						'chain' => "srcnat",
						'src-address' => $network . "/" . $crud,
						'action' => $firewall,
						'disabled' => 'no'
					));
				}
			}
		}
		$output['success'] = true;
		$output['messages'] = "ระบบได้ทำการเพิ่ม Server เรียบร้อยแล้ว";
	}
}
echo json_encode($output);
?>