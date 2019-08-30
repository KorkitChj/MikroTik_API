<?php
require('../include/connect_db.php');
require('function.php');
$output = array();
$column = array("","","A.cus_id", "A.username", "A.site_name", "A.work_phone", "A.e_mail");
$query = '';
$query .= "SELECT * FROM siteadmin A ";
$query .= " WHERE ";
if(isset($_POST["is_category"]))
{
 $query .= "A.site_name = '".$_POST["is_category"]."' AND ";
}
if (isset($_POST["search"]["value"]))
{
	$query .= '(A.cus_id LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR A.username LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR A.site_name LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR A.work_phone LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR A.e_mail LIKE "'.$_POST["search"]["value"] . '%") ';
}
if (isset($_POST["order"])) {
	//$aa = $_POST["order"];
	$query .= 'ORDER BY ' . $column[$_POST['order'][0]['column']]. ' ' . $_POST['order'][0]['dir'] . ' ';
} else {								
	$query .= 'ORDER BY A.cus_id DESC ';
}
if ($_POST["length"] != -1) {								
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
	$status = '<i class="fas fa-check-circle"></i>';
	$sub_array = array();
	foreach ($result1 as $val2) 
	{	
		if($val['cus_id'] == $val2['cus_id']){
			$status = '<i class="fas fa-ban"></i>';
			break;
		}
	}
	$sub_array[] = '<label class="custom-control custom-checkbox"><input type="checkbox" class="checkitem custom-control-input" name="cus_id[]" value="'.$val["cus_id"].'"><span class="custom-control-indicator"></span></label>';
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