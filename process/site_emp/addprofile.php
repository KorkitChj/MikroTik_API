<?php
session_start();
?>
<?php
if ($_POST) {

    $emp_id = $_SESSION['emp_id'];
    $shared = $_POST['shared'];
    $datelimit = $_POST['datelimit'];

    include('function.php');
    include('../site_admin_router/script2.php');
    error_reporting(0);
    if(empty($datelimit)){
        $datelimit = 1;
    }else{
        
    }
    list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($emp_id);

    $output = array('success' => false, 'messages' => array());

    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        $ARRAY = $API->comm("/ip/hotspot/user/profile/print");
        $ARRAY2 = $API->comm("/system/script/print");
        $ARRAY3 = $API->comm("/system/scheduler/print");
        $count2 = count($ARRAY2);
        $count = count($ARRAY);
        $count3 = count($ARRAY3);
        $a = array();
        for ($j = 0; $j < $count2; $j++) {
            $name_script = $ARRAY2[$j]['name'];
            array_push($a,$name_script);
        }
        // $b = array_search("func_shiftDate",$a);
        // if($b != TRUE){
        //     $API->comm("/system/script/add", array(
        //         "name" => "func_shiftDate",
        //         "policy" => "read,write,test",
        //         "source" => $func_shiftDate
        //     ));
        // }
        $c = array_search("auto-cutoff",$a);
        if($c != TRUE){
            $API->comm("/system/script/add", array(
                "name" => "auto-cutoff",
                "policy" => "read,write,test",
                "source" => $auto_Cutoff
            ));
        }
        $d = array();
        for ($c = 0; $c < $count3; $c++) {
            $name_scheduler = $ARRAY3[$c]['name'];
            array_push($d,$name_scheduler);
        }
        $e = array_search("auto-cutoff",$d);
        if($e != TRUE){
            $API->comm("/system/scheduler/add", array(
                "name" => "auto-cutoff",
                "policy" => "read,write,test",
                "interval" => "00:05:00",
                "on-event" => "auto-cutoff"
            ));
        }
        $rand = rand(1,999);
        $profilename = "uprof{$rand}_{$datelimit}/day_0M/0M";
        for ($i = 0; $i < $count; $i++) {
            $a = $ARRAY[$i]['name'];
            if ($a == $profilename) {
                $output['success'] = false;
                $output['messages'] = "กรุณาเปลี่ยนชื่อ Profile";
                echo json_encode($output);
                exit(0);
            }
        }
        $API->comm("/ip/hotspot/user/profile/add", array(
            "name" => $profilename,
            "shared-users" => $shared,
            "rate-limit" => "0M/0M"
            //"on-login" => $profile_Script
        ));
        $output['success'] = true;
        $output['messages'] = "ทำการเพิ่มแพคเกจเข้าระบบเรียบร้อยแล้ว";
    } else {
        $output['success'] = false;
        $output['messages'] = "Disconnect !! กรุณารีเฟซเพจอีกครั้ง";
    }
}
echo json_encode($output);
?>