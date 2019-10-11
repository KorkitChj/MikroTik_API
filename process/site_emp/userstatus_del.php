<?php
session_start();
?>
<?php

$emp_id = $_SESSION['emp_id'];

include('function.php');

$output = array('success' => false, 'messages' => array());

list($ip, $port, $user, $pass_r, $site, $conn, $API) = fetchuser($emp_id);

if ($API->connect($ip . ":" . $port, $user, $pass_r)) {

    if (isset($_POST['type'])) {
        if ($_POST['type'] == 'one') {
            $user_name = $_POST['user_name'];
            $ARRAY = $API->comm("/ip/hotspot/user/print");
            $num = count($ARRAY);
            if ($num == '0') {
                $output['success'] = false;
                $output['messages'] = "ไม่พบรายการ User";
            } else {
                $ARRAY = $API->comm("/ip/hotspot/user/remove", array(
                    "numbers" => $user_name,
                ));
                $output['success'] = true;
                $output['messages'] = "ทำการลบ User เรียบร้อยแล้ว";
            }
        } elseif ($_POST['type'] == 'many') {
            $users_name = implode(", ", $_POST['users_name']);
            $ARRAY = $API->comm("/ip/hotspot/user/remove", array(
                "numbers" => $users_name,
            ));
            $output['success'] = true;
            $output['messages'] = "ทำการลบ User ที่เลือกเรียบร้อยแล้ว";
        }
    }
} else {
    $output['success'] = false;
    $output['messages'] = "Disconnect";
}
echo json_encode($output);
?>