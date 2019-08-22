<?php
session_start();
?>
<?php
include('function.php');
$cus_id = $_SESSION['cus_id'];
$location_id = $_SESSION['location_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/system/resource/print");
    $hdd =    $ARRAY['0']['free-hdd-space'] / 1048576;
    $hdd = round($hdd, 1);
    $totalhdd =    $ARRAY['0']['total-hdd-space'] / 1048576;
    $totalhdd = round($totalhdd, 1);
    $value = array(
        array(
            'name' => 'Free HDD Space',
            'y' => $hdd
        ),
        array(
            'name' => 'Total HDD Size',
            'y' => $totalhdd
        )
    );
    echo json_encode($value, JSON_NUMERIC_CHECK);
}
?>