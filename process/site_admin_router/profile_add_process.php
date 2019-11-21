<?php
session_start();
?>
<?php
if ($_POST) {
    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];
    //$profilename = $_POST['profilename'];
    $session = $_POST['session'];
    $shared = $_POST['shared'];
    $limit = $_POST['limit'];
    $datelimit = $_POST['datelimit'];

    include('function.php');
    include('script2.php');
    //error_reporting(0);
    if(empty($datelimit)){
        $datelimit = 1;
    }else{
        
    }
    if($limit == ''){
        $limit = "unlimited";
    }
    $date = date('Y-m-d');
    $rand = rand(1,999);
    $profilename = "uprof{$rand}_{$datelimit}/day_{$limit}_{$date}";

    list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

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
        for ($i = 0; $i < $count; $i++) {
            $a = $ARRAY[$i]['name'];
            if ($a == $profilename) {
                $output['success'] = false;
                $output['messages'] = "กรุณาเปลี่ยนชื่อ Profile";
                echo json_encode($output);
                exit(0);
            }
        }
        if($limit == "unlimited"){
            $API->comm("/ip/hotspot/user/profile/add", array(
                "name" => $profilename,
                "session-timeout" => $session,
                "shared-users" => $shared
                //"on-login" => $profile_Script
            ));
        }else{
            $API->comm("/ip/hotspot/user/profile/add", array(
                "name" => $profilename,
                "session-timeout" => $session,
                "shared-users" => $shared,
                "rate-limit" => $limit
                //"on-login" => $profile_Script
            ));
        }
        
        $output['success'] = true;
        $output['messages'] = "ทำการเพิ่มแพคเกจเข้าระบบเรียบร้อยแล้ว";
    } else {
        $output['success'] = false;
        $output['messages'] = "Disconnect !! กรุณารีเฟซเพจอีกครั้ง";
    }
}
echo json_encode($output);
?>