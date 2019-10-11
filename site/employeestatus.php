<?php
session_start();
include("../includes/template_backend/site_admin/page_link_config.php");
if (!$_SESSION["cus_id"]) {
    Header("Location:../index.php");
}
include('../process/site_admin/expired_process.php');
include('function.php');
error_reporting(0);
$cus_id = $_SESSION['cus_id'];
$location_id = $_SESSION['location_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/user/group/print");
}
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
                            <div class="btn-group btn-group-toggle" data-toggle="buttons"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMemberModal" id="addMemberModalBtn">
                                    <span class="glyphicon glyphicon-plus "></span>&nbsp;&nbsp;เพิ่มพนักงาน
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllMemberModal" id="removeAllMemberModalBtn">
                                    <span class="glyphicon glyphicon-trash "></span>&nbsp;&nbsp;ลบข้อมูลแถวที่เลือก
                                </button>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#manageUserGroup" id="manageUserGroupModalBtn">
                                    <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;เพิ่มกลุ่มพนักงาน
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='employeestatus.php'">
                                    <img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                            </div>
                        </div>
                        <div class="col-md ">
                            <div class="float-right">
                                <span class="badge-pill badge-success">เปิดใช้งาน</span>
                                <span class="badge-pill badge-warning">ปิดใช้งาน</span>
                                <span class="badge-pill badge-info">แก้ไข</span>
                                <span class="badge-pill badge-danger">ลบ</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="employeestatus" class="table table-striped table-hover table-sm " style="width:100%">
                            <thead class="aa">
                                <tr>
                                    <th width="1%"><label class="checkbox">
                                            <input type="checkbox" id="checkall" />
                                            <span class="danger"></span>
                                        </label></th>
                                    <th width="2%">Message</th>
                                    <th width="1%">#</th>
                                    <th width="1%"></th>
                                    <th width="2%">Username</th>
                                    <th width="2%">Group</th>
                                    <th width="2%">last-logged-in</th>
                                    <th width="3%">Options</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div id="ss"></div>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="manageUserGroup">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่มกลุ่มพนักงาน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="../process/site_admin_router/group_add_process.php" id="addGroup" method="post">
                        <div class="form-group">
                            <label for="namegroup" class="col-sm control-label">ชื่อกลุ่ม: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="namegroup" id="namegroup" placeholder="ชื่อกลุ่ม" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="polici" class="col-sm control-label">อนุญาติการใช้งาน: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                            <div class="col-sm-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="inlineCheckbox1" value="write">
                                    <label class="form-check-label" for="inlineCheckbox1">Write</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="inlineCheckbox2" value="read">
                                    <label class="form-check-label" for="inlineCheckbox2">Read</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="inlineCheckbox3" value="winbox">
                                    <label class="form-check-label" for="inlineCheckbox3">Winbox</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox4" name="inlineCheckbox4" value="api">
                                    <label class="form-check-label" for="inlineCheckbox4">Api</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox5" name="inlineCheckbox5" value="web">
                                    <label class="form-check-label" for="inlineCheckbox5">Web</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="addGroupBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                            <label for="name" class="col-sm control-label">ชื่อ-สกุล: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อ-สกุล" required>
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
                                <input type="text" class="form-control" name="username" id="username" placeholder="ชื่อเข้าสู่ระบบ" required>
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
                                <input type="password" class="form-control" name="password" id="password" placeholder="รหัสผ่าน ต้องมีค่ามากกว่าหรือเท่ากับ 8" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment" class="col-sm control-label">แสดงความคิดเห็น: &nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-credit-card"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="comment" id="comment" placeholder="แสดงความคิดเห็น">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="group" class="col-sm control-label">สิทธ์การใช้งาน: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-credit-card"></i>
                                    </div>
                                </div>
                                <select class="form-control" name="group" size="1" id="group" required>
                                    <?php
                                    $num = count($ARRAY);
                                    for ($i = 0; $i < $num; $i++) {
                                        $seleceted = ($i == 0) ? 'selected="selected"' : '';
                                        echo '<option value="' . $ARRAY[$i]['name'] . $selected . '">' . $ARRAY[$i]['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="site" class="col-sm control-label">ชื่อ Site: &nbsp;</label>
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
                            <label for="editname" class="col-sm control-label">ชื่อ-สกุล:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editname" id="editname" placeholder="ชื่อ-สกุล" required>
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
                            <label for="editpassword" class="col-sm control-label">รหัสผ่าน:&nbsp;</label>
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
                            <label for="editcomment" class="col-sm control-label">แสดงความคิดเห็น: &nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-credit-card"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editcomment" id="editcomment" placehoder="แสดงความคิดเห็น">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editgroup" class="col-sm control-label">สิทธ์การใช้งาน:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-credit-card"></i>
                                    </div>
                                </div>
                                <select class="form-control" name="editgroup" size="1" id="editgroup" required>
                                    <?php
                                    $num = count($ARRAY);
                                    for ($i = 0; $i < $num; $i++) {
                                        $seleceted = ($i == 0) ? 'selected="selected"' : '';
                                        echo '<option value="' . $ARRAY[$i]['name'] . $selected . '">' . $ARRAY[$i]['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editsite" class="col-sm control-label">ชื่อ Site: &nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-link"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="editsite" id="editsite" value="<?php echo $site ?>" readonly required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                            <button type="submit" class="btn btn-success" id="editMemberBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="messageMemberModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="fas fa-inbox"></span>&nbsp;Inbox</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h4 id="message"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;ปิด&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/site_admin/employeestatus.js"></script>
    <?php include('../process/site_admin/useronlinejs_process.php'); ?>
</body>

</html>