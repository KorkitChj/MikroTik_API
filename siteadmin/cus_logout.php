<?php
session_start();
if(isset($_SESSION["cus_id"])){
    unset($_SESSION["cus_id"]);
        header("Location:../login.php");
}
?>