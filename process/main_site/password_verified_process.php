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

    if($password1 != $password2){
        $output['success'] = false;
        $output['messages'] = "รหัสผ่านไม่ตรงกัน";
    }else{
        $user = base64_decode(urldecode( $usera[0]));
        $date = base64_decode(urldecode( $usera[1]));
        $space = explode(" ",$date);
        $time = explode(":",$space[1]);
        $time = $time[0].":".$time['1'];
        $daten = date('Y-m-d H:i:s');
        $daten2 = date('H:i');
        $expired = date('H:i', strtotime($time.'+3 hour'));
        if($date > $daten){
            $output['success'] = false;
            $output['messages'] = "ลิงก์หมดอายุแล้ว";
        }elseif($daten2 >= $expired){
            $output['success'] = false;
            $output['messages'] = "ลิงก์หมดอายุแล้ว";
        }else{
            $password = MD5($password1);
            $sql = "UPDATE siteadmin SET pass_w = :pass_w WHERE username = :user";
            $query = $conn->prepare($sql);
            $query->bindparam(':pass_w', $password);
            $query->bindparam(':user', $user);
            $query->execute();
            $rows = $query->rowCount(); 
            if($rows != 0){
                $output['success'] = true;
                $output['messages'] = "บันทึกข้อมูลแล้ว";
            }else{
                $output['success'] = false;
                $output['messages'] = "ไม่สามารถบันทึกข้อมูลได้";
            }
        }
    }
}
echo json_encode($output);
?>                  