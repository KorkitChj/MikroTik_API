<?php
if ($_POST) {
    include('../../includes/db_connect.php');
    $output = array('success' => false, 'messages' => array());
    if (isset($_POST['product_id'])) {
        if ($_POST['type'] == 'one') {
            $product_id = $_POST['product_id'];
            $sql = "SELECT * FROM product WHERE product_id = :product_id";
            $query = $conn->prepare($sql);
            $query->bindparam(':product_id', $product_id);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            unlink('../../img/products/'.$row['image'].'');
            $sql = "DELETE FROM product WHERE product_id = :product_id";
            $result =  $conn->prepare($sql);
            $result->bindparam(':product_id', $product_id);
            $statement = $result->execute();
            if (!empty($statement)) {
                $output['success'] = true;
                $output['messages'] = "ลบข้อมูลแล้ว";
            } else {
                $output['success'] = false;
                $output['messages'] = "ผิดพลาด";
            }
        } elseif ($_POST['type'] == 'many') {
            $product_id = $_POST['product_id'];
            $product_id = implode(", ", $product_id);
            $product_id2 = explode(", ",$product_id);
            foreach($product_id2 as $xx){
                $sql = "SELECT * FROM product WHERE product_id = :xx";
                $query = $conn->prepare($sql);
                $query->bindparam(':xx', $xx);
                $query->execute();
                $row = $query->fetch(PDO::FETCH_ASSOC);
                unlink('../../img/products/'.$row['image'].'');
            }
            $sql = "DELETE FROM product WHERE product_id IN (:product_id)";
            $result = $conn->prepare($sql);
            $result->bindparam(':product_id',$product_id);
            $statement = $result->execute();
            if (!empty($statement)) {
                $output['success'] = true;
                $output['messages'] = "ลบข้อมูลแล้ว";
            } else {
                $output['success'] = false;
                $output['messages'] = "ผิดพลาด";
            }
        }
    }
}
echo json_encode($output);
