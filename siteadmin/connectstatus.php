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
                        <li class="pad-a bor-red">
                            <a href="#">
                                <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
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
                <h2>Site</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary pull pull-right" data-toggle="modal" data-target="#addSiteModal" id="addSiteModalBtn">
                            <span class="glyphicon glyphicon-plus "></span>เพิ่มสถานบริการ
                        </button>
                        <button class="btn btn-danger pull pull-right" data-toggle="modal" data-target="#removeAllSiteModal" id="removeAllSiteModalBtn">
                            <span class="glyphicon glyphicon-trash "></span>ลบข้อมูลแถวที่เลือก
                        </button>
                        <a href="connectstatus.php"><img src="../img/refresh.png" width="20" title="Refresh"></a>
                        <br /><br />
                        <table id="connectstatus" class="table table-striped table-hover display responsive nowrap" style="width:100%">
                            <thead class="bg-info">
                                <tr>
                                    <th width="1%"></th>
                                    <th width="1%">#</th>
                                    <th width="5%">IP Address/Port</th>
                                    <th width="5%">Username</th>
                                    <th width="5%">Site Name</th>
                                    <th width="1%">ซีพียู</th>
                                    <th width="1%">แรม</th>
                                    <th width="1%">ฮาร์ดดิส</th>
                                    <th width="2%">Connect Status</th>
                                    <th width="4%">Manage</th>
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
    <div class="modal fade " tabindex="-1" role="dialog" id="addSiteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่มสถานบริการ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addsite" method="post">
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary" id="addSiteBtn">บันทึก</button>
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
                                <input type="password" class="form-control" name="editpassword" id="editpassword" placeholder="รหัสผ่าน" required>
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
                                <input type="text" class="form-control" name="editportapi" id="editportapi" placeholder="พอร์ตเอพีไอ" required>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary" id="editSiteBtn">บันทึก</button>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="removeAllSiteBtn">ยืนยัน</button>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="removeSiteBtn">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>
    <script src="connectstatus.js"></script>
<?php } ?>