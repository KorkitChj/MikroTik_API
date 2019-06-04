<?php
// delete records
require('connect_db.php');
if (isset($_POST['chk_id'])) {
    $arr = $_POST['chk_id'];
    foreach ($arr as $id) {
        $result =  $conn->query("DELETE FROM siteadmin WHERE cus_id = " . $id);
    }
    $msg = "Deleted Successfully!";
    //header("Location: index.php?msg=$msg");
}
