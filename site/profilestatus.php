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
                            <div class="btn-group btn-group-toggle" data-toggle="buttons"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addProfileModal" id="addProfileModalBtn">
                                    <span class="glyphicon glyphicon-plus "></span>เพิ่ม Profile
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllProfileModal" id="removeAllProfileModalBtn">
                                    <span class="glyphicon glyphicon-trash "></span>ลบข้อมูลแถวที่เลือก
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='profilestatus.php'">
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
                        <table id="profilestatus" class="table table-striped table-hover  table-sm" style="width:100%">
                            <thead class="aa">
                                <tr>
                                    <th width="1%"></th>
                                    <th width="1%">#</th>
                                    <th width="3%">ชื่อ Profile</th>
                                    <th width="3%">อัตราการดาวโหลด/อัพโหลด(RX/TX)</th>
                                    <th width="3%">จำนวนผู้ใช้งาน</th>
                                    <th width="3%">จำนวนวันใช้งาน</th>
                                    <th width="3%">Options</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade " tabindex="-1" role="dialog" id="addProfileModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>เพิ่ม User Profile</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="addProfile" method="post">
                                <!-- <div class="form-group">
                                    <label for="profilename" class="col-sm control-label">ชื่อ Profile: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-credit-card"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="profilename" id="profilename" placeholder="uprof1" required>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label for="shared" class="col-sm control-label">จำนวนผู้ใช้งาน:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="shared" id="shared" placeholder="1"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="datelimit" class="col-sm control-label">จำนวนวันที่ใช้งานได้:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="datelimit" id="datelimit" placeholder="1 วัน">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="limit" class="col-sm control-label">อัตราการดาวโหลด/อัพโหลด:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-stats"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="limit" id="limit" placeholder="unlimited" value="unlimited">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="session" class="col-sm control-label">Session Timeout:(เวลาตัดการเชื่อมต่อในแต่ละครั้ง)&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-tasks"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="session" id="session" placeholder="00:00:00" value="00:00:00">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                    <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                                    <button type="submit" class="btn btn-success" id="addProfileBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade " tabindex="-1" role="dialog" id="editProfileModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span>แก้ไข User Profile</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="editProfile" method="post">
                                <!-- <div class="form-group">
                                    <label for="editprofilename" class="col-sm control-label">ชื่อ Profile:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-credit-card"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="editprofilename" id="editprofilename" placeholder="ชื่อ Profile" required>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label for="editshared" class="col-sm control-label">จำนวนผู้ใช้งาน:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="editshared" id="editshared" placeholder="จำนวนผู้ใช้งาน">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editdatelimit" class="col-sm control-label">จำนวนวันที่ใช้งานได้:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="editdatelimit" id="editdatelimit" placeholder="1 วัน">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editlimit" class="col-sm control-label">อัตราการดาวโหลด/อัพโหลด:&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-stats"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="editlimit" id="editlimit" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editsession" class="col-sm control-label">Session Timeout:(เวลาตัดการเชื่อมต่อในแต่ละครั้ง)&nbsp;</label>
                                    <div class="col-sm-12 input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="glyphicon glyphicon-tasks"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="editsession" id="editsession">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                    <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                                    <button type="submit" class="btn btn-success" id="editProfileBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="removeAllProfileModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Profile ที่เลือก</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <p>คุณต้องการลบ Profile ที่เลือก ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="button" class="btn btn-success" id="removeAllProfileBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="removeProfileModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบ Profile</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <p>คุณต้องการลบ Profile ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                            <button type="button" class="btn btn-success" id="removeProfileBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                        </div>
                    </div>
                </div>
            </div>
            <script src="../js/site_admin/profilestatus.js"></script>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
        <?php include('../process/site_admin/useronlinejs_process.php'); ?>
    </div>
</body>

</html>