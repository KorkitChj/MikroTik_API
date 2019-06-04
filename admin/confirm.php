<?php
require('../include/connect_db.php');
$id = $_GET['id'];
$result =  $conn->query("UPDATE payment SET paid = 1 WHERE order_id = '$id'");
if($result){
    echo "<script>";
	echo "alert(\"ยืนยันข้อมูลเสร็จสิ้น\");";
	echo "window.history.back()";
    echo "</script>";
    exit(0);
}else{
    echo "<script>";
	echo "alert(\"ยืนยันข้อมูลไม่ได้\");";
	echo "window.history.back()";
    echo "</script>";
    exit(0);
}
?>