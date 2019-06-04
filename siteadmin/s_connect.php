<?php
session_start();
?>
<?php
require('connect_db.php');
if (isset($_POST["connect"])) {
    $ipaddress = $_POST["inputipaddress"];
    $username = $_POST["inputusername"];
    $password = MD5($_POST["inputpassword"]);
    $portapi  = $_POST["inputportapi"];
    $namesite = $_POST["inputnamesite"];
    $cus_id = $_SESSION["cus_id"];
    $mp = $ipaddress.':'.$portapi;

    $result = $conn->query("SELECT * FROM location WHERE ip_address = '$ipaddress'");
    $num_rows = $result->num_rows;
    if($num_rows == 0){
                $sql = "INSERT INTO  location VALUES
            ('','$username','$password','$namesite','$portapi','$ipaddress','$cus_id')";
                if ($conn->query($sql)) {

                    $URL = "connectstatus.php?$ip_P=$mp&$uName=$username&$sName=$namesite&$ip=$ipaddress";
                    
                    echo "<script>";
                    echo "alert(\"บันทึกข้อมูลแล้ว\");";
                    //echo "window.location='connectionstatus.php';";
                    echo "</script>";
                    header("Location:$URL");
                            
                } else{
                    echo "<script>alert('ตรวจสอบอีกครั้งไม่สามารถเพิ่มข้อมูลได้.');</script>";
                    echo "<script>window.history.back()</script>";
                    exit();
                }           
    }else{
        echo "<script>alert(' IP/DNS มีอยู่แล้วในระบบ.');</script>";
			echo "<script>window.history.back()</script>";
			exit();
    }
    }
    $conn->close();
    ?>
       if ($API->connect('$mp', '$username', '$password')) {
                                    $status = "<button type=\"button\" class=\"btn btn-success\">Connect</button>";
                                } else {
                                    $status = "<button type=\"button\" class=\"btn btn-danger\">Disconnect</button>";
                                }
                                <td><?php echo $status ?></td>