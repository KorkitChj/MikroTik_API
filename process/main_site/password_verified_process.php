<?php
session_start();
?>
<?php
error_reporting(0);
if (isset($_POST["user"])) {
    $output = array("success" => false, "messages" => array());
    require('../../includes/db_connect.php');
    $usera = $_POST['user'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ($password1 != $password2) {
        $output['success'] = false;
        $output['messages'] = "รหัสผ่านไม่ตรงกัน";
    } else {
        try {
            $user = base64_decode(urldecode($usera[0]));
            $date = base64_decode(urldecode($usera[1]));
            $userlv = $usera[2];
            preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/', $date, $matches);
            if ((empty($matches))) {
                throw new Exception('ผิดพลาด ขอลิงก์ใหม่');
            } else {
                $space = explode(" ", $date);
            }
            $time = explode(":", $space[1]);
            $time = $time[0] . ":" . $time['1'];
            $addtime = strtotime($time . '+3 hour');
            //$test = date('Y-m-d H:i:s', $addtime);
            $datetime1 = new DateTime();
            $interval = $datetime1->diff(new DateTime(date('Y-m-d H:i:s', $addtime)));
        } catch (Exception $e) {
            $output['success'] = false;
            $output['messages'] = "ไม่สามารถบันทึกข้อมูลได้ " . $e->getMessage();
        }
        if (empty($e)) {
            if ($interval->h == 0 || $interval->h > 2) {
                $output['success'] = false;
                $output['messages'] = "ลิงก์หมดอายุแล้ว";
            }else {
                if($userlv == "siteadmin_pwreset"){
                    $password = password_hash($password1,PASSWORD_DEFAULT);
                    $sql = "UPDATE siteadmin SET pass_w = :pass_w WHERE username = :user";
                    $query = $conn->prepare($sql);
                    $query->bindparam(':pass_w', $password);
                    $query->bindparam(':user', $user);
                    $query->execute();
                    $rows = $query->rowCount();
                    if ($rows != 0) {
                        $output['success'] = true;
                        $output['messages'] = "บันทึกข้อมูลแล้ว";
                    } else {
                        $output['success'] = false;
                        $output['messages'] = "ไม่สามารถบันทึกข้อมูลได้";
                    }
                }elseif($userlv == "admin_pwreset"){
                    $password = password_hash($password1,PASSWORD_DEFAULT);
                    $sql = "UPDATE admin SET pass_w = :pass_w WHERE username = :user";
                    $query = $conn->prepare($sql);
                    $query->bindparam(':pass_w', $password);
                    $query->bindparam(':user', $user);
                    $query->execute();
                    $rows = $query->rowCount();
                    if ($rows != 0) {
                        $output['success'] = true;
                        $output['messages'] = "บันทึกข้อมูลแล้ว";
                    } else {
                        $output['success'] = false;
                        $output['messages'] = "ไม่สามารถบันทึกข้อมูลได้";
                    }
                }else{
                    $output['success'] = false;
                    $output['messages'] = "ไม่สามารถบันทึกข้อมูลได้";
                }
            }
        }
    }
}
echo json_encode($output);
?>                  