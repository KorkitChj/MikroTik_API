<?php
session_start();
?>
<?php
if (!$_SESSION["admin_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Admin</title>
    <style>
        .oop{
            background:black;
        }
    </style>
    <?php
        $admin_name = $_SESSION["admin_name"];
        require('../include/connect_db.php');
        require('../template/template.html');
        require('function.php');
        include('changpw.php');

        $query = $conn->prepare("SELECT * FROM siteadmin GROUP BY site_name ORDER BY cus_id DESC");
        $query->execute();
        $result = $query->fetchAll();
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
                        <div id="load"><?php echo admin_image_profile($_SESSION["admin_id"]); ?></div><button class="btn btn-primary btn-sm" title="Add Image" data-toggle="modal" data-target="#addImageModal" id="addImageModalBtn"><i class="fas fa-user-plus"></i></button>
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <strong><a class="navbar-brand" href="#"><span style="color:gray">Admin</span>&nbsp;<?php print_r($_SESSION["admin_name"]); ?></a></strong>
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
                                <i class="fas fa-tachometer-alt"></i>&nbsp;dashboard</a>
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
                <a href="#" class="logout">
                    <i class="fas fa-sign-out-alt">ออกจากระบบ</i>
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
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllMemberModal" id="deleteAllMemberModalBtn">
                                <span class="glyphicon glyphicon-trash "></span>ลบข้อมูลแถวที่เลือก
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='admin.php'">
                                <img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button></div>
                        <br /><br />
                        <div class="box">
                            <div class="table-responsive">
                                <table id="site_manage" class="table table-striped table-hover table-sm" style="width:100%">
                                    <thead class="aa">
                                        <tr>
                                            <th width="1%"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="checkall" /><span class="custom-control-indicator"></span></label></th>
                                            <th width="2%">รายการสั่งซื้อ</th>
                                            <th width="1%">รหัส</th>
                                            <th width="3%">เจ้าของไซต์</th>
                                            <th width="3%">
                                                <select name="category" id="category" class="form-control">
                                                    <option value="">ค้นหาสถานบริการ</option>
                                                    <?php
                                                        foreach ($result as $row) {
                                                            echo '<option value="' . $row["site_name"] . '">' . $row["site_name"] . '</option>';
                                                        }
                                                        ?>
                                                </select>
                                            </th>
                                            <th width="3%">เบอร์โทร</th>
                                            <th width="4%">E-mail</th>
                                            <th width="2%">Option</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="button" class="btn btn-success" id="removeBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="button" class="btn btn-success" id="removeAllBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <!-- addprofile modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addImageModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formimage" action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title"><span class="fas fa-user-plus"></span>Add Image</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="image" class="col-sm control-label">Add Image:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                </div>
                                <input type="file" name="image" id="image">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                        <button type="submit" class="btn btn-success" id="addImageBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/admin.js"></script>
<?php } ?>