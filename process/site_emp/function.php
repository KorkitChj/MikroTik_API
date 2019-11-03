<?php
function fetchuser($emp_id)
{
    include('../../config/routeros_api.class.php');
    include('../../includes/db_connect.php');
    $API = new routeros_api();
    $API->debug = false;
    set_time_limit(160);
    $sql = "SELECT a.emp_id,a.username,a.pass_router,b.api_port,b.ip_address,b.working_site FROM employee AS a INNER JOIN 
                            location AS b ON a.location_id = b.location_id WHERE a.emp_id = :emp_id";
    $query = $conn->prepare($sql);
    $query->bindparam(':emp_id', $emp_id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return array(
        $row['ip_address'], $row['api_port'],
        $row['username'], $row['pass_router'], $row['working_site'], $conn, $API
    );
}
function fetchlogo($emp_id)
{
    require('../../includes/db_connect.php');
    $query = $conn->prepare("SELECT image_site FROM location AS a INNER JOIN employee AS b ON a.location_id = b.location_id WHERE b.emp_id = :emp_id");
    $query->bindparam(':emp_id', $emp_id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $image = '';
    if ($row["image_site"] != '') {
        $image = '<img src="../../img/sitelogo/' . $row["image_site"] . '"  style="border-radius:50%"/>';
    } else {
        $image = '';
    }
    return array($image, $row["image_site"]);
}
function datetime($profile){

    if(!empty($profile)){
        $string = explode("_",$profile);
        $string2 = explode("/",$string[1]);
        $daytouse = $string2[0];
    }else{
        $daytouse = '';
    }
    // function checkTime($i) {
    //     if ($i < 10) {
    //         $i = "0$i";
    //         return $i;
    //     }else{
    //         return $i;
    //     }
    // }
    if($daytouse != ''){
        $dateTime = date("Y-m-d H:i:s");
        $enddate = strtotime("+{$daytouse} days", strtotime($dateTime));
        //$date2 = date('Y-m-d H:i:s', $enddate);
        $year = date("Y",$enddate);
        $month = date("m",$enddate);
        $day = date("d",$enddate);
        $hour = date("H",$enddate);
        $minute = date("i",$enddate);
        $second = date("s",$enddate);
        // $m = checkTime($month);
        // $d = checkTime($day);
        // $h = checkTime($hour);
        // $i = checkTime($minute);
        // $s = checkTime($second);

        //$date2 = "{$year}-{$m}-{$d} {$h}:{$i}:{$s}";
        return $date2 = "expire={$year}-{$month}-{$day} {$hour}:{$minute}:{$second}";
    }else{
        return $date2 = "Notexpired";
    }
}
