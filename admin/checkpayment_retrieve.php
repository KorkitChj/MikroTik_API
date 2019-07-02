<?php
require('../include/connect_db.php');
$output = array('data' => array());
$result =  $conn->prepare("SELECT a.cus_id,username,b.order_id,total_cash,paid,
slip_name,transfer_date,appointment
FROM siteadmin AS a INNER JOIN orderpd AS b ON
a.cus_id = b.cus_id INNER JOIN payment AS c ON
b.order_id = c.order_id WHERE c.paid = 0");
$result->execute();
$result = $result->fetchAll();
foreach ($result as $row) {
    $src = '../slips/'.$row["slip_name"].'';

    $checkbox = '<input type="checkbox" class="cus_checkbox" name="cus_id[]" value="'.$row["cus_id"].'">';        
    $download = '<a href="view.php?id='.$row["slip_name"].'" target="_blank"><img class="img-thumbnail" src="'.$src.'" style="width:100px;height:120px;"></a>
            <a href="download.php?id='.$row["slip_name"].'" target="iframe"><button type="button" id="dl" class="update btn btn-warning">
            <span title="ดาวน์โหลด" class="glyphicon glyphicon-cloud-download"></span></button></a>';
    $confirm = '<button class="btn btn-success" type="button" data-toggle="modal" data-target="#confirmMemberModal" onclick="confirmMember('.$row['order_id'].')"><span title="ยืนยัน" class="glyphicon glyphicon-check"></span></button>';
    $remove = '<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['cus_id'].')"><span title="ลบ" class="glyphicon glyphicon-trash"></span></button>';
        
    $output['data'][] = array(
        $checkbox,
        $row["username"],
        $row["order_id"],
        $download,
        $row["transfer_date"],
        $row["appointment"],
        $confirm,
        $remove
        
    );
}
echo json_encode($output);
?>