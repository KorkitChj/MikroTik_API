<?php
require('../includes/connect_db.php');
require('function.php');
$output = array();
$column = array("","b.order_id", "c.product_name", "c.price", "b.appointment","","a.username");
$query = '';
$query .= "SELECT b.order_id,c.product_name,c.price,b.appointment,a.username,d.paid 
FROM siteadmin AS a 
INNER JOIN orderpd AS b on a.cus_id = b.cus_id 
INNER JOIN product AS c on c.product_id = b.product_id 
INNER JOIN payment AS d on d.order_id = b.order_id ";
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

foreach ($result as $row=>$val) 
{
	$status = "<span class=\"badge-pill badge-success\">ชำระเงินแล้ว</span>";
	if($val["paid"] != 1){
		$today = date('Y-m-d H:i:s');
			if($today > $val["appointment"]){
				delNoOrder($val['cus_id']);
			}
			else{
				$status = "<span class=\"badge-pill badge-danger\">ยังไม่ชำระเงิน</span>";
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
	$sub_array[] = $status;
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
