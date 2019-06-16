<?php
session_start();
?>
<?php
if (!$_SESSION["admin_id"]) {
    Header("Location:../login.php");
} else { ?>
    <?php
    require('../template/template.html');
    require('../include/connect_db.php');
    ?>
    <title>Admin</title>
    <style>
        .bg-info {
            background: #bdc3c7;
            background: linear-gradient(to bottom, #bdc3c7, #2c3e50);
            background: -webkit-linear-gradient(to bottom, #2c3e50, #bdc3c7);
        }
        th {
            color: darkblue;
        }
        td{
            color:white;
        }
        table.dataTable thead th{
            border-bottom: 0;
        }
        .pad-a{
            background-color:rgba(0, 0, 0, 0.3);
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col ">
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-danger">
                    <a class="navbar-brand" href="#"><span style="color:red">Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["admin_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item  active pad-a">
                                <a href="#" class="nav-link active">
                                    <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                    หน้าหลัก</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="checkpayment.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fas fa-user-check"></i></span>
                                    ยืนยันการชำระเงิน</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="manage.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-tasks"></i></span>
                                    จัดการเจ้าของไซต์</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="changpw.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                    เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="admin_logout.php" class="nav-link" onclick="return confirm('ยืนยันการออกจากระบบ')">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    ออกจากระบบ</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row ">
            <div class="col d-flex justify-content-center ">
                <!--หน้าถัดจากBrandner-->
                <p>
                    <h3 style="font-weight:bold ;margin-top:1em;color:white">ข้อมูลสถานบริการอินเตอร์เน็ต</h3>
                </p>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <form action="admin.php" method="post">
                    <table id="example" class="table table-striped table-hover table-sm" style="width:100%">
                        <thead class="bg-info">
                            <tr>
                                <th>ID</th>
                                <th>เจ้าของไซต์</th>
                                <th>สถานบริการ</th>
                                <th>เบอร์โทร</th>
                                <th>E-mail</th>
                                <!-- <th>ลบ</th> -->

                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                            $sql = "SELECT * FROM siteadmin ORDER BY cus_id ASC";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td><?php echo $row["cus_id"]; ?></td>
                                    <td><?php echo $row["username"]; ?></td>
                                    <td><?php echo $row["site_name"]; ?></td>
                                    <td><?php echo $row["work_phone"]; ?></td>
                                    <td><?php echo $row["e_mail"]; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php } ?>