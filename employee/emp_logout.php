<?php
session_start();
if(isset($_SESSION["emp_id"])){
    unset($_SESSION["emp_id"]);
        header("Location:../index.php");
}
?>