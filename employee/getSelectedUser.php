<?php
session_start();
?>
<?php

include ('function.php');

$emp_id = $_SESSION['emp_id'];

list($ip, $port, $user, $pass_r, $site, $conn, $API) = fetchuser($emp_id);

$user_name = $_POST['user_name'];

$output = array('name' => array(),
 'password' => array(),'profile' => array(),'limituptime' => array(),'comment' => array());

if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
    $ARRAY = $API->comm("/ip/hotspot/user/print", array("from" => $user_name,));

    $output['name'] = $ARRAY[0]['name'];
    $output['password'] = $ARRAY[0]['password'];
    $output['profile'] = $ARRAY[0]['profile'];
    $output['limituptime'] = $ARRAY[0]['limit-uptime'];
    $output['comment'] = $ARRAY[0]['comment'];
}

echo json_encode($output);
?>