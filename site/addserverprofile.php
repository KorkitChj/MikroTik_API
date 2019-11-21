<?php
session_start();
include("../includes/template_backend/site_admin/page_link_config.php");
if (!$_SESSION["cus_id"]) {
    Header("Location:../home");
}
include('function.php');
error_reporting(0);
$cus_id = $_SESSION['cus_id'];
$location_id = $_SESSION['location_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

//include('service_fetch.php');

?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once("../includes/template_backend/admin/head_tag_contents.php"); ?>
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
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addServerProfileModal" id="addServerProfileModalBtn">
                                    <span class="glyphicon glyphicon-plus "></span>เพิ่ม Server Profile
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllServerPModal" id="removeAllServerPModalBtn">
                                    <span class="glyphicon glyphicon-trash "></span>&nbsp;&nbsp;ลบข้อมูลแถวที่เลือก
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='addserverprofile.php'">
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
                        <table id="serverprofile" class="table table-striped table-hover table-sm" width="100%">
                            <thead class="aa">
                                <tr>
                                    <th width="1%"><label class="checkbox">
                                            <input type="checkbox" id="checkall" />
                                            <span class="danger"></span>
                                        </label></th>
                                    <th width="1%">#</th>
                                    <th width="1%">Name</th>
                                    <th width="1%">Hotspot Address</th>
                                    <th width="1%">DNS Name</th>
                                    <th width="1%">Options</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade " tabindex="-1" role="dialog" id="addServerProfileModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่ม Server Profile</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="add_serverprofile" action="" method="post">
                                <div class="form-group">
                                    <label for="name" class="col-sm control-label">ชื่อ Server Profile: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-globe"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="กรุณากรอกชื่อ Server Profiles" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="hotadd" class="col-sm control-label">หมายเลขไอพี Hotspot: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-globe"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="hotadd" id="hotadd" placeholder="192.168.1.1" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dns" class="col-sm control-label">ชื่อ DNS: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="dns" id="dns" placeholder="tranghotal.com" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rate" class="col-sm control-label">อัตราการดาวโหลด/อัพโหลด:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="rate" id="rate" placeholder="10M/15M">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="cookie" name="cookie" id="cookie" checked>
                                            <label class="form-check-label" for="cookie">
                                                กำหนดให้ user ไม่ต้องเข้าสู่ระบบซ้ำ
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="maccookie" name="maccookie" id="maccookie">
                                            <label class="form-check-label" for="maccookie">
                                                กำหนดให้ user กรณีที่ไม่ต้องการให้ user ใช้ username ซ้ำจากอุปกรณ์เครื่องอื่น
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                    <button id="btnReset" class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                                    <button type="submit" class="btn btn-success" id="addServerprofileBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade " tabindex="-1" role="dialog" id="editServerProfileModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>แก้ไข Server Profile</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="edit_serverprofile" action="" method="post">
                                <div class="form-group">
                                    <label for="editname" class="col-sm control-label">ชื่อ Server Profile:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-globe"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="editname" id="editname" placeholder="กรุณากรอกชื่อ Server Profiles" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="edithotadd" class="col-sm control-label">หมายเลขไอพี Hotspot:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-globe"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="edithotadd" id="edithotadd" placeholder="192.168.1.1" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editdns" class="col-sm control-label">ชื่อ DNS:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="editdns" id="editdns" placeholder="tranghotal.com" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editrate" class="col-sm control-label">อัตราการดาวโหลด/อัพโหลด:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="editrate" id="editrate" placeholder="10M/15M">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="editcookie" name="editcookie" id="editcookie">
                                            <label class="form-check-label" for="editcookie">
                                                กำหนดให้ user ไม่ต้องเข้าสู่ระบบซ้ำ
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="editmaccookie" name="editmaccookie" id="editmaccookie">
                                            <label class="form-check-label" for="editmaccookie">
                                                กำหนดให้ user กรณีที่ไม่ต้องการให้ user ใช้ username ซ้ำจากอุปกรณ์เครื่องอื่น
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                    <button id="editbtnReset" class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                                    <button type="submit" class="btn btn-success" id="editServerprofileBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="removeAllServerPModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Pool ที่เลือก</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <p>คุณต้องการลบ Pool ที่เลือก ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="button" class="btn btn-success" id="removeAllServerPBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="removeServerProfileModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Server Profile</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <p>คุณต้องการลบ Server Profile?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="button" class="btn btn-success" id="removeServerPBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </div>
                </div>
            </div>
            <script src="../js/site_admin/serverprofile.js"></script>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
        <?php include('../process/site_admin/useronlinejs_process.php'); ?>
    </div>
</body>

</html>