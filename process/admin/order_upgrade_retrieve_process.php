<?php
include('../../includes/db_connect.php');
include('../../includes/datethai_function.php');
include('function.php');
$output = array();
$column = array("","username","b.payment_at","b.transfer_date","b.amount","b.time_required");
$query = '';
$query .= 'SELECT a.cus_id,a.username,b.puID,b.payment_at,b.transfer_date,b.amount,b.slip_name,b.time_required
FROM siteadmin AS a INNER JOIN packet_update AS b ON a.cus_id = b.cus_id ';
$query .= 'WHERE ';
if (isset($_POST["search"]["value"]))
{
	$query .= '(a.username LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR b.payment_at LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR b.transfer_date LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR b.amount LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR b.time_required LIKE "'.$_POST["search"]["value"] . '%") ';
}
if (isset($_POST["order"])) {
	$query .= 'ORDER BY ' . $column[$_POST['order'][0]['column']]. ' ' . $_POST['order'][0]['dir'] . ' ';
} else {								
	$query .= 'ORDER BY a.cus_id DESC ';
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
		<input type="checkbox" class="checkitem" name="cus_id[]" value="'.$row["puID"].'">
        <span class="danger"></span>
</label>
';
    $transfer_date = DateThai($row["transfer_date"]);
    $sub_array[] = $row["username"];
    $sub_array[] = $row["payment_at"];
    $sub_array[] = $transfer_date;
    $sub_array[] = $row["amount"]." บาท";
    $sub_array[] = $row["time_required"];
    $sub_array[] = '<a  data-toggle="modal" data-target="#displayimgMemberModal" href="" id="'.$row["slip_name"].'" class="displayimg"><img class="img-thumbnail" src="'.$src.'" style="width:100px;height:120px;"></a>';
    $sub_array[] = '<div class="btn-group btn-group-toggle" data-toggle="buttons"><button type="button" id="dl" class="update btn btn-warning btn-sm" onclick="window.location.href=\'../process/admin/download_process.php?id='.$row["slip_name"].'\'" target="iframe"><span title="ดาวน์โหลด" class="glyphicon glyphicon-cloud-download"></span></button>
    <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#confirmMemberModal" onclick="confirmMember('.$row['puID'].','.$row['cus_id'].')"><span title="ยืนยัน" class="glyphicon glyphicon-check"></span></button>
    <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['puID'].')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button></div>';
    $data[] = $sub_array;
}
$send = "upgrade";
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records($send),
	"data"				=>	$data
);
echo json_encode($output);
?>