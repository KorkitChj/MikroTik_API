<?php
session_start();
?>
<?php
if (!$_SESSION["emp_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Users Status</title>
    <?php
    require('../template/template.html');

    $emp_id = $_SESSION['emp_id'];

    include('function.php');

    list($ip, $port, $user, $pass_r, $site, $conn, $API) = fatchuser($emp_id);

    if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
        $ARRAY = $API->comm("/ip/hotspot/user/profile/print");
        $num = count($ARRAY);
    }
    ?>
    <style>
        #coupong {
            background: #f1f1f1;
        }

        .th {
            background: #66ccff;
        }
    </style>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">Web API MikroTik</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img src="../img/iconuser.jpg" alt="user" style="height:70px;width:60px">
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <strong><a class="navbar-brand" href="#"><span style="color:gray">Employee</span>&nbsp;<?php print_r($_SESSION["emp_name"]); ?></a></strong>
                        </span>
                        <span class="user-role">พนักงาน</span>
                        <span class="user-status">
                            <i class="fa fa-circle"></i>
                            <span>Online</span>
                        </span>
                    </div>
                </div>
                <!-- sidebar-header  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>ทั่วไป</span>
                        </li>
                        <li>
                            <a href="dashboard.php">
                                <i class="glyphicon glyphicon-dashboard"></i>
                                &nbsp;Dashboard</a>
                        </li>
                        <li class="sidebar-dropdown pad-a bor-orange">
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                &nbsp;รายการ Users</a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#addUserModal" id="addUserModalBtn">
                                            <span class="fas fa-user "></span>&nbsp;เพิ่ม User ครั้งละ 1 คน
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#addUsersNumModal" id="addUsersNumModalBtn">
                                            <span class="fas fa-users "></span>&nbsp;เพิ่ม Users แบบกลุ่มตัวเลข 0-9
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#addUsersStringModal" id="addUsersStringModalBtn">
                                            <span class="fas fa-users "></span>&nbsp;เพิ่ม Users แบบกลุ่ม A-Z
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="employee.php">
                                <i class="glyphicon glyphicon-log-out"></i>&nbsp;
                                กลับหน้าหลัก</a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
            <div class="sidebar-footer">
                <a href="#" class="logout">
                    <i class="fas fa-sign-out-alt">ออกจากระบบ</i>
                </a>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div class="container-fluid">
                <h2>รายการ Users</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <button class="btn btn-danger pull pull-right" data-toggle="modal" data-target="#removeAllUsersModal" id="removeAllUsersModalBtn">
                            <span class="glyphicon glyphicon-trash "></span>&nbsp;&nbsp;ลบข้อมูลแถวที่เลือก
                        </button>
                        <button id="print" class="btn btn-success" type="submit"><i class="glyphicon glyphicon-print"></i>&nbsp;Print คูปอง&nbsp;</button>
                        <!-- <button id="check" class="btn btn-info" type="submit"><i class="glyphicon glyphicon-print"></i>&nbsp;Print คูปอง ทั้งหมด</button> -->
                        <!-- <button id="check" class="btn btn-info" type="submit"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="checkall"/><span class="custom-control-indicator"></span></label>Print คูปอง ทั้งหมด</button> -->
                        <br /><br />
                        <table id="userstatus" class="table table-striped table-hover table-bordered table-sm display responsive nowrap" style="width:100%">
                            <thead class="aa">
                                <tr>
                                    <th width="1%"></th>
                                    <th width="1%">#</th>
                                    <th width="3%">Name</th>
                                    <th width="3%">Profile</th>
                                    <th width="3%">Limit-UpTime</th>
                                    <th width="3%">UpTime</th>
                                    <th width="3%">Options</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
    <!-- adduser modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="addUserModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="fas fa-user"></span>เพิ่ม User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addUser" method="post">
                        <div class="form-group">
                            <label for="name" class="col-sm control-label">Name::&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อ" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm control-label">Password:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input type="password" class="form-control" name="password" id="password" placeholder="รหัสผ่าน" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profile" class="col-sm control-label">Profile:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                </div>
                                <select class="form-control" name="profile" id="profile" required>
                                    <option value="" selected disabled>Profile</option>
                                    <?php
                                    for ($i = 1; $i < $num; $i++) {
                                        echo '<option value="' . $ARRAY[$i]['name'] . '">' . $ARRAY[$i]['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="limituptime" class="col-sm control-label">Limit-Uptime:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="limituptime" id="limituptime" placeholder="หมดอายุ เช่น 1d 00:00:00" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment" class="col-sm control-label">Comment:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-comments"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="comment" id="comment" placeholder="แสดงความคิดเห็น" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="addUserBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- addusersnum modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addUsersNumModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="fas fa-users"></span>เพิ่ม Users แบบกลุ่มตัวเลข 0-9</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addUsersNum" method="post">
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="prefix">อักษรนำหน้า:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <input name="prefix" id="prefix" type="text" class="form-control" maxlength="5" placeholder="กรอกเป็นภาษาอังกฤษเท่านั้นตัวอย่าง:NB(สูงสุด3ตัวอักษร)" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="total">จำนวนผู้ใช้งาน:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="total" id="total" placeholder="กรุณากรอกจำนวนผู้ใช้งาน" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="username">จำนวนชื่อผู้ใช้:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <select class="form-control" name="username" size="1" id="username">
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5" selected="selected">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="passwordnum">จำนวนรหัสผ่าน:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                        </div>
                                        <select class="form-control" name="passwordnum" size="1" id="passwordnum">
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5" selected="selected">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="profiles">Profile:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-id-card"></i>
                                            </div>
                                        </div>
                                        <select class="form-control" name="profiles" id="profiles" required>
                                            <option value="" selected disabled>Profile</option>
                                            <?php
                                            for ($i = 1; $i < $num; $i++) {
                                                echo '<option value="' . $ARRAY[$i]['name'] . '">' . $ARRAY[$i]['name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="limituptimes">Limit-Uptime:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="limituptimes" id="limituptimes" placeholder="หมดอายุ เช่น 1d 00:00:00" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="comments">Comment:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-comments"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="comments" id="comments" placeholder="แสดงความคิดเห็น" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer row">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="addUsersBtnNum"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- addusersstring modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addUsersStringModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="fas fa-users"></span>เพิ่ม Users แบบกลุ่ม A-Z</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addUsersString" method="post">
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="prefixst">อักษรนำหน้า:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <input name="prefixst" id="prefixst" type="text" class="form-control" maxlength="5" placeholder="กรอกเป็นภาษาอังกฤษเท่านั้นตัวอย่าง:NB(สูงสุด3ตัวอักษร)" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="totalst">จำนวนผู้ใช้งาน:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="totalst" id="totalst" placeholder="กรุณากรอกจำนวนผู้ใช้งาน" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usernamest">จำนวนชื่อผู้ใช้:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <select class="form-control" name="usernamest" size="1" id="usernamest">
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5" selected="selected">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="passwordst">จำนวนรหัสผ่าน:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                        </div>
                                        <select class="form-control" name="passwordst" size="1" id="passwordst">
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5" selected="selected">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="profilest">Profile:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-id-card"></i>
                                            </div>
                                        </div>
                                        <select class="form-control" name="profilest" id="profilest" required>
                                            <option value="" selected disabled>Profile</option>
                                            <?php
                                            for ($i = 1; $i < $num; $i++) {
                                                echo '<option value="' . $ARRAY[$i]['name'] . '">' . $ARRAY[$i]['name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="limituptimest">Limit-Uptime:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="limituptimest" id="limituptimest" placeholder="หมดอายุ เช่น 1d 00:00:00" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="commentst">Comment:&nbsp;</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-comments"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="commentst" id="commentst" placeholder="แสดงความคิดเห็น" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer row">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="addUserstNum"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- editsite modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="editUserModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span>แก้ไข User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editUser" method="post">
                        <div class="form-group">
                            <label for="editname" class="col-sm control-label">Name::&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editname" id="editname" placeholder="ชื่อ" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editpassword" class="col-sm control-label">Password:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input type="password" class="form-control" name="editpassword" id="editpassword" placeholder="รหัสผ่าน" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editprofile" class="col-sm control-label">Profile:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                </div>
                                <select class="form-control" name="editprofile" id="editprofile" required>
                                    <option value="" selected disabled>Profile</option>
                                    <?php
                                    for ($i = 1; $i < $num; $i++) {
                                        echo '<option value="' . $ARRAY[$i]['name'] . '">' . $ARRAY[$i]['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editlimituptime" class="col-sm control-label">Limit-Uptime:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editlimituptime" id="editlimituptime" placeholder="หมดอายุ เช่น 1d 00:00:00" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editcomment" class="col-sm control-label">Comment:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-comments"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editcomment" id="editcomment" placeholder="แสดงความคิดเห็น" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="editUserBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- remove all modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeAllUsersModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Users ที่เลือก</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบ Users ที่เลือก ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="button" class="btn btn-success" id="removeAllUsersBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <!-- remove modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeUserModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบ User ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="button" class="btn btn-success" id="removeUserBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <script src="userstatus.js"></script>
    <script src="logout.js"></script>
<?php } ?>