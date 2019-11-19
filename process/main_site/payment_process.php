<?php
session_start();
?>
<?php
include('function.php');
error_reporting(0);
if (isset($_GET["post"]) == "confirm") {
    $output = array("success" => false, "messages" => array(), "link" => array());
    require('../../includes/db_connect.php');
    $cus_name = $_SESSION["user"];
    $product_id = $_SESSION["id"];
    $email = $_SESSION["email"];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $date_field = $_POST['datetime'];
    $order_name = $_POST['order_name'];
    $order_price = $_POST['order_price'];

    $mail = sendMailOrder($email, $name, $phone, $date_field, $order_name, $order_price);
    if ($mail != "Success") {
        $output['success'] = false;
        $output['messages'] = "ผิดพลาด กรุณาลองใหม่";
    } else {
        $sql = "SELECT * FROM siteadmin WHERE username = :cus_name";
        $query = $conn->prepare($sql);
        $query->bindparam(':cus_name', $cus_name);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
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
            $output['messages'] = "ยืนยันสั่งซื้อเรียนร้อยแล้ว 
            กรุณาตรวจสอบอีเมลของท่าน";
            $output['link'] = "transfer";
        }
    }
}
echo json_encode($output);
?>                  