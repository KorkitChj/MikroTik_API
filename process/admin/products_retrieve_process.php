<?php
include('../../includes/db_connect.php');
include('function.php');
$output = array();
$column = array("","product_id","product_name","price","title");
$query = '';
$query .= 'SELECT * FROM product ';
$query .= 'WHERE ';
if (isset($_POST["search"]["value"]))
{
	$query .= '(product_id LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR product_name LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR price LIKE "'.$_POST["search"]["value"]. '%" ';
	$query .= 'OR title LIKE "'.$_POST["search"]["value"]. '%") ';
}
if (isset($_POST["order"])) {
	$query .= 'ORDER BY ' . $column[$_POST['order'][0]['column']]. ' ' . $_POST['order'][0]['dir'] . ' ';
} else {								
	$query .= 'ORDER BY product_id DESC ';
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

    $sub_array = array();
    $sub_array[] = '
<label class="checkbox">
		<input type="checkbox" class="checkitem" name="product_id[]" value="'.$row["product_id"].'">
        <span class="danger"></span>
</label>
';

    $sub_array[] = $row["product_id"];
    $sub_array[] = $row["product_name"];
    $sub_array[] = $row["price"];
    $sub_array[] = $row["title"];
    $sub_array[] = '<div class="btn-group btn-group-toggle" data-toggle="buttons">
    <button class="btn btn-light btn-sm displaydetail" id="'.$row['product_id'].'" type="button" data-toggle="modal" data-target="#displayproductdetailModal"><span title="รายละเอียดสินค้า" class="glyphicon glyphicon-list-alt"></span></button>
    <button class="btn btn-success btn-sm displayimg" id="'.$row['image'].'" type="button" data-toggle="modal" data-target="#displayimgproductModal"><span title="รูปสินค้า" class="glyphicon glyphicon-picture"></span></button>
    <button type="button" id="dl" class="update btn btn-warning btn-sm" onclick="window.location.href=\'../process/admin/download_process.php?id='.$row["image"].'&idp=product\'" target="iframe"><span title="ดาวน์โหลด" class="glyphicon glyphicon-cloud-download"></span></button>
    <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#editproductModal" onclick="editProduct('.$row['product_id'].')"><span title="แก้ไข" class="glyphicon glyphicon-edit"></span></button>
    <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#removeproductModal" onclick="removeProduct('.$row['product_id'].')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button></div>';
    $data[] = $sub_array;
}
$send = "product";
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records($send),
	"data"				=>	$data
);
echo json_encode($output);
?>