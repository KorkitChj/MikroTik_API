<?php
session_start();
?>
<?php

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];
include('function.php');

$output = array('success' => false, 'messages' => array());

list($ip, $port, $user, $pass, $site, $conn, $API) = fatchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {

    if (isset($_POST['type'])) {
        if ($_POST['type'] == 'one') {
            $profile_id = $_POST['profile_id'];
            $ARRAY = $API->comm("/ip/hotspot/user/profile/print");
            $num = count($ARRAY);
            if ($num == '0') {
                $output['success'] = false;
                $output['messages'] = "ไม่พบรายการ Bypass";
            } else {
                if ($profile_id  == "default") {
                    $output['success'] = false;
                    $output['messages'] = "ไม่สามารถลบ Profile ได้";
                } else {
                    $ARRAY = $API->comm("/ip/hotspot/user/profile/remove", array(
                        "numbers" => $profile_id,
                    ));
                    $output['success'] = true;
                    $output['messages'] = "ทำการลบแพคเกจเรียบร้อยแล้ว";
                }
            }
        } elseif ($_POST['type'] == 'many') {
            $profile_id = implode(", ", $_POST['profile_id']);
            $ARRAY = $API->comm("/ip/hotspot/user/profile/remove", array(
                "numbers" => $profile_id,
            ));
            $output['success'] = true;
            $output['messages'] = "ทำการลบแพคเกจที่เลือกเรียบร้อยแล้ว";
        }
    }
}else{
    $output['success'] = false;
    $output['messages'] = "Disconnect";
}
echo json_encode($output);
?>