<?php
require('connect_db.php');
   
    if(isset($_POST['cus_id'])) {
        $cus_id = trim($_POST['cus_id']);
        $sql = "DELETE FROM siteadmin WHERE cus_id = '$cus_id'";
        $result = $conn->query($sql);
        echo $cus_id;
}
?> 