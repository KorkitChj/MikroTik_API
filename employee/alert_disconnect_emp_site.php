<?php
session_start();
?>
<?php
include('function.php');
$emp_id = $_SESSION['emp_id'];

list($ip, $port, $user, $pass_r, $site, $conn, $API) = fetchuser($emp_id);

$output = array('disconnect' => true,'uptime' => array(),'usercount' => array());

if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
    $ARRAY = $API->comm("/system/resource/print");
    $ARRAY1 = $API->comm("/ip/hotspot/user/print");
    $uptime =    $ARRAY['0']['uptime'];
    $user_router1 = count($ARRAY1);
    $user_router = $user_router1 - 1;
    $output['disconnect'] = false;
    $output['uptime'] = $uptime;
    $output['usercount'] = $user_router;
} else {
    $output['disconnect'] = true;
}
echo json_encode($output);
?>