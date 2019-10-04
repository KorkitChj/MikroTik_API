<?php
session_start();
?>
<?php
//error_reporting(0);
include('function.php');
require('../includes/connect_db.php');
//require('../config/pusher/src/Pusher.php');
$cus_id = $_SESSION['cus_id'];
$location_id = $_SESSION['location_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/system/resource/print");
    $ram =    $ARRAY['0']['free-memory'] / 1048576;
    $ram = round($ram, 1);
    $totalram =    $ARRAY['0']['total-memory'] / 1048576;
    $totalram  = round($totalram, 1);
    $hdd =    $ARRAY['0']['free-hdd-space'] / 1048576;
    $hdd = round($hdd, 1) . "MB";
    $totalhdd =    $ARRAY['0']['total-hdd-space'] / 1048576;
    $cpu = $ARRAY['0']['cpu-load'] . "%";
    $boardname =    $ARRAY['0']['board-name'];
    $version =    $ARRAY['0']['version'];
    $uptime =    $ARRAY['0']['uptime'];
    //$json = [];
    //$json[] = $ram;
    //$json[] = $totalram;

    $value = array(
        array(
            'name' => 'Free Memory',
            'y' => $ram
        ),
        array(
            'name' => 'Total Memory',
            'y' => $totalram
        )
    );
    echo json_encode($value, JSON_NUMERIC_CHECK);
}
?>