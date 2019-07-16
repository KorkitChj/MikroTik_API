<?php
session_start();
?>
<?php

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];
include('function.php');

$output = array('success' => false, 'messages' => array());

list($ip,$port,$user,$pass,$site,$conn,$API) = fatchuser($cus_id,$location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    if(isset($_POST['type'])){
        if ($_POST['type'] == 'one')  {
            $emp_id = $_POST['emp_id'];
            $ARRAY = $API->comm("/user/print");
            $num = count($ARRAY);
            if ($num == '0') {
                $output['success'] = false;
                $output['messages'] = "Default profile can not be removed.";
        
            } else {
                $sql = "SELECT pass_router FROM employee WHERE emp_id = :emp_id";
                $query = $conn->prepare($sql);
                $query->bindparam(':emp_id',$emp_id);
                if ($query->execute()) {
                    $result = $query->fetch(PDO::FETCH_ASSOC);
                    $pass_router = $result['pass_router'];
                    $ARRAY = $API->comm("/user/remove", array(
                        "numbers" => $pass_router,
                    ));
                    $sql = "DELETE FROM employee WHERE emp_id = :emp_id";
                    $query = $conn->prepare($sql);
                    $query->bindparam(':emp_id',$emp_id);
                    $query->execute();
                    $output['success'] = true;
                    $output['messages'] = "ทำการลบพนักงานเรียบร้อยแล้ว";
                }
            }
        } elseif ($_POST['type'] == 'many') {
            $emp_id = implode(", ",$_POST['emp_id']);
            $result1 = $conn->query("SELECT pass_router FROM employee WHERE emp_id IN('".implode("','", $_POST['emp_id'])."')");
            while ($result = $result1->fetch(PDO::FETCH_ASSOC)) {
                $pass_router = $result['pass_router'];
                $ARRAY = $API->comm("/user/remove", array(
                    "numbers" => $pass_router,
                ));
            }
            $sql = "DELETE FROM employee WHERE emp_id IN($emp_id)";
            $query = $conn->prepare($sql);
            $query->execute();
            $output['success'] = true;
            $output['messages'] = "ทำการลบพนักงานที่เลือกเรียบร้อยแล้ว";
        }
    }
} else {
    $output['success'] = false;
    $output['messages'] = "Disconnect";
}
echo json_encode($output);
?>