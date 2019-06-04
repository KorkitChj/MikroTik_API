<?php
session_start();
?>
<?php
require('../include/connect_db.php');
if (isset($_POST['changpw'])) {
    $oldpassword1 = MD5($_POST["oldpassword"]);
    $newpasswordr1 = MD5($_POST["newpassword"]);
    $newpasswordr2 = MD5($_POST["renewpassword"]);
    
    if (isset($_SESSION["admin_id"])) {
        $username = ($_SESSION["admin_name"]);
        if ($newpasswordr1 != $newpasswordr2) {
            echo "<script>";
            echo "alert(\"รหัสผ่านใหม่ไม่ตรงกัน กรุณาใส่อีกครั้ง\");";
            echo "window.history.back()";
            echo "</script>";
        } elseif ($newpasswordr1 === $newpasswordr2) {
            $sqlsel = "SELECT pass_w FROM admin WHERE username = '$username'";
            $result = $conn->query($sqlsel);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $passdb = $row["pass_w"];
            if ($oldpassword1 != $passdb) {
                echo "<script>";
                echo "alert(\"รหัสผ่านเก่าไม่ถูกต้อง\");";
                echo "window.history.back();";
                echo "</script>";
            } elseif ($oldpassword1 === $passdb) {
                $sql = "UPDATE admin set pass_w = '$newpasswordr1' where username = '$username'";
                if ($conn->query($sql)) {
                    echo "<script>";
                    echo "alert(\"เปลี่ยนแปลงรหัสผ่านเรียบร้อยแล้ว\");";
                    echo "window.location='../admin/admin.php'";
                    echo "</script>";
                }
            }
        }
    } elseif (isset($_SESSION["cus_id"])) {
        $cus_name = ($_SESSION["cus_name"]);
        if ($newpasswordr1 != $newpasswordr2) {
            echo "<script>";
            echo "alert(\"รหัสผ่านใหม่ไม่ตรงกัน กรุณาใส่อีกครั้ง\");";
            echo "window.history.back();";
            echo "</script>";
        } elseif ($newpasswordr1 === $newpasswordr2) {
            $sqlsel = "SELECT pass_w FROM siteadmin WHERE username = '$cus_name'";
            $result = $conn->query($sqlsel);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $passdb = $row["pass_w"];
            if ($oldpassword1 != $passdb) {
                echo "<script>";
                echo "alert(\"รหัสผ่านเก่าไม่ถูกต้อง\");";
                echo "window.history.back();";
                echo "</script>";
            } elseif ($oldpassword1 === $passdb) {
                $sql = "UPDATE siteadmin set pass_w = '$newpasswordr1' where username = '$cus_name'";
                if ($conn->query($sql)) {
                    echo "<script>";
                    echo "alert(\"เปลี่ยนแปลงรหัสผ่านเรียบร้อยแล้ว\");";
                    echo "window.location='../siteadmin/connectstatus.php'";
                    echo "</script>";
                }
            }
        }
    } elseif (isset($_SESSION["emp_id"])) {
        $emp_name = ($_SESSION["emp_name"]);
        if ($newpasswordr1 != $newpasswordr2) {
            echo "<script>";
            echo "alert(\"รหัสผ่านใหม่ไม่ตรงกัน กรุณาใส่อีกครั้ง\");";
            echo "window.history.back();";
            echo "</script>";
        } elseif ($newpasswordr1 === $newpasswordr2) {
            $sqlsel = "SELECT pass_w FROM employee WHERE username = '$emp_name'";
            $result = $conn->query($sqlsel);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $passdb = $row["pass_w"];
            if ($oldpassword1 != $passdb) {
                echo "<script>";
                echo "alert(\"รหัสผ่านเก่าไม่ถูกต้อง\");";
                echo "window.history.back();";
                echo "</script>";
            } elseif ($oldpassword1 === $passdb) {
                $sql = "UPDATE employee set pass_w = '$newpasswordr1' where username = '$emp_name'";
                if ($conn->query($sql)) {
                    echo "<script>";
                    echo "alert(\"เปลี่ยนแปลงรหัสผ่านเรียบร้อยแล้ว\");";
                    echo "window.location='../employee/employee.php'";
                    echo "</script>";
                }
            }
        }
    }
}
?>
