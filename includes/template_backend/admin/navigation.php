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
                <li class="<?php if ($CURRENT_PAGE == "dashboard") { ?>pad-a<?php } ?>">
                    <a href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>&nbsp;สถิติ</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "siteregister") { ?>pad-a<?php } ?>">
                    <a href="site_register.php">
                        <i class="glyphicon glyphicon-registration-mark"></i>&nbsp;รายการลงทะเบียน</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "orderlist") { ?>pad-a<?php } ?>">
                    <a href="order_list.php">
                        <i class="glyphicon glyphicon-list"></i>&nbsp;รายการสั่งซื้อ</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "checkpayment") { ?>pad-a<?php } ?>">
                    <a href="checkpayment.php">
                        <i class="glyphicon glyphicon-check"></i>&nbsp;
                        รายการยืนยันชำระเงิน</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "manage") { ?>pad-a<?php } ?>">
                    <a href="manage.php">
                        <i class="glyphicon glyphicon-ok"></i>&nbsp;
                        ดำเนินการสมบูรณ์</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "useronline") { ?>pad-a<?php } ?>">
                    <a href="useronline.php">
                        <i class="glyphicon glyphicon-globe"></i>&nbsp;
                        รายการลูกค้าใช้งาน</a>
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
<script src="../js/admin_image.js"></script>