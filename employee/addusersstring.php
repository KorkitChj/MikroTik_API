<?php
session_start();
?>
<?php
if ($_POST) {
    include('function.php');
    include('ran2.php');

    $emp_id = $_SESSION['emp_id'];


    list($ip, $port, $user, $pass_r, $site, $conn, $API) = fetchuser($emp_id);

    $output = array('success' => false, 'messages' => array());


    $prefixst = $_POST['prefixst'];
    $num = $_POST['totalst'];
    $usernamest = $_POST['usernamest'];
    $passwordst = $_POST['passwordst'];
    $profilest = $_POST['profilest'];
    $limituptimest = $_POST['limituptimest'];
    $commentst = $_POST['commentst'];


    if ($API->connect($ip . ":" . $port, $user, $pass_r)) { } else {
        $output['success'] = false;
        $output['messages'] = "Disconnect !! กรุณารีเฟซเพจอีกครั้ง";
        echo json_encode($output);
        exit(0);
    }

    $i = 1;
    do {

        $username = $_POST['prefixst'] . genUser();
        $password = genPass();

        $ARRAY = $API->comm("/ip/hotspot/user/print");
        $count = count($ARRAY);
        for ($j = 1; $j < $count; $j++) {
            $a = $ARRAY[$j]['name'];
            if ($a == $username) {
                $output['success'] = false;
                $output['messages'] = "กรุณาเปลี่ยน Username";
                echo json_encode($output);
                exit(0);
            }
        }
        $ARRAY = $API->comm("/ip/hotspot/user/add", array(
            "name" => $username,
            "password" => $password,
            "profile" => $profilest,
            "limit-uptime" => $limituptimest,
            "comment" => $commentst,
        ));
        $i++;
    } while ($i <= $num);

    $output['success'] = true;
    $output['messages'] = "บันทึกข้อมูลแล้ว";
    echo json_encode($output);
    exit(0);
}
?>
