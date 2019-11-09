<?php
session_start();
include('../../includes/db_connect.php');
$output = array('success' => "fail", 'messages' => array());
if (is_uploaded_file($_FILES['file']['tmp_name'])) {
    $e = $_FILES['file']['error'];
    if ($e != 0) {
        $msg = "";
        if ($e == 1 || $e == 2) {
            $msg = "ไฟล์ที่อัปโหลดมีขนาดเกินกำหนด";
        } else {
            $msg = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
        }
        $output['success'] = "fail";
        $output['messages'] = $msg;
    } else {
        $name = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $date = $_POST['date'];
        $bank = $_POST['bank'];
        $money = $_POST['money'];
        $username = $_POST['username2'];
        $bk = "";
        if ($bank == 1) {
            $bk = "ไทยพาญิชย์";
        } elseif ($bank == 2) {
            $bk = "กรุงไทย";
        }
        $sqlor = "SELECT a.username FROM siteadmin AS a WHERE username = :username";
        $query = $conn->prepare($sqlor);
        $query->bindparam(':username', $username);
        $query->execute();
        $num_rows = $query->rowCount();
        if ($num_rows == 0) {
            $output['success'] = "fail";
            $output['messages'] = "usernameไม่มีอยู่";
        } else {
            $sqlaa = "SELECT * FROM siteadmin AS a 
                INNER JOIN orderpd AS b ON
                a.cus_id = b.cus_id 
                WHERE a.username = :username";

            $sqlar = "SELECT * FROM siteadmin AS a 
                INNER JOIN orderpd AS b ON
                a.cus_id = b.cus_id 
                INNER JOIN payment AS c ON
                b.order_id = c.order_id 
                WHERE a.username = :username";

            $query4 = $conn->prepare($sqlar);
            $query4->bindparam(':username', $username);
            $query4->execute();
            $result4 = $query4->rowCount();

            $query1 = $conn->prepare($sqlaa);
            $query1->bindparam(':username', $username);
            $query1->execute();
            $result = $query1->rowCount();
            if ($result == 0) {
                $output['success'] = "fail";
                $output['messages'] = "คุณยังไม่ใด้สั่งซื้อ";
            } else if ($result4 != 0) {
                $output['success'] = "fail";
                $output['messages'] = "คุณได้ยืนยันชำระเงินแล้ว";
            } else {
                $id = "";
                $row = $query1->fetch(PDO::FETCH_ASSOC);
                $id = $row['cus_id'];
                $sqlid = "SELECT a.order_id,a.total_cash
                        FROM orderpd AS a 
                        WHERE a.cus_id = :id";
                $query2 = $conn->prepare($sqlid);
                $query2->bindparam(':id', $id);
                $query2->execute();
                $result = $query2->fetchAll();
                foreach ($result as $row) {
                    $orderid = $row['order_id'];
                    if ($row["total_cash"] != $money) {
                        $output['success'] = "confirm";
                        $output['messages'] = "กรุณายืนยันจำนวนเงินให้ถูกต้อง";
                    } else {
                        $target = "../../slips/$name";
                        $newname = $name;
                        if (file_exists($target)) {
                            $oldname = pathinfo($name, PATHINFO_FILENAME);
                            $ext = pathinfo($name, PATHINFO_EXTENSION);
                            $newname = $oldname;
                            do {
                                $r = rand(1000, 9999);
                                $newname = $oldname . "-" . $r . ".$ext";
                                $target = "../../slips/$newname";
                            } while (file_exists($target));
                        }
                        move_uploaded_file($_FILES['file']['tmp_name'], $target);
                        $begin_price = 1000;
                        $days = 365;

                        $expired = round(($row['total_cash']*$days)/$begin_price);
                        $enddate = strtotime("+{$expired} days", strtotime($date));                
                        $expired_date = date('Y-m-d H:i:s', $enddate);
                        $sqlp = "INSERT INTO payment VALUES('',:bk,:date,:expired,:money,:newname,0,:orderid)";
                        $query3 = $conn->prepare($sqlp);
                        $query3->bindparam(':bk', $bk);
                        $query3->bindparam(':date', $date);
                        $query3->bindparam(':expired', $expired_date);
                        $query3->bindparam(':money', $money);
                        $query3->bindparam(':newname', $newname);
                        $query3->bindparam(':orderid', $orderid);
                        $query3->execute();
                        unset($_SESSION['user']);
                        unset($_SESSION['price']);
                        $output['success'] = "success";
                        $output['messages'] = "ดำเนินการเรียบร้อยแล้ว";
                    }
                }
            }
        }
    }
}
echo json_encode($output);
