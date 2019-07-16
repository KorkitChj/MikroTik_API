<?php
session_start();
?>
<?php
if (!$_SESSION["admin_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Admin</title>
    <?php
    $admin_name = $_SESSION["admin_name"];
    require('../template/template.html');
    require('function.php');
    include('changpw.php');
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
                        <?php echo admin_image_profile($admin_name); ?>
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <strong><a class="navbar-brand" href="#"><span style="color:white;text-shadow:2px 2px black">Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["admin_name"]); ?></a></strong>
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
                        <li class="pad-a bor-red">
                            <a href="#">
                                <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="checkpayment.php">
                                <i class="glyphicon glyphicon-check"></i>&nbsp;
                                ยืนยันการชำระเงิน</a>
                        </li>
                        <li>
                            <a href="manage.php">
                                <i class="glyphicon glyphicon-list"></i>&nbsp;
                                จัดการเจ้าของไซต์</a>
                        </li>
                        <li>
                            <a href="useronline.php">
                                <i class="glyphicon glyphicon-globe"></i>&nbsp;
                                User Online</a>
                        </li>
                        <li>
                            <a href="" data-toggle="modal" data-target="#changpwModal">
                                <i class="glyphicon glyphicon-edit"></i>&nbsp;
                                เปลี่ยนรหัสผ่าน</a>
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
                <h2>รายการลงทะเบียน</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <button class="btn btn-danger pull pull-right" data-toggle="modal" data-target="#removeAllMemberModal" id="deleteAllMemberModalBtn">
                            <span class="glyphicon glyphicon-trash "></span>ลบข้อมูลแถวที่เลือก
                        </button><br /><br />
                        <table id="site_manage" class="table table-striped table-hover display responsive nowrap" style="width:100%">
                            <thead class="btn-info">
                                <tr>
                                    <th width="1%"></th>
                                    <th width="2%">รายการสั่งซื้อ</th>
                                    <th width="1%">รหัส</th>
                                    <th width="3%">เจ้าของไซต์</th>
                                    <th width="3%">สถานบริการ</th>
                                    <th width="3%">เบอร์โทร</th>
                                    <th width="4%">E-mail</th>
                                    <th width="2%">ลบ</th>
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
    <!-- remove modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="removeMemberModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบสมาชิก</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบสมาชิก ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="removeBtn">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>
    <!-- remove all modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeAllMemberModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบสมาชิกที่เลือก</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบสมาชิกที่เลือก ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="removeAllBtn">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>
    <script src="admin_del.js"></script>
<?php } ?>