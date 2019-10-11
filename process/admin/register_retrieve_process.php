<?php
include('../../includes/db_connect.php');
include('function.php');
$output = array();
$column = array("","A.cus_id", "A.username", "A.site_name", "A.work_phone", "A.e_mail");
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


foreach ($result as $row=>$val) 
{
	foreach ($result1 as $val2) 
	{	
		if($val['cus_id'] == $val2['cus_id']){
			$today = date('Y-m-d H:i:s');
			$date = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($val['regis_date'])));
			if($today > $date){
				delNoOrder($val['cus_id']);
			}			
		}
	}
	$sub_array = array();
$sub_array[] = '
<label class="checkbox">
		<input type="checkbox" class="checkitem" name="cus_id[]" value="'.$val["cus_id"].'">
        <span class="danger"></span>
</label>
';
	$sub_array[] = $val["cus_id"];
	$sub_array[] = $val["username"];
	$sub_array[] = $val["site_name"];
	$sub_array[] = $val["work_phone"];
	$sub_array[] = $val["e_mail"];
	$sub_array[] = '<button type="button" name="delete" onclick="removeMember('.$val["cus_id"].')" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#removeMemberModal"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button>';
	$data[] = $sub_array;
}
$send = "admin";
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records($send),
	"data"				=>	$data
);
echo json_encode($output);
