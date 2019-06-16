<?php
session_start();
?>
<?php
if (!$_SESSION["cus_name"]) {
    Header("Location:register.php");
} else { ?>
        <?php
        if (isset($_POST['sm'])) {
            require('include/connect_db.php');
            $cus_name1 = $_SESSION["cus_name"];
            $usn = $_POST['name'];
            $sqlor = "SELECT b.cus_id FROM siteadmin AS a INNER JOIN orderpd AS b ON
    a.cus_id = b.cus_id WHERE username = :usn";
            $query = $conn->prepare($sqlor);
            $query->bindparam(':usn', $usn);
            $query->execute();
            $num_rows = $query->rowCount();
            if ($num_rows >= 1) {
                echo "<script>";
                echo "alert(\"คุณสามารถซื้อได้1รายการ\");";
                echo "window.location='transfer.php'";
                echo "</script>";
            } else {
                $sql = "SELECT * FROM siteadmin WHERE username = :cus_name1";
                $query1 = $conn->prepare($sql);
                $query1->bindparam(':cus_name1', $cus_name1);
                $query1->execute();
                $num_rows = $query1->rowCount();
                if ($num_rows != 0) {
                    $add = $_POST['address'];
                    $sl = $_POST['sli'];
                    $tel = $_POST['tel'];
                    $email = $_POST['email'];
                    while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
                        $cus_id = $row["cus_id"];
                        $cus_name = $row["username"];
                        if ($usn != $cus_name) {
                            echo "<script>";
                            echo "alert(\"กรุณาใส่ Username ให้ถุกต้อง\");";
                            echo "window.history.back()";
                            echo "</script>";
                        } else {
                            if ($sl != 500) {
                                $sl1 = 2;
                            } else {
                                $sl1 = 1;
                            }
                            $date_field = date('Y-m-d', strtotime($_POST['date']));
                            $sql1 = "INSERT INTO orderpd VALUES('',:sl,:date_field,:sl1,:cus_id)";
                            $query2 = $conn->prepare($sql1);
                            $query2->bindparam(':sl', $sl);
                            $query2->bindparam(':date_field', $date_field);
                            $query2->bindparam(':sl1', $sl1);
                            $query2->bindparam(':cus_id', $cus_id);
                            if ($query2->execute()) {
                                echo "<script>";
                                echo "alert(\"เพิ่มรายการเรียนร้อยแล้ว\");";
                                echo "window.location='transfer.php'";
                                echo "</script>";
                            }
                        }
                    }
                } else {
                    echo "<script>";
                    echo "alert(\"คุณยังไม่ได้ลงทะเบียน\");";
                    echo "window.location='register.php'";
                    echo "</script>";
                }
            }
        }
        ?>                   
<?php } ?>