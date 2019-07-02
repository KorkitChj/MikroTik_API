<?php
session_start();
require('../template/template.html');
require('../include/connect_db.php');
require('../include/connect_db_router.php');
?>
<?php
if (!$_SESSION["emp_id"]) {
    Header("Location: login.php");
} else { ?>
    <style>
        .pad-a {
            background-color: rgba(0, 0, 0, 0.3);
        }

        #border-login {
            background-color: rgba(0, 0, 0, 0.3);
            padding: 1.5em;
            border-radius: 5px;
            margin-top: 0.5em;
            margin-bottom: 5em;
            border: white 2px dotted;
        }

        label {
            color: white;
        }
    </style>
    <title>Add User Group</title>
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
                                <a href="useronline.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    สถานะ User</a>
                            </li>
                            <li class="nav-item pad">
                                <a href="adduser.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    เพิ่ม User ครั้งละ 1คน</a>
                            </li>
                            <li class="nav-item active pad-a">
                                <a href="addusergroup.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    เพิ่ม User ครั้งละเป็นกลุ่ม</a>
                            </li>
                            <!-- <li class="nav-item pad">
                                <a href="printuser.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    คูปอง</a>
                            </li> -->
                            <li class="nav-item pad">
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

    <div class="container">
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <div id="border-login">
                    <form action="#" method="post">
                        <div class="form-group row">
                            <label for="inputprefix" class="col-sm-3 col-form-label">Prefix: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control " id="inputprefix" placeholder="อักษรนำหน้า" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputpassword" class="col-sm-3 col-form-label">Password Lenght:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputpassword" placeholder="จำนวนรหัสผ่าน" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputnamelength" class="col-sm-3 col-form-label">Name length:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputnamelength" placeholder="จำนวนชื่อ" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputcomment" class="col-sm-3 col-form-label">Comment:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputcomment" placeholder="Comment" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputprofile" class="col-sm-3 col-form-label">Profile:</label>
                            <div class="col-sm-9">
                                <select class="form-control">
                                    <option>1d</option>
                                    <option>2d</option>
                                    <option>3d</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputnumberusers" class="col-sm-3 col-form-label">Number Users:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputnumberusers" placeholder="จำนวนผู้ใช้งาน" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputuptime" class="col-sm-3 col-form-label">Up Time:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputuptime" placeholder="Up Time" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="o" class="col-sm-3 col-form-label"></label>
                            <div class=" col-sm-9">
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                <button type="bottom" class="btn btn-danger">ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>