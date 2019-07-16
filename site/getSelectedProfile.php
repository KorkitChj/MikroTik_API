<?php
session_start();
?>
<?php

include ('function.php');

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

$profile_name = $_POST['profile_name'];

$output = array('name' => array(),
 'idle' => array(),'session' => array(),'shared' => array(),'mac' => array(),'limit' => array());

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/ip/hotspot/user/profile/print", array("from" => $profile_name,));

    $output['name'] = $ARRAY[0]['name'];
    $output['session'] = $ARRAY[0]['session-timeout'];
    $output['idle'] = $ARRAY[0]['idle-timeout'];
    $output['shared'] = $ARRAY[0]['shared-users'];
    $output['mac'] = $ARRAY[0]['mac-cookie-timeout'];
    $output['limit'] = $ARRAY[0]['rate-limit'];
}

echo json_encode($output);
?>