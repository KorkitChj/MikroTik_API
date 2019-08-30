<?php
session_start();
?>
<?php
error_reporting(0);
include('function.php');

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$ip_pool = $_POST['ip_pool'];

$output = array(
    'name' => array(),
    'ranges' => array(),
    'nextpool' => array(),
    'id' => array()
);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/ip/pool/print", array("?.id" => $ip_pool,));

    $pool = $ARRAY[0]['next-pool'];

    if ($ARRAY[0]['next-pool'] == "") {
        $pool = "NONE";
    }
        //$pool = "NONE";

    $output['name'] = $ARRAY[0]['name'];
    $output['ranges'] = $ARRAY[0]['ranges'];
    $output['nextpool'] = $pool;
    $output['id'] = $ARRAY[0]['.id'];
}

echo json_encode($output);
?>