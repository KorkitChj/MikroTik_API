<?php
session_start();
?>
<?php
error_reporting(0);
if ($_POST) {
    $output = array("success" => false, "messages" => array(), "link" => array());
    require('../../includes/db_connect.php');
    $cus_name = $_SESSION["user"];
    $product_id = $_SESSION["id"];
    $usn = $_POST['name'];
    $order_price = $_POST['order_price'];
    $date_field = $_POST['datetime'];

    $sql = "SELECT b.cus_id FROM siteadmin AS a INNER JOIN orderpd AS b ON
    a.cus_id = b.cus_id WHERE full_name = :usn";
    $query = $conn->prepare($sql);
    $query->bindparam(':usn', $usn);
    $query->execute();
    $num_rows = $query->rowCount();
    if ($num_rows >= 1) {
        $output['success'] = false;
        $output['messages'] = "คุณได้สั่งซื้อเรียบร้อยแล้ว";
        $output['link'] = "transfer.php";
    } else {
        $sql = "SELECT * FROM siteadmin WHERE username = :cus_name";
        $query = $conn->prepare($sql);
        $query->bindparam(':cus_name', $cus_name);
        $query->execute();
        $num_rows = $query->rowCount();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($num_rows != 0) {
            $sql = "INSERT INTO orderpd VALUES('',:sl,:date_field,:sl1,:cus_id)";
            $query = $conn->prepare($sql);
            $query->bindparam(':sl', $order_price);
            $query->bindparam(':date_field', $date_field);
            $query->bindparam(':sl1', $product_id);
            $query->bindparam(':cus_id', $result['cus_id']);
            if ($query->execute()) {
                unset($_SESSION['id']);
                unset($_SESSION['title']);
                unset($_SESSION['img']);
                unset($_SESSION['register']);
                unset($_SESSION['fullname']);
                unset($_SESSION['phone']);
                $output['success'] = true;
                $output['messages'] = "เพิ่มรายการเรียนร้อยแล้ว";
                $output['link'] = "transfer.php";
            }
        } else {
            $output['success'] = false;
            $output['messages'] = "คุณยังไม่ได้ลงทะเบียน";
            $output['link'] = "register.php";
        }
    }
}
echo json_encode($output);
?>                  