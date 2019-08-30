<?php
session_start();
?>
<?php
error_reporting(0);
include('../site/function.php');
$interface = $_POST['action'];
$type = $_POST['type'];

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];


$output = array("data"=> array());
list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {

    $ARRAY1 = $API->comm("/interface/print",array("?.id" => $interface));

    if($type == "enable"){
        $ARRAY = $API->comm("/interface/enable
                                    =.id=".$interface."");
        $output["data"] = $ARRAY1[0]['name'];
        
    }else{
        $ARRAY = $API->comm("/interface/disable
                                    =.id=".$interface."");
        $output["data"] = $ARRAY1[0]['name'];
        
    }  
}
echo json_encode($output);
?>