<?php
session_start();
?>
<?php
if ($_POST) {
    include('../include/connect_db.php');
    include('function.php');
    $output = array('messages' => array(),'success' => false);
    $banka = $_POST["bank"];
    $date = $_POST["date"];
    $money = $_POST["money"];
    $packet = $_POST["customRadioInline1"];
    if ($banka == 1) {
        $bank = "ไทยพาญิชย์";
    } elseif ($banka == 2) {
        $bank = "กรุงไทย";
    } elseif ($banka == 3) {
        $bank = "กสิกรไทย";
    } else {
        $bank = "กรุงเทพ";
    }
    if (fetch_packet() != $packet) {
        $cus_id = $_SESSION['cus_id'];
        $query = $conn->prepare("SELECT * FROM siteadmin AS a 
        INNER JOIN orderpd AS b on a.cus_id = b.cus_id
        INNER JOIN payment AS c on b.order_id = c.order_id 
        WHERE a.cus_id = :cus_id");
        $query->bindparam(':cus_id', $cus_id);
        $query->execute();
        $payment_id = '';
        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            $payment_id = $result['payment_id'];
            unlink('../slips/' . $result['slip_name'] . '');
            break;
        }
        if ($_FILES["fileslip"]["name"] != '') {
            $image = upload_imagepacket();
        }
        $sql = "UPDATE payment SET payment_at = :bank,transfer_date = :date,amount = :money,
        slip_name = :image,paid = 0 WHERE payment_id = :payment_id";
        $query = $conn->prepare($sql);
        $query->execute(array(
            ":bank" => $bank,
            ":date" => $date,
            ":money" => $money,
            ":image" => $image,
            ":payment_id" => $payment_id
        ));
        $sql2 = "UPDATE orderpd SET total_cash = :money,product_id = :product_id WHERE cus_id = :cus_id";
        $query = $conn->prepare($sql2);
        $query->execute(array(
            ":money" => $money,
            ":product_id" => $packet,
            ":cus_id" => $cus_id
        ));
        $output['messages'] = "กรุณายืนยันการ Admin";
        $output['success'] = true;
    }else{
        $output['messages'] = "กรุณาเลือก Packet ที่ไม่ใด้ใช้อยู่";
        $output['success'] = false;
    }
}
echo json_encode($output);
?>