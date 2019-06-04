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
                if ($siteadmin = $conn->query("SELECT * FROM siteadmin WHERE  
                username = '$username' AND pass_w = '$password'")) {
                    if ($siteadmin->num_rows == 1) {
                        while ($row = $siteadmin->fetch_array(MYSQLI_ASSOC)) {
                            $_SESSION["cus_id"] = $row["cus_id"];
                            $_SESSION["cus_name"] = $row["username"];
                        }
                        Header("Location:siteadmin/connectstatus.php");
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
                                echo "<script>";
                                echo "alert(\"Username หรือ Password ไม่ถูกต้อง\");";
                                echo "window.history.back()";
                                echo "</script>";
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


