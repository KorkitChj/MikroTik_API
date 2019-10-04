<?php
session_start();
?>
<?php
error_reporting(0);
if ($_POST) {
    $output = array("success" => false, "messages" => array(), "link" => array());
    require('includes/connect_db.php');
    $cus_name = $_SESSION["user_register"];
    $usn = $_POST['name'];
    $sql = "SELECT b.cus_id FROM siteadmin AS a INNER JOIN orderpd AS b ON
    a.cus_id = b.cus_id WHERE username = :usn";
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
        if ($num_rows != 0) {
            $order_price = $_POST['order_price'];
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $cus_id = $row["cus_id"];
                $cus_name = $row["username"];
                if ($usn != $cus_name) {
                    $output['success'] = false;
                    $output['messages'] = "กรุณาใส่ Username ให้ถุกต้อง";
                } else {
                    switch ($order_price) {
                        case 500:
                            $sl1 = 1;
                            break;
                        case 1000:
                            $sl1 = 2;
                            break;
                        case 200:
                            $sl1 = 3;
                            break;
                        case 300:
                            $sl1 = 4;
                            break;
                        case 400:
                            $sl1 = 5;
                            break;
                        case 600:
                            $sl1 = 6;
                            break;
                        case 700:
                            $sl1 = 7;
                            break;
                        case 800:
                            $sl1 = 8;
                            break;
                        case 900:
                            $sl1 = 9;
                            break;
                        case 1500:
                            $sl1 = 10;
                            break;
                        default:
                            $sl1 = 11;
                    }
                    $date_field = $_POST['datetime'];
                    $sql = "INSERT INTO orderpd VALUES('',:sl,:date_field,:sl1,:cus_id)";
                    $query = $conn->prepare($sql);
                    $query->bindparam(':sl', $order_price);
                    $query->bindparam(':date_field', $date_field);
                    $query->bindparam(':sl1', $sl1);
                    $query->bindparam(':cus_id', $cus_id);
                    if ($query->execute()) {
                        $output['success'] = true;
                        $output['messages'] = "เพิ่มรายการเรียนร้อยแล้ว";
                        $output['link'] = "transfer.php";
                        break;
                    }
                }
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