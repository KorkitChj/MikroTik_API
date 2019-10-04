<?php
session_start();
?>
<?php
error_reporting(0);
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

include('function.php');

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

$output = array('data' => array());


$ARRAY = '';
if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/ip/pool/print");
    $num = count($ARRAY);
    if ($num == 0) { } else {
        for ($i = 0; $i < $num; $i++) {
            $no = $i + 1;

            $pool = $ARRAY[$i]['next-pool'];

            if ($pool == '') {
                $pool =  "NONE";
            }
            $checkbox = '
            <label class="checkbox">
                    <input type="checkbox" class="checkitem" name="pool_id[]" value="'. $ARRAY[$i][".id"].'">
                    <span class="danger"></span>
            </label>
            ';
            //$checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="checkitem pool_checkbox custom-control-input" name="pool_id[]" value="' . $ARRAY[$i][".id"] . '"><span class="custom-control-indicator"></span></label>';
            $manage = '
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#editIppoolModal" onclick="editIppool(\'' . $ARRAY[$i]['.id'] . '\')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removePoolModal" onclick="removePool(\'' . $ARRAY[$i]['.id'] . '\')"><span class="glyphicon glyphicon-trash"></span></button></div>';

            $output['data'][] = array(
                $checkbox,
                $no,
                $ARRAY[$i]['name'],
                $ARRAY[$i]['ranges'],
                $pool,
                $manage
            );
        }
    }
}
echo json_encode($output);
?>