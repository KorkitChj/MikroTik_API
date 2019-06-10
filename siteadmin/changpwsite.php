<?php
session_start();
?>
<?php
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
    ?>
    <title>Chang Password Site</title>
    <style>
        #border-login {
            background:honeydew;
            padding: 1.5em;
            border-radius: 5px;
            background-repeat: no-repeat;
            background-size: cover;
            /* box-shadow: 0px 0px 12px 6px rgb(0, 0, 0); */
            margin-top: 5em;
            margin-bottom: 5em;
        }
        .btn-danger,
        .btn-primary {
            background-color: white;
            color: black;
        }
    </style>
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
                            <li class="nav-item ">
                                <a href="addconnect.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fas fa-hotel"></i></span>
                                    เพิ่มสถานบริการ</a>
                            </li>
                            <!-- <li class="nav-item dropdown ">
                                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                                <span class="badge badge-primary"><i class="fas fa-user"></i></span>
                                                พนักงานดูแล
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="employeestatus.php" class="dropdown-item ">สถานะพนักงาน</a>
                                                <a href="addemployee.php" class="dropdown-item ">เพิ่มพนักงาน</a>
                                            </div>
                                        </li>
                                        <li class="nav-item dropdown ">
                                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                                <span class="badge badge-primary"><i class="fas fa-wifi"></i></span>
                                                Hotspot
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="profilestatus.php" class="dropdown-item ">สถานะ Profile</a>
                                                <a href="addprofile.php" class="dropdown-item ">เพิ่ม Profile</a>
                                            </div>
                                        </li>
                                        <li class="nav-item dropdown ">
                                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                                <span class="badge badge-primary"><i class="fas fa-unlock"></i></span>
                                                Wall Garden
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="wallgardenstatus.php" class="dropdown-item ">สถานะ Wall Garden</a>
                                                <a href="addwallgarden.php" class="dropdown-item ">เพิ่ม Wall Garden</a>
                                            </div>
                                        </li> -->
                            <li class="nav-item active">
                                <a href="#" class="nav-link active">
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

    <div class="container">
        <!-- <div class="row ">
                <div class="col d-flex justify-content-center">
                    หน้าถัดจากBrandner
                    <p>
                        <h3 style="font-weight:bold">เปลี่ยนรหัสผ่าน</h3>
                    </p>
                </div>
            </div> -->
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <div id="border-login">
                    <form id="myform" action="../include/s_changpw.php" method="post" class="margin-custom">
                        <!-- <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>target="iframe_target" -->
                        <div class="form-group row">
                            <label for="oldpassword" class="control-label col-sm">รหัสผ่านเก่า:<i class="fas fa-key"></i></label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="oldpassword" placeholder="รหัสผ่านเก่า" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="newpassword" class="control-label col-sm">รหัสผ่านใหม่:<i class="fas fa-key"></i></label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="newpassword" placeholder="รหัสผ่านใหม่" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="renewpassword" class="control-label col-sm">ยืนยันรหัสผ่านใหม่:<i class="fas fa-key"></i></label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="renewpassword" placeholder="ยืนยันรหัสผ่านใหม่" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kkk" class="control-label col-sm"></label>
                            <div class="col-sm-12">
                                <button type="submit" name="changpw" class="btn btn-primary">บันทึก</button>
                                <button type="bottom" class="btn btn-danger"><a style="color:black;text-decoration:none" href="connectstatus.php">ยกเลิก</a></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>