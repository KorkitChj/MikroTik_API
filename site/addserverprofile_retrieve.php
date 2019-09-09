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
    $ARRAY = $API->comm("/ip/hotspot/profile/print");
    $ARRAY2 = $API->comm("/ip/hotspot/profile/print",array("?default" => "true"));
    $num = count($ARRAY);
    for ($i = 0; $i < $num; $i++) {
        $no = $i + 1;
        foreach($ARRAY2 as $value){
            if($value['.id'] == $ARRAY[$i]['.id']){
                $server = $value['.id'];
                    $m = " * ";
                    $checkbox = '';
                    $manage = '<div class="btn-group btn-group-toggle" data-toggle="buttons"><button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#editServerProfileModal" onclick="editServerProfile(\'' . $ARRAY[$i]['.id'] . '\')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
                    <button  type="button" class="btn btn-danger disabled btn-sm"><span class="glyphicon glyphicon-trash"></span></button></div>';
                break;
            }
        }
        if($server == ''){
            $m = '';
            $checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="checkitem custom-control-input" name="ServerP_id[]" value="' . $ARRAY[$i][".id"] . '"><span class="custom-control-indicator"></span></label>';
            $manage = '<div class="btn-group btn-group-toggle" data-toggle="buttons"><button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#editServerProfileModal" onclick="editServerProfile(\'' . $ARRAY[$i]['.id'] . '\')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
            <button  type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeServerProfileModal" onclick="removeServerProfile(\'' . $ARRAY[$i]['.id'] . '\')"><span class="glyphicon glyphicon-trash"></span></button></div>';
        }
        

        $output['success'] = true;
        $output['data'][] = array(
            $checkbox,
            $no,
            $m,
            $ARRAY[$i]['name'],
            $ARRAY[$i]['hotspot-address'],
            $ARRAY[$i]['dns-name'],
            $ARRAY[$i]['rate-limit'],
            $manage
        );
        $server = '';
    }
}
echo json_encode($output);
?>