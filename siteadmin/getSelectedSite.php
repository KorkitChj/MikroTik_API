<?php 

include ('../include/connect_db.php');

$location_id = $_POST['location_id'];

$output = array('ip_address' => array(), 'username' => array(),'password' => array(),
'api_port' => array(),'working_site' => array(),'location_id' => array());
$sql = "SELECT * FROM location WHERE location_id = :location_id";
$query = $conn->prepare($sql);
$query->bindParam(':location_id',$location_id);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
    $output['ip_address'] = $result['ip_address'];
    $output['username'] = $result['username'];
    $output['password'] = $result['password'];
    $output['api_port'] = $result['api_port'];
    $output['working_site'] = $result['working_site'];
    $output['location_id'] = $location_id;

echo json_encode($output);
?>