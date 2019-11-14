<?php
session_start();
include('../../includes/db_connect.php');
if(isset($_SESSION["cus_id"])){
    $statement = $conn->prepare("DELETE FROM login_details WHERE cus_id = :cus_id");
    $statement->bindParam(':cus_id',$_SESSION["cus_id"]);
    $statement->execute();
    unset($_SESSION["cus_id"]);
        header("Location:../../home");
}
?>