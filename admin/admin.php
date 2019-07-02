<?php
session_start();
?>
<?php
if (!$_SESSION["admin_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Admin</title>
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
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-dark bor-orange">
                    <?php echo admin_image_profile($admin_name); ?>
                    <a class="navbar-brand" href="#"><span style="color:white;text-shadow:2px 2px black">Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["admin_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item  active pad-a">
                                <a href="#" class="nav-link active">
                                    <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="checkpayment.php" class="nav-link ">
                                    <i class="glyphicon glyphicon-check"></i>&nbsp;
                                    ยืนยันการชำระเงิน</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="manage.php" class="nav-link ">
                                    <i class="glyphicon glyphicon-list"></i>&nbsp;
                                    จัดการเจ้าของไซต์</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="useronline.php" class="nav-link ">
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
                                        <i class="glyphicon glyphicon-log-out"></i></span>
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
                <center>
                    <p>รายการลงทะเบียน</p>
                </center>
                <button class="btn btn-danger pull pull-right" data-toggle="modal" data-target="#removeAllMemberModal" id="deleteAllMemberModalBtn">
                    <span class="glyphicon glyphicon-trash "></span>ลบข้อมูลแถวที่เลือก
                </button><br /><br />
                <table id="site_manage" class="table table-striped table-hover table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="1%"></th>
                            <th width="3%">รายการสั่งซื้อ</th>
                            <th width="0.5%">รหัส</th>
                            <th width="5%">เจ้าของไซต์</th>
                            <th width="5%">สถานบริการ</th>
                            <th width="5%">เบอร์โทร</th>
                            <th width="5%">E-mail</th>
                            <th width="2%">ลบ</th>
                        </tr>
                    </thead>
                </table>
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
                    <p>คุณแน่ใจที่จะลบสมาชิก ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="removeBtn">Save changes</button>
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
                    <p>คุณแน่ใจที่จะลบสมาชิกที่เลือก ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="removeAllBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="admin_del.js"></script>
<?php } ?>