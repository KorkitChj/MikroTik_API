<?php

include('../includes/connect_db.php');

//$_SESSION['cus_id'] ? $cus_id = $_SESSION['cus_id'] : '';

$query = $conn->prepare('SELECT b.product_id FROM siteadmin AS a 
                                INNER JOIN orderpd AS b ON
                                a.cus_id = b.cus_id 
                                WHERE a.cus_id = :cus_id');
$query->execute(array(':cus_id' =>  $cus_id));
$service = '';
$result = $query->fetch(PDO::FETCH_ASSOC);
if ($result['product_id'] == 1) {
    $service .=1;
} else {
    $service .=2;
}
