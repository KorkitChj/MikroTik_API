<?php
        
function fatchuser($cus_id,$location_id){
   
    include('../config/routeros_api.class.php');
    require('../include/connect_db.php');

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
