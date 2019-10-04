<?php
session_start();
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Address List</title>
    <?php
        //error_reporting(0);
        require('../template/template.html');
        include('../siteadmin/expired.php');
        include('../siteadmin/useronlinejs.php');
        include('../siteadmin/changpwsite.php');
        include('function.php');

        $location_id = $_SESSION['location_id'];
        $cus_id = $_SESSION['cus_id'];

        list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

        if ($API->connect($ip . ":" . $port, $user, $pass)) {
            $ARRAY = $API->comm("/ip/address/print");
            $ARRAY1 = $API->comm("/interface/print");
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
                        <li class="sidebar-dropdown pad-a bor-red">
                            <a href="#">
                                <i class="glyphicon glyphicon-flag"></i>
                                &nbsp;Address List</a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li class="pad-a bor-red">
                                        <a href="#" id="addresslistBtn">
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
                <h2>รายการ IP Address</h2>
                <hr>
                <div class="row">
                    <div class="col-md">
                    <a href="../siteadmin/connectstatus.php">หน้าหลัก</a>><a href="#" style="color:black;text-decoration:underline">Address List</a>
                    </div>
                    <div class="ml-auto">
                        <div class="col-md">
                            <div id="disconnect">
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addIpModal" id="addIpModalBtn">
                                <span class="glyphicon glyphicon-plus "></span>เพิ่ม IP Address
                            </button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllAddressModal" id="removeAllAddressModalBtn">
                                <span class="glyphicon glyphicon-trash "></span>&nbsp;&nbsp;ลบข้อมูลแถวที่เลือก
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='addresslist.php'">
                                <img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button></div>
                        <div class="float-right">
                            <span class="badge-pill badge-success">เปิดใช้งาน</span>
                            <span class="badge-pill badge-warning">ปิดใช้งาน</span>
                            <span class="badge-pill badge-info">แก้ไข</span>
                            <span class="badge-pill badge-danger">ลบ</span>
                        </div>
                        <br><br>
                        <div class="box">
                            <div class="table-responsive">
                                <table id="ip_table" class="table table-striped table-hover table-sm" width="100%">
                                    <thead>
                                        <tr>
                                        <th width="1%"><label class="checkbox">
                                                    <input type="checkbox" id="checkall" />
                                                    <span class="danger"></span>
                                            </label></th>
                                            <th width="1%">#</th>
                                            <th width="1%"></th>
                                            <th width="1%">Address</th>
                                            <th width="1%">Network</th>
                                            <th width="1%">Interface</th>
                                            <th width="1%">comment</th>
                                            <th width="1%">Options</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div id="ss"></div>
                    </div>
                </div>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
    <!-- addip modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="addIpModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่ม IP Address</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="add_address" action="" method="post">
                        <div class="form-group">
                            <label for="address" class="col-sm control-label">หมายเลขไอพี: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-globe"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Ex: 192.168.10.1/24" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="network" class="col-sm control-label">หมายเลขเครือข่าย: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-globe"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="network" id="network" placeholder="Ex: 192.168.10.0" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment" class="col-sm control-label">แสดงความคิดเห็น:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="comment" id="comment" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="interface" class="col-sm control-label">อินเตอร์เฟส: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-link"></i>
                                    </div>
                                </div>
                                <select class="form-control" name="interface" size="1" id="interface" required>
                                    <?php
                                        $num = count($ARRAY1);
                                        for ($i = 0; $i < $num; $i++) {
                                            $seleceted = ($i == 0) ? 'selected="selected"' : '';
                                            echo '<option value="' . $ARRAY1[$i]['name'] . $selected . '">' . $ARRAY1[$i]['name'] . '</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button id="btnReset" class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="addIpBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- editip modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="editIpModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>แก้ไข IP Address</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="edit_address" action="" method="post">
                        <div class="form-group">
                            <label for="editaddress" class="col-sm control-label">หมายเลขไอพี:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-globe"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editaddress" id="editaddress" placeholder="Ex: 172.16.0.0/23" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editnetwork" class="col-sm control-label">หมายเลขเครือข่าย:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-globe"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editnetwork" id="editnetwork" placeholder="Ex:172.16.0.0" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editcomment" class="col-sm control-label">แสดงความคิดเห็น:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editcomment" id="editcomment" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editinterface" class="col-sm control-label">อินเตอร์เฟส:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-link"></i>
                                    </div>
                                </div>
                                <select class="form-control" name="editinterface" size="1" id="editinterface" required>
                                    <?php
                                        $num = count($ARRAY1);
                                        for ($i = 0; $i < $num; $i++) {
                                            $seleceted = ($i == 0) ? 'selected="selected"' : '';
                                            echo '<option value="' . $ARRAY1[$i]['name'] . $selected . '">' . $ARRAY1[$i]['name'] . '</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button id="editbtnReset" class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="editIpBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- remove all modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeAllAddressModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Address ที่เลือก</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบ Address ที่เลือก ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="button" class="btn btn-success" id="removeAllAddressBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <!-- remove modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeAddressModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Address</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบ Address ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="button" class="btn btn-success" id="removeAddressBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script src="../js/address.js"></script>
<script src="../js/alert_disconnect.js"></script>