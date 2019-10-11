<?php
session_start();
?>
<?php
error_reporting(0);
$emp_id = $_SESSION['emp_id'];

include('function.php');
include('../../includes/datethai_function.php');
list($ip, $port, $user, $pass_r, $site, $conn, $API) = fetchuser($emp_id);

$output = array('data' => array(), 'success' => false, 'messages' => array());

$ARRAY = '';
if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
    $ARRAY = $API->comm("/ip/hotspot/user/print");
    $ARRAY2 = $API->comm("/ip/hotspot/user/profile/print");

    $num = count($ARRAY);
    $num2 = count($ARRAY2);

    if ($num == 1) {
        $output['success'] = false;
        $output['messages'] = "ไม่มี User";
    } else {
        for ($i = 1; $i < $num; $i++) {
            $daytouse = "unlimit";
            for ($j = 0; $j < $num2; $j++) {
                if ($ARRAY[$i]['profile'] == $ARRAY2[$j]['name']) {
                    $string = explode(";", $ARRAY2[$j]['on-login']);
                    $string2 = explode(" ", $string[2]);
                    $daytouse = $string2[2]." วัน";
                    break;
                }
            }
            $checkbox = '
            <label class="checkbox">
                <input type="checkbox" class="checkitem " name="users_name[]" value="' . $ARRAY[$i]["name"].'">
                <span class="danger"></span>
        </label>
        ';

            $manage = '<div class="btn-group btn-group-toggle" data-toggle="buttons"><button type="button" class="btn btn-success btn-sm" onclick="window.location.href=\'../process/site_emp/print.php?user&id=' . $ARRAY[$i]["name"] . '&day='.$daytouse.'\'"><span title="Print คูปอง" class="glyphicon glyphicon-print"></span></button>
            <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#editUserModal"  onclick="editUser(\'' . $ARRAY[$i]["name"] . '\')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#removeUserModal"  onclick="removeUser(\'' . $ARRAY[$i]["name"] . '\')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button></div>';


            if ($ARRAY[$i]['comment'] != '') {
                if (($ARRAY[$i]['comment']) == "expire") {
                    $expired_date = '';
                } else {
                    $value = explode("@", $ARRAY[$i]['comment']);
                    $expired_date = DateThai($value[1]);
                }
            } else {
                $expired_date = '';
            }
            $output['success'] = true;
            $output['data'][] = array(
                $checkbox,
                $i,
                $ARRAY[$i]['name'],
                $ARRAY[$i]['profile'],
                $daytouse,
                $expired_date,
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