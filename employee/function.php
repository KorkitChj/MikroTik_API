<?php

function fetchuser($emp_id)
{
    include('../config/routeros_api.class.php');
    include('../includes/db_connect.php');
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
    require('../includes/db_connect.php');
    $query = $conn->prepare("SELECT image_site FROM location AS a INNER JOIN employee AS b ON a.location_id = b.location_id WHERE b.emp_id = :emp_id");
    $query->bindparam(':emp_id', $emp_id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $image = '';
    if ($row["image_site"] != '') {
        $image = '<img src="../img/sitelogo/' . $row["image_site"] . '"  style="border-radius:50%"/>';
    } else {
        $image = '';
    }
    return array($image, $row["image_site"]);
}
// function service($emp_id)
// {
//     require('../includes/connect_db.php');
//     $query = $conn->prepare("SELECT product_id FROM orderpd AS a 
//     INNER JOIN location AS b ON
//     a.cus_id = b.cus_id 
//     INNER JOIN employee AS c ON
//     b.location_id = c.location_id
//     WHERE emp_id = :emp_id");
//     $query->bindparam(':emp_id', $emp_id);
//     $query->execute();
//     $row = $query->fetch(PDO::FETCH_ASSOC);
//     return $row['product_id'];
// }

