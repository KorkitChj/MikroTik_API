<?php
session_start();
include('../../includes/db_connect.php');
if(isset($_SESSION["admin_id"])){
    $clear_login_num = $conn->prepare("UPDATE admin SET login_num = 0 WHERE admin_id = :admin_id");
    $clear_login_num ->execute(array(':admin_id' =>$_SESSION["admin_id"]));
    unset($_SESSION["admin_id"]);
        header("Location:../../home");
}
?>


