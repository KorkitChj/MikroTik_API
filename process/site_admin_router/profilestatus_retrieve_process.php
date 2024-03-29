<?php
session_start();
?>
<?php
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

error_reporting(0);
include('function.php');

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$output = array('data' => array(),'success' => false,'messages' => array());

$ARRAY = '';
if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/ip/hotspot/user/profile/print");

    $num = count($ARRAY);
    for ($i = 0; $i < $num; $i++) {
        $no = $i + 1;

        $rate = '';
        if ($ARRAY[$i]['rate-limit'] == "") {
            $rate =  "Unlimited";
        } else {
            $rate = $ARRAY[$i]['rate-limit'];
        }
        // if(!empty($ARRAY[$i]['on-login'])){
        //     $string = explode(";",$ARRAY[$i]['on-login']);
        //     $string2 = explode(" ",$string[2]);
        //     $daytouse = $string2[2];
        // }else{
        //     $daytouse = '';
        // }

        if(!empty($ARRAY[$i]['name'])){
            $string = explode("_",$ARRAY[$i]['name']);
            $string2 = explode("/",$string[1]);
            $daytouse = $string2[0];
        }else{
            $daytouse = '';
        }
        

        //$checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="profile_checkbox custom-control-input" name="Profile_id[]" value="' . $ARRAY[$i]["name"] . '"><span class="custom-control-indicator"></span></label>';
        $checkbox = '
        <label class="checkbox">
                <input type="checkbox" class="profile_checkbox " name="Profile_id[]" value="' . $ARRAY[$i]["name"] . '">
                <span class="danger"></span>
        </label>
        ';
        $manage = '<div class="btn-group btn-group-toggle" data-toggle="buttons"><button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#editProfileModal"  onclick="editProfile(\''.$ARRAY[$i]["name"].'\')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
        <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#removeProfileModal"  onclick="removeProfile(\''.$ARRAY[$i]["name"].'\')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button></div>';

        $output['success'] = true;
        $output['data'][] = array(
            $checkbox,
            $no,
            $ARRAY[$i]['name'],
            $rate,
            $ARRAY[$i]['shared-users'],
            $daytouse,
            $manage
        );
    }
}
else{
    $output['success'] = false;
    $output['messages'] = "กรุณารีเฟสหน้าจอ หรือ เชื่อมต่อไซต์ใหม่";
}
echo json_encode($output);
?>