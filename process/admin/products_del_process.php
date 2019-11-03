<?php
//มันลบข้อมูลใน order และ siteadmin ด้วย น่าจะเพราะ on delete
if ($_POST) {
    include('../../includes/db_connect.php');
    $output = array('success' => false, 'messages' => array());
    if (isset($_POST['product_id'])) {
        $sql = "SELECT * FROM orderpd WHERE product_id = :product_id";
        if ($_POST['type'] == 'one') {
            $product_id = $_POST['product_id'];
            $query = $conn->prepare($sql);
            $query->bindparam(':product_id', $product_id);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            if (!empty($row['product_id'])) {
                $output['success'] = false;
                $output['messages'] = "ไม่สามารถลบรายการสินค้าได้ เนื่องจากยังมีรายการสั่งซื้อ";
            } else {
                $sql = "SELECT image FROM product WHERE product_id = :product_id";
                $query = $conn->prepare($sql);
                $query->bindparam(':product_id', $product_id);
                $query->execute();
                $row = $query->fetch(PDO::FETCH_ASSOC);
                unlink('../../img/products/' . $row['image'] . '');
                $sql = "DELETE FROM product WHERE product_id = :product_id";
                $result =  $conn->prepare($sql);
                $result->bindparam(':product_id', $product_id);
                $statement = $result->execute();
                if (!empty($statement)) {
                    $output['success'] = true;
                    $output['messages'] = "ลบข้อมูลแล้ว";
                }
            }
        } elseif ($_POST['type'] == 'many') {
            $product_id = $_POST['product_id'];
            $product_id = implode(", ", $product_id);
            $product_id2 = explode(", ", $product_id);
            $alert = array();
            foreach ($product_id2 as $xx) {
                $sql = "SELECT * FROM product AS a 
                INNER JOIN orderpd AS b on a.product_id = b.product_id
                WHERE a.product_id = :product_id";
                $query = $conn->prepare($sql);
                $query->bindparam(':product_id', $xx);
                $query->execute();
                $row = $query->fetch(PDO::FETCH_ASSOC);
                if (!empty($row['product_id'])) {
                    $alert[] = $row['product_name'];
                } else {
                    $sql = "SELECT image FROM product WHERE product_id = :product_id";
                    $query = $conn->prepare($sql);
                    $query->bindparam(':product_id', $xx);
                    $query->execute();
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                    unlink('../../img/products/' . $row['image'] . '');
                    $sql = "DELETE FROM product WHERE product_id = :product_id";
                    $result = $conn->prepare($sql);
                    $result->bindparam(':product_id', $xx);
                    $statement = $result->execute();
                }
            }
            if ($alert != '') {
                $pdname = implode(", ", $alert);
                $output['success'] = false;
                $output['messages'] = "รายการสินค้า{$pdname} ไม่สามารถลบได้ เนื่องจากยังมีรายการสั่งซื้อ";
            } else {
                $output['success'] = true;
                $output['messages'] = "ลบข้อมูลแล้ว";
            }
        }
    }
}
echo json_encode($output);
