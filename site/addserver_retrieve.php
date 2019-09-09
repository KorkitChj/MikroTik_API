<?php
session_start();
?>
<?php
error_reporting(0);
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

include('function.php');

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$output = array('data' => array(), 'success' => false, 'messages' => array());


$ARRAY = '';
if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/ip/hotspot/print");
    $ARRAY2 = $API->comm("/ip/hotspot/print", array('?disabled' => "true"));
    $num = count($ARRAY);
    if ($num != 0) {
        for ($i = 0; $i < $num; $i++) {
            $no = $i + 1;
            $pool = $ARRAY[$i]['address-pool'];
            if (!$ARRAY[$i]['address-pool']) {
                $pool = "none";
            }
            foreach ($ARRAY2 as $vv) {
                if ($vv['name'] == $ARRAY[$i]['name']) {
                    $aa = $ARRAY[$i]['name'];
                    $idtk = '<button title="disable" class="btn btn-warning btn-sm">D</button>';
                    $checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="checkitem custom-control-input" name="Server_id[]" value="' . $ARRAY[$i]['.id'] . '"><span class="custom-control-indicator"></span></label>';
                    $manage = '<div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <button class="btn btn-success btn-sm" type="button" onclick="enableServer(\'' . $ARRAY[$i]['.id'] . '\')"><span title="เปิด" class="glyphicon glyphicon-ok"></span></button>
                                <button class="btn btn-danger btn-sm" type="button"  onclick="disableServer(\'' . $ARRAY[$i]['.id'] . '\')"><span title="ปิด" class="glyphicon glyphicon-remove"></span></button>
                                <button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#editServerModal" onclick="editServer(\'' . $ARRAY[$i]['.id'] . '\')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeServerModal" onclick="removeServer(\'' . $ARRAY[$i]['.id'] . '\')"><span class="glyphicon glyphicon-trash"></span></button></div>';
                                break;
                }
            }
            if ($aa == "") {
                $idtk = '';
                $checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="checkitem custom-control-input" name="Server_id[]" value="' . $ARRAY[$i]['.id'] . '"><span class="custom-control-indicator"></span></label>';
                $manage = '<div class="btn-group btn-group-toggle" data-toggle="buttons">
                <button class="btn btn-success btn-sm" type="button" onclick="enableServer(\'' . $ARRAY[$i]['.id'] . '\')"><span title="เปิด" class="glyphicon glyphicon-ok"></span></button>
                <button class="btn btn-danger btn-sm" type="button"  onclick="disableServer(\'' . $ARRAY[$i]['.id'] . '\')"><span title="ปิด" class="glyphicon glyphicon-remove"></span></button>
                <button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#editServerModal" onclick="editServer(\'' . $ARRAY[$i]['.id'] . '\')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeServerModal" onclick="removeServer(\'' . $ARRAY[$i]['.id'] . '\')"><span class="glyphicon glyphicon-trash"></span></button></div>';
            }

            $output['success'] = true;
            $output['data'][] = array(
                $checkbox,
                $no,
                $idtk,
                $ARRAY[$i]['name'],
                $ARRAY[$i]['interface'],
                $pool,
                $ARRAY[$i]['profile'],
                $manage
            );
            $aa = '';
        }
    } else {
        $output['success'] = false;
        $output['messages'] = "ไม่พบรายการ";
    }
} else {
    $output['success'] = false;
    $output['messages'] = "กรุณารีเฟสหน้าจอ หรือ เชื่อมต่อไซต์ใหม่";
}
echo json_encode($output);
?>