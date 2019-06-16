<?php
require('../site/conn.php');
?>
<?php
error_reporting(0);
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <?php
    $id = $_SESSION['cus_id'];
    $sql = "SELECT * FROM siteadmin WHERE cus_id = :id";
    $query = $conn->prepare($sql);
    $query->bindparam(':id', $id);
    if ($query->execute()) {
        $numrows = $query->rowCount();
        if ($numrows == 0) {
            echo "<script>";
            echo "alert(\"หมดอายุแล้ว\");";
            echo "</script>";
            unset($_SESSION["cus_id"]);
            echo "<a style=\"margin:5em 5em\" href=\"../index.php\"><bottom type=\"bottom\" class=\"btn btn-danger\">กลับสู่หน้าหลัก</a>";
            exit(0);
        }
    }
    if (isset($_POST['connect'])) {
        $ipaddress = $_POST["ipaddress"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $portapi  = $_POST["portapi"];
        $namesite = $_POST["namesite"];
        $cus_id = $_SESSION["cus_id"];
        $idl = $_POST['idl'];
        if ($idl) {
            try {
                $sql5 = "UPDATE location SET ip_address= :ipaddress,username= :username
            ,password= :password ,api_port= :portapi,working_site= :namesite WHERE location_id = :idl";
                $query5 = $conn->prepare($sql5);
                $query5->bindparam(':ipaddress', $ipaddress);
                $query5->bindparam(':username', $username);
                $query5->bindparam(':password', $password);
                $query5->bindparam(':portapi', $portapi);
                $query5->bindparam(':namesite', $namesite);
                $query5->bindparam(':idl', $idl);
                $query5->execute();
            } catch (PDOException $e) {
                $message = $e->getMessage();
                echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <strong>Unsuccess!</strong>ไม่สามารถแก้ไขข้อมูลได้กรุณาเปลี่ยน IP Address
                        </div>";
            }
            if (empty($e)) {
                echo "<div class=\"alert alert-success alert-dismissible fade show\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <strong>Success!</strong>แก้ไขข้อมูลแล้ว
                        </div>";
                echo "<meta http-equiv=\"refresh\" content=\"1;url=connectstatus.php\">";
            }
        } else {
            $sql3 = "SELECT * FROM location WHERE ip_address = :ipaddress";
            $query3 = $conn->prepare($sql3);
            $query3->bindparam(':ipaddress', $ipaddress);
            $query3->execute();
            if ($query3->rowCount() != 0) {
                echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <strong>Unsuccess!</strong>ไม่สามารถเพิ่มข้อมูลได้กรุณาเปลี่ยน IP Address
                        </div>";
            } else {
                try{
                    $sql4 = "INSERT INTO  location VALUES
                    ('',:username,:password,:namesite,:portapi,:ipaddress,:cus_id)";
                    $query4 = $conn->prepare($sql4);
                    $query4->bindparam(':username' ,$username);
                    $query4->bindparam(':password',$password);
                    $query4->bindparam(':namesite',$namesite);
                    $query4->bindparam(':portapi',$portapi);
                    $query4->bindparam(':ipaddress',$ipaddress);
                    $query4->bindparam(':cus_id',$cus_id);
                    $query4->execute();
                }
                catch(PDOException $e) {
                    echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <strong>Unsuccess!</strong>echo $e
                        </div>";
                }
                if(empty($e)){
                    echo "<div class=\"alert alert-success alert-dismissible fade show\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <strong>Unsuccess!</strong>บันทึกข้อมูลแล้ว
                        </div>";
                    echo "<meta http-equiv=\"refresh\" content=\"1;url=connectstatus.php\">";
                }
            }
        }
    }
    ?>
    <style>
        #border-login {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 1.5em;
            border-radius: 5px;
            margin-bottom: 2em;
            color: white;
            border: 2px dotted white;
        }

        .btn-danger,
        .btn-primary {
            background-color: white;
            color: black;
        }

        .container {
            margin-bottom: -30em;
        }

        .pad-a {
            background-color: rgba(0, 0, 0, 0.3);
        }
    </style>
    <title>Add Connect</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col ">
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="connectstatus.php"><span style="color:red">Site Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["cus_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item pad">
                                <a href="connectstatus.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                    หน้าหลัก</a>
                                </a>
                            </li>
                            <li class="nav-item active pad-a">
                                <a href="#" class="nav-link active">
                                    <span class="badge badge-primary"><i class="fas fa-hotel"></i></span>
                                    เพิ่มสถานบริการ</a>
                            </li>
                            <!-- <li class="nav-item dropdown">
                                                                                                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                                                                                                        <span class="badge badge-primary"><i class="fas fa-user"></i></span>
                                                                                                                        พนักงานดูแล
                                                                                                                    </a>
                                                                                                                    <div class="dropdown-menu">
                                                                                                                        <a href="employeestatus.php" class="dropdown-item">สถานะพนักงาน</a>
                                                                                                                        <a href="addemployee.php" class="dropdown-item">เพิ่มพนักงาน</a>
                                                                                                                    </div>
                                                                                                                </li>
                                                                                                                <li class="nav-item dropdown">
                                                                                                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                                                                                                        <span class="badge badge-primary"><i class="fas fa-wifi"></i></span>
                                                                                                                        Hotspot
                                                                                                                    </a>
                                                                                                                    <div class="dropdown-menu">
                                                                                                                        <a href="profilestatus.php" class="dropdown-item">สถานะ Profile</a>
                                                                                                                        <a href="addprofile.php" class="dropdown-item">เพิ่ม Profile</a>
                                                                                                                    </div>
                                                                                                                </li>
                                                                                                                <li class="nav-item dropdown">
                                                                                                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                                                                                                        <span class="badge badge-primary"><i class="fas fa-unlock"></i></span>
                                                                                                                        ตั้งค่าเว็บไม่ต้อง Login
                                                                                                                    </a>
                                                                                                                    <div class="dropdown-menu">
                                                                                                                        <a href="wallgardenstatus.php" class="dropdown-item">สถานะ</a>
                                                                                                                        <a href="addwallgarden.php" class="dropdown-item">เพิ่ม</a>
                                                                                                                    </div>
                                                                                                                </li> -->
                            <li class="nav-item pad">
                                <a href="changpwsite.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                    เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item pad">
                                <a href="cus_logout.php" class="nav-link " onclick="return confirm('ยืนยันการออกจากระบบ')">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    ออกจากระบบ</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    </div>
    <div class="container">
        <button type="button" style="margin:1em 1em" class="btn btn-danger "><a style="color:black;text-decoration:none" href="connectstatus.php">รายการสถานะการเชื่อมต่อ</a></button>
        <div class="row">
            <?php
            if (isset($_GET['action'])) {
                if ($_GET['action'] == "edit_site") {
                    $id = $_GET['id'];
                    $sql2 = "SELECT * FROM location WHERE location_id = :id";
                    $query2 = $conn->prepare($sql2);
                    $query2->bindparam( ':id',$id);
                    $query2->execute();
                    $row = $query2->fetch(PDO::FETCH_ASSOC);
                    //echo "<script> window.scrollBy(0, 60);</script>";
                    echo "<div class=\"col d-flex justify-content-center\">";
                    echo "<div id=\"border-login\">";
                    echo "<form action=\"\" id=\"site\" method=\"post\">";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"idl\" class=\"col-sm-3 col-form-label\">Location ID:&nbsp;</label>";
                    echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"idl\" value=\"{$row['location_id']}\" readonly required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"ipaddress\" class=\"col-sm-3 col-form-label\">IP:</label>";
                    echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"ipaddress\" placeholder=\"ไอพี หรือ โดเมนเนม\" value=\"{$row['ip_address']}\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"username\" class=\"col-sm-3 col-form-label\">Username:</label>";
                    echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"ชื่อใช้งาน\" value=\"{$row['username']}\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"password\" class=\"col-sm-3 col-form-label\">Password:</label>";
                    echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"password\" class=\"form-control\" name=\"password\" placeholder=\"รหัสผ่าน\" value=\"{$row['password']}\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"portapi\" class=\"col-sm-3 col-form-label\">API Port:</label>";
                    echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"portapi\" placeholder=\"พอร์ตเอพีไอ\" value=\"{$row['api_port']}\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"namesite\" class=\"col-sm-3 col-form-label\">Site Name:</label>";
                    echo "<div class=\"col-sm-9\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"namesite\" placeholder=\"ชื่อไซต์งาน\" value=\"{$row['working_site']}\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"b\" class=\"col-sm-3 col-form-label\"></label>";
                    echo "<div class=\"col-sm-9\">";
                    echo "<button type=\"submit\" name=\"connect\" class=\"btn btn-primary\">บันทึก</button>&nbsp;";
                    echo "<button type=\"bottom\" class=\"btn btn-danger\" onClick=\"history.go(-1); return false;\">ยกเลิก</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                //echo "<script> window.scrollBy(0, 60);</script>";
                echo "<div class=\"col d-flex justify-content-center\">";
                echo "<div id=\"border-login\">";
                echo "<form action=\"\" id=\"site\" method=\"post\">";
                echo "<div class=\"form-group row\">";
                echo "<label for=\"ipaddress\" class=\"col-sm-3 col-form-label\">IP:</label>";
                echo "<div class=\"col-sm-9\">";
                echo "<input type=\"text\" class=\"form-control\" name=\"ipaddress\" placeholder=\"ไอพี หรือ โดเมนเนม\" required>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"form-group row\">";
                echo "<label for=\"username\" class=\"col-sm-3 col-form-label\">Username:</label>";
                echo "<div class=\"col-sm-9\">";
                echo "<input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"ชื่อใช้งาน\" required>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"form-group row\">";
                echo "<label for=\"password\" class=\"col-sm-3 col-form-label\">Password:</label>";
                echo "<div class=\"col-sm-9\">";
                echo "<input type=\"password\" class=\"form-control\" name=\"password\" placeholder=\"รหัสผ่าน\" required>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"form-group row\">";
                echo "<label for=\"portapi\" class=\"col-sm-3 col-form-label\">API Port:</label>";
                echo "<div class=\"col-sm-9\">";
                echo "<input type=\"text\" class=\"form-control\" name=\"portapi\" placeholder=\"พอร์ตเอพีไอ\" required>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"form-group row\">";
                echo "<label for=\"namesite\" class=\"col-sm-3 col-form-label\">Site Name:</label>";
                echo "<div class=\"col-sm-9\">";
                echo "<input type=\"text\" class=\"form-control\" name=\"namesite\" placeholder=\"ชื่อไซต์งาน\" required>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"form-group row\">";
                echo "<label for=\"b\" class=\"col-sm-3 col-form-label\"></label>";
                echo "<div class=\"col-sm-9\">";
                echo "<button type=\"submit\" name=\"connect\" class=\"btn btn-primary\">บันทึก</button>&nbsp;";
                echo "<button type=\"bottom\" class=\"btn btn-danger\" onClick=\"history.go(-1); return false;\">ยกเลิก</button>";
                echo "</div>";
                echo "</div>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
<?php } ?>