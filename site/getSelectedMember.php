<?php
session_start();
?>
<?php 
error_reporting(0);
include('function.php');
include ('../includes/connect_db.php');

$emp_name = $_POST['emp_name'];
$name = $_POST['name'];

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

if($API->connect($ip.":".$port,$user,$pass)){
    $ARRAY = $API->comm("/user/print",array("?.id" => $emp_name));
}

$output = array('full_name' => array(), 'pass_w' => array(),'username' => array(),'group' => array(),'comment' => array(),'id' => array());
$sql = "SELECT * FROM employee WHERE username = :name";
$query = $conn->prepare($sql);
$query->bindParam(':name',$name);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
    $output['full_name'] = $result['full_name'];
    $output['pass_w'] = $result['pass_w'];
    $output['username'] = $result['username'];
    $output['group'] = $ARRAY[0]['group'];
    $output['comment'] = $ARRAY[0]['comment'];
    $output['id'] = $ARRAY[0]['.id'];
echo json_encode($output);
?>