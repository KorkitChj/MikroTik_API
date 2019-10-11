<?php
include('../../includes/db_connect.php');
include('../../includes/datethai_function.php');
include('function.php');
$output = array();
$column = array("","b.order_id", "c.product_name", "c.price", "b.appointment","a.username");
$query = '';
$query .= "SELECT b.order_id,c.product_name,c.price,b.appointment,a.username 
FROM siteadmin AS a 
INNER JOIN orderpd AS b on a.cus_id = b.cus_id 
INNER JOIN product AS c on c.product_id = b.product_id ";
$query .= " WHERE ";

if (isset($_POST["search"]["value"]))
{
	$query .= '(b.order_id LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR c.product_name LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR c.price LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR b.appointment LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR a.username LIKE "'.$_POST["search"]["value"] . '%") ';
}
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

$statement1 = $conn->prepare("SELECT * FROM orderpd WHERE order_id NOT IN (SELECT order_id FROM payment)");
$statement1->execute();
$result1 = $statement1->fetchAll();

foreach ($result as $row=>$val) 
{
	foreach ($result1 as $val2) 
	{	
		if($val['order_id'] == $val2['order_id']){
			$today = date('Y-m-d H:i:s');
			$appoint = $val["appointment"];
			if($today > $appoint){
				delNoOrder($val2['cus_id']);
			}			
		}
	}
	$sub_array = array();
$sub_array[] = '
<label class="checkbox">
		<input type="checkbox" class="checkitem" name="order_id[]" value="'.$val["order_id"].'">
        <span class="danger"></span>
</label>
';
	$appointment = DateThai($val["appointment"]);
	$sub_array[] = $val["order_id"];
	$sub_array[] = $val["product_name"];
	$sub_array[] = $val["price"];
	$sub_array[] = $appointment;
	$sub_array[] = $val["username"];
	$sub_array[] = '<button type="button" name="delete" onclick="removeOrder('.$val["order_id"].')" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#removeOrderModal"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_order_records(),
	"data"				=>	$data
);
echo json_encode($output);
