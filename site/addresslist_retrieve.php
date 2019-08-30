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
    $ARRAY = $API->comm("/ip/address/print");

    $ARRAY2 = $API->comm("/ip/address/print",array("?dynamic" => "true"));
    $ARRAY3 = $API->comm("/ip/address/print",array("?disabled" => "true"));

    $no = 1;
    foreach($ARRAY as $row) {       
        foreach($ARRAY2 as $row2){
            if($row2['.id'] == $row['.id']){
                $checkbox = '';
                $addresst = $row2['address'];
                $idtk = '<button title="dynamic" class="btn btn-success">D</button>';
                $manage = '
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <button class="btn btn-success disabled" type="button"><span title="เปิด" class="glyphicon glyphicon-ok"></span></button>
            <button class="btn btn-danger disabled" type="button"><span title="ปิด" class="glyphicon glyphicon-remove"></span></button>
            <button type="button" class="btn btn-warning disabled"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
            <button type="button" class="btn btn-danger disabled"><span class="glyphicon glyphicon-trash"></span></button></div>';
                break;
            }
        }

        foreach($ARRAY3 as $row3){
            if($row3['.id'] == $row['.id']){
                $addresst = $row3['address'];
                $idtk = '<button title="disable" class="btn btn-light">X</button>';
                $checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="checkitem custom-control-input" name="address_id[]" value="'.$row['.id'].'"><span class="custom-control-indicator"></span></label>';
                $manage = '
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <button class="btn btn-success" type="button" onclick="enableAddress(\''.$row['.id'].'\')"><span title="เปิด" class="glyphicon glyphicon-ok"></span></button>
            <button class="btn btn-danger" type="button"  onclick="disableAddress(\''.$row['.id'].'\')"><span title="ปิด" class="glyphicon glyphicon-remove"></span></button>
            <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editIpModal" onclick="editIp(\'' . $row['.id'] . '\')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#removeAddressModal" onclick="removeAddress(\'' . $row['.id'] . '\')"><span class="glyphicon glyphicon-trash"></span></button></div>';
                break;
            }
        }
        
        if($addresst==""){
            $idtk = "";
            $checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="checkitem custom-control-input" name="address_id[]" value="'.$row['.id'].'"><span class="custom-control-indicator"></span></label>';
            $manage = '
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <button class="btn btn-success" type="button" onclick="enableAddress(\''.$row['.id'].'\')"><span title="เปิด" class="glyphicon glyphicon-ok"></span></button>
            <button class="btn btn-danger" type="button"  onclick="disableAddress(\''.$row['.id'].'\')"><span title="ปิด" class="glyphicon glyphicon-remove"></span></button>
            <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editIpModal" onclick="editIp(\'' . $row['.id'] . '\')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#removeAddressModal" onclick="removeAddress(\'' . $row['.id'] . '\')"><span class="glyphicon glyphicon-trash"></span></button></div>';
        }
        
        $output['success'] = true;
        $output['data'][] = array(
            $checkbox,
            $no,
            $idtk,
            $row['address'],
            $row['network'],
            $row['interface'],
            $row['comment'],
            $manage
        );
        $no++;
        $addresst = "";
    }
}
echo json_encode($output);
?>