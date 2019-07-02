<?php
session_start();
require('include/connect_db.php');
?>
<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = MD5($_POST['password']);

    $sql = "SELECT * FROM admin WHERE  
            username = :username AND pass_w = :password";
    $query = $conn->prepare($sql);
    $query->bindparam(':username', $username);
    $query->bindparam(':password', $password);
    $sql2 = "SELECT * FROM employee WHERE  
                username = :username AND pass_w = :password";
    $query2 = $conn->prepare($sql2);
    $query2->bindparam(':username', $username);
    $query2->bindparam(':password', $password);
    $sql3 = "SELECT * FROM siteadmin WHERE  
                        username = :username AND pass_w = :password";
    $query3 = $conn->prepare($sql3);
    $query3->bindparam(':username', $username);
    $query3->bindparam(':password', $password);
    $sql4 = "SELECT b.cus_id FROM siteadmin AS a 
    INNER JOIN orderpd AS b ON
    a.cus_id = b.cus_id 
    INNER JOIN payment AS c ON b.order_id = c.order_id
     WHERE username = '$username' AND pass_w = '$password' AND paid = 1";
    $query4 = $conn->prepare($sql4);
    $query4->bindparam(':username', $username);
    $query4->bindparam(':password', $password);
    
    if ($username) {
        if ($query->execute()) {
            if ($query->rowCount() == 1) {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION["admin_id"] = $row["admin_id"];
                    $_SESSION["admin_name"] = $row["username"];
                }
                Header("Location:admin/admin.php");
                exit(0);
            } else {
                if ($query2->execute()) {
                    if ($query2->rowCount() == 1) {
                        while ($row = $query2->fetch(PDO::FETCH_ASSOC)) {
                            $_SESSION["emp_id"] = $row["emp_id"];
                            $_SESSION["emp_name"] = $row["username"];
                        }
                        Header("Location:employee/employee.php");
                        exit(0);
                    } else {
                        if ($query3->execute()) {
                            if ($query3->rowCount() != 1) {
                                echo "<script>";
                                echo "alert(\"Username หรือ Password ไม่ถูกต้อง\");";
                                echo "window.history.back()";
                                echo "</script>";
                                exit(0);
                            } else {
                                while ($row = $query3->fetch(PDO::FETCH_ASSOC)) {
                                    $insert_query = "INSERT INTO login_details(last_activity,cus_id) VALUES (:last_activity,:cus_id)";
                                    $statement = $conn->prepare($insert_query);
                                    $dateTime = date("Y-m-d H:i:sa");
                                    $statement->bindparam(':last_activity', $dateTime);
                                    $statement->bindparam(':cus_id', $row["cus_id"]);
                                    $statement->execute();
                                    $login_id = $conn->lastInsertId();
                                    if (!empty($login_id)) {
                                        $_SESSION["cus_id"] = $row["cus_id"];
                                        $_SESSION["cus_name"] = $row["username"];
                                        $_SESSION["login_id"] = $login_id;
                                    }
                                }
                                if ($query4->execute()) {
                                    if ($query4->rowCount() != 1) {
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


