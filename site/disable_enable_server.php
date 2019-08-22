<?php
session_start();
?>
<?php
error_reporting(0);
include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

$id = $_POST['id'];
$type = $_POST['type'];

$output = array('id' => array());

list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {

    $ARRAY2 = $API->comm("/ip/hotspot/print",array("?.id" => $id));

    if($type == "disable"){
        $ARRAY = $API->comm("/ip/hotspot/disable
        =.id=".$id."");
        $output['id'] = $ARRAY2[0]['name'];
    }else{
        $ARRAY = $API->comm("/ip/hotspot/enable
        =.id=".$id."");
        $output['id'] = $ARRAY2[0]['name'];
    }
}
echo json_encode($output);
?>