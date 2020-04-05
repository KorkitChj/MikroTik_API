<?php
session_start();
include '../../includes/db_connect.php';
define("SECRET_KEY", "6Ldi6scUAAAAAAXB0ayT36BYDiZnWeFOeXzV78Id");
$url = "https://www.google.com/recaptcha/api/siteverify";
?>

<?php
$output = array('success' => false, 'messages' => array());
function siteadmin($conn, $username, $password)
{
    $sql = "SELECT * FROM  siteadmin WHERE username = :username";
    $query = $conn->prepare($sql);
    $query->execute(array(':username' =>  $username));
    if ($query->rowCount() == 1) {
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $hashed_password = $result['pass_w'];
        if (password_verify($password, $hashed_password)) {
            $insert_query = "INSERT INTO login_details(last_activity,cus_id) VALUES (:last_activity,:cus_id)";
            $statement = $conn->prepare($insert_query);
            $dateTime = date("Y-m-d H:i:s");
            $statement->bindparam(':last_activity', $dateTime);
            $statement->bindparam(':cus_id', $result["cus_id"]);
            $statement->execute();
            $login_id = $conn->lastInsertId();
            if (!empty($login_id)) {
                $_SESSION["cus_id"] = $result["cus_id"];
                $_SESSION["cus_name"] = $result["username"];
                $_SESSION["login_id"] = $login_id;
            }
            $sql = "SELECT b.cus_id,b.product_id FROM siteadmin AS a 
                                    INNER JOIN orderpd AS b ON
                                    a.cus_id = b.cus_id 
                                    INNER JOIN payment AS c ON
                                    b.order_id = c.order_id
                                    WHERE username = :username AND paid = 1";
            $query = $conn->prepare($sql);
            if ($query->execute(array(':username' =>  $username))) {
                if ($query->rowCount() == 1) {
                    return array(true, "service");
                } else {
                    $_SESSION["service"] = "wait";
                    return array(true, "service");
                }
            }
        } else {
            return array(false, "รหัสผ่านไม่ถูกต้อง");
        }
    } else {
        return array(false, "ไม่พบ User");
    }
}
if (isset($_GET['hlogin'])) {
    $hlogin = $_GET['hlogin'];
    if ($hlogin == "admin_login") {
        $data = [
            'secret' => SECRET_KEY,
            'response' => $_POST['token'],
            // 'remoteip' => $_SERVER['REMOTE_ADDR']
        ];
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $res = json_decode($response, true);
        if ($res['success'] == true) {
            if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
                $e_mail = $_POST['username'];
                $password = $_POST['password'];
                $sql = "SELECT * FROM  admin WHERE e_mail = :e_mail";
                $query = $conn->prepare($sql);
                $query->execute(array(':e_mail' =>  $e_mail));
                if ($query->rowCount() == 1) {
                    $result = $query->fetch(PDO::FETCH_ASSOC);
                    $hashed_password = $result['pass_w'];
                    if (password_verify($password, $hashed_password)) {
                        if ($result['login_num'] == 0) {
                            //$issert_login_num = $conn->prepare("UPDATE admin SET login_num = 1 WHERE e_mail = :e_mail");
                            //$issert_login_num ->execute(array(':e_mail' =>$e_mail));  
                            $_SESSION["admin_id"] = $result["admin_id"];
                            $_SESSION["admin_name"] = $result["username"];
                            $output['success'] = true;
                            $output['messages'] = "admin";
                        } else {
                            $output['success'] = false;
                            $output['messages'] = "กรุณา logout ออกจากระบบ";
                        }
                    } else {
                        $output['success'] = false;
                        $output['messages'] = "รหัสผ่านไม่ถูกต้อง";
                    }
                } else {
                    $output['success'] = false;
                    $output['messages'] = "ไม่พบ User";
                }
            } else {
                $output['success'] = false;
                $output['messages'] = "e-mail ไม่ถูกต้อง";
            }
        } else {
            $output['success'] = false;
            $output['messages'] = "You are not a human";
        }
    } elseif ($hlogin == "siteadmin_empadmin_login") {
        $data = [
            'secret' => SECRET_KEY,
            'response' => $_POST['token'],
            // 'remoteip' => $_SERVER['REMOTE_ADDR']
        ];
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $res = json_decode($response, true);
        if ($res['success'] == true) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM  employee WHERE username = :username";
            $query = $conn->prepare($sql);
            $query->execute(array(':username' =>  $username));
            if ($query->rowCount() == 1) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $hashed_password = $result['pass_w'];
                if (password_verify($password, $hashed_password)) {
                    $_SESSION["emp_id"] = $result["emp_id"];
                    $_SESSION["emp_name"] = $result["username"];
                    $output['success'] = true;
                    $output['messages'] = "employee";
                } else {
                    $return = siteadmin($conn, $username, $password);
                    $output['success'] = $return[0];
                    $output['messages'] = $return[1];
                }
            } else {
                $return = siteadmin($conn, $username, $password);
                $output['success'] = $return[0];
                $output['messages'] = $return[1];
            }
        } else {
            $output['success'] = false;
            $output['messages'] = "You are not a human";
        }
    } else {
        Header("Location:../../index.php");
    }
}
echo json_encode($output);
?>


