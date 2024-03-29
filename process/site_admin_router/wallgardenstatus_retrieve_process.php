<?php
session_start();
?>
<?php
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

include('function.php');

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$output = array('data' => array(), 'success' => false, 'messages' => array());

$ARRAY = '';
if ($API->connect($ip . ":" . $port, $user, $pass)) {

    $ARRAY = $API->comm("/ip/hotspot/walled-garden/ip/print");

    $num = count($ARRAY);
    if($num == 0){
        $output['success'] = false;
        $output['messages'] = "ไม่มีรายการ Bypass";
    }
    for ($i = 0; $i < $num; $i++) {
        $no = $i + 1;

        $action = '';
        if($ARRAY[$i]['action'] == "accept"){
            $action = '<button class="btn btn-success btn-sm" type="button">ACCEPT</button>';
        }
        elseif($ARRAY[$i]['action'] == "drop")
        {
            $action = '<button class="btn btn-danger btn-sm" type="button">DROP</button>';
        }
        else
        {
            $action = '<button class="btn btn-warning btn-sm" type="button">REJECT</button>';
        }
        //$checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="profile_checkbox custom-control-input" name="wall_id[]" value="' . $ARRAY[$i]["comment"] . '"><span class="custom-control-indicator"></span></label>';
        $checkbox = '
        <label class="checkbox">
                <input type="checkbox" class="profile_checkbox " name="wall_id[]" value="' . $ARRAY[$i]["comment"] . '">
                <span class="danger"></span>
        </label>
        ';
        $manage = '<div class="btn-group btn-group-toggle" data-toggle="buttons"><button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#editWallModal"  onclick="editWall(\'' . $ARRAY[$i]["comment"] . '\')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
        <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#removeWallModal"  onclick="removeWall(\'' . $ARRAY[$i]["comment"] . '\')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button></div>';

        $output['success'] = true;
        $output['data'][] = array(
            $checkbox,
            $no,
            $ARRAY[$i]['dst-host'],
            $action,
            $ARRAY[$i]['comment'],
            $manage
        );
    }
} else {
    $output['success'] = false;
    $output['messages'] = "กรุณารีเฟสหน้าจอ หรือ เชื่อมต่อไซต์ใหม่";
}
echo json_encode($output);
?>                           
