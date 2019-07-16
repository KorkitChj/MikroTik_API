<?php
session_start();
?>
<?php
if ($_POST) {
    include('function.php');

    $emp_id = $_SESSION['emp_id'];

    
    list($ip, $port, $user, $pass_r, $site, $conn, $API) = fatchuser($emp_id);

    $output = array('success' => false, 'messages' => array());


    $name = $_POST['name'];
    $password = $_POST['password'];
    $profile = $_POST['profile'];
    $limituptime = $_POST['limituptime'];
    $comment = $_POST['comment'];
    
    if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
        $ARRAY = $API->comm("/ip/hotspot/user/print");
        $count = count($ARRAY);
        for ($i = 1; $i < $count; $i++) {
            $a = $ARRAY[$i]['name'];
            if ($a == $name) {    
                $output['success'] = false;
                $output['messages'] = "กรุณาเปลี่ยน Username";
                echo json_encode($output);
                exit(0);
         
            }
        }
        $ARRAY = $API->comm("/ip/hotspot/user/add", array(
            "name" => $name,
            "password" => $password,
            "profile" => $profile,
            "limit-uptime" => $limituptime,
            "comment" => $comment,
        ));
        $output['success'] = true;
        $output['messages'] = "บันทึกข้อมูลแล้ว";
    }
    else
    {
        $output['success'] = false;
        $output['messages'] = "Disconnect !! กรุณารีเฟซเพจอีกครั้ง";
    }
}
echo json_encode($output);
?>
