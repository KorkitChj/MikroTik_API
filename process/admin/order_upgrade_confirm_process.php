<?php
include('../../includes/db_connect.php');
$output = array('success' => false, 'messages' => array());
if (isset($_POST['puid']) && isset($_POST['cusid'])) {
    $puid = $_POST['puid'];
    $cusid = $_POST['cusid'];


    $sql = "SELECT a.payment_id,a.expired_date,a.amount,a.slip_name FROM payment AS a 
    INNER JOIN orderpd AS b 
    on a.order_id = b.order_id
    INNER JOIN siteadmin AS c 
    on b.cus_id = c.cus_id
    WHERE c.cus_id = :cus_id ";
    $result =  $conn->prepare($sql);
    $result->bindparam(':cus_id', $cusid);
    $result->execute();
    $result2 = $result->fetch(PDO::FETCH_ASSOC);
    $payment_id = $result2['payment_id'];
    $expired_date = $result2['expired_date'];
    $amount = $result2['amount'];
    $slip_name = $result2['slip_name'];


    $sql2 = "SELECT * FROM packet_update WHERE puID = :puID AND cus_id = :cus_id";
    $result3 =  $conn->prepare($sql2);
    $result3->bindparam(':puID', $puid);
    $result3->bindparam(':cus_id', $cusid);
    $result3->execute();
    $result4 = $result3->fetch(PDO::FETCH_ASSOC);
    $payment_at = $result4['payment_at'];
    $transfer_date = $result4['transfer_date'];
    $amount2 = $result4['amount'];
    $slip_name2 = $result4['slip_name'];
    $time_required = $result4['time_required'];
    $enddate = strtotime("+{$time_required} days", strtotime($expired_date));
    $expired_date2 = date('Y-m-d H:i:s', $enddate);
    unlink('../../slips/'.$slip_name);


    $sql3 = "UPDATE payment SET payment_at = :payment_at,
    transfer_date = :transfer_date,expired_date = :expired_date,
    amount = :amount,slip_name = :slip_name WHERE payment_id = :payment_id";

    $result5 =  $conn->prepare($sql3);
    $result5->bindparam(':payment_at', $payment_at);
    $result5->bindparam(':transfer_date', $transfer_date);
    $result5->bindparam(':expired_date', $expired_date2);
    $result5->bindparam(':amount', $amount2);
    $result5->bindparam(':slip_name', $slip_name2);
    $result5->bindparam(':payment_id', $payment_id);
    $result5->execute();

    $sql4 = "DELETE FROM packet_update WHERE puID = :puID";
    $result6 =  $conn->prepare($sql4);
    $result6->bindparam(':puID', $puid);
    $result6->execute();

    if(!empty($result5)) {
        $output['success'] = true;
		$output['messages'] = 'ยืนยันข้อมูลแล้ว';
    }else{
        $output['success'] = false;
		$output['messages'] = 'ไม่สามารถยืนยันข้อมูลได้';
    }
}
echo json_encode($output);