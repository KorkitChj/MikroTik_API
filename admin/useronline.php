<?php
session_start();
?>
<?php
if (!$_SESSION["admin_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>User Online</title>
    <?php
    $admin_name = $_SESSION["admin_name"];
    require('../template/template.html');
    require('function.php');
    include('changpw.php');
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
                        <?php echo admin_image_profile($admin_name); ?>
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <strong><a class="navbar-brand" href="#"><span style="color:white;text-shadow:2px 2px black">Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["admin_name"]); ?></a></strong>
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
                        <li>
                            <a href="admin.php">
                                <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="checkpayment.php">
                                <i class="glyphicon glyphicon-check"></i>&nbsp;
                                ยืนยันการชำระเงิน</a>
                        </li>
                        <li>
                            <a href="manage.php">
                                <i class="glyphicon glyphicon-list"></i>&nbsp;
                                จัดการเจ้าของไซต์</a>
                        </li>
                        <li class="pad-a bor-red">
                            <a href="#">
                                <i class="glyphicon glyphicon-globe"></i>&nbsp;
                                User Online</a>
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
                <h2>User Online</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Online User Details</div>
                            <div id="user_login_status" class="panel-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
    <script>
        $(document).ready(function() {
            <?php
            if ($_SESSION["cus_id"]) {
                ?>
                fetch_user_login_data();
                setInterval(function() {
                    fetch_user_login_data();
                }, 3000);

                function fetch_user_login_data() {
                    var action = "fetch_data";
                    $.ajax({
                        url: "useronline_action.php",
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function(data) {
                            $('#user_login_status').html(data);
                        }
                    });
                } <?php
            } ?>
        });
    </script>
<?php } ?>