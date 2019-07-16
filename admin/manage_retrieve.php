<?php
require('../include/connect_db.php');
$output = array('data' => array());
$result =  $conn->query("SELECT a.cus_id,username,site_name,total_cash,paid,
    slip_name,transfer_date,appointment
    FROM siteadmin AS a INNER JOIN orderpd AS b ON
    a.cus_id = b.cus_id INNER JOIN payment AS c ON
    b.order_id = c.order_id WHERE c.paid = 1");
$result->execute();
$result = $result->fetchAll();
foreach ($result as $row) {
    if ($row["total_cash"] != 500) {
        $startdate = $row["transfer_date"];
        $enddate = strtotime('+365 days', strtotime($startdate));
    } elseif ($row["total_cash"] == 500) {
        $startdate = $row["transfer_date"];
        $enddate = strtotime('+183 days', strtotime($startdate));
    }
    $checkbox = '<label class="custom-control custom-checkbox"><input type="checkbox" class="cus_checkbox custom-control-input" name="cus_id[]" value="'.$row["cus_id"].'"><span class="custom-control-indicator"></span></label>';
    $del = '<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['cus_id'].')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button>';
    $output['data'][] = array(
        $checkbox,
        $row["username"],
        $row["site_name"],
        $row["total_cash"],
        $row["transfer_date"],
        date('Y-m-d', $enddate),
        $del
    );
}
echo json_encode($output);
?>
