<?php
require('../include/connect_db.php');
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        // $conn->query("DELETE FROM location WHERE location_id IN($id)");
        $result = $conn->query("DELETE FROM location WHERE location_id = '$id'");
        if ($result) {
            echo "<script>";
            echo "alert(\"ลบข้อมูลแล้ว\");";
            echo "window.history.back()";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert(\"Error Delete\");";
            echo "window.history.back()";
            echo "</script>";
        }
    }
?>