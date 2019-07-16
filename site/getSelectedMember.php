<?php 

include ('../include/connect_db.php');

$emp_id = $_POST['emp_id'];

$output = array('full_name' => array(), 'pass_w' => array(),'username' => array(),'location_id' => array(),'emp_id' => array());
$sql = "SELECT * FROM employee WHERE emp_id = :emp_id";
$query = $conn->prepare($sql);
$query->bindParam(':emp_id',$emp_id);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
    $output['full_name'] = $result['full_name'];
    $output['pass_w'] = $result['pass_w'];
    $output['username'] = $result['username'];
    $output['location_id'] = $result['location_id'];
    $output['emp_id'] = $result['emp_id'];
    
echo json_encode($output);
?>