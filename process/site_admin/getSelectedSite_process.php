<?php

include('../../includes/db_connect.php');

$location_id = $_POST['location_id'];

$output = array();
$sql = "SELECT * FROM location WHERE location_id = :location_id";
$query = $conn->prepare($sql);
$query->bindParam(':location_id', $location_id);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
if ($result["image_site"] != '') {
    $output['site_image'] = '<img src="../img/sitelogo/' . $result["image_site"] . '" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_site_image" value="' . $result["image_site"] . '" />';
} else {
    $output['site_image'] = '<input type="hidden" name="hidden_site_image" value="" />';
}
$output['ip_address'] = $result['ip_address'];
$output['username'] = $result['username'];
$output['password'] = $result['password'];
$output['api_port'] = $result['api_port'];
$output['working_site'] = $result['working_site'];
$output['location_id'] = $location_id;

echo json_encode($output);
?>