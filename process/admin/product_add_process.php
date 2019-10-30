<?php
if ($_POST) {
    include('../../includes/db_connect.php');
    include('function.php');
    $output = array('success' => false, 'messages' => array());

    $productname = $_POST["productname"];
    $productprice = $_POST["productprice"];
    $producttitle = $_POST["producttitle"];
    $productdetail  = $_POST["productdetail"];
    try {
        $image = '';
        if ($_FILES["product_image"]["name"] != '') {
            $image = upload_image_product();
        }
        $sql4 = "INSERT INTO product VALUES
                    ('',:product_name,:product_price,:product_title,:product_detail,:image_product)";
        $query4 = $conn->prepare($sql4);
        $query4->bindparam(':product_name', $productname);
        $query4->bindparam(':product_price', $productprice);
        $query4->bindparam(':product_title', $producttitle);
        $query4->bindparam(':product_detail', $productdetail);
        $query4->bindparam(':image_product', $image);
        $query4->execute();
    } catch (PDOException $e) {
        $output['success'] = false;
        $output['messages'] = "ผิดพลาด";
    }
    if (empty($e)) {
        $output['success'] = true;
        $output['messages'] = "เพิ่มข้อมูลแล้ว";
    }
}
echo json_encode($output);
