<?php
session_start();
?>
<?php
error_reporting(0);
include ('function.php');

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$profile_name = $_POST['profile_name'];

$output = array('name' => array(),
 'idle' => array(),'session' => array(),'shared' => array(),'mac' => array(),'limit' => array(),'refresh' => array(),'pool' => array());

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/ip/hotspot/user/profile/print", array("from" => $profile_name,));

    if($ARRAY[0]['session-timeout'] != ''){
        $aa = $ARRAY[0]['session-timeout'];
    }else{
        $aa = "00:00:00";
    }
    if($ARRAY[0]['address-pool'] != ''){
        $bb = $ARRAY[0]['address-pool'];
    }else{
        $bb = "none";
    }
    $output['name'] = $ARRAY[0]['name'];
    $output['session'] = $aa;
    $output['idle'] = $ARRAY[0]['idle-timeout'];
    $output['shared'] = $ARRAY[0]['shared-users'];
    $output['mac'] = $ARRAY[0]['mac-cookie-timeout'];
    $output['limit'] = $ARRAY[0]['rate-limit'];
    $output['refresh'] = $ARRAY[0]['status-autorefresh'];
    $output['pool'] = $bb;
}

echo json_encode($output);
?>