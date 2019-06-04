<?php
session_start();
require('../template/template.html');
require('../include/connect_db.php');
require('../include/connect_db_router.php');
?>
<?php
if (!$_SESSION["emp_id"]) {
    Header("Location:../login.php");
} else { ?>
    <style>
        .container {
            background-color: white;
            padding: 20px;
        }
    </style>
    <title>Chang Password Employee</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col ">
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="employee.php">Employee: <?php print_r($_SESSION["emp_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item ">
                                <a href="employee.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                    หน้าหลัก</a>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-wifi"></i></span>
                                    Hotspot
                                </a>
                                <div class="dropdown-menu">
                                    <a href="useronline.php" class="dropdown-item">สถานะ User</a>
                                    <a href="adduser.php" class="dropdown-item">เพิ่ม User ครั้งละ 1คน</a>
                                    <a href="useronlinegroup.php" class="dropdown-item">สถานะ User กลุ่ม</a>
                                    <a href="addusergroup.php" class="dropdown-item">เพิ่ม User ครั้งละเป็นกลุ่ม</a>
                                    <a href="printuser.php" class="dropdown-item">ปริ้นคูปอง</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a href="#" class="nav-link active">
                                    <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                    เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item">
                                <a href="emp_logout.php" class="nav-link ">
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

    <div class="container color-custom ">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <p>
                    <h3 style="font-weight:bold">เปลี่ยนรหัสผ่าน</h3>
                </p>
            </div>
        </div>
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <form id="myform" action="s_changpw.php" method="post" class="margin-custom" >
                    <!-- <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe> target="iframe_target"-->
                    <div class="form-group row">
                        <label for="inputoldpassword" class="control-label col-sm-4">รหัสผ่านเก่า:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="oldpassword" placeholder="รหัสผ่านเก่า" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputnewpassword" class="control-label col-sm-4">รหัสผ่านใหม่:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="newpassword" placeholder="รหัสผ่านใหม่" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputrenewpassword" class="control-label col-sm-4">ยืนยันรหัสผ่านใหม่:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="renewpassword" placeholder="ยืนยันรหัสผ่านใหม่" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="b" class="control-label col-sm-4"></label>
                        <div class="col-sm-8">
                            <button type="submit" name="changpw" class=" btn btn-primary ">บันทึก</button>
                            <button type="bottom" class=" btn btn-danger "><a style="color:#fff" href="admin.php">ยกเลิก</a></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>