<?php
session_start();
?>
<?php

$location_id = $_SESSION['location_id'];
$cus_id = $_SESSION['cus_id'];
include('function.php');

$output = array('success' => false, 'messages' => array());

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    if (isset($_POST['type'])) {
        if ($_POST['type'] == 'one') {
            $wall_id = $_POST['wall_id'];
            $ARRAY = $API->comm("/ip/hotspot/walled-garden/ip/print");
            $num = count($ARRAY);
            if ($num == '0')
            {
                $output['success'] = false;
                $output['messages'] = "ไม่พบรายการ Wallgarden";
            } 
             else
            {
                $ARRAY = $API->comm("/ip/hotspot/walled-garden/ip/remove", array(
                    "numbers" => $wall_id,
                ));
                $output['success'] = true;
                $output['messages'] = "ทำการลบ Bypass เรียบร้อยแล้ว";
            }
        }
        elseif($_POST['type'] == 'many')
        {
            $wall_id = implode(", ", $_POST['wall_id']);
            $ARRAY = $API->comm("/ip/hotspot/walled-garden/ip/remove", array(
            "numbers" => $wall_id,
        ));
            $output['success'] = true;
            $output['messages'] = "ทำการลบ  Bypass ที่เลือกเรียบร้อยแล้ว";
        }
    }
}
else
{
    $output['success'] = false;
    $output['messages'] = "Disconnect";
}
echo json_encode($output);
?>