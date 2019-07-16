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

    if (isset($_SESSION["cus_id"])) {
        $cus_name = ($_SESSION["cus_name"]);
        if ($newpasswordr1 != $newpasswordr2) {
            $output['success'] = false;
            $output['messages'] = 'รหัสผ่านใหม่ไม่ตรงกัน กรุณาใส่อีกครั้ง';
        } elseif ($newpasswordr1 === $newpasswordr2) {
            $sqlsel = "SELECT pass_w FROM siteadmin WHERE username = :cus_name";
            $result = $conn->prepare($sqlsel);
            $result->bindParam(':cus_name', $cus_name);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $passdb = $row["pass_w"];
            if ($oldpassword1 != $passdb) {
                $output['success'] = false;
                $output['messages'] = 'รหัสผ่านเก่าไม่ถูกต้อง';
            } elseif ($oldpassword1 === $passdb) {
                $sql = "UPDATE siteadmin set pass_w = :newpasswordr1 where username = :cus_name";
                $result = $conn->prepare($sql);
                $result->bindParam(':newpasswordr1',$newpasswordr1);
                $result->bindParam(':cus_name',$cus_name);
                $result->execute();
                if (!empty($result)) {
                    $output['success'] = true;
                    $output['messages'] = 'เปลี่ยนแปลงรหัสผ่านเรียบร้อยแล้ว';
                }
            }
        }
    }
}
// (isset($_SESSION["emp_id"])) {
//     $emp_name = ($_SESSION["emp_name"]);
//     if ($newpasswordr1 != $newpasswordr2) {
//         $output['success'] = false;
//         $output['messages'] = 'รหัสผ่านใหม่ไม่ตรงกัน กรุณาใส่อีกครั้ง';
//     } elseif ($newpasswordr1 === $newpasswordr2) {
//         $sqlsel = "SELECT pass_w FROM employee WHERE username = :emp_name";
//         $result = $conn->prepare($sqlsel);
//         $result->bindParam(':emp_name', $emp_name);
//         $result->execute();
//         $row = $result->fetch(PDO::FETCH_ASSOC);
//         $passdb = $row["pass_w"];
//         if ($oldpassword1 != $passdb) {
//             $output['success'] = false;
//             $output['messages'] = 'รหัสผ่านเก่าไม่ถูกต้อง';
//         } elseif ($oldpassword1 === $passdb) {
//             $sql = "UPDATE employee set pass_w = :newpasswordr1 where username = :emp_name";
//             $result = $conn->prepare($sql);
//             $result->bindParam(':emp_name', $emp_name);
//             $result->execute();
//             if (!empty($result)) {
//                 $output['success'] = false;
//                 $output['messages'] = 'เปลี่ยนแปลงรหัสผ่านเรียบร้อยแล้ว';
//             }
//         }
//     }
// }

echo json_encode($output);
?>
