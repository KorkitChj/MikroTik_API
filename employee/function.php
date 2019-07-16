<?php
        
function fatchuser($emp_id){
   
    include('../config/routeros_api.class.php');
    require('../include/connect_db.php');

    $API = new routeros_api();
    $API->debug = false;
    set_time_limit(160);

    $sql = "SELECT a.emp_id,a.username,a.pass_router,b.api_port,b.ip_address,b.working_site FROM employee AS a INNER JOIN 
                            location AS b ON a.location_id = b.location_id WHERE a.emp_id = :emp_id";
            $query = $conn->prepare($sql);
            $query->bindparam(':emp_id', $emp_id);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return array($row['ip_address'],$row['api_port'],
            $row['username'],$row['pass_router'],$row['working_site'],$conn,$API);
       
}
?>