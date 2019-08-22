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
    'address' => array(), 'dns' => array(),'rate' => array(),
    'id' => array()
);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/ip/hotspot/profile/print", array("?.id" => $name,));

    $rate = $ARRAY[0]['rate-limit'];

    $output['name'] = $ARRAY[0]['name'];
    $output['address'] = $ARRAY[0]['hotspot-address'];
    $output['dns'] = $ARRAY[0]['dns-name'];
    $output['rate'] = $rate;
    $output['id'] = $ARRAY[0]['.id'];
}

echo json_encode($output);
?>