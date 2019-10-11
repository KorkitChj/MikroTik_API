<?php
require('../../includes/db_connect.php');
if(isset($_POST['id'])){
    $query = $conn->prepare("SELECT * FROM packet_update AS a INNER JOIN employee AS b
    on a.emp_id = b.emp_id WHERE b.username = :username");
    $query->execute(
        array(
            ":username" => $_POST['id']
        )
    );
    $resute = $query->fetchAll();
    $send = array();
    foreach($resute as $resute2){
        $send[] = $resute2['comment'];
    }
}
echo json_encode($send);
?>