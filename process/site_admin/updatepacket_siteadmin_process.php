<?php
session_start();
?>
<?php
if ($_POST) {
    include('../../includes/db_connect.php');
    include('function.php');
    $output = array('messages' => array(), 'success' => false);
    $banka = $_POST["bank"];
    $date = $_POST["date"];
    $money = $_POST["money"];


    if ($banka == 1) {
        $bank = "ไทยพาญิชย์";
    } elseif ($banka == 2) {
        $bank = "กรุงไทย";
    }

    switch ($money) {
        case "200":
            $time_required = 31;
            break;
        case "400":
            $time_required = 62;
            break;
        case "600":
            $time_required = 155;
            break;
        case "1000":
            $time_required = 365;
            break;
        case "2000":
            $time_required = 730;
    }

    if ($_FILES["fileslip"]["name"] != '') {
        $image = upload_imagepacket();
    }
    $sql = "INSERT INTO packet_update VALUES(:id,:payment_at,:transfer_date,:amount,:slip_name,:time_required,:cus_id)";
    $query = $conn->prepare($sql);
    $query->execute(array(
        ":id" => "",
        ":payment_at" => $bank,
        ":transfer_date" => $date,
        ":amount" => $money,
        ":slip_name" => $image,
        ":time_required" => $time_required,
        ":cus_id" => $_SESSION['cus_id']
    ));
    if($query != false){
        $output['messages'] = "ดำเนินการแล้ว";
        $output['success'] = true;
    }else{
        $output['messages'] = "ผิดพลาด";
        $output['success'] = false;
    }
}
echo json_encode($output);
?>