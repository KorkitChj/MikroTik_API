<?php
session_start();
?>
<?php
include('function.php');
$cus_id = $_SESSION['cus_id'];
$location_id = $_SESSION['location_id'];
list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$output = array('disconnect' => true,'uptime'=> array(),'cpuload' => array());

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/system/resource/print");
    $cpu = $ARRAY['0']['cpu-load'] . "%";
    $uptime =    $ARRAY['0']['uptime'];
    $output['disconnect'] = false;
    $output['uptime'] = $uptime;
    $output['cpuload'] = $cpu;
} else {
    $output['disconnect'] = true;
}
echo json_encode($output);

?>