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
    <title>Print User</title>
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
                            <li class="nav-item dropdown ">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge badge-primary"><i class="fas fa-wifi"></i></span>
                                    Hotspot
                                </a>
                                <div class="dropdown-menu active">
                                    <a href="useronline.php" class="dropdown-item ">สถานะ User</a>
                                    <a href="useronlinegroup.php" class="dropdown-item">สถานะ User กลุ่ม</a>
                                    <a href="adduser.php" class="dropdown-item">เพิ่ม User ครั้งละ 1คน</a>
                                    <a href="addusergroup.php" class="dropdown-item">เพิ่ม User ครั้งละเป็นกลุ่ม</a>
                                    <a href="#" class="dropdown-item active">ปริ้นคูปอง</a>
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
                <p>
                    <h3 style="font-weight:bold">ปริ้นคูปอง</h3>
                </p>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Profile</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Print</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="d1">
                            <td>1</td>
                            <td id="s1">1d</td>
                            <td id="f1">aaa</td>
                            <td id="u1">1234</td>
                            <td> <a class="btn btn-info" href="coupons.php">พิมพ์</a></td>
                            <td><a class="btn btn-danger" href="#">ลบ</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
      <?php } ?>