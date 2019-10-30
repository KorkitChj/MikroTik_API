<?php
if ($_POST) {
    include('../../includes/db_connect.php');
    include('function.php');
    $output = array('success' => false, 'messages' => array());
    $image = '';
    if ($_FILES["editproduct_image"]["name"] != '') {
        $image = upload_image_product();
        unlink('../../img/products/'.$_POST["hidden_product_image"].'');
    } else {
        $image = $_POST["hidden_product_image"];
    }
    $editproductname = $_POST["editproductname"];
    $editproductprice = $_POST["editproductprice"];
    $editproducttitle = $_POST["editproducttitle"];
    $editproductdetail  = $_POST["editproductdetail"];
    $editproduct_id  = $_POST["editproduct_id"];

    $sql = "SELECT product_name FROM product WHERE product_id = :product_id";
    $query = $conn->prepare($sql);
    $query->bindparam(':product_id', $editproduct_id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if ($result['product_name'] == $editproductname) {
        try {
            $sql = "UPDATE product SET price= :price
            ,title= :title ,function= :function,image =:image WHERE product_id = :product_id";
            $query = $conn->prepare($sql);
            $query->bindparam(':price', $editproductprice);
            $query->bindparam(':title', $editproducttitle);
            $query->bindparam(':function', $editproductdetail);
            $query->bindparam(':image', $image);
            $query->bindparam(':product_id', $editproduct_id);
            $query->execute();
        } catch (PDOException $e) {
            $output['success'] = false;
            $output['messages'] = "ไม่สามารถเพิ่มข้อมูลได้กรุณาเปลี่ยนชื่่อ";
        }
        if (empty($e)) {
            $output['success'] = true;
            $output['messages'] = "แก้ไขข้อมูลแล้ว";
        }
    } else {
        try {
            $sql = "UPDATE product SET product_name = :product_name,price= :price
            ,title= :title ,function= :function,image =:image WHERE product_id = :product_id";
            $query = $conn->prepare($sql);
            $query->bindparam(':product_name', $editproductname);
            $query->bindparam(':price', $editproductprice);
            $query->bindparam(':title', $editproducttitle);
            $query->bindparam(':function', $editproductdetail);
            $query->bindparam(':image', $image);
            $query->bindparam(':product_id', $editproduct_id);
            $query->execute();
        } catch (PDOException $e) {
            $output['success'] = false;
            $output['messages'] = "ไม่สามารถเพิ่มข้อมูลได้กรุณาเปลี่ยนชื่่อ";
        }
        if (empty($e)) {
            $output['success'] = true;
            $output['messages'] = "แก้ไขข้อมูลแล้ว";
        }
    }
}
echo json_encode($output);
?>
