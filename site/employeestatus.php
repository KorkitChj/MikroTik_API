<?php
session_start();
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Employee Status</title>
    <?php
    require('../template/template.html');
    include('../siteadmin/expired.php');
    include('../siteadmin/useronlinejs.php');
    include('../siteadmin/changpwsite.php');
    include('function.php');

    $location_id = $_SESSION['location_id'];
    $cus_id = $_SESSION['cus_id'];

    list($ip,$port,$user,$pass,$site,$conn,$API) = fatchuser($cus_id,$location_id);
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
                        <li class="pad-a bor-red">
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                &nbsp;รายการพนักงานดูแล</a>
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
                <h2>รายการพนักงาน</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary pull pull-right" data-toggle="modal" data-target="#addMemberModal" id="addMemberModalBtn">
                            <span class="glyphicon glyphicon-plus "></span>เพิ่มพนักงาน
                        </button>
                        <button class="btn btn-danger pull pull-right" data-toggle="modal" data-target="#removeAllMemberModal" id="removeAllMemberModalBtn">
                            <span class="glyphicon glyphicon-trash "></span>ลบข้อมูลแถวที่เลือก
                        </button>
                        <br /><br />
                        <table id="employeestatus" class="table table-striped table-hover table-sm table-bordered display responsive nowrap" style="width:100%">
                            <thead class="aa">
                                <tr>
                                    <th width="1%"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="checkall"/><span class="custom-control-indicator"></span></label></th>
                                    <th width="1%">#</th>
                                    <th width="2%">ไซต์</th>
                                    <th width="2%">ชื่อ</th>
                                    <th width="2%">Username</th>
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
    <!-- addsite modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="addMemberModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่มพนักงาน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addMember" method="post">
                        <div class="form-group">
                            <label for="name" class="col-sm control-label">Full Name::&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อพนักงาน" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm control-label">Username:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="username" id="username" placeholder="ชื่อเข้าสู่ระบบ" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm control-label">Password:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-lock"></i>
                                    </div>
                                </div>
                                <input type="password" class="form-control" name="password" id="password" placeholder="รหัสผ่าน" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="site" class="col-sm control-label">Site:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-link"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="site" id="site" value="<?php echo $site ?>" readonly required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="addMemberBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- editsite modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="editMemberModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span>แก้ไขพนักงาน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editMember" method="post">
                        <div class="form-group">
                            <label for="editname" class="col-sm control-label">Full Name::&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editname" id="editname" placeholder="ชื่อพนักงาน" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editusername" class="col-sm control-label">Username:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editusername" id="editusername" placeholder="ชื่อเข้าสู่ระบบ" readonly required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editpassword" class="col-sm control-label">Password:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-lock"></i>
                                    </div>
                                </div>
                                <input type="password" class="form-control" name="editpassword" id="editpassword" placeholder="รหัสผ่าน" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editsite" class="col-sm control-label">Site:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-link"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editsite" id="editsite" readonly required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="editMemberBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- remove all modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeAllMemberModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบพนักงานที่เลือก</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบพนักงานที่เลือก ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="button" class="btn btn-success" id="removeAllMemberBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <!-- remove modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบพนักงาน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบพนักงาน ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="button" class="btn btn-success" id="removeMemberBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <script src="employeestatus.js"></script>
<?php } ?>