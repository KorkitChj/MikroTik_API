<?php
include('../../includes/db_connect.php');
$output = array('success' => false);
if(isset($_POST['data'])){
    $video = $_POST['data'];
    $statement1 = $conn->prepare("UPDATE video SET url = :url WHERE id = 1");
    $statement1->bindParam(":url",$video);
    $aa = $statement1->execute();
    if($aa != false);
    $output['success'] = true;
}
echo json_encode($output);
?>