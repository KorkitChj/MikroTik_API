<?php
require('../include/connect_db.php');
require('function.php');
$output = array();
$column = array("","username","site_name","total_cash","transfer_date");
$query = '';
$query .= 'SELECT a.cus_id,username,site_name,total_cash,
transfer_date FROM siteadmin AS a INNER JOIN orderpd AS b ON
a.cus_id = b.cus_id INNER JOIN payment AS c ON
b.order_id = c.order_id ';
$query .= 'WHERE ';
if (isset($_POST["search"]["value"]))
{
	$query .= '(username LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR site_name LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR total_cash LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR transfer_date LIKE "'.$_POST["search"]["value"]. '%") ';
}
$query .= 'AND c.paid = 1 ';
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
    if ($row["total_cash"] != 500) {
        $startdate = $row["transfer_date"];
        $enddate = strtotime('+365 days', strtotime($startdate));
    } elseif ($row["total_cash"] == 500) {
        $startdate = $row["transfer_date"];
        $enddate = strtotime('+183 days', strtotime($startdate));
    }
    $sub_array = array();
    $sub_array[]  = '<label class="custom-control custom-checkbox"><input type="checkbox" class="checkitem custom-control-input" name="cus_id[]" value="'.$row["cus_id"].'"><span class="custom-control-indicator"></span></label>';
    $sub_array[]  = $row["username"];
    $sub_array[]  = $row["site_name"];
    $sub_array[]  = $row["total_cash"];
    $sub_array[]  = $row["transfer_date"];
    $sub_array[]  = date('Y-m-d', $enddate);
    $sub_array[]  = '<button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['cus_id'].')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button>';
    $data[] = $sub_array;
}
$send = "manage";
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records($send),
	"data"				=>	$data
);
echo json_encode($output);
?>
