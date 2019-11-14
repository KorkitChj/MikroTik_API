<?php
session_start();
if(isset($_SESSION["admin_id"])){
    unset($_SESSION["admin_id"]);
        header("Location:../../home");
}
?>


