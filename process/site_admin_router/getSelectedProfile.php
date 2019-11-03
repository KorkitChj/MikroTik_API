<?php
session_start();
?>
<?php
error_reporting(0);
include ('function.php');

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$profile_name = $_POST['profile_name'];

$output = array('name' => array(),'session' => array(),'shared' => array(),'limit' => array(),'daytouse' => array());

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/ip/hotspot/user/profile/print", array("from" => $profile_name,));

    if($ARRAY[0]['session-timeout'] != ''){
        $aa = $ARRAY[0]['session-timeout'];
    }else{
        $aa = "00:00:00";
    }
    if($ARRAY[0]['address-pool'] != ''){
        $bb = $ARRAY[0]['address-pool'];
    }else{
        $bb = "none";
    }
    // if(!empty($ARRAY[0]['on-login'])){
    //     $string = explode(";",$ARRAY[0]['on-login']);
    //     $string2 = explode(" ",$string[2]);
    //     $daytouse = $string2[2];
    // }else{
    //     $daytouse = '';
    // }
    if(!empty($ARRAY[0]['name'])){
            $string = explode("_",$ARRAY[0]['name']);
            $string2 = explode("/",$string[1]);
            $daytouse = $string2[0];
        }else{
            $daytouse = '';
        }
    $output['name'] = $ARRAY[0]['name'];
    $output['session'] = $aa;
    $output['shared'] = $ARRAY[0]['shared-users'];
    $output['limit'] = $ARRAY[0]['rate-limit'];
    $output['daytouse'] = $daytouse;
}

echo json_encode($output);
?>