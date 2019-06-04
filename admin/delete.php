<?php
require('../include/connect_db.php');
// $result =  $conn->query("DELETE FROM siteadmin AS a orderpd, payment
// INNER JOIN orderpd AS b ON a.cus_id = b.cus_id 
// INNER JOIN payment AS c ON b.order_id = c.order_id
// WHERE a.cus_id = '".$_GET["CusID"]."'
// AND ");

// $result =  $conn->query("DELETE FROM siteadmin, orderpd, payment
// USING siteadmin INNER JOIN orderpd INNER JOIN payment
// WHERE siteadmin.cus_id ='".$_GET["cusid"]."'
//     AND orderpd.cus_id = siteadmin.cus_id
//     AND payment.order_id = orderpd.order_id");

// $strSQL = "DELETE FROM customer ";
// $strSQL .="WHERE CustomerID = '".$_GET["CusID"]."' ";

$result =  $conn->query("DELETE FROM siteadmin WHERE cus_id = '" . $_GET['id'] . "'");

if ($result) {
    echo "<script>";
    echo "alert(\"ลบข้อมูลแล้ว\");";
    echo "window.history.back()";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert(\"Error Delete\");";
    echo "window.history.back()";
    echo "</script>";
}
//$conn->close;
