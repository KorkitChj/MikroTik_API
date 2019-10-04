<?php
require('../includes/connect_db.php');
require('function.php');
$output = array();
$column = array("","username","b.order_id","transfer_date","appointment","total_cash");
$query = '';
$query .= 'SELECT a.cus_id,username,b.order_id,total_cash,
slip_name,transfer_date,appointment
FROM siteadmin AS a INNER JOIN orderpd AS b ON
a.cus_id = b.cus_id INNER JOIN payment AS c ON
b.order_id = c.order_id ';
$query .= 'WHERE ';
if (isset($_POST["search"]["value"]))
{
	$query .= '(username LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR b.order_id LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR transfer_date LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR appointment LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR total_cash LIKE "'.$_POST["search"]["value"] . '%") ';
}
$query .= 'AND c.paid = 0 ';
if (isset($_POST["order"])) {
	$query .= 'ORDER BY ' . $column[$_POST['order'][0]['column']]. ' ' . $_POST['order'][0]['dir'] . ' ';
} else {								
	$query .= 'ORDER BY b.order_id DESC ';
}
if ($_POST["length"] != -1) {								
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach ($result as $row) {
    $src = '../slips/'.$row["slip_name"].'';

    $sub_array = array();
    $sub_array[] = '
<label class="checkbox">
		<input type="checkbox" class="checkitem" name="cus_id[]" value="'.$row["cus_id"].'">
        <span class="danger"></span>
</label>
';
    $transfer_date = DateThai($row["transfer_date"]);
    $appointment = DateThai($row["appointment"]);
    $sub_array[] = $row["username"];
    $sub_array[] = $row["order_id"];
    $sub_array[] = $transfer_date;
    $sub_array[] = $appointment;
    $sub_array[] = $row["total_cash"]." บาท";
    $sub_array[] = '<a  data-toggle="modal" data-target="#displayimgMemberModal" href="" id="'.$row["slip_name"].'" class="displayimg"><img class="img-thumbnail" src="'.$src.'" style="width:100px;height:120px;"></a>';
    $sub_array[] = '<div class="btn-group btn-group-toggle" data-toggle="buttons"><button type="button" id="dl" class="update btn btn-warning btn-sm" onclick="window.location.href=\'download.php?id='.$row["slip_name"].'\'" target="iframe"><span title="ดาวน์โหลด" class="glyphicon glyphicon-cloud-download"></span></button>
    <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#confirmMemberModal" onclick="confirmMember('.$row['order_id'].')"><span title="ยืนยัน" class="glyphicon glyphicon-check"></span></button>
    <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['cus_id'].')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button></div>';
    $data[] = $sub_array;
}
$send = "payment";
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records($send),
	"data"				=>	$data
);
echo json_encode($output);
?>