<?php
session_start();
?>
<?php
require('../template/template.html');
require('../include/connect_db.php');
if (!$_SESSION["admin_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Chang Password</title>
    <style>
        #border-login {
            /* background: #e3e3e3; */
            /* background: url('../img/3.jpg');
            background-color: rgba(255, 0, 0, 0.4); */
            background:honeydew;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 1.5em;
            border-radius: 5px;
            /* box-shadow: 0px 0px 8px 4px rgb(0, 0, 0); */
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
                    <a class="navbar-brand" href="admin.php"><span style="color:red">Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["admin_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item   pad">
                                <a href="admin.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                    หน้าหลัก</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="checkpayment.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fas fa-user-check"></i></span>
                                    ยืนยันการชำระเงิน</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="manage.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-tasks"></i></span>
                                    จัดการเจ้าของไซต์</a>
                            </li>
                            <li class="nav-item active  pad">
                                <a href="#" class="nav-link active">
                                    <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                    เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="admin_logout.php" class="nav-link " onclick="return confirm('ยืนยันการออกจากระบบ')">
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
        <!-- <div class="row">
                        <div class="col d-flex justify-content-center">
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
                            <label for="inputoldpassword" class="control-label col-sm">รหัสผ่านเก่า:<i class="fas fa-key"></i></label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="oldpassword" placeholder="รหัสผ่านเก่า" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputnewpassword" class="control-label col-sm">รหัสผ่านใหม่:<i class="fas fa-key"></i></label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="newpassword" placeholder="รหัสผ่านใหม่" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputrenewpassword" class="control-label col-sm">ยืนยันรหัสผ่านใหม่:<i class="fas fa-key"></i></label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="renewpassword" placeholder="ยืนยันรหัสผ่านใหม่" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="b" class="control-label col-sm"></label>
                            <div class="col-sm-12">
                                <button type="submit" name="changpw" class=" btn btn-primary ">บันทึก</button>
                                <button type="bottom" class=" btn btn-danger "><a style="color:black;text-decoration:none" href="admin.php">ยกเลิก</a></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>