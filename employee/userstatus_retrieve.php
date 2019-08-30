<?php
session_start();
?>
<?php

$emp_id = $_SESSION['emp_id'];

include('function.php');

list($ip, $port, $user, $pass_r, $site, $conn, $API) = fetchuser($emp_id);

$output = array('data' => array(), 'success' => false, 'messages' => array());

$ARRAY = '';
if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
    $ARRAY = $API->comm("/ip/hotspot/user/print");

    $num = count($ARRAY);

    if ($num == 1) {
        $output['success'] = false;
        $output['messages'] = "ไม่มี User";
    } else {
        for ($i = 1; $i < $num; $i++) {


            $checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="checkitem custom-control-input" name="users_name[]" value="' . $ARRAY[$i]["name"] . '"><span class="custom-control-indicator"></span></label>';


            $manage = '<div class="btn-group btn-group-toggle" data-toggle="buttons"><button type="button" class="btn btn-success" onclick="window.location.href=\'print.php?user&id='.$ARRAY[$i]["name"].'\'"><span title="Print คูปอง" class="glyphicon glyphicon-print"></span></button>
            <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editUserModal"  onclick="editUser(\'' . $ARRAY[$i]["name"] . '\')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#removeUserModal"  onclick="removeUser(\'' . $ARRAY[$i]["name"] . '\')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button></div>';

            $output['success'] = true;
            $output['data'][] = array(
                $checkbox,
                $i,
                $ARRAY[$i]['name'],
                $ARRAY[$i]['profile'],
                $ARRAY[$i]['limit-uptime'],
                $ARRAY[$i]['uptime'],
                $manage
            );
        }
    }
} else {
    $output['success'] = false;
    $output['messages'] = "กรุณารีเฟสหน้าจอ หรือ เชื่อมต่อไซต์ใหม่";
}
echo json_encode($output);
?>