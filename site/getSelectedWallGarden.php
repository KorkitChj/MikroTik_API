<?php
session_start();
?>
<?php

include ('function.php');

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$comment = $_POST['comment'];

$output = array('domainname' => array(),'action' => array(),'comment' => array());

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/ip/hotspot/walled-garden/ip/print", array("from" => $comment));


    $output['domainname'] = $ARRAY[0]['dst-host'];
    $output['action'] = $ARRAY[0]['action'];
    $output['comment'] = $ARRAY[0]['comment'];

}

echo json_encode($output);
?>