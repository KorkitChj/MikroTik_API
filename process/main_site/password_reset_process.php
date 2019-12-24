<?php
session_start();
?>
<?php
include('function.php');
$output = array("success" => false, "messages" => array(), "link" => array());
require('../../includes/db_connect.php');
error_reporting(0);
if (isset($_GET['pwreset'])) {
    $pwreset = $_GET['pwreset'];
    if ($pwreset == "admin_resetpw") {
        if (isset($_POST["email"])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['email'];
                $datetime = date('Y-m-d H:i:s');
                $sql = "SELECT e_mail,username FROM admin WHERE e_mail = :email";
                $query = $conn->prepare($sql);
                $query->bindparam(':email', $email);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                if ($result['e_mail'] != '') {
                    $link = "http://localhost/web/password_verified/" . urlencode(base64_encode($result['username'])) . "/" . urlencode(base64_encode($datetime)) . "/admin_pwreset";
                    $mail = sendMailPasswordReset($result['e_mail'], $result['username'], $link, "admin_resetpw");
                    if ($mail != "Success") {
                        $output['success'] = false;
                        $output['messages'] = "ผิดพลาด กรุณาลองใหม่";
                    } else {
                        $output['success'] = true;
                        $output['messages'] = "ส่งอีเมลแล้ว 
                        กรุณาตรวจสอบอีเมลของท่าน";
                        $output['link'] = "login";
                    }
                } else {
                    $output['success'] = false;
                    $output['messages'] = "ไม่พบข้อมูล";
                }
            } else {
                $output['success'] = false;
                $output['messages'] = "e-mail ไม่ถูกต้อง";
            }
        }
    } elseif ($pwreset == "siteadmin_resetpw") {
        if (isset($_POST["email"])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['email'];
                $datetime = date('Y-m-d H:i:s');
                $sql = "SELECT full_name,e_mail,username FROM siteadmin WHERE e_mail = :email";
                $query = $conn->prepare($sql);
                $query->bindparam(':email', $email);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                if ($result['e_mail'] != '') {
                    $link = "http://localhost/web/password_verified/" . urlencode(base64_encode($result['username'])) . "/" . urlencode(base64_encode($datetime)) . "/siteadmin_pwreset";
                    $mail = sendMailPasswordReset($result['e_mail'], $result['full_name'], $link, "siteadmin_resetpw");
                    if ($mail != "Success") {
                        $output['success'] = false;
                        $output['messages'] = "ผิดพลาด กรุณาลองใหม่";
                    } else {
                        $output['success'] = true;
                        $output['messages'] = "ส่งอีเมลแล้ว 
                        กรุณาตรวจสอบอีเมลของท่าน";
                        $output['link'] = "login";
                    }
                } else {
                    $output['success'] = false;
                    $output['messages'] = "ไม่พบข้อมูล";
                }
            }else{
                $output['success'] = false;
                $output['messages'] = "e-mail ไม่ถูกต้อง";
            }
        }
    } else {
        $output['success'] = false;
        $output['messages'] = "ไม่สามารถส่งเมลได้ ปิดแล้วลองใหม่";
    }
}
echo json_encode($output);
?>                  