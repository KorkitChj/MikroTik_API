<?php
require('../include/connect_db.php');
require('function.php');
$output = array();
$query = '';
$query .= "SELECT * FROM siteadmin ";
if (isset($_POST["search"]["value"])) //ไว้ search ข้อมูล
{
	$query .= 'WHERE cus_id LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR username LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR site_name LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR work_phone LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR e_mail LIKE "'.$_POST["search"]["value"] . '%" ';
}
if (isset($_POST["order"])) {
	$query .= 'ORDER BY ' . $_POST['order'][0]['column']. ' ' . $_POST['order'][0]['dir'] . ' ';
} else {										//aa
	$query .= 'ORDER BY cus_id DESC '; //เรียงจากมากไปหาน้อย
}
if ($_POST["length"] != -1) {									//aa
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
$statement1 = $conn->prepare("SELECT * FROM siteadmin WHERE cus_id NOT IN (SELECT cus_id FROM orderpd)");
$statement1->execute();
$result1 = $statement1->fetchAll();
$filtered_rows = $statement1->rowCount();
foreach ($result as $row=>$val) 
{
	$status = '<button class="update btn btn-success" type="button"><span class="glyphicon glyphicon-ok-sign"></span></button>';
	$sub_array = array();
	foreach ($result1 as $val2) 
	{	
		if($val['cus_id'] == $val2['cus_id']){
			$status = '<button class="update btn btn-danger" type="button"><span class="glyphicon glyphicon-remove-sign"></span></button>';
			break;
		}
	}
	$sub_array[] = '<input type="checkbox" class="cus_checkbox" name="cus_id[]" value="'.$val["cus_id"].'">';
	$sub_array[] = $status;
	$sub_array[] = $val["cus_id"];
	$sub_array[] = $val["username"];
	$sub_array[] = $val["site_name"];
	$sub_array[] = $val["work_phone"];
	$sub_array[] = $val["e_mail"];
	$sub_array[] = '<button type="button" name="delete" onclick="removeMember('.$val["cus_id"].')" class="btn btn-danger"  data-toggle="modal" data-target="#removeMemberModal"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>