<?php
include('../includes/connect_db.php');

if(isset($_GET['start_date'])){
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

        function splitYear($start_date,$end_date){
            $array = array();
            $array2 = array();
            $array = explode("-",$start_date,2);
            $array2 = explode("-",$end_date,2);
            $a = $array[0];
            $b = $array2[0];
            return array(($a-543)."-".$array[1],($b-543)."-".$array2[1],$a,$b);
        }
        list($new_start_date,$new_end_date,$a,$b)= splitYear($start_date,$end_date);
        $file_name = 'OrderData'.$a.'_'.$b.'.csv';
        header('Content-Encoding: UTF-8');
        header("Content-Type: application/csv;charset=UTF-8");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        echo "\xEF\xBB\xBF";

        $file = fopen('php://output', 'w');

        $header = array("Order ID", "Username", "Site Name", "Order Value", "Start Payment", "Expired Date");

        fputcsv($file, $header);

        $query = 'SELECT b.order_id,username,site_name,total_cash,
        transfer_date,expired_date FROM siteadmin AS a 
        INNER JOIN orderpd AS b ON a.cus_id = b.cus_id 
        INNER JOIN payment AS c ON b.order_id = c.order_id 
        WHERE transfer_date >= "'.$new_start_date.'" AND expired_date <= "'.$new_end_date.'" AND paid=1 ORDER BY b.order_id DESC';

        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $data = array();
            $data[] = $row["order_id"];
            $data[] = $row["username"];
            $data[] = $row["site_name"];
            $data[] = $row["total_cash"];
            $data[] = $row["transfer_date"];
            $data[] = $row["expired_date"];
            fputcsv($file, $data);
        }
        fclose($file);
        exit;
    }
