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
                                        $id = $_SESSION["cus_name"];
                                        $sqlor = "SELECT b.cus_id FROM siteadmin AS a INNER JOIN orderpd AS b ON
                                a.cus_id = b.cus_id WHERE username = '$id'";
                                        if ($ord = $conn->query($sqlor)) {
                                            if ($ord->num_rows >= 1) {
                                                echo "<script>";
                                                echo "alert(\"คุณสามารถซื้อได้1รายการ\");";
                                                echo "window.location='transfer.php'";
                                                echo "</script>";
                                            } else {
                                                $sql = "SELECT * FROM siteadmin WHERE username = '$id'";
                                                if ($us = $conn->query($sql)) {
                                                    if ($us->num_rows == 1) {
                                                        $usn = $_POST['name'];
                                                        $add = $_POST['address'];
                                                        $sl = $_POST['sli'];
                                                        $tel = $_POST['tel'];
                                                        $email = $_POST['email'];
                                                        //$date = $_POST['date'];

                                                        while ($row = $us->fetch_array(MYSQLI_ASSOC)) {
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
                                                                $sql1 = "INSERT INTO orderpd VALUES('','$sl','$date_field','$sl1','$cus_id')";
                                                                if ($conn->query($sql1)) {
                                                                    echo "<script>";
                                                                    echo "alert(\"เพิ่มรายการเรียนร้อยแล้ว\");";
                                                                    echo "window.location='transfer.php'";
                                                                    echo "</script>";
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>

<?php } ?>