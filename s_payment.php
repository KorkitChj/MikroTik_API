<?php
session_start();
?>
<?php
if (!$_SESSION["register"]) {
    Header("Location:register.php");
} else { ?>
        <?php
        if (isset($_POST['sm'])) {
            require('include/connect_db.php');
            $cus_name = $_SESSION["register"];
            $usn = $_POST['name'];
            $sql = "SELECT b.cus_id FROM siteadmin AS a INNER JOIN orderpd AS b ON
    a.cus_id = b.cus_id WHERE username = :usn";
            $query = $conn->prepare($sql);
            $query->bindparam(':usn', $usn);
            $query->execute();
            $num_rows = $query->rowCount();
            if ($num_rows >= 1) {
                echo "<script>";
                echo "alert(\"คุณสามารถซื้อได้1รายการ\");";
                echo "window.location='transfer.php'";
                echo "</script>";
            } else {
                $sql = "SELECT * FROM siteadmin WHERE username = :cus_name";
                $query = $conn->prepare($sql);
                $query->bindparam(':cus_name', $cus_name);
                $query->execute();
                $num_rows = $query->rowCount();
                if ($num_rows != 0) {
                    $sl = $_POST['sli'];
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
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
                            $sql = "INSERT INTO orderpd VALUES('',:sl,:date_field,:sl1,:cus_id)";
                            $query = $conn->prepare($sql);
                            $query->bindparam(':sl', $sl);
                            $query->bindparam(':date_field', $date_field);
                            $query->bindparam(':sl1', $sl1);
                            $query->bindparam(':cus_id', $cus_id);
                            if ($query->execute()) {
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
        else if(isset($_POST['in']))
        {

        }
        ?>                   
<?php } ?>