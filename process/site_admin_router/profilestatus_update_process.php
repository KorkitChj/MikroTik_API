<?php
session_start();
?>
<?php
error_reporting(0);
if($_POST){
    $profile = $_POST["editprofile_name"];
    //$profilename = $_POST['editprofilename'];
    $session = $_POST['editsession'];
    $shared = $_POST['editshared'];
    $limit = $_POST['editlimit'];
    $datelimit = $_POST['editdatelimit'];
    include ('function.php');
    //include ('script2.php');
    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];
    list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

    $output = array('success' => false, 'messages' => array());
    
    if(!empty($profile)){
        $string = explode("_",$profile);
        $string2 = explode("/",$string[1]);
        $daytouse = $string2[0];
    }else{
        $daytouse = '';
    }
    if($daytouse != ''){
        $profilename = str_replace($daytouse,$datelimit,$profile);
    }else{
        $profilename = $profile;
    }
    if($limit == ""){
        $profilename = str_replace($string[2],"unlimited",$profilename);
    }elseif($string[2] == $limit){
        
    }elseif($string[2] != $limit){
        $profilename = str_replace($string[2],$limit,$profilename);
    }


    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        if($limit == ''){
            $ARRAY = $API->comm("/ip/hotspot/user/profile/set",array(
                "name" => $profilename,
                "session-timeout" => $session,
                "shared-users" => $shared,
                "rate-limit" => false,
                "numbers" => $profile
                //"on-login" => $profile_Script
            ));
        }elseif($limit != "unlimited" && $limit != "Unlimited"){
            $ARRAY = $API->comm("/ip/hotspot/user/profile/set",array(
                "name" => $profilename,
                "session-timeout" => $session,
                "shared-users" => $shared,
                "rate-limit" => $limit,
                "numbers" => $profile
                //"on-login" => $profile_Script
            ));
        }else{
            $ARRAY = $API->comm("/ip/hotspot/user/profile/set",array(
                "name" => $profilename,
                "session-timeout" => $session,
                "shared-users" => $shared,
                "numbers" => $profile
                //"on-login" => $profile_Script
            ));
        }       
            $output['success'] = true;
            $output['messages'] = "แก้ไขข้อมูลแล้ว";
    }
    else
    {
        $output['success'] = false;
        $output['messages'] = "กรุณารีเฟสหน้าจอ หรือ เชื่อมต่อไซต์ใหม่";
    }
}
echo json_encode($output);
?>