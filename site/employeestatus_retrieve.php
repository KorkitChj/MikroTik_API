<?php
session_start();
?>
<?php
require('../include/connect_db.php');

$output = array('data' => array());
$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];
$sql = "SELECT b.emp_id,a.working_site,b.full_name,b.username FROM location AS a INNER JOIN employee AS b
                        on a.location_id = b.location_id WHERE a.location_id = :location_id AND cus_id = :cus_id";
$query = $conn->prepare($sql);
$query->bindparam(':location_id',$location_id);
$query->bindparam(':cus_id',$cus_id);
$query->execute();
$result = $query->fetchAll();
$no= 0;
foreach ($result as $row) {
    $no++;
    $checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="cus_checkbox custom-control-input" name="emp_id[]" value="'.$row["emp_id"].'"><span class="custom-control-indicator"></span></label>';
    $manage = '<button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editMemberModal"  onclick="editMember('.$row['emp_id'].')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#removeMemberModal"  onclick="removeMember('.$row['emp_id'].')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button>';


    $output['data'][] = array(
        $checkbox,
        $no,
        $row['working_site'],
        $row['full_name'],
        $row['username'],
        $manage
    );
}
echo json_encode($output);
?>
