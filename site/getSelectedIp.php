<?php
session_start();
?>
<?php
error_reporting(0);
include ('function.php');

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$ip_address = $_POST['ip_address'];

$output = array('id' => array(),'address' => array(),
 'network' => array(),'interface' => array(),'comment' => array());

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    //$ARRAY = $API->comm("/ip/address/print", array("from" => $ip_address,));

    $ARRAY = $API->comm("/ip/address/print",array("?.id" => $ip_address));

    $output['id'] = $ARRAY[0]['.id'];
    $output['address'] = $ARRAY[0]['address'];
    $output['network'] = $ARRAY[0]['network'];
    $output['interface'] = $ARRAY[0]['interface'];
    $output['comment'] = $ARRAY[0]['comment'];
}

echo json_encode($output);
?>