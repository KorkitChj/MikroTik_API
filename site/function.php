<?php
        
function fetchuser($cus_id,$location_id){
   
    include('../config/routeros_api.class.php');
    include('../includes/db_connect.php');

    $API = new routeros_api();
    $API->debug = false;
    set_time_limit(160);

    $sql = "SELECT * FROM location WHERE cus_id= :cus_id  AND location_id = :location_id ";
            $query = $conn->prepare($sql);
            $query->bindparam(':cus_id', $cus_id);
            $query->bindparam(':location_id', $location_id);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return array($row['ip_address'],$row['api_port'],
            $row['username'],$row['password'],$row['working_site'],$conn,$API);
       
}
function fetchimage($cus_id)
{
    include('../includes/db_connect.php');

    $query = $conn->prepare("SELECT image FROM siteadmin  WHERE cus_id = :cus_id");
    $query->bindparam(':cus_id', $cus_id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $image = '';
    if ($row["image"] != '') {
        $image = '<img src="../img/site_admin/' . $row["image"] . '"  style="border-radius:50%"/>';
    } else {
        $image = '<img src="../img/site_admin/iconuser.jpg" alt="user" style="border-radius:50%">';
    }
    return $image;
}
