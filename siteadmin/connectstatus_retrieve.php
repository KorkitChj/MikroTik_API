<?php
session_start();
?>
<?php
error_reporting(0);
require('../include/connect_db.php');
require('../config/routeros_api.class.php');
$API = new routeros_api();
$API->debug = false;
set_time_limit(160);
$output = array('data' => array());
$query1 = $conn->prepare("SELECT * FROM location WHERE cus_id = :cus_id");
$cus_id = $_SESSION['cus_id'];
$query1->bindparam(':cus_id',$cus_id);
$query1->execute();
$result = $query1->fetchAll();
$no = 0;
foreach ($result as $row) {
    $no++;
    $port = $row['api_port'];
    $checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="checkitem custom-control-input" name="location_id[]" value="' . $row["location_id"] . '"><span class="custom-control-indicator"></span></label>';
    if ($API->connect($row['ip_address'].":".$port,$row['username'],$row['password'])) {
        $ARRAY = $API->comm("/system/resource/print");

        $ARRAY2 = $API->comm("/ip/dhcp-client/print");

        foreach($ARRAY2 as $row2){
            $add = array();
            $add = explode("/",$row2['address']);
            $result = $add[0];
            if($result == $row['ip_address']){
                //$ress = $row2['address'];
                $inter = $row2['interface'];
                $status = $row2['status'];
                $expires = $row2['expires-after'];
                break;
            }
        }

        $connect = '<button type="button" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i>CONNECT</button>';
        $connz = "connect";       
        $manage = '<div class="btn-group btn-group-toggle" data-toggle="buttons">
        <button type="button" class="btn btn-info" onclick="window.location.href=\'../site/site_conn.php?id='.$row['location_id'].'&conn='.$connz.'\';"><span title="เข้าบริหารจัดการ" class="glyphicon glyphicon-new-window"></span></button>
        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editSiteModal"  onclick="editSite('.$row['location_id'].')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#removeSiteModal"  onclick="removeSite('.$row['location_id'].')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button></div>';
        /*$manage = '<button class="btn btn-info" type="button" onclick="if (confirm(\'เข้าจัดการไซต์งาน?\')) window.location.href=\'../site/site_conn.php?id='.$row['location_id'].'&conn='.$connz.'\';"><span title="เข้าบริหารจัดการ" class="glyphicon glyphicon-new-window"></span></button>
        <button class="btn btn-success" type="button" onclick="enableSite(\''.$ress.'\')"><span title="เปิด" class="glyphicon glyphicon-ok"></span></button>
        <button class="btn btn-danger" type="button"  onclick="disableSite(\''.$ress.'\')"><span title="ปิด" class="glyphicon glyphicon-remove"></span></button>*/
    } else {
        $inter = "-";
        $status = "-";
        $expires = "-";
        $connect = '<button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i>DISCONNECT</button>';
        $connz = "disconnect";
        $manage = '<div class="btn-group btn-group-toggle" data-toggle="buttons">
        <button type="button" class="btn btn-info" onclick="window.location.href=\'../site/site_conn.php?id='.$row['location_id'].'&conn='.$connz.'\';"><span title="เข้าบริหารจัดการ" class="glyphicon glyphicon-new-window"></span></button>
        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editSiteModal"  onclick="editSite('.$row['location_id'].')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#removeSiteModal"  onclick="removeSite('.$row['location_id'].')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button></div>';
        /*$manage = '<button class="btn btn-info" type="button" onclick="if (confirm(\'เข้าจัดการไซต์งาน?\')) window.location.href=\'../site/site_conn.php?id='.$row['location_id'].'&conn='.$connz.'\';"><span title="เข้าบริหารจัดการ" class="glyphicon glyphicon-new-window"></span></button>
        <button class="btn btn-success" type="button"><span title="เปิด" class="glyphicon glyphicon-ok"></span></button>
        <button class="btn btn-danger" type="button"><span title="ปิด" class="glyphicon glyphicon-remove"></span></button>
        */
    }
    $output['data'][]  = array(
        $checkbox,
        $no,
        $row['ip_address'].":".$port,
        $row['username'],
        $row['working_site'],
        $inter,
        $status,
        $expires,
        $connect,
        $manage
    );
}
echo json_encode($output);
?>
