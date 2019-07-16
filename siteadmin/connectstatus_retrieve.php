<?php
session_start();
?>
<?php
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
    $checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="cus_checkbox custom-control-input" name="location_id[]" value="' . $row["location_id"] . '"><span class="custom-control-indicator"></span></label>';
    if ($API->connect($row['ip_address'].":".$port,$row['username'],$row['password'])) {
        $ARRAY = $API->comm("/system/resource/print");
        $ram =    $ARRAY['0']['free-memory'] / 1048576;
        $hdd =    $ARRAY['0']['free-hdd-space'] / 1048576;
        $cpu = $ARRAY['0']['cpu-load']."%";
        $ram = round($ram, 1)."MB";
        $hdd = round($hdd, 1)."MB";
        $connect = '<button type="button" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i>CONNECT</button>';
        $connz = "connect";       
        $manage = '<button class="btn btn-info" type="button" onclick="if (confirm(\'เข้าจัดการไซต์งาน?\')) window.location.href=\'../site/site_conn.php?id='.$row['location_id'].'&conn='.$connz.'\';"><span title="เข้าบริหารจัดการ" class="glyphicon glyphicon-new-window"></span></button>
        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editSiteModal"  onclick="editSite('.$row['location_id'].')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#removeSiteModal"  onclick="removeSite('.$row['location_id'].')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button>';
    } else {
        $cpu = "-%";
        $ram = "-MB";
        $hdd = "-MB";
        $connect = '<button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i>DISCONNECT</button>';
        $connz = "disconnect";
        $manage = '<button class="btn btn-info" type="button" onclick="if (confirm(\'เข้าจัดการไซต์งาน?\')) window.location.href=\'../site/site_conn.php?id='.$row['location_id'].'&conn='.$connz.'\';"><span title="เข้าบริหารจัดการ" class="glyphicon glyphicon-new-window"></span></button>
        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editSiteModal"  onclick="editSite('.$row['location_id'].')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#removeSiteModal"  onclick="removeSite('.$row['location_id'].')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button>';
    }
    $output['data'][]  = array(
        $checkbox,
        $no,
        $row['ip_address'].":".$port,
        $row['username'],
        $row['working_site'],
        $cpu,
        $ram,
        $hdd,
        $connect,
        $manage
    );
}
echo json_encode($output);
?>
