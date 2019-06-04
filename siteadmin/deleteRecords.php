<?php
    require('connect_db.php');
    if($_REQUEST['cusid']) {
    $sql = "DELETE FROM siteadmin WHERE cus_id='".$_REQUEST['cusid']."'";
    $resultset = $conn->query($sql);
    if($resultset) {
    echo "Record Deleted";
    }
    }
?>