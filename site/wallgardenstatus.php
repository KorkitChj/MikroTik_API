<?php
session_start();
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Wall Garden Status</title>
    <?php
    require('../template/template.html');
    include('../siteadmin/expired.php');
    include('../siteadmin/useronlinejs.php');
    include('../siteadmin/changpwsite.php');
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
                        <img src="../img/iconuser.jpg" alt="user" style="height:70px;width:60px">
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <strong><a class="navbar-brand" href="#"><span style="color:gray">Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["cus_name"]); ?></a></strong>
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
                            <a href="employeestatus.php">
                                <i class="glyphicon glyphicon-user"></i>
                                &nbsp;รายการพนักงานดูแล</a>
                        </li>
                        <li>
                            <a href="profilestatus.php">
                                <i class="glyphicon glyphicon-th-list"></i>
                                &nbsp;รายการ Profile</a>
                        </li>
                        <li class="pad-a bor-violet">
                            <a href="">
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
                <a href="#" data-toggle="modal" data-target="#logoutModalCenter">
                    <i class="fa fa-power-off">ออกจากระบบ</i>
                </a>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div class="container-fluid">
                <h2>รายการตั้งค่าเว็บไม่ต้อง Login</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary pull pull-right" data-toggle="modal" data-target="#addWallModal" id="addWallModalBtn">
                            <span class="glyphicon glyphicon-plus "></span>เพิ่ม Bypass
                        </button>
                        <button class="btn btn-danger pull pull-right" data-toggle="modal" data-target="#removeAllWallModal" id="removeAllWallModalBtn">
                            <span class="glyphicon glyphicon-trash "></span>ลบข้อมูลแถวที่เลือก
                        </button>
                        <br /><br />
                        <table id="wallstatus" class="table table-striped table-hover display responsive nowrap" style="width:100%">
                            <thead class="bg-info">
                                <tr>
                                    <th width="1%"></th>
                                    <th width="1%">#</th>
                                    <th width="3%">Domain Name</th>
                                    <th width="3%">Action</th>
                                    <th width="3%">Comment</th>
                                    <th width="3%">Manage</th>
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
    <!-- addsite modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="addWallModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่ม Bypass</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addWall" method="post">
                        <div class="form-group">
                            <label for="domainname" class="col-sm control-label">Domain Name:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-globe"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="domainname" id="domainname" placeholder="ชื่อเว็บไซต์" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="action" class="col-sm control-label">Action:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-wrench"></i>
                                    </div>
                                </div>
                                <select class="form-control" name="action" id="action" required>
                                    <option value="" selected disabled>จัดการ</option>
                                    <option value="accept">Accept</option>
                                    <option value="drop">Drop</option>
                                    <option value="reject">Reject</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment" class="col-sm control-label">Status:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-tasks"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="comment" id="comment" placeholder="หมายเหตุ" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary" id="addWallBtn">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- editsite modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="editWallModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span>แก้ไขรายการ Bypass</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editWall" method="post">
                        <div class="form-group">
                            <label for="editdomainname" class="col-sm control-label">Domain Name:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-globe"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editdomainname" id="editdomainname" placeholder="ชื่อเว็บไซต์" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editaction" class="col-sm control-label">Action:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-wrench"></i>
                                    </div>
                                </div>
                                <select class="form-control" name="editaction" id="editaction" required>
                                    <option value="" selected disabled>จัดการ</option>
                                    <option value="accept">Accept</option>
                                    <option value="drop">Drop</option>
                                    <option value="reject">Reject</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editcomment" class="col-sm control-label">Status:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-tasks"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editcomment" id="editcomment" placeholder="หมายเหตุ" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary" id="editWallBtn">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- remove all modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeAllWallModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Bypass ที่เลือก</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบ Bypass ที่เลือก ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="removeAllWallBtn">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>
    <!-- remove modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeWallModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Bypass</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบ Bypass ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="removeWallBtn">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>
    <script src="wallgardenstatus.js"></script>
<?php } ?>