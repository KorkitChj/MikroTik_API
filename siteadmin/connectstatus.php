<?php
session_start();
include("../includes/template_backend/site_admin/page_link_config.php");
if (!$_SESSION["cus_id"]) {
    Header("Location:../home");
}
include('../process/site_admin/function.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once("../includes/template_backend/admin/head_tag_contents.php"); ?>
</head>

<body>
    <div class="modalx" style="display: none;"></div>
    <div class="page-wrapper chiller-theme toggled">
        <?php include("../includes/template_backend/admin/bar_top.php"); ?>
        <?php if (isset($_SESSION['service']) == "wait") { ?>

        <?php } else { ?>
            <?php include("../process/site_admin/alert_expired.php"); ?>
        <?php } ?>
        <?php include("../includes/template_backend/site_admin/navigation.php"); ?>
        <?php include('changpwsite.php'); ?>
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="box">
                            <div class="row">
                                <div class="col-md" style="margin-bottom:20px">
                                    <?php if (isset($_SESSION['service']) == "wait") { ?>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSiteModal" id="addSiteModalBtn" disabled>
                                                <span class="glyphicon glyphicon-plus "></span>&nbsp;&nbsp;เพิ่มสถานบริการ
                                            </button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllSiteModal" id="removeAllSiteModalBtn" disabled>
                                                <span class="glyphicon glyphicon-trash "></span>&nbsp;&nbsp;ลบข้อมูลแถวที่เลือก
                                            </button>
                                            <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='connect_status'" disabled><img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                                        </div>
                                    <?php } else { ?>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSiteModal" id="addSiteModalBtn">
                                                <span class="glyphicon glyphicon-plus "></span>&nbsp;&nbsp;เพิ่มสถานบริการ
                                            </button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllSiteModal" id="removeAllSiteModalBtn">
                                                <span class="glyphicon glyphicon-trash "></span>&nbsp;&nbsp;ลบข้อมูลแถวที่เลือก
                                            </button>
                                            <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='connect_status'"><img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md">
                                    <div class="float-right">
                                        <div>
                                            <span class="badge-pill badge-info">เข้าไซต์งาน</span>
                                            <span class="badge-pill badge-warning">แก้ไข</span>
                                            <span class="badge-pill badge-danger">ลบ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table id="connectstatus" class="table table-striped table-hover table-sm" style="width:100%">
                                    <thead class="aa">
                                        <tr>
                                            <th width="1%"><label class="checkbox">
                                                    <input type="checkbox" id="checkall" />
                                                    <span class="danger"></span>
                                                </label></th>
                                            <th>#</th>
                                            <th>IP Address/Port</th>
                                            <th>Username</th>
                                            <th>Site Name</th>
                                            <th>Logo</th>
                                            <th>Connect Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div id="count-checked-checkboxes"></div>
                        </div>
                    </div>
                </div>
                <div class="modal fade " tabindex="-1" role="dialog" id="addSiteModal">
                    <div class="modal-dialog modal-dialog-custom" role="document">
                        <div class="modal-content">
                            <form action="" id="addsite" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่มสถานบริการ</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ipaddress" class="col-sm control-label">หมายเลขไอพี: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
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
                                                <label for="username" class="col-sm control-label">Username: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
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
                                                <label for="password" class="col-sm control-label">รหัสผ่าน: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
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
                                                <label for="portapi" class="col-sm control-label">พอร์ตเอพีไอ: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
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
                                                <label for="namesite" class="col-sm control-label">ชื่อ Site: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
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
                                                <label for="siteimage" class="col-sm control-label">รูปภาพ Site: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                                <div class="col-sm-12 input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="far fa-file-image"></i>
                                                        </div>
                                                    </div>
                                                    <input type="file" name="site_image" id="site_image" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img id="add_connect" src="#" alt="your image" class="img-fluid rounded shadow-lg p-3 mb-5 bg-white" alt="Responsive image" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                        <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                                        <button type="submit" class="btn btn-success" id="addSiteBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade " tabindex="-1" role="dialog" id="editSiteModal">
                    <div class="modal-dialog modal-dialog-custom" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span>แก้ไขสถานบริการ</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="editSite" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="editipaddress" class="col-sm control-label">หมายเลขไอพี:&nbsp;</label>
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
                                                <label for="editpassword" class="col-sm control-label">รหัสผ่าน:&nbsp;</label>
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
                                                <label for="editportapi" class="col-sm control-label">พอร์ตเอพีไอ:&nbsp;</label>
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
                                                <label for="editnamesite" class="col-sm control-label">ชื่อ Site:&nbsp;</label>
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
                                                <label for="editsite_image" class="col-sm control-label">รูปภาพ Site:&nbsp;</label>
                                                <div class="col-sm-12 input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="far fa-file-image"></i>
                                                        </div>
                                                    </div>
                                                    <input type="file" name="editsite_image" id="editsite_image">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                                    <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                                                    <button type="submit" class="btn btn-success" id="editSiteBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <span id="site_uploaded_image"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
                <script src="../js/site_admin/connectstatus.js"></script>
            </div>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
            <?php include('../process/site_admin/useronlinejs_process.php'); ?>
        </main>
    </div>
</body>

</html>