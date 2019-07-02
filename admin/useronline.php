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
    <div class="container-fluid">
        <div class="row">
            <div class="col ">
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-dark bor-yellow">
                    <?php echo admin_image_profile($admin_name); ?>
                    <a class="navbar-brand" href="admin.php"><span style="color:white;text-shadow:2px 2px black">Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["admin_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item  pad">
                                <a href="admin.php" class="nav-link">
                                    <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="checkpayment.php" class="nav-link ">
                                    <i class="glyphicon glyphicon-check"></i>&nbsp;
                                    ยืนยันการชำระเงิน</a>
                            </li>
                            <li class="nav-item pad">
                                <a href="manage.php" class="nav-link ">
                                    <i class="glyphicon glyphicon-list"></i>&nbsp;
                                    จัดการเจ้าของไซต์</a>
                            </li>
                            <li class="nav-item active pad-a">
                                <a href="#" class="nav-link active">
                                    <i class="glyphicon glyphicon-globe"></i>&nbsp;
                                    User Online</a>
                            </li>
                        </ul>
                        <div class="navbar-nav m dropdown">
                            <a data-toggle="dropdown" class="nav-link dropdown-toggle" href="">
                                <span class="glyphicon glyphicon-cog"></span>&nbsp;จัดการ
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                <li><a href="" data-toggle="modal" data-target="#changpwModal" class="dropdown-item">
                                        <i class="glyphicon glyphicon-edit"></i>
                                        เปลี่ยนรหัสผ่าน</a></li>
                                <li><a href="" class="dropdown-item" data-toggle="modal" data-target="#logoutModalCenter">
                                        <i class="glyphicon glyphicon-log-out"></i>
                                        ออกจากระบบ</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid box">
        <div class="row ">
            <div class="col">
                <br /><br />
                <div class="panel panel-default">
                    <div class="panel-heading">Online User Details</div>
                    <div id="user_login_status" class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
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
            } 
        <?php }?> 
    });
</script>
<?php } ?>