<?php
session_start();
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
<title>Server</title>
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
        $ARRAY = $API->comm("/ip/hotspot/profile/print");
        $ARRAY1 = $API->comm("/interface/print");
        $ARRAY2 = $API->comm("/ip/pool/print");
        $ARRAY3 = $API->comm("/ip/address/print");

        $cc = array();
        foreach ($ARRAY3 as $aa) {
            $cc[] = $aa['interface'] . "/" . $aa['address'];
        }
        $kk = array();
        foreach ($ARRAY1 as $ll) {
            $kk[] = $ll['name'];
        }
        rsort($kk);
        rsort($cc);
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
                                <li>
                                    <a href="addserverprofile.php" id="addserverprofileBtn">
                                        <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Server Profile
                                    </a>
                                </li>
                                <li class="pad-a bor-red">
                                    <a href="#" id="addserverBtn">
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
            <h2>รายการ Server</h2>
            <hr>
            <div style="margin-bottom:20px">
                <h5><a href="../siteadmin/connectstatus.php">หน้าหลัก</a>><a href="#" style="color:black;text-decoration:underline">Server</a></h5>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <button class="btn btn-primary pull pull-right" data-toggle="modal" data-target="#addServerModal" id="addServerModalBtn">
                            <span class="glyphicon glyphicon-plus "></span>เพิ่ม Server
                        </button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#removeAllServerModal" id="removeAllServerModalBtn">
                            <span class="glyphicon glyphicon-trash "></span>&nbsp;&nbsp;ลบข้อมูลแถวที่เลือก
                        </button>
                        <button type="button" class="btn btn-warning" onclick="window.location.href='addserver.php'">
                            <img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                    </div>
                    <br><br>
                    <div class="table-responsive">
                        <table id="addserver" class="table table-striped table-bordered table-hover table-sm" width="100%">
                            <thead>
                                <tr>
                                    <th width="1%"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="checkall" /><span class="custom-control-indicator"></span></label></th>
                                    <th width="1%">#</th>
                                    <th width="1%"></th>
                                    <th width="1%">Name</th>
                                    <th width="1%">Interface</th>
                                    <th width="1%">Address Pool</th>
                                    <th width="1%">Profile</th>
                                    <th width="1%">Options</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="ss"></div>
                </div>
            </div>
        </div>
    </main>
    <!-- page-content" -->
