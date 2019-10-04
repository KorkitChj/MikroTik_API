<?php
    $host ="localhost";
    $username = "root";
    $password = "";
    $dbname = "webapi"; 
    try{
            $timezone = date_default_timezone_set("Asia/Bangkok");
            $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password,array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8","SET time_zone = '{$timezone}'"));
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>