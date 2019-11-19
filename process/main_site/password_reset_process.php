<?php
session_start();
?>
<?php
include('function.php');
error_reporting(0);
if (isset($_POST["email"])) {
    $output = array("success" => false, "messages" => array(), "link" => array());
    require('../../includes/db_connect.php');
    $email = $_POST['email'];

    $datetime = date('Y-m-d H:i:s');
    $sql = "SELECT full_name,e_mail,username FROM siteadmin WHERE e_mail = :email";
    $query = $conn->prepare($sql);
    $query->bindparam(':email', $email);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if ($result['e_mail'] != '') {
        $link = "http://localhost/web/password_verified/".urlencode(base64_encode($result['username']))."/".urlencode(base64_encode($datetime));
        $mail = sendMailPasswordReset($result['e_mail'], $result['full_name'],$link);
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
}
echo json_encode($output);
?>                  