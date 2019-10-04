<?php
session_start();
require('includes/connect_db.php');
?>
<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = MD5($_POST['password']);

    $sql = '';

    $sql .= "SELECT * FROM ";

    $output = array('success' => false, 'messages' => array());

    if ($username) {
        $admin = "admin";
        $sql1 = "WHERE username = :username AND pass_w = :password";
        $sql .= "$admin $sql1";
            $query = $conn->prepare($sql);
        if ($query->execute(array(
                ':username' =>  $username,
                ':password' => $password)
                )) {
            if ($query->rowCount() == 1) {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION["admin_id"] = $row["admin_id"];
                    $_SESSION["admin_name"] = $row["username"];
                }
                $output['success'] = true;
                $output['messages'] = "admin";
            } else {
                $sql = '';

                $sql .= "SELECT * FROM ";

                $employee = "employee";
                $sql .= "$employee $sql1";
                $query = $conn->prepare($sql);
                if ($query->execute(
                    array(
                        ':username' =>  $username,
                        ':password' => $password)
                        )) {
                    if ($query->rowCount() == 1) {
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            $_SESSION["emp_id"] = $row["emp_id"];
                            $_SESSION["emp_name"] = $row["username"];
                        }
                        $output['success'] = true;
                        $output['messages'] = "employee";                      
                    } else {
                        $sql2 = '';

                        $sql2 .= "SELECT * FROM ";

                        $siteadmin = "siteadmin";
                        $sql2 .= "$siteadmin $sql1";
                        $query = $conn->prepare($sql2);
                        if ($query->execute(
                            array(
                                ':username' =>  $username,
                                ':password' => $password)
                                )) {
                            if ($query->rowCount() != 1) {
                                $output['success'] = false;
                                $output['messages'] = "Username หรือ Password ไม่ถูกต้อง";  
                            } else {
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
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
                                $sql3 = "SELECT b.cus_id,b.product_id FROM siteadmin AS a 
                                INNER JOIN orderpd AS b ON
                                a.cus_id = b.cus_id 
                                INNER JOIN payment AS c ON
                                b.order_id = c.order_id
                                WHERE username = :username AND pass_w = :password AND paid = 1";
                                $query = $conn->prepare($sql3);
                                if ($query->execute(
                                    array(
                                        ':username' =>  $username,
                                        ':password' => $password)
                                    )) {
                                    if ($query->rowCount() != 1) {
                                        $output['success'] = true;
                                        $output['messages'] = "กรุณารอการยืนยันการชำระเงินจากAdmin หรือคุณยังไม่ยืนยันชำระเงิน";   
                                    } else {
                                        $result = $query->fetch(PDO::FETCH_ASSOC);
                                        if($result['product_id'] != '')
                                        {
                                            $output['success'] = true;
                                            $output['messages'] = "service"; 
                                        }
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
echo json_encode($output);
?>


