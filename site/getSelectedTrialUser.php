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

$output = array(
    'name' => array(),
    'uptime' => array(),
    'reset' => array(), 'profile' => array()
);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/ip/hotspot/profile/print", array("from" => $name,));

    $output['name'] = $ARRAY[0]['name'];
    $output['uptime'] = $ARRAY[0]['trial-uptime-limit'];
    $output['reset'] = $ARRAY[0]['trial-uptime-reset'];
    $output['profile'] = $ARRAY[0]['trial-user-profile'];
}

echo json_encode($output);
?>