</div>
<!-- page-wrapper -->
<!-- addserver modal -->
<div class="modal fade " tabindex="-1" role="dialog" id="addServerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่ม Server</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="add_server" action="" method="post">
                    <div class="form-group">
                        <label for="name" class="col-sm control-label">Name Server: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-globe"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="name" id="name" placeholder="กรุณากรอกชื่อ Server" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="interface" class="col-sm control-label">Interface: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-globe"></i>
                                </div>
                            </div>
                            <select class="form-control" name="interface" size="1" id="interface">
                                <?php
                                    $num = count($kk);
                                    $num2 = count($cc);
                                    for ($i = 0; $i < $num; $i++) {
                                        if ($cc[$i] != '') {
                                            $xx = explode("/", $cc[$i]);
                                            if ($xx[0] == $kk[$i]) {
                                                $add = $xx[1];
                                            } else {
                                                $add = "";
                                            }
                                        } else {
                                            foreach ($cc as $num3) {
                                                $num4 = explode("/", $num3);
                                                if ($kk[$i] == $num4[0]) {
                                                    $add = $num4[1];
                                                    break;
                                                }
                                            }
                                        }
                                        echo '<option value="' . $kk[$i] . '">' . $kk[$i] . ": " . $add . '</option>';
                                        $add = "";
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pool" class="col-sm control-label">IP Pool:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </div>
                            </div>
                            <select class="form-control" name="pool" size="1" id="pool">
                                <?php
                                    echo '<option value="none">none</option>';
                                    $num = count($ARRAY2);
                                    for ($i = 0; $i < $num; $i++) {
                                        echo '<option value="' . $ARRAY2[$i]['name'] . '">' . $ARRAY2[$i]['name'] . ": " . $ARRAY2[$i]['ranges'] . '</option>';
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profile" class="col-sm control-label">Profile:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </div>
                            </div>
                            <select class="form-control" name="profile" size="1" id="profile">
                                <?php
                                    $num = count($ARRAY);
                                    for ($i = 0; $i < $num; $i++) {
                                        echo '<option value="' . $ARRAY[$i]['name'] . '">' . $ARRAY[$i]['name'] . ": " . $ARRAY[$i]['dns-name'] . '</option>';
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firewall" class="col-sm control-label">สวมหน้ากาก IP:&nbsp;</label>
                        <label class="custom-control custom-checkbox"><input type="checkbox" class="firewall_checkbox custom-control-input" name="firewall" id="firewall" value="masquerade" checked><span class="custom-control-indicator"></span></label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                        <button id="btnReset" class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                        <button type="submit" class="btn btn-success" id="addServerBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- editserver modal -->
<div class="modal fade " tabindex="-1" role="dialog" id="editServerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>แก้ไข Server</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="edit_server" action="" method="post">
                    <div class="form-group">
                        <label for="editname" class="col-sm control-label">Name Server:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-globe"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="editname" id="editname" placeholder="กรุณากรอกชื่อ Server" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editinterface" class="col-sm control-label">Interface:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-globe"></i>
                                </div>
                            </div>
                            <select class="form-control" name="editinterface" size="1" id="editinterface" required>
                                <?php
                                    $num = count($kk);
                                    $num2 = count($cc);
                                    for ($i = 0; $i < $num; $i++) {
                                        if ($cc[$i] != '') {
                                            $xx = explode("/", $cc[$i]);
                                            if ($xx[0] == $kk[$i]) {
                                                $add = $xx[1];
                                            } else {
                                                $add = "";
                                            }
                                        } else {
                                            foreach ($cc as $num3) {
                                                $num4 = explode("/", $num3);
                                                if ($kk[$i] == $num4[0]) {
                                                    $add = $num4[1];
                                                    break;
                                                }
                                            }
                                        }
                                        echo '<option value="' . $kk[$i] . '">' . $kk[$i] . ": " . $add . '</option>';
                                        $add = "";
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editpool" class="col-sm control-label">IP Pool:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </div>
                            </div>
                            <select class="form-control" name="editpool" size="1" id="editpool">
                                <?php
                                    echo '<option value="none">none</option>';
                                    $num = count($ARRAY2);
                                    for ($i = 0; $i < $num; $i++) {
                                        echo '<option value="' . $ARRAY2[$i]['name'] . '">' . $ARRAY2[$i]['name'] . ": " . $ARRAY2[$i]['ranges'] . '</option>';
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editprofile" class="col-sm control-label">Profile:&nbsp;</label>
                        <div class="col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </div>
                            </div>
                            <select class="form-control" name="editprofile" size="1" id="editprofile">
                                <?php
                                    $num = count($ARRAY);
                                    for ($i = 0; $i < $num; $i++) {
                                        echo '<option value="' . $ARRAY[$i]['name'] . '">' . $ARRAY[$i]['name'] . ": " . $ARRAY[$i]['dns-name'] . '</option>';
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                        <button id="editbtnReset" class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                        <button type="submit" class="btn btn-success" id="editServerBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- remove all modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeAllServerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Server ที่เลือก</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>คุณต้องการลบ Server ที่เลือก ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                <button type="button" class="btn btn-success" id="removeAllServerBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
            </div>
        </div>
    </div>
</div>
<!-- remove modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeServerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Address</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>คุณต้องการลบ Server ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                <button type="button" class="btn btn-success" id="removeServerBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
            </div>
        </div>
    </div>
</div>
<script src="../js/server.js"></script>
<?php } ?>