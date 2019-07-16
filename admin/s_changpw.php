<?php
session_start();
?>
<?php
require('../include/connect_db.php');
$output = array('success' => false, 'messages' => array());
if (isset($_POST['oldpassword'])) {

    $oldpassword1 = MD5(strip_tags($_POST["oldpassword"]));
    $newpasswordr1 = MD5(strip_tags($_POST["newpassword"]));
    $newpasswordr2 = MD5(strip_tags($_POST["renewpassword"]));
    if (isset($_SESSION["admin_id"])) {
        $username = $_SESSION["admin_name"];
        if ($newpasswordr1 != $newpasswordr2) {
            $output['success'] = false;
            $output['messages'] = 'รหัสผ่านใหม่ไม่ตรงกัน กรุณาใส่อีกครั้ง';
        } elseif ($newpasswordr1 === $newpasswordr2) {
            $result = $conn->prepare("SELECT pass_w FROM admin WHERE username = :username");
            $result->bindParam(':username', $username);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $passdb = $row["pass_w"];
            if ($oldpassword1 != $passdb) {
                $output['success'] = false;
                $output['messages'] = 'รหัสผ่านเก่าไม่ถูกต้อง';
            } elseif ($oldpassword1 === $passdb) {
                $sql = "UPDATE admin set pass_w = :newpasswordr1 where username = :username";
                $result = $conn->prepare($sql);
                $result->bindParam(':username', $username);
                $result->bindParam(':newpasswordr1', $newpasswordr1);
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
