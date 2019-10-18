<?php
session_start();
include("../includes/template_backend/admin/page_link_config.php");
$admin_name = $_SESSION["admin_name"];
if (!$_SESSION["admin_id"]) {
    Header("Location:../index.php");
}
include('../process/admin/function.php');

?>
<!DOCTYPE html>
<html>

<head>
    <?php include("../includes/template_backend/admin/head_tag_contents.php"); ?>
</head>

<body>
    <?php include("../includes/template_backend/admin/bar_top.php"); ?>
    <div class="page-wrapper chiller-theme toggled">
        <?php include("../includes/template_backend/admin/navigation.php"); ?>
        <?php include('changpw.php'); ?>
        <main class="page-content">
            <div class="container-fluid">
                <div class="box">
                    <div class="row">
                        <div class="col-md">
                            <div id="btn_padding" class="btn-group btn-group-toggle" data-toggle="buttons">
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllMemberModal" id="deleteAllMemberModalBtn">
                                    <span class="glyphicon glyphicon-trash"></span> ลบข้อมูลแถวที่เลือก
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='manage.php'">
                                    <img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect
                                </button>
                            </div>
                        </div>
                        <div class="col-md-5" style="margin:10px 10px">
                            <form id="date_picker" method="post">
                                <div class="box">
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="start_date">วันเริ่มต้น</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </div>
                                                        </div>
                                                        <input id="start_date" name="start_date" class="datepicker form-control" data-date-format="mm/dd/yyyy" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <label for="start_date">วันหมดอายุ</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="far fa-calendar-times"></i>
                                                            </div>
                                                        </div>
                                                        <input id="end_date" name="end_date" class="datepicker form-control" data-date-format="mm/dd/yyyy" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div style="margin-top:1em" class="col-md">
                                            <input type="submit" name="export" onclick="datepicker(); return false" value="ดาวโหลดไฟล์ CSV" class="btn-sm btn btn-info" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md">
                            <div class="float-right">
                                <span class="badge-pill badge-danger">ลบ</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="managemember" class="table table-sm table-striped table-hover " style="width:100%">
                            <thead class="aa">
                                <tr>
                                    <th width="1%"><label class="checkbox">
                                            <input type="checkbox" id="checkall" />
                                            <span class="danger"></span>
                                        </label></th>
                                    <th width="5%">เจ้าของไซต์</th>
                                    <th width="5%">สถานบริการ</th>
                                    <th width="2%">ราคา</th>
                                    <th width="3%">วันที่ชำระเงิน</th>
                                    <th width="3%">วันหมดอายุ</th>
                                    <th width="1%">Option</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
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
                <script src="../js/admin/manage.js"></script>
            </div>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
    </div>
</body>

</html>