<?php
session_start();
include("../includes/template_backend/admin/page_link_config.php");
$admin_name = $_SESSION["admin_name"];
if (!$_SESSION["admin_id"]) {
    Header("Location:../index.php");
}
include('../includes/db_connect.php');
include('../process/admin/function.php');

$query = $conn->prepare("SELECT * FROM siteadmin GROUP BY site_name ORDER BY cus_id DESC");
$query->execute();
$result = $query->fetchAll();

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
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="row">
                                <div class="col-md" style="margin:10px 10px">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllMemberModal" id="deleteAllMemberModalBtn">
                                            <span class="glyphicon glyphicon-trash "></span>ลบข้อมูลแถวที่เลือก
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='site_register.php'">
                                            <img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="float-right">
                                        <div>
                                            <span class="badge-pill badge-danger">ลบ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table id="site_manage" class="table table-striped table-hover table-sm" style="width:100%">
                                    <thead class="aa">
                                        <tr>
                                            <th width="1%"><label class="checkbox">
                                                    <input type="checkbox" id="checkall" />
                                                    <span class="danger"></span>
                                                </label></th>
                                            <th width="1%">ID</th>
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
                            <div id="count-checked-checkboxes"></div>
                        </div>
                    </div>
                </div>
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
                <script src="../js/admin/register.js"></script>
            </div>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
    </div>
</body>

</html>