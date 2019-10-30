<?php

include('../../includes/db_connect.php');

$product_id = $_POST['product_id'];

$output = array();
$sql = "SELECT * FROM product WHERE product_id = :product_id";
$query = $conn->prepare($sql);
$query->bindParam(':product_id', $product_id);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
if ($result["image"] != '') {
    $output['image'] = '<img src="../img/products/' . $result["image"] . '" id="imageproduct"  alt="your image" class="img-fluid rounded shadow-lg p-3 mb-5 bg-white" width="300" height="300" /><input type="hidden" name="hidden_product_image" value="' . $result["image"] . '" />';
} else {
    $output['image'] = '<input type="hidden" name="hidden_product_image" value="" />';
}
$output['product_name'] = $result['product_name'];
$output['price'] = $result['price'];
$output['title'] = $result['title'];
$output['function'] = $result['function'];
$output['product_id'] = $result['product_id'];
echo json_encode($output);
?>