<?php
session_start();
?>
<?php
require('../../includes/db_connect.php');
$output = array('success' => false, 'messages' => array());
if (isset($_POST['oldpassword'])) {
    $oldpassword = $_POST["oldpassword"];
    $newpassword = $_POST["newpassword"];
    $renewpassword = $_POST["renewpassword"];
    $newpassword1 = password_hash($newpassword,PASSWORD_DEFAULT);
    if (isset($_SESSION["admin_id"])) {
        $username = $_SESSION["admin_name"];
        if ($newpassword != $renewpassword) {
            $output['success'] = false;
            $output['messages'] = 'รหัสผ่านใหม่ไม่ตรงกัน กรุณาใส่อีกครั้ง';
        } else {
            $result = $conn->prepare("SELECT pass_w FROM admin WHERE username = :username");
            $result->bindParam(':username', $username);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $passdb = $row["pass_w"];
            if (!password_verify($oldpassword,$passdb)) {
                $output['success'] = false;
                $output['messages'] = 'รหัสผ่านเก่าไม่ถูกต้อง';
            } else{
                $sql = "UPDATE admin set pass_w = :newpassword1 where username = :username";
                $result = $conn->prepare($sql);
                $result->bindParam(':username', $username);
                $result->bindParam(':newpassword1', $newpassword1);
                $result->execute();

                if (!empty($result)) {
                    $output['success'] = true;
                    $output['messages'] = 'เปลี่ยนแปลงรหัสผ่านเรียบร้อยแล้ว';
                }
            }
        }
    }
} 
echo json_encode($output);
?>
