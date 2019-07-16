<?php
session_start();
?>
<?php
if (!$_SESSION["emp_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Chang Password Employee</title>
    <?php
    require('../template/template.html');
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
                            <strong><a class="navbar-brand" href="#"><span style="color:gray">Employee</span><span style="color:blue">|</span><?php print_r($_SESSION["emp_name"]); ?></a></strong>
                        </span>
                        <span class="user-role">พนักงาน</span>
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
                        <li>
                            <a href="employee.php">
                                <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
                        </li>
                        <li class="pad-a bor-green">
                            <a href="">
                                <i class="glyphicon glyphicon-edit"></i>&nbsp;
                                เปลี่ยนรหัสผ่าน</a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
            <div class="sidebar-footer">              
                <a href="emp_logout.php" class="logout fa fa-power-off" data-confirm="คุณต้องการออกจากระบบ?">ออกจากระบบ</a>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div class="container-fluid">
                <h2><i class="glyphicon glyphicon-edit"></i> เปลี่ยนรหัสผ่าน</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <form id="changpw" action="" method="post">
                            <div class="form-group">
                                <label for="oldpassword" class="control-label col-sm">รหัสผ่านเก่า:&nbsp;</label>
                                <div class="col-sm-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="glyphicon glyphicon-lock"></i>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="รหัสผ่านเก่า" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newpassword" class="control-label col-sm">รหัสผ่านใหม่:&nbsp;</label>
                                <div class="col-sm-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="glyphicon glyphicon-lock"></i>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="รหัสผ่านใหม่" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="renewpassword" class="control-label col-sm">ยืนยันรหัสผ่านใหม่:&nbsp;</label>
                                <div class="col-sm-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="glyphicon glyphicon-lock"></i>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control" name="renewpassword" id="renewpassword" placeholder="ยืนยันรหัสผ่านใหม่" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-sm"></label>
                                <div class="col-sm-12 input-group">
                                    <button type="button" class="btn btn-danger" onclick="history.back();">ยกเลิก</button>
                                    <button type="submit" class="btn btn-primary" id="submit">บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
    <script>
        $(document).ready(function() {
            $("#changpw").unbind('submit').bind('submit', function() {
                var form = $(this);
                var oldpassword = $("#oldpassword").val();
                var newpassword = $("#newpassword").val();
                var renewpassword= $("#renewpassword").val();
                if (oldpassword && newpassword && renewpassword) {
                    $.ajax({
                        url: 's_changpw.php',
                        type: 'POST',
                        data: form.serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.success == true) {
                                swal("สำเร็จ", response.messages, "success");
                                $("#changpw")[0].reset();
                            } else {
                                swal("ผิดพลาด", response.messages, "error");
                            }
                        }
                    });
                }
                return false;
            });
        });
    </script>
    <script src="logout.js"></script>
<?php } ?>