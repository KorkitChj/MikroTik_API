<?php
session_start();
?>
<?php
include('../site/function.php');
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

$address = $_POST['ipaddress'];
$type = $_POST['type'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {

    //$API ->comm("/ip/dhcp-client/set[/ip/dhcp-client/where/address='172.20.10.5/28']/comment=bb");  

}
?>