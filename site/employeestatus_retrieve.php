<?php
session_start();
?>
<?php
error_reporting(0);
require('../include/connect_db.php');
include('function.php');

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/user/print");
    $ARRAY2 = $API->comm("/user/print", array("?disabled" => "true"));
}

function message($conn)
{
    $query = $conn->prepare("SELECT a.emp_id,b.username,a.comment 
    FROM packet_update AS a 
    INNER JOIN employee AS b on a.emp_id = b.emp_id");
    $query->execute();
    $result = $query->fetchAll();
    $result2 = array();
    foreach ($result as $row) {
        $result3 = array();
        $result3["num"] = $row['emp_id'];
        $result3["name"] = $row['username'];
        $result3["message"] = $row['comment'];
        $result2[] = $result3;
    }
    return $result2;
}
function countMessage($value,$user)
{
    $i =0;
    foreach($value as $value2){
        if($value2['name'] == $user){
            $i++;
        }
    }
    return $i;
}

$output = array('data' => array());
$sql = "SELECT b.emp_id,a.working_site,b.full_name,b.username FROM location AS a INNER JOIN employee AS b
                        on a.location_id = b.location_id WHERE a.location_id = :location_id AND cus_id = :cus_id";
$query = $conn->prepare($sql);
$query->bindparam(':location_id', $location_id);
$query->bindparam(':cus_id', $cus_id);
$query->execute();
$result = $query->fetchAll();
$no = 0;

foreach ($result as $row) {
    foreach ($ARRAY as $row2) {
        if ($row2['name'] == $row['username']) {
            $group = $row2['group'];
            $adddress = $row2['address'];
            $last = $row2['last-logged-in'];
            $comment = $row2['comment'];
            $message = message($conn);
            foreach($message as $value){
                if ($value['name'] == $row['username']) {
                        $count = countMessage($message,$row['username']);
                        $messages = '<button type="button" class="btn btn-primary btn-sm" onclick="viewMessage(\'' . $value['name'] . '\')"> Inbox <span class="badge badge-light">'.$count.'</span></button>';
                      break;
                }else{
                    $messages = '';
                }
            }
            foreach ($ARRAY2 as $row3) {
                if ($row3['name'] == $row['username']) {
                    $idtk = '<button title="disable" class="btn btn-warning btn-sm">D</button>';
                    break;
                } else {
                    $idtk = '';
                }
            }
            break;
        } else {
            $group = '';
            $adddress = '';
            $last = '';
        }
    }
    $no++;
    $checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="checkitem custom-control-input" name="emp_id[]" value="' . $row["username"] . ',' . $row2['.id'] . '"><span class="custom-control-indicator"></span></label>';
    $manage = '
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <button class="btn btn-success btn-sm" type="button" onclick="enableEmp(\'' . $row2['.id'] . '\')"><span title="เปิด" class="glyphicon glyphicon-ok"></span></button>
        <button class="btn btn-danger btn-sm" type="button"  onclick="disableEmp(\'' . $row2['.id'] . '\')"><span title="ปิด" class="glyphicon glyphicon-remove"></span></button>
        <button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#editMemberModal"  onclick="editMember(\'' . $row2['.id'] . '\',\'' . $row['username'] . '\')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
        <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#removeMemberModal"  onclick="removeMember(\'' . $row2['.id'] . '\',\'' . $row['username'] . '\')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button></div>';


    $output['data'][] = array(
        $checkbox,
        $messages,
        $no,
        $idtk,
        $row['working_site'],
        $row['full_name'],
        $row['username'],
        $group,
        $last,
        $comment,
        $manage
    );
}
echo json_encode($output);
?>
