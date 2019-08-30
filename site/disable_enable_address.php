<?php
session_start();
?>
<?php
include('function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

$id = $_POST['id'];
$type = $_POST['type'];

$output = array('id' => array());

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {

    $ARRAY2 = $API->comm("/ip/address/print",array("?.id" => $id));

    if($type == "disable"){
        $ARRAY = $API->comm("/ip/address/disable
        =.id=".$id."");
        $output['id'] = $ARRAY2[0]['interface'];
    }else{
        $ARRAY = $API->comm("/ip/address/enable
        =.id=".$id."");
        $output['id'] = $ARRAY2[0]['interface'];
    }
}
echo json_encode($output);
?>