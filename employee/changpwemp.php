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
        /* .container {
                background-color: white;
                padding: 20px;
            } */

        #border-login {
            background-color: rgba(0, 0, 0, 0.3);
            padding: 1.5em;
            border-radius: 5px;
            margin-top: 5em;
            margin-bottom: 5em;
            border: white 2px dotted;
        }

        .btn-danger,
        .btn-primary {

            color: black;
        }

        label {
            color: white;
        }

        .fa-key {
            color: tomato;
        }

        .pad-a {
            background-color: rgba(0, 0, 0, 0.3);
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
                    <a class="navbar-brand" href="employee.php"><span style="color:White">Employee</span><span style="color:blue">|</span><?php print_r($_SESSION["emp_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item pad">
                                <a href="employee.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                    หน้าหลัก</a>
                                </a>
                            </li>
                            <li class="nav-item active pad-a">
                                <a href="#" class="nav-link active">
                                    <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                    เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item pad">
                                <a href="emp_logout.php" class="nav-link " onclick="return confirm('ยืนยันการออกจากระบบ')">
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
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <div id="border-login">
                    <form id="myform" action="s_changpw.php" method="post" class="margin-custom">
                        <div class="form-group row">
                            <label for="inputoldpassword" class="control-label col-sm">รหัสผ่านเก่า:</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="oldpassword" placeholder="รหัสผ่านเก่า" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputnewpassword" class="control-label col-sm">รหัสผ่านใหม่:</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="newpassword" placeholder="รหัสผ่านใหม่" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputrenewpassword" class="control-label col-sm">ยืนยันรหัสผ่านใหม่:</label>
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
    <?php } ?>