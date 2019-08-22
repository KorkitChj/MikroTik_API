<?php
session_start();
?>
<?php
error_reporting(0);
include('function.php');

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

$id = $_POST['name'];

$output = array(
    'name' => array(),
    'interface' => array(), 'pool' => array(), 'profile' => array(), 'id' => array()
);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/ip/hotspot/print", array("?.id" => $id,));

    $pool = $ARRAY[0]['address-pool'];
    if (!$ARRAY[0]['address-pool']) {
        $pool = "none";
    }

    $output['name'] = $ARRAY[0]['name'];
    $output['interface'] = $ARRAY[0]['interface'];
    $output['pool'] = $pool;
    $output['profile'] =  $ARRAY[0]['profile'];
    $output['id'] =  $ARRAY[0]['.id'];
}

echo json_encode($output);
?>