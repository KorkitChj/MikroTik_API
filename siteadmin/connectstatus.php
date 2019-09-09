<?php
session_start();
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Connect Status</title>
    <?php
        include('expired.php');
        require('../template/template.html');
        include('useronlinejs.php');
        include('changpwsite.php');
        include('function.php');
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
                        <div id="load"><?php echo fetchimage($_SESSION["cus_id"]); ?></div><button class="btn btn-primary btn-sm" title="Add Image" data-toggle="modal" data-target="#addImageModal" id="addImageModalBtn"><i class="fas fa-user-plus"></i></button>
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
                        <li class="pad-a bor-red">
                            <a href="#">
                                <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="invoice.php">
                                <i class="glyphicon glyphicon-paperclip"></i>&nbsp;Invoice</a>
                        </li>
                        <li>
                            <a href="" data-toggle="modal" data-target="#changpwModal">
                                <i class="glyphicon glyphicon-edit"></i>
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
                <h2>Site</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSiteModal" id="addSiteModalBtn">
                                <span class="glyphicon glyphicon-plus "></span>&nbsp;&nbsp;เพิ่มสถานบริการ
                            </button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllSiteModal" id="removeAllSiteModalBtn">
                                <span class="glyphicon glyphicon-trash "></span>&nbsp;&nbsp;ลบข้อมูลแถวที่เลือก
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='connectstatus.php'"><img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                        </div>
                        <br /><br />
                        <div class="box">
                            <div class="table-responsive">
                                <table id="connectstatus" class="table table-striped table-hover table-sm" style="width:100%">
                                    <thead class="aa">
                                        <tr>
                                            <th width="1%"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="checkall" /><span class="custom-control-indicator"></span></label></th>
                                            <th>#</th>
                                            <th>IP Address/Port</th>
                                            <th>Username</th>
                                            <th>Site Name</th>
                                            <th>Interface</th>
                                            <th>Status</th>
                                            <th>Expires-After</th>
                                            <th>Logo</th>
                                            <th>Connect Status</th>
                                            <th>Options</th>
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
    <!-- addsite modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="addSiteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่มสถานบริการ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addsite" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="ipaddress" class="col-sm control-label">IP:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-globe"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="ipaddress" id="ipaddress" placeholder="ไอพี หรือ โดเมนเนม" required>
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
                                <input type="text" class="form-control" name="username" id="username" placeholder="ชื่อใช้งาน" required>
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
                            <label for="portapi" class="col-sm control-label">API Port:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-link"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="portapi" id="portapi" placeholder="พอร์ตเอพีไอ" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="namesite" class="col-sm control-label">Site Name:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-cloud"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="namesite" id="namesite" placeholder="ชื่อไซต์งาน" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="siteimage" class="col-sm control-label">Site Image:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-file-image"></i>
                                    </div>
                                </div>
                                <input type="file" name="site_image" id="site_image" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="addSiteBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- editsite modal -->
    <div class="modal fade " tabindex="-1" role="dialog" id="editSiteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span>แก้ไขสถานบริการ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editSite" method="post">
                        <div class="form-group">
                            <label for="editipaddress" class="col-sm control-label">IP:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-globe"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editipaddress" id="editipaddress" placeholder="ไอพี หรือ โดเมนเนม" required>
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
                                <input type="text" class="form-control" name="editusername" id="editusername" placeholder="ชื่อใช้งาน" required>
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
                                <input type="password" class="form-control" name="editpassword" id="editpassword" placeholder="รหัสผ่าน">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editportapi" class="col-sm control-label">API Port:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-link"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editportapi" id="editportapi" placeholder="พอร์ตเอพีไอ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editnamesite" class="col-sm control-label">Site Name:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-cloud"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editnamesite" id="editnamesite" placeholder="ชื่อไซต์งาน" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editsite" class="col-sm control-label">Site Image:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-file-image"></i>
                                    </div>
                                </div>
                                <input type="file" name="editsite_image" id="editsite_image">
                                <span id="site_uploaded_image"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="editSiteBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- remove all modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeAllSiteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบไซต์ที่เลือก</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบไซต์ที่เลือก ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="button" class="btn btn-success" id="removeAllSiteBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <!-- remove modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeSiteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบไซต์</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการลบไซต์ ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                    <button type="button" class="btn btn-success" id="removeSiteBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
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
    <script src="../js/connectstatus.js"></script>
<?php } ?>