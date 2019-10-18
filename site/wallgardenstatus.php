<?php
session_start();
include("../includes/template_backend/site_admin/page_link_config.php");
if (!$_SESSION["cus_id"]) {
    Header("Location:../index.php");
}
include('function.php');
error_reporting(0);
$cus_id = $_SESSION['cus_id'];

//include('service_fetch.php');

?>
<!DOCTYPE html>
<html>

<head>
    <?php include("../includes/template_backend/admin/head_tag_contents.php"); ?>
</head>

<body>
    <?php include("../includes/template_backend/site_admin/bar_top.php"); ?>
    <div class="page-wrapper chiller-theme toggled">
        <?php include("../includes/template_backend/site_admin/navigation_site.php"); ?>
        <?php include('../siteadmin/changpwsite.php'); ?>
        <main class="page-content">
            <div class="form-group col-md-12">
                <div class="box">
                    <div class="row">
                        <div class="col-md" style=" margin-bottom:20px">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addWallModal" id="addWallModalBtn">
                                    <span class="glyphicon glyphicon-plus "></span>เพิ่ม Bypass
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllWallModal" id="removeAllWallModalBtn">
                                    <span class="glyphicon glyphicon-trash "></span>ลบข้อมูลแถวที่เลือก
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='wallgardenstatus.php'">
                                    <img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="float-right">
                                <span class="badge-pill badge-info">แก้ไข</span>
                                <span class="badge-pill badge-danger">ลบ</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="wallstatus" class="table table-striped table-hover table-sm display responsive nowrap" style="width:100%">
                            <thead class="aa">
                                <tr>
                                    <th width="1%"></th>
                                    <th width="1%">#</th>
                                    <th width="3%">Domain Name</th>
                                    <th width="3%">Action</th>
                                    <th width="3%">Comment</th>
                                    <th width="3%">Options</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
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
                                    <label for="domainname" class="col-sm control-label">ชื่อเว็บไซต์: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
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
                                    <label for="action" class="col-sm control-label">Action: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
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
                                    <label for="comment" class="col-sm control-label">แสดงความคิดเห็น: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-tasks"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="comment" id="comment" placeholder="แสดงความคิดเห็น" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                    <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                                    <button type="submit" class="btn btn-success" id="addWallBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <label for="editdomainname" class="col-sm control-label">ชื่อเว็บไซต์:&nbsp;</label>
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
                                    <label for="editcomment" class="col-sm control-label">แสดงความคิดเห็น:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-tasks"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="editcomment" id="editcomment" placeholder="แสดงความคิดเห็น" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                    <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                                    <button type="submit" class="btn btn-success" id="editWallBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="button" class="btn btn-success" id="removeAllWallBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </div>
                </div>
            </div>
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="button" class="btn btn-success" id="removeWallBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </div>
                </div>
            </div>
            <script src="../js/site_admin/wallgardenstatus.js"></script>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
        <?php include('../process/site_admin/useronlinejs_process.php'); ?>
    </div>
</body>

</html>