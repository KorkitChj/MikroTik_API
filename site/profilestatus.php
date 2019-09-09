<?php
session_start();
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Profile Status</title>
    <?php
        require('../template/template.html');
        include('../siteadmin/expired.php');
        include('../siteadmin/useronlinejs.php');
        include('../siteadmin/changpwsite.php');

        include('function.php');

        $location_id = $_SESSION['location_id'];
        $cus_id = $_SESSION['cus_id'];

        include('service_fetch.php');

        list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

        if ($API->connect($ip . ":" . $port, $user, $pass)) {
            $ARRAY = $API->comm("/ip/pool/print");
        }
        ?>
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
                        <?php echo fetchimage($cus_id); ?>
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <strong><a class="navbar-brand" href="#"><span style="color:gray">Admin</span>&nbsp;<?php print_r($_SESSION["cus_name"]); ?></a></strong>
                        </span>
                        <span class="user-role">ผู้ดูแล</span>
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
                        <li>
                            <a href="interfacemonitor.php">
                                <i class="glyphicon glyphicon-signal"></i>
                                &nbsp;Interface Monitor</a>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                &nbsp;รายการพนักงานดูแล</a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="employeestatus.php" id="addemployee">
                                            <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;เพิ่มพนักงาน
                                        </a>
                                    </li>
                                    <li>
                                        <a href="employeeactive.php" id="employeeactive">
                                            <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;พนักงานออนไลน์
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="glyphicon glyphicon-flag"></i>
                                &nbsp;Address List</a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="addresslist.php" id="addresslistBtn">
                                            <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Address List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pool.php" id="addPoolBtn">
                                            <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Address Pool
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="glyphicon glyphicon-wrench"></i>
                                &nbsp;Hotspot Setup</a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="addserverprofile.php" id="addserverprofileBtn">
                                            <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Server Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="addserver.php" id="addserverBtn">
                                            <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Server
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="pad-a bor-orange">
                            <a href="#">
                                <i class="glyphicon glyphicon-th-list"></i>
                                &nbsp;รายการ Profile</a>
                        </li>
                        <li>
                            <a href="wallgardenstatus.php">
                                <i class="glyphicon glyphicon-menu-hamburger"></i>
                                &nbsp;รายการ ByPass</a>
                        </li>
                        <li>
                            <a href="../siteadmin/connectstatus.php">
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
                <h2>รายการ Profiles</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addProfileModal" id="addProfileModalBtn">
                                <span class="glyphicon glyphicon-plus "></span>เพิ่ม Profile
                            </button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllProfileModal" id="removeAllProfileModalBtn">
                                <span class="glyphicon glyphicon-trash "></span>ลบข้อมูลแถวที่เลือก
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='profilestatus.php'">
                                <img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                        </div>
                        <br /><br />
                        <div class="box">
                            <table id="profilestatus" class="table table-striped table-hover  table-sm display responsive nowrap" style="width:100%">
                                <thead class="aa">
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="1%">#</th>
                                        <th width="3%">Profile</th>
                                        <th width="3%">Rate Limit(RX/TX)</th>
                                        <th width="3%">Shared User</th>
                                        <th width="3%">Mac Cookie Timeout</th>
                                        <th width="3%">Options</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
    <!-- addsite modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="addProfileModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่ม Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addProfile" method="post">
                        <div class="form-group">
                            <label for="profilename" class="col-sm control-label">Profile Name:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-credit-card"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="profilename" id="profilename" placeholder="uprof1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="adpool" class="col-sm control-label">Address Pool:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-credit-card"></i>
                                    </div>
                                </div>
                                <select class="form-control" name="adpool" size="1" id="adpool">
                                    <?php
                                        $num = count($ARRAY);
                                        echo '<option value="none">none</option>';
                                        for ($i = 0; $i < $num; $i++) {
                                            $seleceted = ($i == 0) ? 'selected="selected"' : '';
                                            echo '<option value="' . $ARRAY[$i]['name'] . $selected . '">' . $ARRAY[$i]['name'] . ": " . $ARRAY2[$i]['addresses'] .  '</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="idle" class="col-sm control-label">Idle Timeout:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-signal"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="idle" id="idle" placeholder="none" value="00:00:00">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="session" class="col-sm control-label">Session Timeout:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-tasks"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="session" id="session" placeholder="00:00:00" value="00:00:00">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="autorefresh" class="col-sm control-label">Auto Refresh:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-tasks"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="autorefresh" id="autorefresh" placeholder="00:01:00" value="00:01:00">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shared" class="col-sm control-label">Shared Users:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="shared" id="shared" placeholder="1" value="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mac" class="col-sm control-label">Mac Cookie Timeout:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-wrench"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="mac" id="mac" placeholder="3d 00:00:00" value="3d 00:00:00">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="limit" class="col-sm control-label">Rate Limit(RX/TX):&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-stats"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="limit" id="limit" placeholder="" value="0m/0m">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="addProfileBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- editsite modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="editProfileModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span>แก้ไข Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editProfile" method="post">
                        <div class="form-group">
                            <label for="editprofilename" class="col-sm control-label">Profile Name:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-credit-card"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editprofilename" id="editprofilename" placeholder="ชื่อ Profile" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editadpool" class="col-sm control-label">Address Pool:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-credit-card"></i>
                                    </div>
                                </div>
                                <select class="form-control" name="editadpool" size="1" id="editadpool">
                                    <?php
                                        $num = count($ARRAY);
                                        echo '<option value="none">none</option>';
                                        for ($i = 0; $i < $num; $i++) {
                                            $seleceted = ($i == 0) ? 'selected="selected"' : '';
                                            echo '<option value="' . $ARRAY[$i]['name'] . $selected . '">' . $ARRAY[$i]['name'] . '</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editidle" class="col-sm control-label">Idle Timeout:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-signal"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editidle" id="editidle" placeholder="เวลาตัดการเชื่อมต่อเมื่อ User ไม่ Active Pattern 00:00:00">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editsession" class="col-sm control-label">Session Timeout:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-tasks"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editsession" id="editsession">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editautorefresh" class="col-sm control-label">Auto Refresh:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-tasks"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editautorefresh" id="editautorefresh" placeholder="00:01:00">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editshared" class="col-sm control-label">Shared Users:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editshared" id="editshared" placeholder="จำนวนผู้ใช้งาน">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editmac" class="col-sm control-label">Mac Cookie Timeout:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-wrench"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editmac" id="editmac" placeholder="3d 00:00:00">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editlimit" class="col-sm control-label">Rate Limit(RX/TX):&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-stats"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editlimit" id="editlimit" placeholder="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="editProfileBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- remove all modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeAllProfileModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Profile ที่เลือก</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบ Profile ที่เลือก ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="button" class="btn btn-success" id="removeAllProfileBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <!-- remove modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeProfileModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบ Profile ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="button" class="btn btn-success" id="removeProfileBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/profilestatus.js"></script>
<?php } ?>