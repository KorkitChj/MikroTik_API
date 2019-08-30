<?php
session_start();
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
<title>Server Profile</title>
<?php
    error_reporting(0);
    require('../template/template.html');
    include('../siteadmin/expired.php');
    include('../siteadmin/useronlinejs.php');
    include('../siteadmin/changpwsite.php');
    include('function.php');

    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];

    list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

    if ($API->connect($ip . ":" . $port, $user, $pass)) {
        $ARRAY = $API->comm("/ip/hotspot/user/profile/print");
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
                    <?php echo fetchimage($cus_id);?>
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
                    <li class="sidebar-dropdown pad-a bor-red">
                        <a href="#">
                            <i class="glyphicon glyphicon-wrench"></i>
                            &nbsp;Hotspot Setup</a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li class="pad-a bor-red">
                                    <a href="#" id="addserverprofileBtn">
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
                    <li>
                        <a href="profilestatus.php">
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
            <h2>รายการ Server Profile</h2>
            <hr>
            <div style="margin-bottom:20px"><h5><a href="../siteadmin/connectstatus.php">หน้าหลัก</a>><a href="#" style="color:black;text-decoration:underline">Server Profile</a></h5></div>
            <div class="row">
                <div class="form-group col-md-12">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <button class="btn btn-primary pull pull-right" data-toggle="modal" data-target="#addServerProfileModal" id="addServerProfileModalBtn">
                            <span class="glyphicon glyphicon-plus "></span>เพิ่ม Server Profile
                        </button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#removeAllServerPModal" id="removeAllServerPModalBtn">
                            <span class="glyphicon glyphicon-trash "></span>&nbsp;&nbsp;ลบข้อมูลแถวที่เลือก
                        </button>
                        <button type="button" class="btn btn-warning" onclick="window.location.href='addserverprofile.php'">
                            <img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                    </div>
                    <br><br>
                    <div class="table-responsive">
                        <table id="serverprofile" class="table table-striped table-bordered table-hover table-sm" width="100%">
                            <thead>
                                <tr>
                                    <th width="1%"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="checkall" /><span class="custom-control-indicator"></span></label></th>
                                    <th width="1%">#</th>
                                    <th width="1%"></th>
                                    <th width="1%">Name</th>
                                    <th width="1%">Hotspot Address</th>
                                    <th width="1%">DNS Name</th>
                                    <th width="1%">Rate Limit(rx/tx)</th>
                                    <th width="1%">Options</th>
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
<!-- addserverprofile modal -->
<div class="modal fade " tabindex="-1" role="dialog" id="addServerProfileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่ม Server Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="add_serverprofile" action="" method="post">
                    <div class="form-group">
                        <label for="name" class="col-sm control-label">Name Server Profile: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-globe"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="name" id="name" placeholder="กรุณากรอกชื่อ Server Profiles" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hotadd" class="col-sm control-label">Hotspot Address:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-globe"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="hotadd" id="hotadd" placeholder="192.168.1.1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dns" class="col-sm control-label">DNS Name:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="dns" id="dns" placeholder="tranghotal.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rate" class="col-sm control-label">Rate Limit(rx/tx):&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="rate" id="rate" placeholder="10M/15M">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                        <button id="btnReset" class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                        <button type="submit" class="btn btn-success" id="addServerprofileBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- editserverprofile modal -->
<div class="modal fade " tabindex="-1" role="dialog" id="editServerProfileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>แก้ไข Server Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="edit_serverprofile" action="" method="post">
                    <div class="form-group">
                        <label for="editname" class="col-sm control-label">Name Server Profile:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-globe"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="editname" id="editname" placeholder="กรุณากรอกชื่อ Server Profiles" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edithotadd" class="col-sm control-label">Hotspot Address:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-globe"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="edithotadd" id="edithotadd" placeholder="192.168.1.1" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editdns" class="col-sm control-label">DNS Name:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="editdns" id="editdns" placeholder="tranghotal.com" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editrate" class="col-sm control-label">Rate Limit(rx/tx):&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="editrate" id="editrate" placeholder="10M/15M">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                        <button id="editbtnReset" class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                        <button type="submit" class="btn btn-success" id="editServerprofileBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- remove all modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeAllServerPModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Pool ที่เลือก</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>คุณต้องการลบ Pool ที่เลือก ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                <button type="button" class="btn btn-success" id="removeAllServerPBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
            </div>
        </div>
    </div>
</div>
<!-- remove modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeServerProfileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Server Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>คุณต้องการลบ Server Profile?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                <button type="button" class="btn btn-success" id="removeServerPBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
            </div>
        </div>
    </div>
</div>
<!-- addTrialUserModal modal -->
<!-- <div class="modal fade " tabindex="-1" role="dialog" id="addTrialUserModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่ม Trial User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="add_trialuser.php" action="" method="post">
                        <div class="form-group">
                            <label for="login" class="col-sm control-label">Login By:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-globe"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="login" id="login" placeholder="Trial" value="trial" required readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="uptime" class="col-sm control-label">Trial UpTime Limit:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-globe"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="uptime" id="uptime" placeholder="00:30:00" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="uptimereset" class="col-sm control-label">Trial UpTime Reset:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="uptimereset" id="uptimereset" placeholder="1d 00:00:00" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trialprofile" class="col-sm control-label">Trial User Profile:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </div>
                                </div>
                                <select class="form-control" name="trialprofile" size="1" id="trialprofile">
                                    <?php
                                        $num = count($ARRAY);
                                        for ($i = 0; $i < $num; $i++) {
                                            $seleceted = ($i == 0) ? 'selected="selected"' : '';
                                            echo '<option value="' . $ARRAY[$i]['name'] . $selected . '">' . $ARRAY[$i]['name'] . '</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button id="addTrialbtnReset" class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="addTrialBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
<script src="../js/serverprofile.js"></script>
<?php } ?>