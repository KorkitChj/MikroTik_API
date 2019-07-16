<?php
session_start();
?>
<?php
if($_POST){
    $name = $_POST["editname"];
    $password = $_POST['editpassword'];
    $profile = $_POST['editprofile'];
    $limituptime = $_POST['editlimituptime'];
    $comment = $_POST['editcomment'];
    $username = $_POST['edituser_name'];

    include ('function.php');

    $emp_id = $_SESSION['emp_id'];

    list($ip, $port, $user, $pass_r, $site, $conn, $API) = fatchuser($emp_id);

    $output = array('success' => false, 'messages' => array());

    if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
        $ARRAY = $API->comm("/ip/hotspot/user/set",array(
            "name" => $name,
            "password" => $password,
            "profile" => $profile,
            "limit-uptime" => $limituptime,
            "comment" => $comment,
            "numbers" => $username,
        ));
            $output['success'] = true;
            $output['messages'] = "แก้ไขข้อมูลแล้ว";
    }
    else
    {
        $output['success'] = false;
        $output['messages'] = "กรุณารีเฟสหน้าจอ หรือ เชื่อมต่อไซต์ใหม่";
    }
}
echo json_encode($output);
?>