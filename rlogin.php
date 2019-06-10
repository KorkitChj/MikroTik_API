<?php
session_start();
require('include/connect_db.php');
?>
<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = MD5($_POST['password']);

    if ($username) {
        if ($admin = $conn->query("SELECT * FROM admin WHERE  
        username = '$username' AND pass_w = '$password'")) {
            if ($admin->num_rows == 1) {
                while ($row = $admin->fetch_array(MYSQLI_ASSOC)) {
                    $_SESSION["admin_id"] = $row["admin_id"];
                    $_SESSION["admin_name"] = $row["username"];
                }
                Header("Location:admin/admin.php");
                exit(0);
            } else {
                if ($employee = $conn->query("SELECT * FROM employee WHERE  
                        username = '$username' AND pass_w = '$password'")) {
                    if ($employee->num_rows == 1) {
                        while ($row = $employee->fetch_array(MYSQLI_ASSOC)) {
                            $_SESSION["emp_id"] = $row["emp_id"];
                            $_SESSION["emp_name"] = $row["username"];
                        }
                        Header("Location:employee/employee.php");
                        exit(0);
                    } else {
                        if ($siteadmin = $conn->query("SELECT * FROM siteadmin WHERE  
                        username = '$username' AND pass_w = '$password'")) {
                            if ($siteadmin->num_rows != 1) {
                                echo "<script>";
                                echo "alert(\"Username หรือ Password ไม่ถูกต้อง\");";
                                echo "window.history.back()";
                                echo "</script>";
                                exit(0);
                            } else {
                                while ($row = $siteadmin->fetch_array(MYSQLI_ASSOC)) {
                                    $_SESSION["cus_id"] = $row["cus_id"];
                                    $_SESSION["cus_name"] = $row["username"];
                                }
                                if ($sitepayment = $conn->query("SELECT b.cus_id FROM siteadmin AS a 
                                INNER JOIN orderpd AS b ON
                                a.cus_id = b.cus_id 
                                INNER JOIN payment AS c ON b.order_id = c.order_id
                                 WHERE username = '$username' AND pass_w = '$password' AND paid = 1")) {
                                    if ($sitepayment->num_rows != 1) {
                                        echo "<script>";
                                        echo "alert(\"กรุณารอการยืนยันการชำระเงินจากAdmin หรือคุณยังไม่ยืนยันชำระเงิน\");";
                                        echo "window.history.back()";
                                        echo "</script>";
                                        exit(0);
                                    } else {
                                        echo "<script>";
                                        echo "alert(\"ยินดีต้อนรับสมาชิก\");";
                                        echo "window.location.href='siteadmin/connectstatus.php'";
                                        echo "</script>";
                                        exit(0);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    Header("Location:login.php");
}
?>


