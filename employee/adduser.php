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
    <title>Add User</title>
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
                            <li class="nav-item dropdown active">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-wifi"></i></span>
                                    Hotspot
                                </a>
                                <div class="dropdown-menu">
                                    <a href="useronline.php" class="dropdown-item ">สถานะ User</a>
                                    <a href="useronlinegroup.php" class="dropdown-item ">สถานะ User กลุ่ม</a>
                                    <a href="#" class="dropdown-item active">เพิ่ม User ครั้งละ 1คน</a>
                                    <a href="addusergroup.php" class="dropdown-item">เพิ่ม User ครั้งละเป็นกลุ่ม</a>
                                    <a href="printuser.php" class="dropdown-item">ปริ้นคูปอง</a>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a href="changpwemp.php" class="nav-link">
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

 

    <div class="container color-custom ">
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <!--หน้าถัดจากBrandner-->
                <p>
                    <h3 style="font-weight:bold">เพิ่ม User ครั้งละ 1 คน</h3>
                </p>
            </div>
        </div>
        <div class="row ">
            <div class="col d-flex justify-content-center">
                <form action="#" method="post">
                    <div class="form-group row">
                        <label for="inputname" class="col-sm-3 col-form-label">Name: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control " id="inputname" placeholder="ชื่อลูกค้า" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputpassword" class="col-sm-3 col-form-label">Password:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputpassword" placeholder="รหัสผ่าน" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputcomment" class="col-sm-3 col-form-label">Comment:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputcomment" placeholder="แสดงความคิดเห็น" required>
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
                        <label for="inputuptime" class="col-sm-3 col-form-label">Up Time:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputuptime" placeholder="Up Time" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="qq" class="col-sm-3 col-form-label"></label>
                        <div class=" col-sm-9">
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                            <button type="bottom" class="btn btn-danger">ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.dropdown-menu li').on('click', function() {
                var getValue = $(this).text();
                $('.dropdown-select').text(getValue);
            });
        });
    </script>
<?php } ?>