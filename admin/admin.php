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
    // $result = $conn->query("SELECT site_name,username,work_phone,c.paid
    //  FROM siteadmin AS a LEFT JOIN orderpd AS b ON
    //  a.cus_id = b.cus_id LEFT JOIN payment AS c ON
    //  b.order_id = c.order_id WHERE c.paid = 0");
        //$result = $conn->query("SELECT*FROM siteadmin");
    $result = $conn->query("SELECT*FROM siteadmin");
    //$result = $conn->query("SELECT*FROM siteadmin AS a  WHERE a.cus_id  NOT IN (SELECT cus_id FROM orderpd)");
    ?>
    <title>Admin</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col ">
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-danger">
                    <a class="navbar-brand" href="#"><span style="color:#ff6600">Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["admin_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item  active  pad">
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

    <div class="container-fluid">
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
                    <table id="example" class="table table-striped table-hover table-bordered table-dark table-sm" style="width:100%">
                        <thead class="bg-danger">
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

                            <?php while ($row = $result->fetch_array(MYSQLI_ASSOC)) {?>
                                <tr>
                                    <td><?php echo $row["cus_id"]; ?></td>
                                    <td><?php echo $row["username"]; ?></td>
                                    <td><?php echo $row["site_name"]; ?></td>
                                    <td><?php echo $row["work_phone"]; ?></td>
                                    <td><?php echo $row["e_mail"]; ?></td>
                                    <!-- <td><button type="button" id="trach" class="trach btn btn-danger btn-sm">
                                    <a href="JavaScript:if(confirm('Confirm Delete?') == true)
                                    {window.location='delete.php?cusid=
                                        <?php echo $row["cus_id"];?>';}"><span style="color:white" class="glyphicon glyphicon-trash"></span></a></button>
                                    </td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php } ?>