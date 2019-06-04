<?php
session_start();
?>
<?php
error_reporting(0);
require('../config/routeros_api.class.php');
require('../include/connect_db.php');
require('../template/template.html');
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <?php
    $id = $_SESSION['cus_id'];
    if ($result = $conn->query("SELECT * FROM siteadmin WHERE cus_id = '$id'")) {
        $numrows = $result->num_rows;
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
            $sql1 = "UPDATE location SET ip_address='$ipaddress',username='$username'
            ,password='$password',api_port='$portapi',working_site='$namesite'WHERE location_id = '$idl'";
            if ($conn->query($sql1)) {
                echo "<h5 style=\"border-bottom:5px white solid;background:red;text-align:center;font-weight:bold;padding:0.5em;color:white\">บันทึกข้อมูลแล้ว</h5>";
                // echo "<script language='javascript'>alert('บันทึกข้อมูลแล้ว')</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0;url=connectstatus.php\">";
                exit(0);
            } else {
                echo "<h5 style=\"border-bottom:5px white solid;background:red;text-align:center;font-weight:bold;padding:0.5em;color:white\">ไม่สามารถแก้ไขข้อมูลได้กรุณาเปลี่ยน IP Address</h5>";
                // echo $conn->error;
            }
        } else {
            $result = $conn->query("SELECT * FROM location WHERE ip_address = '$ipaddress'");
            if ($result->num_rows != 0) {
                echo "<h5 style=\"border-bottom:5px white solid;background:red;text-align:center;font-weight:bold;padding:0.5em;color:white\">ไม่สามารถเพิ่มข้อมูลได้กรุณาเปลี่ยน IP Address</h5>";
            } else {
                $sql = "INSERT INTO  location VALUES
                ('','$username','$password','$namesite','$portapi','$ipaddress','$cus_id')";
                if ($conn->query($sql)) {
                    echo "<h5 style=\"border-bottom:5px white solid;background:red;text-align:center;font-weight:bold;padding:0.5em;color:white\">บันทึกข้อมูลแล้ว</h5>";
                    // echo "<script language='javascript'>alert('บันทึกข้อมูลแล้ว')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0;url=connectstatus.php\">";
                    exit(0);
                } else {
                    echo $conn->error;
                }
            }
        }
    }
    ?>
    <style>
        #border-login {
            /* background: #e3e3e3; */
            background: url('../img/3.jpg');
            background-color: rgba(255, 0, 0, 0.4);
            background-repeat: no-repeat;
            background-size: cover;
            padding: 1.5em;
            border-radius: 5px;
            box-shadow: 0px 0px 8px 4px rgb(0, 0, 0);
            margin-bottom: 2em;
        }
        .container-fluid {
            /* padding-bottom: 1.5em; */
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
                            <li class="nav-item ">
                                <a href="connectstatus.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                    หน้าหลัก</a>
                                </a>
                            </li>
                            <li class="nav-item active">
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
                            <li class="nav-item">
                                <a href="changpwsite.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                    เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item">
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
    <div class="container-fluid">
        <!-- <div class="row">
                                                                                <div class="col d-flex justify-content-center">
                                                                                    <p>
                                                                                        <h3 style="font-weight:bold;color:white;margin-top:1em">เพิ่มสถานบริการ</h3>
                                                                                    </p>
                                                                                </div>
                                                                            </div> -->
        <button type="button" style="margin:1em 1em" class="btn btn-danger "><a style="color:white" href="connectstatus.php">รายการสถานะการเชื่อมต่อ</a></button>
        <div class="row">
            <?php
            if (isset($_GET['action'])) {
                if ($_GET['action'] == "edit_site") {
                    $id = $_GET['id'];
                    $result = $conn->query("SELECT * FROM location WHERE location_id = $id");
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    // echo $row['ip_address'];
                    echo "<div class=\"col d-flex justify-content-center\">";
                    echo "<div id=\"border-login\">";
                    echo "<form action=\"\" id=\"site\" method=\"post\">";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"idl\" class=\"col-sm-4 col-form-label\">Location ID:&nbsp;</label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"idl\" value=\"{$row['location_id']}\" readonly required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"ipaddress\" class=\"col-sm-4 col-form-label\">IP:&nbsp; <i class=\"fas fa-server\"></i></label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"ipaddress\" placeholder=\"ไอพี หรือ โดเมนเนม\" value=\"{$row['ip_address']}\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"username\" class=\"col-sm-4 col-form-label\">Username:&nbsp; <i class=\"fas fa-user\"></i></label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"ชื่อใช้งาน\" value=\"{$row['username']}\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"password\" class=\"col-sm-4 col-form-label\">Password:&nbsp;<i class=\"fas fa-key\"></i></label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"password\" class=\"form-control\" name=\"password\" placeholder=\"รหัสผ่าน\" value=\"{$row['password']}\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"portapi\" class=\"col-sm-4 col-form-label\">API Port:</label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"portapi\" placeholder=\"พอร์ตเอพีไอ\" value=\"{$row['api_port']}\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"namesite\" class=\"col-sm-4 col-form-label\">Site Name:</label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<input type=\"text\" class=\"form-control\" name=\"namesite\" placeholder=\"ชื่อไซต์งาน\" value=\"{$row['working_site']}\" required>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"form-group row\">";
                    echo "<label for=\"b\" class=\"col-sm-4 col-form-label\"></label>";
                    echo "<div class=\"col-sm-8\">";
                    echo "<button type=\"submit\" name=\"connect\" class=\"btn btn-primary\">บันทึก</button>";
                    echo "<button type=\"bottom\" class=\"btn btn-danger\" onClick=\"history.go(-1); return false;\">ยกเลิก</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<div class=\"col d-flex justify-content-center\">";
                echo "<div id=\"border-login\">";
                echo "<form action=\"\" id=\"site\" method=\"post\">";
                echo "<div class=\"form-group row\">";
                echo "<label for=\"ipaddress\" class=\"col-sm-4 col-form-label\">IP:&nbsp; <i class=\"fas fa-server\"></i></label>";
                echo "<div class=\"col-sm-8\">";
                echo "<input type=\"text\" class=\"form-control\" name=\"ipaddress\" placeholder=\"ไอพี หรือ โดเมนเนม\" required>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"form-group row\">";
                echo "<label for=\"username\" class=\"col-sm-4 col-form-label\">Username:&nbsp; <i class=\"fas fa-user\"></i></label>";
                echo "<div class=\"col-sm-8\">";
                echo "<input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"ชื่อใช้งาน\" required>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"form-group row\">";
                echo "<label for=\"password\" class=\"col-sm-4 col-form-label\">Password:&nbsp;<i class=\"fas fa-key\"></i></label>";
                echo "<div class=\"col-sm-8\">";
                echo "<input type=\"password\" class=\"form-control\" name=\"password\" placeholder=\"รหัสผ่าน\" required>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"form-group row\">";
                echo "<label for=\"portapi\" class=\"col-sm-4 col-form-label\">API Port:</label>";
                echo "<div class=\"col-sm-8\">";
                echo "<input type=\"text\" class=\"form-control\" name=\"portapi\" placeholder=\"พอร์ตเอพีไอ\" required>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"form-group row\">";
                echo "<label for=\"namesite\" class=\"col-sm-4 col-form-label\">Site Name:</label>";
                echo "<div class=\"col-sm-8\">";
                echo "<input type=\"text\" class=\"form-control\" name=\"namesite\" placeholder=\"ชื่อไซต์งาน\" required>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"form-group row\">";
                echo "<label for=\"b\" class=\"col-sm-4 col-form-label\"></label>";
                echo "<div class=\"col-sm-8\">";
                echo "<button type=\"submit\" name=\"connect\" class=\"btn btn-primary\">บันทึก</button>";
                echo "<button type=\"bottom\" class=\"btn btn-danger\" onClick=\"history.go(-1); return false;\">ยกเลิก</button>";
                echo "</div>";
                echo "</div>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
            ?>
            <!-- <div class="col d-flex justify-content-center">
                                                                                    <div id="border-login">
                                                                                        <form action="" id="site" method="post">
                                                                                            <div class="form-group row">
                                                                                                <label for="ipaddress" class="col-sm-4 col-form-label">IP:&nbsp; <i class="fas fa-server"></i></label>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="text" class="form-control " name="ipaddress" placeholder="ไอพี หรือ โดเมนเนม" required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label for="username" class="col-sm-4 col-form-label">Username:&nbsp; <i class="fas fa-user"></i></label>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="text" class="form-control" name="username" placeholder="ชื่อใช้งาน" required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label for="password" class="col-sm-4 col-form-label">Password:&nbsp;<i class="fas fa-key"></i></label>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label for="portapi" class="col-sm-4 col-form-label">API Port:</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="text" class="form-control" name="portapi" placeholder="พอร์ตเอพีไอ" required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label for="namesite" class="col-sm-4 col-form-label">Site Name:</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="text" class="form-control" name="namesite" placeholder="ชื่อไซต์งาน" required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label for="b" class="col-sm-4 col-form-label"></label>
                                                                                                <div class="col-sm-8">
                                                                                                    <button type="submit" name="connect" class="btn btn-primary">บันทึก</button>
                                                                                                    <button type="bottom" class="btn btn-danger" onclick="window.location='connectstatus.php'">ยกเลิก</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div> -->
        </div>
    </div>
<?php } ?>