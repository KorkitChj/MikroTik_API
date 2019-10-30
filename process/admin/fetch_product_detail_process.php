<?php
include('../../includes/db_connect.php');

if(isset($_POST['product_id'])){
    $statement = $conn->prepare("SELECT function FROM product WHERE product_id = :product_id");
    $statement->execute(array(':product_id' => $_POST['product_id']));
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    $function = $data['function'];
    echo json_encode(array('data' => $function));
}

